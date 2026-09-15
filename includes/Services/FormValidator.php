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

		// Required fields are derived from the saved widget settings; the
		// client-declared list can never weaken the server-side rules.
		$required_fields = $this->resolve_required_fields($submission);

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

	/**
	 * Determine which fields are mandatory for a submission.
	 *
	 * The widget settings saved in Elementor are the source of truth. The
	 * client-declared list is only consulted as a fallback when the widget
	 * cannot be resolved from the submitted form ID.
	 *
	 * @param FormSubmission $submission Submission to validate.
	 *
	 * @return array
	 */
	protected function resolve_required_fields(FormSubmission $submission)
	{
		$widget_id = isset($submission->raw['mtforms_form_id']) ? sanitize_text_field(wp_unslash($submission->raw['mtforms_form_id'])) : '';
		$post_id = isset($submission->raw['mtforms_post_id']) ? absint($submission->raw['mtforms_post_id']) : 0;

		$settings = (new ElementorWidgetSettings())->get($widget_id, $post_id);

		if (empty($settings)) {
			// Widget could not be resolved; fall back to the client-declared list.
			return isset($submission->raw['mtforms_required_fields']) ? explode(',', sanitize_text_field(wp_unslash($submission->raw['mtforms_required_fields']))) : [];
		}

		$show_defaults = array(
			'name'    => 'yes',
			'email'   => 'yes',
			'phone'   => 'no',
			'website' => 'no',
			'subject' => 'yes',
			'message' => 'yes',
		);

		$required_defaults = array(
			'name'    => 'yes',
			'email'   => 'yes',
			'phone'   => 'no',
			'website' => 'no',
			'subject' => 'no',
			'message' => 'yes',
		);

		$required_fields = array();

		foreach (array_keys($show_defaults) as $field) {
			$show = isset($settings['show_' . $field]) ? $settings['show_' . $field] : $show_defaults[$field];
			$required = isset($settings['required_' . $field]) ? $settings['required_' . $field] : $required_defaults[$field];

			if ($show === 'yes' && $required === 'yes') {
				$required_fields[] = 'mtforms_' . $field;
			}
		}

		$show_gdpr = isset($settings['show_gdpr']) ? $settings['show_gdpr'] : 'no';
		if ($show_gdpr === 'yes') {
			$required_fields[] = 'mtforms_gdpr';
		}

		return $required_fields;
	}
}

