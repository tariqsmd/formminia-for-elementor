<?php

namespace MTForms\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    MTForms
 * @author     Muhammad Tariq
 */
class I18n {
	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {
		// Keep loading translations from /languages for installs outside wordpress.org.
		// phpcs:ignore PluginCheck.CodeAnalysis.DiscouragedFunctions.load_plugin_textdomainFound
		load_plugin_textdomain(
			'mtforms',
			false,
			dirname( dirname( dirname( plugin_basename( __FILE__ ) ) ) ) . '/languages/'
		);
	}
}
