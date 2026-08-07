<?php

namespace MTForms\Admin;

use MTForms\Admin\SubmissionsTable;

/**
 * Admin settings page for MTForms.
 *
 * Modern, namespaced counterpart to the legacy MTForms_Admin class.
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
		if ('toplevel_page_mtforms' !== $hook && 'mtforms_page_mtforms-submissions' !== $hook) {
			return;
		}

		wp_enqueue_style(
			$this->plugin_name,
			MTFORMS_PLUGIN_URL . 'assets/admin/css/mtforms-admin.css',
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
		if ('toplevel_page_mtforms' !== $hook && 'mtforms_page_mtforms-submissions' !== $hook) {
			return;
		}

		wp_enqueue_media();

		wp_enqueue_script(
			$this->plugin_name,
			MTFORMS_PLUGIN_URL . 'assets/admin/js/mtforms-admin.js',
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
			__('MTForms', MTFORMS_TEXT_DOMAIN),
			__('MTForms', MTFORMS_TEXT_DOMAIN),
			'manage_options',
			'mtforms',
			array($this, 'display_plugin_setup_page'),
			'dashicons-email',
			79
		);

		add_submenu_page(
			'mtforms',
			__('Settings', MTFORMS_TEXT_DOMAIN),
			__('Settings', MTFORMS_TEXT_DOMAIN),
			'manage_options',
			'mtforms',
			array($this, 'display_plugin_setup_page')
		);

		add_submenu_page(
			'mtforms',
			__('Submissions', MTFORMS_TEXT_DOMAIN),
			__('Submissions', MTFORMS_TEXT_DOMAIN),
			'manage_options',
			'mtforms-submissions',
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

		// Handle export.
		if (isset($_GET['action']) && $_GET['action'] === 'export_csv') {
			$this->handle_export_csv();
		}
		?>
		<div class="wrap">
			<h1 class="wp-heading-inline"><?php _e('MTForms Submissions', MTFORMS_TEXT_DOMAIN); ?></h1>
			<a href="<?php echo esc_url(add_query_arg('action', 'export_csv')); ?>" class="page-title-action"><?php _e('Export to CSV', MTFORMS_TEXT_DOMAIN); ?></a>
			<hr class="wp-header-end">

			<form method="get">
				<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page']) ? esc_attr($_REQUEST['page']) : 'mtforms-submissions'; ?>" />
				<?php
				$table->search_box(__('Search Submissions', MTFORMS_TEXT_DOMAIN), 'submission');
				$table->display();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register plugin settings.
	 */
	public function register_settings()
	{
		// General Tab - All captcha-related settings will be here now
		register_setting(Options::GROUP_GENERAL, Options::CAPTCHA_PROVIDER);
		register_setting(Options::GROUP_GENERAL, Options::RECAPTCHA_SITE_KEY);
		register_setting(Options::GROUP_GENERAL, Options::RECAPTCHA_SECRET_KEY);
		register_setting(Options::GROUP_GENERAL, Options::TURNSTILE_SITE_KEY);
		register_setting(Options::GROUP_GENERAL, Options::TURNSTILE_SECRET_KEY);

		// Email Tab
		register_setting(Options::GROUP_EMAIL, Options::ADMIN_EMAIL);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_SUBJECT);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_FROM_NAME);
		register_setting(Options::GROUP_EMAIL, Options::ENABLE_HTML_EMAIL);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_ACCENT_COLOR);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_LOGO_URL);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_FOOTER_TEXT);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_BG_COLOR);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_CONTENT_BG_COLOR);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_TEXT_COLOR);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_SHOW_FOOTER_CREDIT);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_CC);
		register_setting(Options::GROUP_EMAIL, Options::EMAIL_BCC);
	}

	/**
	 * Render the plugin settings page.
	 */
	public function display_plugin_setup_page()
	{
		$path = MTFORMS_PLUGIN_DIR . 'includes/admin/settings-view.php';
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
			wp_die(__('You do not have sufficient permissions to access this page.', MTFORMS_TEXT_DOMAIN));
		}

		$repository = new \MTForms\Services\SubmissionRepository();
		$submissions = $repository->get_submissions(1000, 0); // Export last 1000 submissions

		if (empty($submissions)) {
			return;
		}

		$filename = 'mtforms-submissions-' . date('Y-m-d') . '.csv';

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $filename);

		$output = fopen('php://output', 'w');

		// Header row.
		fputcsv($output, [
			__('ID', MTFORMS_TEXT_DOMAIN),
			__('Name', MTFORMS_TEXT_DOMAIN),
			__('Email', MTFORMS_TEXT_DOMAIN),
			__('Phone', MTFORMS_TEXT_DOMAIN),
			__('Website', MTFORMS_TEXT_DOMAIN),
			__('Subject', MTFORMS_TEXT_DOMAIN),
			__('Message', MTFORMS_TEXT_DOMAIN),
			__('Form ID', MTFORMS_TEXT_DOMAIN),
			__('IP Address', MTFORMS_TEXT_DOMAIN),
			__('Date', MTFORMS_TEXT_DOMAIN),
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

		fclose($output);
		exit;
	}
}
