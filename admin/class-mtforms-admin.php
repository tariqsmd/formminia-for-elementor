<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://developer.developer.developer
 * @since      1.0.0
 * @package    MTForms
 * @subpackage MTForms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MTForms
 * @subpackage MTForms/admin
 * @author     Muhammad Tariq
 */
class MTForms_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param    string    $plugin_name    The name of this plugin.
     * @param    string    $version        The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles($hook)
    {

        if ('toplevel_page_mtforms' !== $hook) {
            return;
        }

        wp_enqueue_style($this->plugin_name, plugins_url('../assets/css/mtforms-admin.css', __FILE__), array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts($hook)
    {

        if ('toplevel_page_mtforms' !== $hook) {
            return;
        }

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/mtforms-admin.js', array('jquery'), $this->version, false);

    }

    /**
     * Register the admin menu
     * 
     * @since 1.0.0
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
            79 // Below Tools
        );
    }

    /**
     * Register settings
     */
    public function register_settings()
    {
        register_setting('mtforms_settings', 'mtforms_captcha_provider');
        register_setting('mtforms_settings', 'mtforms_recaptcha_site_key');
        register_setting('mtforms_settings', 'mtforms_recaptcha_secret_key');
        register_setting('mtforms_settings', 'mtforms_turnstile_site_key');
        register_setting('mtforms_settings', 'mtforms_turnstile_secret_key');
    }

    /**
     * Render the admin page
     * 
     * @since 1.0.0
     */
    public function display_plugin_setup_page()
    {
        include_once plugin_dir_path(__FILE__) . 'partials/mtforms-admin-display.php';
    }

}
