<?php
/**
 * Plugin Name:       FormMinia for Elementor
 * Plugin URI:        https://wordpress.org/plugins/formminia-for-elementor/
 * Description:       A modern, feature-rich contact form plugin with multiple skins, layouts, GDPR support, and Elementor integration.
 * Version:           1.0.0
 * Author:            Muhammad Tariq
 * Author URI:        https://profiles.wordpress.org/mtariqsmd/
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires at least: 6.8
 * Requires PHP:      7.4
 * Requires Plugins:  elementor
 * Text Domain:       formminia-for-elementor
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin Constants
 */
define( 'FORMMINIA_VERSION', '1.0.0' );
define( 'FORMMINIA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FORMMINIA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function formminia_activate() {
	\FORMMINIA\Core\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function formminia_deactivate() {
	\FORMMINIA\Core\Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'formminia_activate' );
register_deactivation_hook( __FILE__, 'formminia_deactivate' );

require FORMMINIA_PLUGIN_DIR . 'includes/Core/bootstrap.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function formminia_run() {
	$plugin = \FORMMINIA\Core\Plugin::get_instance();
	$plugin->run();
}

formminia_run();
