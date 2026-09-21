<?php

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * MT Elementor Forms Core Bootstrap
 *
 * Registers a PSR-4 style autoloader with explicit class-to-file mapping
 * for reliable loading on both case-sensitive (Linux) and case-insensitive (Windows/macOS) filesystems.
 */

if ( ! defined( 'MTEF_VERSION' ) ) {
	return;
}

/**
 * Class-to-file map.
 *
 * Keys are fully qualified class names; values are relative paths from includes/.
 */
$mtef_class_map = array(
	// Core
	'MTEF\Core\Plugin'              => 'Core/Plugin.php',
	'MTEF\Core\Loader'              => 'Core/Loader.php',
	'MTEF\Core\Activator'           => 'Core/Activator.php',
	'MTEF\Core\Deactivator'         => 'Core/Deactivator.php',

	// Admin
	'MTEF\Admin\SettingsPage'       => 'Admin/SettingsPage.php',
	'MTEF\Admin\Options'            => 'Admin/Options.php',
	'MTEF\Admin\SubmissionsTable'   => 'Admin/SubmissionsTable.php',

	// Services
	'MTEF\Services\FormValidator'           => 'Services/FormValidator.php',
	'MTEF\Services\FormSubmission'          => 'Services/FormSubmission.php',
	'MTEF\Services\SubmissionRepository'    => 'Services/SubmissionRepository.php',
	'MTEF\Services\WpOptionsConfig'         => 'Services/WpOptionsConfig.php',
	'MTEF\Services\WpMailMailer'            => 'Services/WpMailMailer.php',
	'MTEF\Services\ElementorWidgetSettings' => 'Services/ElementorWidgetSettings.php',
	'MTEF\Services\Email\SubmissionMailer'  => 'Services/Email/SubmissionMailer.php',

	// Captcha
	'MTEF\Services\Captcha\CaptchaVerifierInterface' => 'Services/Captcha/CaptchaVerifierInterface.php',
	'MTEF\Services\Captcha\RecaptchaVerifier'        => 'Services/Captcha/RecaptchaVerifier.php',
	'MTEF\Services\Captcha\TurnstileVerifier'        => 'Services/Captcha/TurnstileVerifier.php',
	'MTEF\Services\Captcha\NullCaptchaVerifier'      => 'Services/Captcha/NullCaptchaVerifier.php',

	// Frontend
	'MTEF\Frontend\FormController'  => 'Frontend/FormController.php',

	// Integrations
	'MTEF\Integrations\Elementor\Integration' => 'Integrations/Elementor/Integration.php',
	'MTEF\Integrations\Elementor\Widget'       => 'Integrations/Elementor/Widget.php',
	'MTEF\Integrations\Elementor\WidgetControls\ContentControls' => 'Integrations/Elementor/WidgetControls/ContentControls.php',
	'MTEF\Integrations\Elementor\WidgetControls\StyleControls'   => 'Integrations/Elementor/WidgetControls/StyleControls.php',
	'MTEF\Integrations\Elementor\WidgetRenderer'                 => 'Integrations/Elementor/WidgetRenderer.php',
);

spl_autoload_register(
	static function ( $class ) use ( $mtef_class_map ) {
		if ( isset( $mtef_class_map[ $class ] ) ) {
			$file = MTEF_PLUGIN_DIR . 'includes/' . $mtef_class_map[ $class ];
			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	}
);
