<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://developer.developer.developer
 * @since      1.0.0
 * @package    MTForms
 * @subpackage MTForms/admin
 */

class MTForms_Admin
{

	/**
	 * @var \MTForms\Admin\SettingsPage
	 */
	private $settings_page;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{
		// Keep legacy class as a thin proxy to the modern namespaced settings page.
		$this->settings_page = new \MTForms\Admin\SettingsPage($plugin_name, $version);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook)
	{
		$this->settings_page->enqueue_styles($hook);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook)
	{
		$this->settings_page->enqueue_scripts($hook);
	}

	/**
	 * Register the admin menu
	 *
	 * @since 1.0.0
	 */
	public function add_admin_menu()
	{
		$this->settings_page->add_admin_menu();
	}

	/**
	 * Register settings
	 */
	public function register_settings()
	{
		$this->settings_page->register_settings();
	}

	/**
	 * Render the admin page
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_setup_page()
	{
		$this->settings_page->display_plugin_setup_page();
	}

}
