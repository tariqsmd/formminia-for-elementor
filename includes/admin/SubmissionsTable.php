<?php

namespace MTForms\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (!class_exists('WP_List_Table')) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

use MTForms\Services\SubmissionRepository;

/**
 * List Table class for MTForms submissions.
 */
class SubmissionsTable extends \WP_List_Table
{
	/** @var SubmissionRepository */
	protected $repository;

	public function __construct()
	{
		parent::__construct([
			'singular' => __('Submission', MTFORMS_TEXT_DOMAIN),
			'plural'   => __('Submissions', MTFORMS_TEXT_DOMAIN),
			'ajax'     => false,
		]);

		$this->repository = new SubmissionRepository();
	}

	public function get_columns()
	{
		return [
			'cb'         => '<input type="checkbox" />',
			'name'       => __('Name', MTFORMS_TEXT_DOMAIN),
			'email'      => __('Email', MTFORMS_TEXT_DOMAIN),
			'subject'    => __('Subject', MTFORMS_TEXT_DOMAIN),
			'message'    => __('Message', MTFORMS_TEXT_DOMAIN),
			'created_at' => __('Date', MTFORMS_TEXT_DOMAIN),
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
				return esc_html(print_r($item, true));
		}
	}

	protected function column_cb($item)
	{
		return sprintf(
			'<input type="checkbox" name="submission[]" value="%s" />',
			$item['id']
		);
	}

	protected function column_name($item)
	{
		$actions = [
			'delete' => sprintf(
				'<a href="?page=%s&action=%s&submission=%s&_wpnonce=%s">%s</a>',
				esc_attr(sanitize_text_field(wp_unslash($_REQUEST['page']))),
				'delete',
				absint($item['id']),
				wp_create_nonce('mtforms_delete_submission'),
				__('Delete', MTFORMS_TEXT_DOMAIN)
			),
		];

		return sprintf('%1$s %2$s', esc_html($item['name']), $this->row_actions($actions));
	}

	public function prepare_items()
	{
		$per_page = 20;
		$current_page = $this->get_pagenum();
		$search = isset($_REQUEST['s']) ? sanitize_text_field($_REQUEST['s']) : '';

		$this->_column_headers = [$this->get_columns(), [], $this->get_sortable_columns()];

		$this->process_bulk_action();

		$total_items = $this->repository->get_total_count($search);
		$this->items = $this->repository->get_submissions($per_page, ($current_page - 1) * $per_page, $search);

		$this->set_pagination_args([
			'total_items' => $total_items,
			'per_page'    => $per_page,
		]);
	}

	public function get_bulk_actions()
	{
		return [
			'bulk-delete' => __('Delete', MTFORMS_TEXT_DOMAIN),
		];
	}

	protected function process_bulk_action()
	{
		if ('delete' === $this->current_action()) {
			$nonce = isset($_REQUEST['_wpnonce']) ? esc_attr($_REQUEST['_wpnonce']) : '';
			if (!wp_verify_nonce($nonce, 'mtforms_delete_submission')) {
				die('Security check failed');
			}

			if (isset($_GET['submission'])) {
				$this->repository->delete(absint($_GET['submission']));
				echo '<div class="updated"><p>' . __('Submission deleted.', MTFORMS_TEXT_DOMAIN) . '</p></div>';
			}
		}

		$action2 = isset($_REQUEST['action2']) ? sanitize_text_field(wp_unslash($_REQUEST['action2'])) : '';

		if (('bulk-delete' === $this->current_action() || 'bulk-delete' === $action2) && isset($_REQUEST['submission'])) {
			$submissions = array_map('absint', $_REQUEST['submission']);
			foreach ($submissions as $id) {
				$this->repository->delete($id);
			}
			echo '<div class="updated"><p>' . __('Submissions deleted.', MTFORMS_TEXT_DOMAIN) . '</p></div>';
		}
	}
}
