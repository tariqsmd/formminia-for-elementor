<?php

namespace MTForms\Services;

/**
 * Value object representing a sanitized form submission.
 */
class FormSubmission
{

	/** @var string */
	public $name;

	/** @var string */
	public $email;

	/** @var string */
	public $phone;

	/** @var string */
	public $website;

	/** @var string */
	public $subject;

	/** @var string */
	public $message;

	/**
	 * Whether the GDPR checkbox was rendered on the form.
	 *
	 * @var bool
	 */
	public $gdpr_enabled;

	/**
	 * Whether the user checked the GDPR checkbox.
	 *
	 * @var bool
	 */
	public $gdpr_accepted;

	/**
	 * Raw request payload (for logging / hooks).
	 *
	 * @var array<string, mixed>
	 */
	public $raw;

	/**
	 * @param array<string, mixed> $data
	 *
	 * @return self
	 */
	public static function from_post_array(array $data)
	{
		$instance = new self();
		$instance->name = isset($data['mtforms_name']) ? sanitize_text_field(wp_unslash($data['mtforms_name'])) : '';
		$instance->email = isset($data['mtforms_email']) ? sanitize_email(wp_unslash($data['mtforms_email'])) : '';
		$instance->phone = isset($data['mtforms_phone']) ? sanitize_text_field(wp_unslash($data['mtforms_phone'])) : '';
		$instance->website = isset($data['mtforms_website']) ? esc_url_raw(wp_unslash($data['mtforms_website'])) : '';
		$instance->subject = isset($data['mtforms_subject']) ? sanitize_text_field(wp_unslash($data['mtforms_subject'])) : '';
		$instance->message = isset($data['mtforms_message']) ? sanitize_textarea_field(wp_unslash($data['mtforms_message'])) : '';
		$instance->gdpr_enabled = isset($data['mtforms_gdpr_enabled']) && sanitize_text_field(wp_unslash($data['mtforms_gdpr_enabled'])) === 'yes';
		$instance->gdpr_accepted = isset($data['mtforms_gdpr']);
		$instance->raw = $data;

		return $instance;
	}
}

