<?php

namespace MTEF\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Core plugin orchestrator for Quick & Modern Forms for Elementor.
 *
 * This class is responsible for:
 * - Loading dependencies.
 * - Registering admin and public hooks.
 * - Wiring Elementor integration.
 *
 * It is the modern, namespaced counterpart to the legacy MTEF_Core class.
 */
class Plugin {

	/**
	 * Singleton instance.
	 *
	 * @var Plugin|null
	 */
	protected static $instance = null;

	/**
	 * Loader that registers all hooks.
	 *
	 * @var Loader
	 */
	protected $loader;

	/**
	 * Unique plugin identifier.
	 *
	 * @var string
	 */
	protected $plugin_name;

	/**
	 * Current plugin version.
	 *
	 * @var string
	 */
	protected $version;

	/**
	 * Get the singleton instance.
	 *
	 * @return Plugin
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Plugin constructor.
	 *
	 * Sets up configuration and registers hooks.
	 */
	protected function __construct() {
		if ( defined( 'MTEF_VERSION' ) ) {
			$this->version = MTEF_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		$this->plugin_name = 'mtef';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load plugin dependencies.
	 */
	protected function load_dependencies() {
		// All classes are autoloaded via the Quick & Modern Forms for Elementor namespace.
		$this->loader = new Loader();
	}

	/**
	 * Register Elementor integration.
	 *
	 * Since WordPress 4.6, WordPress.org plugin translations are loaded
	 * automatically, so no explicit load_plugin_textdomain() call is needed.
	 */
	protected function set_locale() {
		// Register Elementor integration (namespaced).
		new \MTEF\Integrations\Elementor\Integration();
	}

	/**
	 * Register admin hooks.
	 */
	protected function define_admin_hooks() {
		$plugin_admin = new \MTEF\Admin\SettingsPage( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'maybe_handle_export_csv' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'maybe_display_elementor_notice' );
	}

	/**
	 * Register public hooks.
	 */
	protected function define_public_hooks() {
		$validator = new \MTEF\Services\FormValidator();

		$provider = get_option( 'mtef_captcha_provider', 'none' );
		if ( $provider === 'recaptcha' ) {
			$secret           = get_option( 'mtef_recaptcha_secret_key' );
			$captcha_verifier = new \MTEF\Services\Captcha\RecaptchaVerifier( (string)$secret );
		} else if ( $provider === 'turnstile' ) {
			$secret           = get_option( 'mtef_turnstile_secret_key' );
			$captcha_verifier = new \MTEF\Services\Captcha\TurnstileVerifier( (string)$secret );
		} else {
			$captcha_verifier = new \MTEF\Services\Captcha\NullCaptchaVerifier();
		}

		$config = new \MTEF\Services\WpOptionsConfig();
		$mailer = new \MTEF\Services\WpMailMailer();
		$repository = new \MTEF\Services\SubmissionRepository();

		$submission_mailer = new \MTEF\Services\Email\SubmissionMailer( $config, $mailer );

		$controller = new \MTEF\Frontend\FormController(
			$this->get_plugin_name(),
			$this->get_version(),
			$validator,
			$captcha_verifier,
			$submission_mailer,
			$repository
		);

		$this->loader->add_action( 'wp_enqueue_scripts', $controller, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $controller, 'enqueue_scripts' );

		$this->loader->add_action( 'wp_ajax_mtef_submit_form', $controller, 'handle_form_submission' );
		$this->loader->add_action( 'wp_ajax_nopriv_mtef_submit_form', $controller, 'handle_form_submission' );
	}

	/**
	 * Execute all registered hooks.
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * Get plugin name.
	 *
	 * @return string
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Get plugin version.
	 *
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}
}

