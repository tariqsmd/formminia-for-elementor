<?php
/**
 * Plugin Name:       MTForms
 * Plugin URI:        https://wordpress.org/plugins/mtforms/
 * Description:       A modern, feature-rich contact form plugin with multiple skins, layouts, GDPR support, and Elementor integration.
 * Version:           1.0.0
 * Author:            Muhammad Tariq
 * Author URI:        https://profiles.wordpress.org/muhammadtariq
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Requires Plugins:  elementor
 * Text Domain:       mtforms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin Constants
 */
define( 'MTFORMS_VERSION', '1.0.0' );
define( 'MTFORMS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MTFORMS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function mtforms_activate() {
	\MTForms\Core\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function mtforms_deactivate() {
	\MTForms\Core\Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'mtforms_activate' );
register_deactivation_hook( __FILE__, 'mtforms_deactivate' );

require MTFORMS_PLUGIN_DIR . 'includes/Core/bootstrap.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function mtforms_run() {
	$plugin = \MTForms\Core\Plugin::get_instance();
	$plugin->run();
}

mtforms_run();
