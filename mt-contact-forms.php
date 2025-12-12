<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * administrative area. This file also includes all of the plugin dependencies.
 *
 * @link              https://developer.developer.developer
 * @since             1.0.0
 * @package           MTForms
 *
 * @wordpress-plugin
 * Plugin Name:       MTForms
 * Plugin URI:        https://developer.developer.developer/mtforms
 * Description:       A modern, feature-rich contact form plugin with multiple skins, layouts, GDPR support, and Elementor/Gutenberg integration.
 * Version:           1.1.0
 * Author:            Muhammad Tariq
 * Author URI:        https://developer.developer.developer
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mtforms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Plugin Constants
 */
define('MTFORMS_VERSION', '1.1.0');
define('MTFORMS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MTFORMS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MTFORMS_TEXT_DOMAIN', 'mtforms');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mtforms-activator.php
 */
function activate_mtforms()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-mtforms-activator.php';
	MTForms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mtforms-deactivator.php
 */
function deactivate_mtforms()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-mtforms-deactivator.php';
	MTForms_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_mtforms');
register_deactivation_hook(__FILE__, 'deactivate_mtforms');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-mtforms-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mtforms()
{

	$plugin = new MTForms_Core();
	$plugin->run();

}
run_mtforms();
