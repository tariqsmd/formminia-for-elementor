<?php

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FormMinia for Elementor Core Bootstrap
 *
 * Registers a PSR-4 style autoloader with explicit class-to-file mapping
 * for reliable loading on both case-sensitive (Linux) and case-insensitive (Windows/macOS) filesystems.
 */

if ( ! defined( 'FORMMINIA_VERSION' ) ) {
	return;
}

/**
 * Class-to-file map.
 *
 * Keys are fully qualified class names; values are relative paths from includes/.
 */
$formminia_class_map = array(
	// Core
	'FORMMINIA\Core\Plugin'              => 'Core/Plugin.php',
	'FORMMINIA\Core\Loader'              => 'Core/Loader.php',
	'FORMMINIA\Core\Activator'           => 'Core/Activator.php',
	'FORMMINIA\Core\Deactivator'         => 'Core/Deactivator.php',

	// Admin
	'FORMMINIA\Admin\SettingsPage'       => 'Admin/SettingsPage.php',
	'FORMMINIA\Admin\Options'            => 'Admin/Options.php',
	'FORMMINIA\Admin\SubmissionsTable'   => 'Admin/SubmissionsTable.php',

	// Services
	'FORMMINIA\Services\FormValidator'           => 'Services/FormValidator.php',
	'FORMMINIA\Services\FormSubmission'          => 'Services/FormSubmission.php',
	'FORMMINIA\Services\SubmissionRepository'    => 'Services/SubmissionRepository.php',
	'FORMMINIA\Services\WpOptionsConfig'         => 'Services/WpOptionsConfig.php',
	'FORMMINIA\Services\WpMailMailer'            => 'Services/WpMailMailer.php',
	'FORMMINIA\Services\ElementorWidgetSettings' => 'Services/ElementorWidgetSettings.php',
	'FORMMINIA\Services\Email\SubmissionMailer'  => 'Services/Email/SubmissionMailer.php',

	// Captcha
	'FORMMINIA\Services\Captcha\CaptchaVerifierInterface' => 'Services/Captcha/CaptchaVerifierInterface.php',
	'FORMMINIA\Services\Captcha\RecaptchaVerifier'        => 'Services/Captcha/RecaptchaVerifier.php',
	'FORMMINIA\Services\Captcha\TurnstileVerifier'        => 'Services/Captcha/TurnstileVerifier.php',
	'FORMMINIA\Services\Captcha\NullCaptchaVerifier'      => 'Services/Captcha/NullCaptchaVerifier.php',

	// Frontend
	'FORMMINIA\Frontend\FormController'  => 'Frontend/FormController.php',

	// Integrations
	'FORMMINIA\Integrations\Elementor\Integration' => 'Integrations/Elementor/Integration.php',
	'FORMMINIA\Integrations\Elementor\Widget'       => 'Integrations/Elementor/Widget.php',
	'FORMMINIA\Integrations\Elementor\WidgetControls\ContentControls' => 'Integrations/Elementor/WidgetControls/ContentControls.php',
	'FORMMINIA\Integrations\Elementor\WidgetControls\StyleControls'   => 'Integrations/Elementor/WidgetControls/StyleControls.php',
	'FORMMINIA\Integrations\Elementor\WidgetRenderer'                 => 'Integrations/Elementor/WidgetRenderer.php',
);

spl_autoload_register(
	static function ( $class ) use ( $formminia_class_map ) {
		if ( isset( $formminia_class_map[ $class ] ) ) {
			$file = FORMMINIA_PLUGIN_DIR . 'includes/' . $formminia_class_map[ $class ];
			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	}
);
