<?php

namespace MTForms\Services\Captcha;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MTForms\Services\FormSubmission;

/**
 * Cloudflare Turnstile verifier.
 */
class TurnstileVerifier implements CaptchaVerifierInterface {

	/** @var string */
	protected $secret_key;

	/**
	 * @param string $secret_key Secret key from settings.
	 */
	public function __construct( $secret_key ) {
		$this->secret_key = (string)$secret_key;
	}

	/**
	 * @inheritDoc
	 */
	public function verify( FormSubmission $submission, array $request ) {
		unset( $submission ); // Unused for now, kept for future extension.

		$response = isset( $request['cf-turnstile-response'] ) ? sanitize_text_field( wp_unslash( $request['cf-turnstile-response'] ) ) : '';

		if ( $this->secret_key === '' ) {
			return new \WP_Error(
				'mtforms_turnstile_config',
				esc_html__( 'Captcha is not configured correctly.', 'mtforms' )
			);
		}

		if ( $response === '' ) {
			return new \WP_Error(
				'mtforms_turnstile_missing',
				esc_html__( 'Please complete the Captcha.', 'mtforms' )
			);
		}

		$remote = wp_safe_remote_post(
			'https://challenges.cloudflare.com/turnstile/v0/siteverify', // phpcs:ignore PluginCheck.CodeAnalysis.Offloading.OffloadedContent -- Server-side verification API; the captcha provider cannot be self-hosted.
			array(
				'timeout' => 10,
				'body'    => array(
					'secret'   => $this->secret_key,
					'response' => $response,
				),
			)
		);

		if ( is_wp_error( $remote ) ) {
			/**
			 * Fires when Turnstile verification fails due to HTTP error.
			 */
			do_action( 'mtforms_captcha_error', $remote, 'turnstile' );

			return new \WP_Error(
				'mtforms_turnstile_http_error',
				esc_html__( 'Captcha verification request failed.', 'mtforms' )
			);
		}

		$body   = wp_remote_retrieve_body( $remote );
		$result = json_decode( $body );

		if ( ! isset( $result->success ) || ! $result->success ) {
			return new \WP_Error(
				'mtforms_turnstile_invalid',
				esc_html__( 'Captcha verification failed.', 'mtforms' )
			);
		}

		return true;
	}
}

