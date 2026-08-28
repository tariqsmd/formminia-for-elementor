<?php

namespace MTForms\Services\Captcha;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MTForms\Services\FormSubmission;

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
				'mtforms_recaptcha_config',
				esc_html__( 'reCAPTCHA is not configured correctly.', MTFORMS_TEXT_DOMAIN )
			);
		}

		if ( $response === '' ) {
			return new \WP_Error(
				'mtforms_recaptcha_missing',
				esc_html__( 'Please complete the reCAPTCHA.', MTFORMS_TEXT_DOMAIN )
			);
		}

		$remote = wp_safe_remote_post(
			'https://www.google.com/recaptcha/api/siteverify',
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
			do_action( 'mtforms_captcha_error', $remote, 'recaptcha' );

			return new \WP_Error(
				'mtforms_recaptcha_http_error',
				esc_html__( 'reCAPTCHA verification request failed.', MTFORMS_TEXT_DOMAIN )
			);
		}

		$body   = wp_remote_retrieve_body( $remote );
		$result = json_decode( $body );

		if ( ! isset( $result->success ) || ! $result->success ) {
			return new \WP_Error(
				'mtforms_recaptcha_invalid',
				esc_html__( 'reCAPTCHA verification failed.', MTFORMS_TEXT_DOMAIN )
			);
		}

		return true;
	}
}

