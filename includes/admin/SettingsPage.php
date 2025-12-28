<?php

namespace MTForms\Admin;

/**
 * Admin settings page for MTForms.
 *
 * Modern, namespaced counterpart to the legacy MTForms_Admin class.
 */
class SettingsPage {

	/** @var string */
	private $plugin_name;

	/** @var string */
	private $version;

	/**
	 * @param string $plugin_name Plugin slug.
	 * @param string $version     Plugin version.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Enqueue admin styles.
	 *
	 * @param string $hook Current admin page hook suffix.
	 */
	public function enqueue_styles( $hook ) {
		if ( 'toplevel_page_mtforms' !== $hook ) {
			return;
		}

		wp_enqueue_style(
			$this->plugin_name,
			MTFORMS_PLUGIN_URL . 'assets/css/mtforms-admin.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @param string $hook Current admin page hook suffix.
	 */
	public function enqueue_scripts( $hook ) {
		if ( 'toplevel_page_mtforms' !== $hook ) {
			return;
		}

		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/mtforms-admin.js',
			array( 'jquery' ),
			$this->version,
			false
		);
	}

	/**
	 * Register the top-level admin menu.
	 */
	public function add_admin_menu() {
		add_menu_page(
			__( 'MTForms', MTFORMS_TEXT_DOMAIN ),
			__( 'MTForms', MTFORMS_TEXT_DOMAIN ),
			'manage_options',
			'mtforms',
			array( $this, 'display_plugin_setup_page' ),
			'dashicons-email',
			79
		);
	}

	/**
	 * Register plugin settings.
	 */
	public function register_settings() {
		register_setting( Options::GROUP_SETTINGS, Options::CAPTCHA_PROVIDER );
		register_setting( Options::GROUP_SETTINGS, Options::RECAPTCHA_SITE_KEY );
		register_setting( Options::GROUP_SETTINGS, Options::RECAPTCHA_SECRET_KEY );
		register_setting( Options::GROUP_SETTINGS, Options::TURNSTILE_SITE_KEY );
		register_setting( Options::GROUP_SETTINGS, Options::TURNSTILE_SECRET_KEY );
		register_setting( Options::GROUP_SETTINGS, Options::ADMIN_EMAIL );
		register_setting( Options::GROUP_SETTINGS, Options::EMAIL_SUBJECT );
		register_setting( Options::GROUP_SETTINGS, Options::EMAIL_FROM_NAME );
		register_setting( Options::GROUP_SETTINGS, Options::ENABLE_HTML_EMAIL );
	}

	/**
	 * Render the plugin settings page.
	 */
	public function display_plugin_setup_page() {
		include_once plugin_dir_path( __FILE__ ) . 'partials/mtforms-admin-display.php';
	}
}

