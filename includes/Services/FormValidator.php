<?php

namespace MTForms\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Server-side validator for MTForms submissions.
 */
class FormValidator {

	/**
	 * Validate a submission.
	 *
	 * @param FormSubmission $submission Submission to validate.
	 *
	 * @return true|\WP_Error
	 */
	public function validate(FormSubmission $submission)
	{
		/**
		 * Allow custom validation before MTForms runs its own rules.
		 *
		 * Return a \WP_Error to short-circuit validation.
		 */
		$pre = apply_filters('mtforms_before_validate_submission', null, $submission);
		if ($pre instanceof \WP_Error) {
			return $pre;
		}

		// Get required fields list from the submission (sent as comma separated via hidden field)
		$required_fields = isset($submission->raw['mtforms_required_fields']) ? explode(',', sanitize_text_field(wp_unslash($submission->raw['mtforms_required_fields']))) : [];

		foreach ($required_fields as $field) {
			$value = '';
			switch ($field) {
				case 'mtforms_name':
					$value = $submission->name;
					break;
				case 'mtforms_email':
					$value = $submission->email;
					break;
				case 'mtforms_phone':
					$value = $submission->phone;
					break;
				case 'mtforms_website':
					$value = $submission->website;
					break;
				case 'mtforms_subject':
					$value = $submission->subject;
					break;
				case 'mtforms_message':
					$value = $submission->message;
					break;
				case 'mtforms_gdpr':
					if (!$submission->gdpr_accepted) {
						return new \WP_Error('mtforms_gdpr_required', esc_html__('You must agree to the terms', 'mtforms'));
					}
					continue 2;
			}

			if (empty($value)) {
				return new \WP_Error('mtforms_required', esc_html__('Please fill in all required fields.', 'mtforms'));
			}
		}

		// Ensure at least one actual field has data (sanity check)
		$all_fields = [$submission->name, $submission->email, $submission->phone, $submission->website, $submission->subject, $submission->message];
		if (empty(array_filter($all_fields))) {
			return new \WP_Error('mtforms_empty', esc_html__('Please fill in at least one field.', 'mtforms'));
		}

		// Email format validation (only if email is provided or required)
		if (!empty($submission->email) && !is_email($submission->email)) {
			return new \WP_Error('mtforms_invalid_email', esc_html__('Invalid email address.', 'mtforms'));
		}

		/**
		 * Allow additional custom validation after core checks.
		 *
		 * Return a \WP_Error to make the submission invalid.
		 */
		$post = apply_filters('mtforms_after_validate_submission', null, $submission);
		if ($post instanceof \WP_Error) {
			return $post;
		}

		return true;
	}
}

