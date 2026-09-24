<?php

namespace FORMMINIA\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (!class_exists('WP_List_Table')) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

use FORMMINIA\Services\SubmissionRepository;

/**
 * List Table class for FormMinia for Elementor submissions.
 */
class SubmissionsTable extends \WP_List_Table
{
	/** @var SubmissionRepository */
	protected $repository;

	public function __construct()
	{
		parent::__construct([
			'singular' => __('Submission', 'formminia-for-elementor'),
			'plural'   => __('Submissions', 'formminia-for-elementor'),
			'ajax'     => false,
		]);

		$this->repository = new SubmissionRepository();
	}

	public function get_columns()
	{
		return [
			'cb'         => '<input type="checkbox" />',
			'name'       => __('Name', 'formminia-for-elementor'),
			'email'      => __('Email', 'formminia-for-elementor'),
			'subject'    => __('Subject', 'formminia-for-elementor'),
			'message'    => __('Message', 'formminia-for-elementor'),
			'created_at' => __('Date', 'formminia-for-elementor'),
		];
	}

	protected function get_sortable_columns()
	{
		return [
			'name'       => ['name', false],
			'email'      => ['email', false],
			'created_at' => ['created_at', true],
		];
	}

	protected function column_default($item, $column_name)
	{
		switch ($column_name) {
			case 'name':
			case 'email':
			case 'subject':
			case 'created_at':
				return esc_html($item[$column_name]);
			case 'message':
				return nl2br(esc_html($item[$column_name]));
			default:
				return isset($item[$column_name]) ? esc_html($item[$column_name]) : '';
		}
	}

	protected function column_cb($item)
	{
		return sprintf(
			'<input type="checkbox" name="submission[]" value="%s" />',
			esc_attr(absint($item['id']))
		);
	}

protected function column_name($item)
	{
		// List-table page slug is read from the URL for building row links only (no state change).
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$page = isset($_REQUEST['page']) ? sanitize_text_field(wp_unslash($_REQUEST['page'])) : 'formminia';

		$actions = [
			'delete' => sprintf(
				'<a href="?page=%s&action=%s&submission=%s&_wpnonce=%s">%s</a>',
				esc_attr($page),
				'delete',
				absint($item['id']),
				wp_create_nonce('formminia_delete_submission'),
				__('Delete', 'formminia-for-elementor')
			),
		];

		return sprintf('%1$s %2$s', esc_html($item['name']), $this->row_actions($actions));
	}

	public function prepare_items()
	{
		$per_page = 20;
		$current_page = $this->get_pagenum();
		// Search term is read from the URL for list filtering only (no state change).
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$search = isset($_REQUEST['s']) ? sanitize_text_field(wp_unslash($_REQUEST['s'])) : '';
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$orderby = isset($_REQUEST['orderby']) ? sanitize_text_field(wp_unslash($_REQUEST['orderby'])) : 'created_at';
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$order = isset($_REQUEST['order']) ? strtoupper(sanitize_text_field(wp_unslash($_REQUEST['order']))) : 'DESC';

		$this->_column_headers = [$this->get_columns(), [], $this->get_sortable_columns()];

		$this->process_bulk_action();

		$total_items = $this->repository->get_total_count($search);
		$this->items = $this->repository->get_submissions($per_page, ($current_page - 1) * $per_page, $search, $orderby, $order);

		$this->set_pagination_args([
			'total_items' => $total_items,
			'per_page'    => $per_page,
		]);
	}

	public function get_bulk_actions()
	{
		return [
			'bulk-delete' => __('Delete', 'formminia-for-elementor'),
		];
	}

	protected function process_bulk_action()
	{
		if (!current_user_can('manage_options')) {
			wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'formminia-for-elementor'));
		}

		if ('delete' === $this->current_action()) {
			$nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])) : '';
			if (!wp_verify_nonce($nonce, 'formminia_delete_submission')) {
				wp_die(esc_html__('Security check failed.', 'formminia-for-elementor'));
			}

			if (isset($_GET['submission'])) {
				$this->repository->delete(absint($_GET['submission']));
				echo '<div class="updated"><p>' . esc_html__('Submission deleted.', 'formminia-for-elementor') . '</p></div>';
			}
		}

		$action  = isset($_REQUEST['action']) ? sanitize_text_field(wp_unslash($_REQUEST['action'])) : '';
		$action2 = isset($_REQUEST['action2']) ? sanitize_text_field(wp_unslash($_REQUEST['action2'])) : '';

		if (('bulk-delete' === $action || 'bulk-delete' === $action2) && isset($_REQUEST['submission'])) {
			$nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field(wp_unslash($_REQUEST['_wpnonce'])) : '';
			if (!wp_verify_nonce($nonce, 'bulk-submissions')) {
				wp_die(esc_html__('Security check failed.', 'formminia-for-elementor'));
			}

			$submissions = array_map('absint', (array) $_REQUEST['submission']);
			foreach ($submissions as $id) {
				$this->repository->delete($id);
			}
			echo '<div class="updated"><p>' . esc_html__('Submissions deleted.', 'formminia-for-elementor') . '</p></div>';
		}
	}
}
