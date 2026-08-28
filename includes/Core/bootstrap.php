<?php

/**
 * MTForms Core Bootstrap
 *
 * Registers a PSR-4 style autoloader with explicit class-to-file mapping
 * for reliable loading on both case-sensitive (Linux) and case-insensitive (Windows/macOS) filesystems.
 */

if ( ! defined( 'MTFORMS_VERSION' ) ) {
	return;
}

/**
 * Class-to-file map.
 *
 * Keys are fully qualified class names; values are relative paths from includes/.
 */
$mtforms_class_map = array(
	// Core
	'MTForms\Core\Plugin'              => 'Core/Plugin.php',
	'MTForms\Core\Loader'              => 'Core/Loader.php',
	'MTForms\Core\I18n'                => 'Core/I18n.php',
	'MTForms\Core\Activator'           => 'Core/Activator.php',
	'MTForms\Core\Deactivator'         => 'Core/Deactivator.php',

	// Admin
	'MTForms\Admin\SettingsPage'       => 'Admin/SettingsPage.php',
	'MTForms\Admin\Options'            => 'Admin/Options.php',
	'MTForms\Admin\SubmissionsTable'   => 'Admin/SubmissionsTable.php',

	// Services
	'MTForms\Services\FormValidator'           => 'Services/FormValidator.php',
	'MTForms\Services\FormSubmission'          => 'Services/FormSubmission.php',
	'MTForms\Services\SubmissionRepository'    => 'Services/SubmissionRepository.php',
	'MTForms\Services\WpOptionsConfig'         => 'Services/WpOptionsConfig.php',
	'MTForms\Services\WpMailMailer'            => 'Services/WpMailMailer.php',
	'MTForms\Services\ElementorWidgetSettings' => 'Services/ElementorWidgetSettings.php',
	'MTForms\Services\Email\SubmissionMailer'  => 'Services/Email/SubmissionMailer.php',

	// Captcha
	'MTForms\Services\Captcha\CaptchaVerifierInterface' => 'Services/Captcha/CaptchaVerifierInterface.php',
	'MTForms\Services\Captcha\RecaptchaVerifier'        => 'Services/Captcha/RecaptchaVerifier.php',
	'MTForms\Services\Captcha\TurnstileVerifier'        => 'Services/Captcha/TurnstileVerifier.php',
	'MTForms\Services\Captcha\NullCaptchaVerifier'      => 'Services/Captcha/NullCaptchaVerifier.php',

	// Frontend
	'MTForms\Frontend\FormController'  => 'Frontend/FormController.php',

	// Integrations
	'MTForms\Integrations\Elementor\Integration' => 'Integrations/Elementor/Integration.php',
	'MTForms\Integrations\Elementor\Widget'       => 'Integrations/Elementor/Widget.php',
	'MTForms\Integrations\Elementor\WidgetControls\ContentControls' => 'Integrations/Elementor/WidgetControls/ContentControls.php',
	'MTForms\Integrations\Elementor\WidgetControls\StyleControls'   => 'Integrations/Elementor/WidgetControls/StyleControls.php',
	'MTForms\Integrations\Elementor\WidgetRenderer'                 => 'Integrations/Elementor/WidgetRenderer.php',
);

spl_autoload_register(
	static function ( $class ) use ( $mtforms_class_map ) {
		if ( isset( $mtforms_class_map[ $class ] ) ) {
			$file = MTFORMS_PLUGIN_DIR . 'includes/' . $mtforms_class_map[ $class ];
			if ( file_exists( $file ) ) {
				require_once $file;
			}
		}
	}
);
