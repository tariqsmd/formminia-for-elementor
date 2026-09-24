<?php

namespace FORMMINIA\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
		$instance->name = isset($data['formminia_name']) ? sanitize_text_field(wp_unslash($data['formminia_name'])) : '';
		$instance->email = isset($data['formminia_email']) ? sanitize_email(wp_unslash($data['formminia_email'])) : '';
		$instance->phone = isset($data['formminia_phone']) ? sanitize_text_field(wp_unslash($data['formminia_phone'])) : '';
		$instance->website = isset($data['formminia_website']) ? esc_url_raw(wp_unslash($data['formminia_website'])) : '';
		$instance->subject = isset($data['formminia_subject']) ? sanitize_text_field(wp_unslash($data['formminia_subject'])) : '';
		$instance->message = isset($data['formminia_message']) ? sanitize_textarea_field(wp_unslash($data['formminia_message'])) : '';
		$instance->gdpr_enabled = isset($data['formminia_gdpr_enabled']) && sanitize_text_field(wp_unslash($data['formminia_gdpr_enabled'])) === 'yes';
		$instance->gdpr_accepted = isset($data['formminia_gdpr']);
		// The raw payload is sanitized recursively so it is safe to expose to
		// logging and extension hooks. Keys are preserved as-is; only values
		// are cleaned.
		$instance->raw = self::sanitize_payload($data);

		return $instance;
	}

	/**
	 * Recursively sanitize a request payload before storing/exposing it.
	 *
	 * @param mixed $value Value to sanitize.
	 *
	 * @return mixed
	 */
	private static function sanitize_payload($value)
	{
		if (is_array($value)) {
			return array_map(array(__CLASS__, 'sanitize_payload'), $value);
		}

		if (is_scalar($value) || $value === null) {
			return sanitize_text_field(wp_unslash((string) $value));
		}

		return $value;
	}
}

