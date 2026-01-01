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

if ( $settings['show_captcha'] === 'yes' ) {
	$captcha_provider = get_option( 'mtforms_captcha_provider', 'none' );

	if ( $captcha_provider === 'recaptcha' ) {
		$site_key = get_option( 'mtforms_recaptcha_site_key' );
		if ( ! empty( $site_key ) ) {
			wp_enqueue_script(
				'google-recaptcha',
				'https://www.google.com/recaptcha/api.js',
				array(),
				null,
				true
			);
			echo '<div class="mtforms-captcha-wrap"><div class="g-recaptcha" data-sitekey="' . esc_attr( $site_key ) . '"></div></div>';
		}
	} elseif ( $captcha_provider === 'turnstile' ) {
		$site_key = get_option( 'mtforms_turnstile_site_key' );
		if ( ! empty( $site_key ) ) {
			wp_enqueue_script(
				'cloudflare-turnstile',
				'https://challenges.cloudflare.com/turnstile/v0/api.js',
				array(),
				null,
				true
			);
			echo '<div class="mtforms-captcha-wrap"><div class="cf-turnstile" data-sitekey="' . esc_attr( $site_key ) . '"></div></div>';
		}
	}
}
