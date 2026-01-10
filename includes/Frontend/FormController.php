<?php

namespace MTForms\Frontend;

use MTForms\Services\Captcha\CaptchaVerifierInterface;
use MTForms\Services\FormSubmission;
use MTForms\Services\FormValidator;
use MTForms\Services\Email\SubmissionMailer;

/**
 * Public-facing form controller for MTForms.
 *
 * Handles:
 * - Asset registration/enqueueing.
 * - AJAX form submission.
 */
class FormController {

	/** @var string */
	protected $plugin_name;

	/** @var string */
	protected $version;

	/** @var FormValidator */
	protected $validator;

	/** @var CaptchaVerifierInterface */
	protected $captcha_verifier;

	/** @var SubmissionMailer */
	protected $mailer;

	/**
	 * @param string                   $plugin_name      Plugin slug.
	 * @param string                   $version          Plugin version.
	 * @param FormValidator            $validator        Validator service.
	 * @param CaptchaVerifierInterface $captcha_verifier Captcha verifier.
	 * @param SubmissionMailer         $mailer           Mailer service.
	 */
	public function __construct( $plugin_name, $version, FormValidator $validator, CaptchaVerifierInterface $captcha_verifier, SubmissionMailer $mailer ) {
		$this->plugin_name      = $plugin_name;
		$this->version          = $version;
		$this->validator        = $validator;
		$this->captcha_verifier = $captcha_verifier;
		$this->mailer           = $mailer;
	}

	/**
	 * Register styles for the public-facing side.
	 */
	public function enqueue_styles() {
		wp_register_style(
			$this->plugin_name,
			MTFORMS_PLUGIN_URL . 'assets/css/mtforms-public.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register JavaScript for the public-facing side.
	 */
	public function enqueue_scripts() {
		// Allow overriding JustValidate source to a self-hosted file.
		$just_validate_src = apply_filters(
			'mtforms_just_validate_src',
			'https://unpkg.com/just-validate@4.3.0/dist/just-validate.production.min.js'
		);

		wp_register_script(
			'mtforms-just-validate',
			$just_validate_src,
			array(),
			'4.3.0',
			true
		);

		wp_register_script(
			$this->plugin_name,
			MTFORMS_PLUGIN_URL . 'assets/js/mtforms-public.js',
			array( 'jquery', 'mtforms-just-validate' ),
			$this->version,
			true
		);

		wp_localize_script(
			$this->plugin_name,
			'mtforms_ajax',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'mtforms-submit-form' ),
				'i18n'     => array(
					'name_required'    => __( 'Name is required', MTFORMS_TEXT_DOMAIN ),
					'name_min'         => __( 'Name must be at least 2 characters', MTFORMS_TEXT_DOMAIN ),
					'email_required'   => __( 'Email is required', MTFORMS_TEXT_DOMAIN ),
					'email_invalid'    => __( 'Email is invalid', MTFORMS_TEXT_DOMAIN ),
					'phone_invalid'    => __( 'Please enter a valid phone number', MTFORMS_TEXT_DOMAIN ),
					'message_required' => __( 'Message is required', MTFORMS_TEXT_DOMAIN ),
					'gdpr_required'    => __( 'You must agree to the terms', MTFORMS_TEXT_DOMAIN ),
					'sending'          => __( 'Sending...', MTFORMS_TEXT_DOMAIN ),
					'send_message'     => __( 'Send Message', MTFORMS_TEXT_DOMAIN ),
					'error_generic'    => __( 'An unexpected error occurred. Please try again.', MTFORMS_TEXT_DOMAIN ),
				),
			)
		);
	}

	/**
	 * Handle AJAX form submission.
	 */
	public function handle_form_submission() {
		// Verify nonce.
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'mtforms-submit-form' ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Security check failed.', MTFORMS_TEXT_DOMAIN ),
				)
			);
		}

		// Simple honeypot field to prevent basic spam bots.
		if ( ! empty( $_POST['mtforms_hp'] ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Spam detected. Please try again.', MTFORMS_TEXT_DOMAIN ),
				)
			);
		}

		// Basic IP-based rate limiting.
		$ip_address = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
		if ( $ip_address ) {
			$key   = 'mtforms_rate_' . md5( $ip_address );
			$count = (int)get_transient( $key );

			if ( $count >= 10 ) {
				wp_send_json_error(
					array(
						'message' => __( 'Too many submissions from this IP. Please try again later.', MTFORMS_TEXT_DOMAIN ),
					)
				);
			}

			set_transient( $key, $count + 1, 5 * MINUTE_IN_SECONDS );
		}

		$data       = $_POST; // phpcs:ignore WordPress.Security.NonceVerification.Missing
		$submission = FormSubmission::from_post_array( $data );
		$validation = $this->validator->validate( $submission );

		if ( is_wp_error( $validation ) ) {
			wp_send_json_error(
				array(
					'message' => $validation->get_error_message(),
				)
			);
		}

		$captcha_result = $this->captcha_verifier->verify( $submission, $data );

		if ( is_wp_error( $captcha_result ) ) {
			wp_send_json_error(
				array(
					'message' => $captcha_result->get_error_message(),
				)
			);
		}

		$sent = $this->mailer->send( $submission );

		if ( $sent instanceof \WP_Error ) {
			wp_send_json_error(
				array(
					'message' => $sent->get_error_message(),
				)
			);
		}

		if ( $sent ) {
			wp_send_json_success(
				array(
					'message' => __( 'Message sent successfully!', MTFORMS_TEXT_DOMAIN ),
				)
			);
		}

		wp_send_json_error(
			array(
				'message' => __( 'Failed to send message. Please try again.', MTFORMS_TEXT_DOMAIN ),
			)
		);
	}
}

