<?php
/**
 * Captcha Partial
 *
 * @var array $args Partial arguments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$settings = $args['settings'];

if ( $settings['show_captcha'] !== 'yes' ) {
	return;
}

$captcha_provider = get_option( 'mtforms_captcha_provider', 'none' );

if ( $captcha_provider === 'recaptcha' ) {
	$site_key = get_option( 'mtforms_recaptcha_site_key' );
	if ( ! empty( $site_key ) ) {
		echo '<div class="mtforms-captcha-wrap"><div class="g-recaptcha" data-sitekey="' . esc_attr( $site_key ) . '"></div></div>';
	} else {
		mtforms_show_captcha_config_error();
	}
} else if ( $captcha_provider === 'turnstile' ) {
	$site_key = get_option( 'mtforms_turnstile_site_key' );
	if ( ! empty( $site_key ) ) {
		echo '<div class="mtforms-captcha-wrap"><div class="cf-turnstile" data-sitekey="' . esc_attr( $site_key ) . '"></div></div>';
	} else {
		mtforms_show_captcha_config_error();
	}
}

/**
 * Show a visible notice when a form requests CAPTCHA but the selected
 * provider has no site key configured. Prevents a silently unusable form.
 */
if ( ! function_exists( 'mtforms_show_captcha_config_error' ) ) {
	function mtforms_show_captcha_config_error() {
		echo '<div class="mtforms-captcha-config-error" style="border:1px solid #d63638;background:#fcf0f1;color:#8a1f11;padding:10px 14px;border-radius:4px;font-size:14px;line-height:1.5;">'
			. esc_html__( 'CAPTCHA is enabled on this form, but the selected provider is not configured. Add the site key under MTForms » General settings.', MTFORMS_TEXT_DOMAIN )
			. '</div>';
	}
}
