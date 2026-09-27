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
	 * Build a submission from a request payload.
	 *
	 * The payload MUST already be unslashed by the caller. WordPress slashes
	 * request data exactly once, so unslashing here as well would strip
	 * legitimate backslashes from visitor input.
	 *
	 * @param array<string, mixed> $data Unslashed request payload.
	 *
	 * @return self
	 */
	public static function from_post_array(array $data)
	{
		$instance = new self();
		$instance->name = isset($data['formminia_name']) ? sanitize_text_field($data['formminia_name']) : '';
		$instance->email = isset($data['formminia_email']) ? sanitize_email($data['formminia_email']) : '';
		$instance->phone = isset($data['formminia_phone']) ? sanitize_text_field($data['formminia_phone']) : '';
		$instance->website = isset($data['formminia_website']) ? esc_url_raw($data['formminia_website']) : '';
		$instance->subject = isset($data['formminia_subject']) ? sanitize_text_field($data['formminia_subject']) : '';
		$instance->message = isset($data['formminia_message']) ? sanitize_textarea_field($data['formminia_message']) : '';
		$instance->gdpr_enabled = isset($data['formminia_gdpr_enabled']) && sanitize_text_field($data['formminia_gdpr_enabled']) === 'yes';
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
	 * Values arrive unslashed, so they are sanitized but never unslashed again.
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
			return sanitize_text_field((string) $value);
		}

		return $value;
	}
}

