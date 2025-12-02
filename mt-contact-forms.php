<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * administrative area. This file also includes all of the plugin dependencies.
 *
 * @link              https://example.com
 * @since             1.0.0
 * @package           MT_Contact_Forms
 *
 * @wordpress-plugin
 * Plugin Name:       MT Contact Forms
 * Plugin URI:        https://example.com/plugin-name
 * Description:       A modern, block-based contact form plugin with GDPR support and Elementor integration.
 * Version:           1.0.0
 * Author:            Muhammad Tariq
 * Author URI:        https://example.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mt-contact-forms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MTCF_VERSION', '1.0.0' );
define( 'MTCF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MTCF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mtcf-activator.php
 */
function activate_mt_contact_forms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mtcf-activator.php';
	MTCF_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mtcf-deactivator.php
 */
function deactivate_mt_contact_forms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mtcf-deactivator.php';
	MTCF_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mt_contact_forms' );
register_deactivation_hook( __FILE__, 'deactivate_mt_contact_forms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mtcf-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mt_contact_forms() {

	$plugin = new MTCF_Core();
	$plugin->run();

}
run_mt_contact_forms();
