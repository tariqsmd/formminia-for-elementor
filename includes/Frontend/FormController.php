<?php

namespace FORMMINIA\Frontend;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use FORMMINIA\Services\Captcha\CaptchaVerifierInterface;
use FORMMINIA\Services\FormSubmission;
use FORMMINIA\Services\FormValidator;
use FORMMINIA\Services\Email\SubmissionMailer;
use FORMMINIA\Services\ElementorWidgetSettings;
use FORMMINIA\Services\SubmissionRepository;

/**
 * Public-facing form controller for FormMinia for Elementor.
 *
 * Handles:
 * - Asset registration/enqueueing.
 * - AJAX form submission.
 */
class FormController
{

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

	/** @var SubmissionRepository */
	protected $repository;

	/**
	 * @param string                   $plugin_name      Plugin slug.
	 * @param string                   $version          Plugin version.
	 * @param FormValidator            $validator        Validator service.
	 * @param CaptchaVerifierInterface $captcha_verifier Captcha verifier.
	 * @param SubmissionMailer         $mailer           Mailer service.
	 * @param SubmissionRepository    $repository       Submission repository.
	 */
	public function __construct($plugin_name, $version, FormValidator $validator, CaptchaVerifierInterface $captcha_verifier, SubmissionMailer $mailer, SubmissionRepository $repository)
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->validator = $validator;
		$this->captcha_verifier = $captcha_verifier;
		$this->mailer = $mailer;
		$this->repository = $repository;
	}

	/**
	 * Register styles for the public-facing side.
	 */
	public function enqueue_styles()
	{
		// Styles are now registered in the Elementor widget class and enqueued on-demand.
	}

	/**
	 * Register JavaScript for the public-facing side.
	 */
	public function enqueue_scripts()
	{
		// Allow overriding JustValidate source to a self-hosted file.
		$just_validate_src = apply_filters(
			'formminia_just_validate_src',
			FORMMINIA_PLUGIN_URL . 'assets/js/just-validate.min.js'
		);

		wp_register_script(
			'formminia-just-validate',
			$just_validate_src,
			array(),
			'4.3.0',
			true
		);

		// Register Captcha scripts (will be enqueued on-demand by the Elementor widget)
		$captcha_provider = get_option('formminia_captcha_provider', 'none');
		if ($captcha_provider === 'recaptcha') {
			$site_key = get_option('formminia_recaptcha_site_key');
			if (!empty($site_key)) {
				// phpcs:ignore PluginCheck.CodeAnalysis.EnqueuedResourceOffloading.OffloadedContent -- Captcha scripts must be served by the provider's CDN.
				wp_register_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), $this->version, true);
			}
		} elseif ($captcha_provider === 'turnstile') {
			$site_key = get_option('formminia_turnstile_site_key');
			if (!empty($site_key)) {
				// phpcs:ignore PluginCheck.CodeAnalysis.EnqueuedResourceOffloading.OffloadedContent -- Captcha scripts must be served by the provider's CDN.
				wp_register_script('cloudflare-turnstile', 'https://challenges.cloudflare.com/turnstile/v0/api.js', array(), $this->version, true);

				// Add async/defer to Turnstile
				add_filter('script_loader_tag', function ($tag, $handle) {
					if ('cloudflare-turnstile' !== $handle) {
						return $tag;
					}
					return str_replace(' src', ' async defer src', $tag);
				}, 10, 2);
			}
		}
	}

	/**
	 * Handle AJAX form submission.
	 */
	public function handle_form_submission()
	{
		// Verify nonce.
		if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'formminia-submit-form')) {
			wp_send_json_error(
				array(
					'message' => esc_html__('Security check failed.', 'formminia-for-elementor'),
				)
			);
		}

		// Unslash the request exactly once, here. Everything read below is
		// therefore already unslashed and downstream sanitizers must not
		// unslash again.
		$data = wp_unslash( $_POST ); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verified immediately above.

		// Simple honeypot field to prevent basic spam bots.
		if (!empty($data['formminia_hp'])) {
			wp_send_json_error(
				array(
					'message' => esc_html__('Spam detected. Please try again.', 'formminia-for-elementor'),
				)
			);
		}

		// Basic IP-based rate limiting.
		$ip_address = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '';
		if ($ip_address) {
			$key = 'formminia_rate_' . md5($ip_address);
			$count = (int) get_transient($key);

			if ($count >= 10) {
				wp_send_json_error(
					array(
						'message' => esc_html__('Too many submissions from this IP. Please try again later.', 'formminia-for-elementor'),
					)
				);
			}

			set_transient($key, $count + 1, 5 * MINUTE_IN_SECONDS);
		}

		// Nonce verified and request unslashed above; each value is sanitized
		// by FormSubmission before it is stored or handed to third parties.
		$submission = FormSubmission::from_post_array($data);
		$validation = $this->validator->validate($submission);

		if (is_wp_error($validation)) {
			wp_send_json_error(
				array(
					'message' => $validation->get_error_message(),
				)
			);
		}

		// Only verify CAPTCHA when the submitting widget actually has
		// "Show CAPTCHA" enabled. The setting is read from the saved
		// Elementor document data, never from client input.
		$widget_id = isset($data['formminia_form_id']) ? sanitize_text_field($data['formminia_form_id']) : '';
		$post_id = isset($data['formminia_post_id']) ? absint($data['formminia_post_id']) : 0;
		$widget_settings = (new ElementorWidgetSettings())->get($widget_id, $post_id);
		$show_captcha = isset($widget_settings['show_captcha']) && $widget_settings['show_captcha'] === 'yes';

		if ($show_captcha) {
			// Hand over the sanitized payload, never the raw request, so
			// unsanitized user input never reaches the captcha provider.
			$captcha_result = $this->captcha_verifier->verify($submission, $submission->raw);

			if (is_wp_error($captcha_result)) {
				wp_send_json_error(
					array(
						'message' => $captcha_result->get_error_message(),
					)
				);
			}
		}

		$sent = $this->mailer->send($submission);

		// Save to database regardless of email status.
		$this->repository->save($submission, [
			'ip_address' => $ip_address,
			'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_textarea_field(wp_unslash($_SERVER['HTTP_USER_AGENT'])) : '',
		]);

		if ($sent instanceof \WP_Error) {
			wp_send_json_error(
				array(
					'message' => $sent->get_error_message(),
				)
			);
		}

		if ($sent) {
			$this->mailer->send_autoresponder($submission);

			wp_send_json_success(
				array(
					'message' => esc_html__('Message sent successfully!', 'formminia-for-elementor'),
				)
			);
		}

		wp_send_json_error(
			array(
				'message' => esc_html__('Failed to send message. Please try again.', 'formminia-for-elementor'),
			)
		);
	}
}

