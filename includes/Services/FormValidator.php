<?php

namespace MTEF\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Server-side validator for Quick & Modern Forms for Elementor submissions.
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
		 * Allow custom validation before Quick & Modern Forms for Elementor runs its own rules.
		 *
		 * Return a \WP_Error to short-circuit validation.
		 */
		$pre = apply_filters('mtef_before_validate_submission', null, $submission);
		if ($pre instanceof \WP_Error) {
			return $pre;
		}

		// Required fields are derived from the saved widget settings; the
		// client-declared list can never weaken the server-side rules.
		$required_fields = $this->resolve_required_fields($submission);

		foreach ($required_fields as $field) {
			$value = '';
			switch ($field) {
				case 'mtef_name':
					$value = $submission->name;
					break;
				case 'mtef_email':
					$value = $submission->email;
					break;
				case 'mtef_phone':
					$value = $submission->phone;
					break;
				case 'mtef_website':
					$value = $submission->website;
					break;
				case 'mtef_subject':
					$value = $submission->subject;
					break;
				case 'mtef_message':
					$value = $submission->message;
					break;
				case 'mtef_gdpr':
					if (!$submission->gdpr_accepted) {
						return new \WP_Error('mtef_gdpr_required', esc_html__('You must agree to the terms', 'quick-modern-forms-for-elementor'));
					}
					continue 2;
			}

			if (empty($value)) {
				return new \WP_Error('mtef_required', esc_html__('Please fill in all required fields.', 'quick-modern-forms-for-elementor'));
			}
		}

		// Ensure at least one actual field has data (sanity check)
		$all_fields = [$submission->name, $submission->email, $submission->phone, $submission->website, $submission->subject, $submission->message];
		if (empty(array_filter($all_fields))) {
			return new \WP_Error('mtef_empty', esc_html__('Please fill in at least one field.', 'quick-modern-forms-for-elementor'));
		}

		// Email format validation (only if email is provided or required)
		if (!empty($submission->email) && !is_email($submission->email)) {
			return new \WP_Error('mtef_invalid_email', esc_html__('Invalid email address.', 'quick-modern-forms-for-elementor'));
		}

		/**
		 * Allow additional custom validation after core checks.
		 *
		 * Return a \WP_Error to make the submission invalid.
		 */
		$post = apply_filters('mtef_after_validate_submission', null, $submission);
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
		$widget_id = isset($submission->raw['mtef_form_id']) ? sanitize_text_field(wp_unslash($submission->raw['mtef_form_id'])) : '';
		$post_id = isset($submission->raw['mtef_post_id']) ? absint($submission->raw['mtef_post_id']) : 0;

		$settings = (new ElementorWidgetSettings())->get($widget_id, $post_id);

		if (empty($settings)) {
			// Widget could not be resolved; fall back to the client-declared list.
			return isset($submission->raw['mtef_required_fields']) ? explode(',', sanitize_text_field(wp_unslash($submission->raw['mtef_required_fields']))) : [];
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
				$required_fields[] = 'mtef_' . $field;
			}
		}

		$show_gdpr = isset($settings['show_gdpr']) ? $settings['show_gdpr'] : 'no';
		if ($show_gdpr === 'yes') {
			$required_fields[] = 'mtef_gdpr';
		}

		return $required_fields;
	}
}

