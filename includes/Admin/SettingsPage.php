<?php

namespace MTEF\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MTEF\Admin\SubmissionsTable;

/**
 * Admin settings page for FormMinia for Elementor.
 *
 * Modern, namespaced counterpart to the legacy MTEF_Admin class.
 */
class SettingsPage
{

	/** @var string */
	private $plugin_name;

	/** @var string */
	private $version;

	/**
	 * @param string $plugin_name Plugin slug.
	 * @param string $version     Plugin version.
	 */
	public function __construct($plugin_name, $version)
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @param string $hook Current admin page hook suffix.
	 */
	public function enqueue_styles($hook)
	{
		if ('toplevel_page_mtef' !== $hook && 'mtef_page_mtef-submissions' !== $hook) {
			return;
		}

		wp_enqueue_style(
			$this->plugin_name,
			MTEF_PLUGIN_URL . 'assets/admin/css/mtef-admin.min.css',
			array(),
			$this->version,
			'all'
		);

		wp_enqueue_style('wp-color-picker');
	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @param string $hook Current admin page hook suffix.
	 */
	public function enqueue_scripts($hook)
	{
		if ('toplevel_page_mtef' !== $hook && 'mtef_page_mtef-submissions' !== $hook) {
			return;
		}

		wp_enqueue_media();

		wp_enqueue_script(
			$this->plugin_name,
			MTEF_PLUGIN_URL . 'assets/admin/js/mtef-admin.js',
			array('jquery', 'wp-color-picker'),
			$this->version,
			true
		);
	}

	/**
	 * Register the top-level admin menu.
	 */
	public function add_admin_menu()
	{
		add_menu_page(
			__('FormMinia for Elementor', 'formminia-for-elementor'),
			__('FormMinia', 'formminia-for-elementor'),
			'manage_options',
			'mtef',
			array($this, 'display_plugin_setup_page'),
			'dashicons-email',
			79
		);

		add_submenu_page(
			'mtef',
			__('Settings', 'formminia-for-elementor'),
			__('Settings', 'formminia-for-elementor'),
			'manage_options',
			'mtef',
			array($this, 'display_plugin_setup_page')
		);

		add_submenu_page(
			'mtef',
			__('Submissions', 'formminia-for-elementor'),
			__('Submissions', 'formminia-for-elementor'),
			'manage_options',
			'mtef-submissions',
			array($this, 'display_submissions_page')
		);
	}

	/**
	 * Render the submissions page.
	 */
	public function display_submissions_page()
	{
		$table = new SubmissionsTable();
		$table->prepare_items();
		?>
		<div class="wrap">
			<h1 class="wp-heading-inline"><?php esc_html_e('FormMinia for Elementor Submissions', 'formminia-for-elementor'); ?></h1>
			<a href="<?php echo esc_url(wp_nonce_url(add_query_arg('action', 'export_csv'), 'mtef_export_csv')); ?>" class="page-title-action"><?php esc_html_e('Export to CSV', 'formminia-for-elementor'); ?></a>
			<hr class="wp-header-end">

			<form method="post">
				<?php wp_nonce_field('bulk-submissions'); ?>
				<!-- Page slug echo only; no state change. -->
				<?php // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- The form carries its own nonce; this read is for a hidden field only. ?>
				<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page']) ? esc_attr(sanitize_text_field(wp_unslash($_REQUEST['page']))) : 'mtef-submissions'; ?>" />
				<?php
				$table->search_box(esc_html__('Search Submissions', 'formminia-for-elementor'), 'submission');
				$table->display();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Handle the CSV export request before any output is sent.
	 *
	 * Hooked to admin_init so the download headers are never preceded by
	 * admin panel markup.
	 */
	public function maybe_handle_export_csv()
	{
		if (!isset($_GET['page']) || 'mtef-submissions' !== $_GET['page']) {
			return;
		}

		if (!isset($_GET['action']) || 'export_csv' !== $_GET['action']) {
			return;
		}

		if (!current_user_can('manage_options')) {
			wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'formminia-for-elementor'));
		}

		if (!isset($_GET['_wpnonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_GET['_wpnonce'])), 'mtef_export_csv')) {
			wp_die(esc_html__('Security check failed.', 'formminia-for-elementor'));
		}

		$this->handle_export_csv();
	}

	/**
	 * Register plugin settings.
	 */
	public function register_settings()
	{
		// General Tab - All captcha-related settings will be here now
		register_setting(Options::GROUP_GENERAL, Options::CAPTCHA_PROVIDER, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_GENERAL, Options::RECAPTCHA_SITE_KEY, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_GENERAL, Options::RECAPTCHA_SECRET_KEY, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_GENERAL, Options::TURNSTILE_SITE_KEY, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_GENERAL, Options::TURNSTILE_SECRET_KEY, ['sanitize_callback' => 'sanitize_text_field']);

		// Email Tab
		register_setting(Options::GROUP_EMAIL, Options::ADMIN_EMAIL, ['sanitize_callback' => 'sanitize_email']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_SUBJECT, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_FROM_NAME, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_EMAIL, Options::ENABLE_HTML_EMAIL, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_ACCENT_COLOR, ['sanitize_callback' => 'sanitize_hex_color']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_LOGO_URL, ['sanitize_callback' => 'esc_url_raw']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_FOOTER_TEXT, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_BG_COLOR, ['sanitize_callback' => 'sanitize_hex_color']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_CONTENT_BG_COLOR, ['sanitize_callback' => 'sanitize_hex_color']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_TEXT_COLOR, ['sanitize_callback' => 'sanitize_hex_color']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_SHOW_FOOTER_CREDIT, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_CC, ['sanitize_callback' => 'MTEF\Admin\SettingsPage::sanitize_email_list']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_BCC, ['sanitize_callback' => 'MTEF\Admin\SettingsPage::sanitize_email_list']);
	}

	/**
	 * Sanitize a comma-separated list of email addresses.
	 *
	 * WordPress's sanitize_email() only accepts a single address, so lists
	 * are validated address by address and re-joined.
	 *
	 * @param mixed $value Raw option value.
	 *
	 * @return string
	 */
	public static function sanitize_email_list($value)
	{
		if (!is_string($value)) {
			return '';
		}

		$emails = array_map('trim', explode(',', $value));
		$valid = array_unique(array_filter($emails, 'is_email'));

		return implode(', ', $valid);
	}

	/**
	 * Show an admin notice when the Elementor dependency is inactive.
	 *
	 * Displayed only on FormMinia for Elementor admin screens.
	 */
	public function maybe_display_elementor_notice()
	{
		$screen = function_exists('get_current_screen') ? get_current_screen() : null;
		if (!$screen || strpos((string) $screen->id, 'mtef') === false) {
			return;
		}

		if (defined('ELEMENTOR_VERSION')) {
			return;
		}

		echo '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('FormMinia for Elementor requires the Elementor plugin to build forms. Install and activate Elementor to get started.', 'formminia-for-elementor') . '</p></div>';
	}

	/**
	 * Render the plugin settings page.
	 */
	public function display_plugin_setup_page()
	{
		$path = MTEF_PLUGIN_DIR . 'includes/Admin/settings-view.php';
		if (file_exists($path)) {
			include_once $path;
		}
	}

	/**
	 * Handle CSV export.
	 */
	protected function handle_export_csv()
	{
		if (!current_user_can('manage_options')) {
			wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'formminia-for-elementor'));
		}

		$repository = new \MTEF\Services\SubmissionRepository();
		$submissions = $repository->get_submissions(1000, 0); // Export last 1000 submissions

		if (empty($submissions)) {
			return;
		}

		$filename = 'mtef-submissions-' . wp_date('Y-m-d') . '.csv';

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $filename);

		$output = fopen('php://output', 'w');

		// Header row.
		fputcsv($output, [
			__('ID', 'formminia-for-elementor'),
			__('Name', 'formminia-for-elementor'),
			__('Email', 'formminia-for-elementor'),
			__('Phone', 'formminia-for-elementor'),
			__('Website', 'formminia-for-elementor'),
			__('Subject', 'formminia-for-elementor'),
			__('Message', 'formminia-for-elementor'),
			__('Form ID', 'formminia-for-elementor'),
			__('IP Address', 'formminia-for-elementor'),
			__('Date', 'formminia-for-elementor'),
		]);

		foreach ($submissions as $submission) {
			fputcsv($output, [
				$submission['id'],
				$submission['name'],
				$submission['email'],
				$submission['phone'],
				$submission['website'],
				$submission['subject'],
				$submission['message'],
				$submission['form_id'],
				$submission['ip_address'],
				$submission['created_at'],
			]);
		}

		// CSV is streamed straight to the browser via php://output, so WP_Filesystem does not apply.
		fclose( $output ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose
		exit;
	}
}
