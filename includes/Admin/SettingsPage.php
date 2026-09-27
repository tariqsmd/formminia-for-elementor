<?php

namespace FORMMINIA\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use FORMMINIA\Admin\SubmissionsTable;

/**
 * Admin settings page for FormMinia for Elementor.
 *
 * Modern, namespaced counterpart to the legacy FORMMINIA_Admin class.
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
		if ('toplevel_page_formminia' !== $hook && 'formminia_page_formminia-submissions' !== $hook) {
			return;
		}

		wp_enqueue_style(
			$this->plugin_name,
			FORMMINIA_PLUGIN_URL . 'assets/admin/css/formminia-admin.min.css',
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
		if ('toplevel_page_formminia' !== $hook && 'formminia_page_formminia-submissions' !== $hook) {
			return;
		}

		wp_enqueue_media();

		wp_enqueue_script(
			$this->plugin_name,
			FORMMINIA_PLUGIN_URL . 'assets/admin/js/formminia-admin.js',
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
			'formminia',
			array($this, 'display_plugin_setup_page'),
			'dashicons-email',
			79
		);

		add_submenu_page(
			'formminia',
			__('Settings', 'formminia-for-elementor'),
			__('Settings', 'formminia-for-elementor'),
			'manage_options',
			'formminia',
			array($this, 'display_plugin_setup_page')
		);

		add_submenu_page(
			'formminia',
			__('Submissions', 'formminia-for-elementor'),
			__('Submissions', 'formminia-for-elementor'),
			'manage_options',
			'formminia-submissions',
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
			<a href="<?php echo esc_url(wp_nonce_url(add_query_arg('action', 'export_csv'), 'formminia_export_csv')); ?>" class="page-title-action"><?php esc_html_e('Export to CSV', 'formminia-for-elementor'); ?></a>
			<hr class="wp-header-end">

			<form method="post">
				<?php wp_nonce_field('bulk-submissions'); ?>
				<!-- Page slug echo only; no state change. -->
				<?php // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- The form carries its own nonce; this read is for a hidden field only. ?>
				<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page']) ? esc_attr(sanitize_text_field(wp_unslash($_REQUEST['page']))) : 'formminia-submissions'; ?>" />
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
		if (!isset($_GET['page']) || 'formminia-submissions' !== $_GET['page']) {
			return;
		}

		if (!isset($_GET['action']) || 'export_csv' !== $_GET['action']) {
			return;
		}

		if (!current_user_can('manage_options')) {
			wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'formminia-for-elementor'));
		}

		if (!isset($_GET['_wpnonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_GET['_wpnonce'])), 'formminia_export_csv')) {
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

		// Email Tab - Notification Routing only
		register_setting(Options::GROUP_EMAIL, Options::ADMIN_EMAIL, ['sanitize_callback' => 'sanitize_email']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_SUBJECT, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_FROM_NAME, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_CC, ['sanitize_callback' => 'FORMMINIA\Admin\SettingsPage::sanitize_email_list']);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_BCC, ['sanitize_callback' => 'FORMMINIA\Admin\SettingsPage::sanitize_email_list']);

		// Template Tab - Email template branding & colors
		register_setting(Options::GROUP_TEMPLATE, Options::ENABLE_HTML_EMAIL, ['sanitize_callback' => 'sanitize_text_field']);
		register_setting(Options::GROUP_TEMPLATE, Options::EMAIL_ACCENT_COLOR, ['sanitize_callback' => 'sanitize_hex_color']);
		register_setting(Options::GROUP_TEMPLATE, Options::EMAIL_LOGO_URL, ['sanitize_callback' => 'esc_url_raw']);
		register_setting(Options::GROUP_TEMPLATE, Options::EMAIL_FOOTER_TEXT, ['sanitize_callback' => 'sanitize_textarea_field']);
		register_setting(Options::GROUP_TEMPLATE, Options::EMAIL_BG_COLOR, ['sanitize_callback' => 'sanitize_hex_color']);
		register_setting(Options::GROUP_TEMPLATE, Options::EMAIL_CONTENT_BG_COLOR, ['sanitize_callback' => 'sanitize_hex_color']);
		register_setting(Options::GROUP_TEMPLATE, Options::EMAIL_TEXT_COLOR, ['sanitize_callback' => 'sanitize_hex_color']);
		register_setting(Options::GROUP_TEMPLATE, Options::EMAIL_SHOW_FOOTER_CREDIT, ['sanitize_callback' => 'sanitize_text_field']);
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
	 * Show an admin notice when Elementor is not installed or active.
	 *
	 * Elementor is an optional dependency: the plugin activates without it and
	 * the widget is simply unavailable until Elementor is present. The notice is
	 * shown on the screens where a user is most likely to need it.
	 */
	public function maybe_display_elementor_notice()
	{
		if ($this->is_elementor_active()) {
			return;
		}

		$screen = function_exists('get_current_screen') ? get_current_screen() : null;
		if (!$screen) {
			return;
		}

		$screen_id    = (string) $screen->id;
		$is_formminia = strpos($screen_id, 'formminia') !== false;

		if (!$is_formminia && !in_array($screen_id, array('dashboard', 'plugins', 'plugins-network'), true)) {
			return;
		}

		if (!current_user_can('activate_plugins')) {
			return;
		}

		$is_installed = $this->is_elementor_installed();

		if ($is_formminia) {
			$message = $is_installed
				? __('Elementor is installed but inactive. Activate Elementor to build forms with the Contact Form widget.', 'formminia-for-elementor')
				: __('FormMinia for Elementor needs the Elementor plugin before you can build forms. Install Elementor to get the Contact Form widget.', 'formminia-for-elementor');
		} else {
			$message = $is_installed
				? __('FormMinia for Elementor is active, but Elementor is installed and inactive. Your existing forms and submissions keep working. Activate Elementor to get the Contact Form widget.', 'formminia-for-elementor')
				: __('FormMinia for Elementor is active, but Elementor is not installed. Your existing forms and submissions keep working. Install Elementor to get the Contact Form widget.', 'formminia-for-elementor');
		}

		printf(
			'<div class="notice notice-warning"><p>%s <a href="%s" class="button button-primary">%s</a></p></div>',
			esc_html($message),
			esc_url(
				self_admin_url(
					$is_installed
						? 'plugins.php?s=elementor'
						: 'plugin-install.php?tab=search&s=elementor'
				)
			),
			esc_html(
				$is_installed
					? __('Activate Elementor', 'formminia-for-elementor')
					: __('Install Elementor', 'formminia-for-elementor')
			)
		);
	}

	/**
	 * Whether Elementor is loaded and usable.
	 *
	 * @return bool
	 */
	protected function is_elementor_active()
	{
		if (defined('ELEMENTOR_VERSION')) {
			return true;
		}

		return (bool) did_action('elementor/loaded');
	}

	/**
	 * Whether the Elementor plugin files are present, regardless of its state.
	 *
	 * This is deliberately not an active-state check: an installed but
	 * deactivated Elementor needs an activation prompt, not an install prompt.
	 *
	 * @return bool
	 */
	protected function is_elementor_installed()
	{
		$plugin_file = 'elementor/elementor.php';

		if (function_exists('get_plugins')) {
			$plugins = get_plugins();

			return isset($plugins[$plugin_file]);
		}

		return defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . $plugin_file);
	}

	/**
	 * Render the plugin settings page.
	 */
	public function display_plugin_setup_page()
	{
		$path = FORMMINIA_PLUGIN_DIR . 'includes/Admin/settings-view.php';
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

		$repository = new \FORMMINIA\Services\SubmissionRepository();
		$submissions = $repository->get_submissions(1000, 0); // Export last 1000 submissions

		if (empty($submissions)) {
			return;
		}

		$filename = 'formminia-submissions-' . wp_date('Y-m-d') . '.csv';

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
