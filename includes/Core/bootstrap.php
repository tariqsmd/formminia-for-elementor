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
	'MTForms\Core\I18n'                => 'Core/i18n.php',
	'MTForms\Core\Activator'           => 'Core/activator.php',
	'MTForms\Core\Deactivator'         => 'Core/deactivator.php',

	// Admin
	'MTForms\Admin\SettingsPage'       => 'admin/SettingsPage.php',
	'MTForms\Admin\Options'            => 'admin/Options.php',
	'MTForms\Admin\SubmissionsTable'   => 'admin/SubmissionsTable.php',

	// Services
	'MTForms\Services\FormValidator'           => 'services/formvalidator.php',
	'MTForms\Services\FormSubmission'          => 'services/formsubmission.php',
	'MTForms\Services\SubmissionRepository'    => 'services/SubmissionRepository.php',
	'MTForms\Services\WpOptionsConfig'         => 'services/wpoptionsconfig.php',
	'MTForms\Services\WpMailMailer'            => 'services/wpmailmailer.php',
	'MTForms\Services\Email\SubmissionMailer'  => 'services/email/submissionmailer.php',

	// Captcha
	'MTForms\Services\Captcha\CaptchaVerifierInterface' => 'services/captcha/captchaverifierinterface.php',
	'MTForms\Services\Captcha\RecaptchaVerifier'        => 'services/captcha/recaptchaverifier.php',
	'MTForms\Services\Captcha\TurnstileVerifier'        => 'services/captcha/turnstileverifier.php',
	'MTForms\Services\Captcha\NullCaptchaVerifier'      => 'services/captcha/nullcaptchaverifier.php',

	// Frontend
	'MTForms\Frontend\FormController'  => 'Frontend/FormController.php',

	// Integrations
	'MTForms\Integrations\Elementor\Integration' => 'integrations/elementor/Integration.php',
	'MTForms\Integrations\Elementor\Widget'       => 'integrations/elementor/Widget.php',
	'MTForms\Integrations\Elementor\WidgetControls\ContentControls' => 'integrations/elementor/WidgetControls/ContentControls.php',
	'MTForms\Integrations\Elementor\WidgetControls\StyleControls'   => 'integrations/elementor/WidgetControls/StyleControls.php',
	'MTForms\Integrations\Elementor\WidgetRenderer'                 => 'integrations/elementor/WidgetRenderer.php',
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
