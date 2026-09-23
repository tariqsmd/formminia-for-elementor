<?php

namespace MTEF\Services\Captcha;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MTEF\Services\FormSubmission;

/**
 * Google reCAPTCHA v2 verifier.
 */
class RecaptchaVerifier implements CaptchaVerifierInterface {

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

		$response = isset( $request['g-recaptcha-response'] ) ? sanitize_text_field( wp_unslash( $request['g-recaptcha-response'] ) ) : '';

		if ( $this->secret_key === '' ) {
			return new \WP_Error(
				'mtef_recaptcha_config',
				esc_html__( 'reCAPTCHA is not configured correctly.', 'formminia-for-elementor' )
			);
		}

		if ( $response === '' ) {
			return new \WP_Error(
				'mtef_recaptcha_missing',
				esc_html__( 'Please complete the reCAPTCHA.', 'formminia-for-elementor' )
			);
		}

		$remote = wp_safe_remote_post(
			'https://www.google.com/recaptcha/api/siteverify', // phpcs:ignore PluginCheck.CodeAnalysis.Offloading.OffloadedContent -- Server-side verification API; the captcha provider cannot be self-hosted.
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
			 * Fires when reCAPTCHA verification fails due to HTTP error.
			 */
			do_action( 'mtef_captcha_error', $remote, 'recaptcha' );

			return new \WP_Error(
				'mtef_recaptcha_http_error',
				esc_html__( 'reCAPTCHA verification request failed.', 'formminia-for-elementor' )
			);
		}

		$body   = wp_remote_retrieve_body( $remote );
		$result = json_decode( $body );

		if ( ! isset( $result->success ) || ! $result->success ) {
			return new \WP_Error(
				'mtef_recaptcha_invalid',
				esc_html__( 'reCAPTCHA verification failed.', 'formminia-for-elementor' )
			);
		}

		return true;
	}
}

