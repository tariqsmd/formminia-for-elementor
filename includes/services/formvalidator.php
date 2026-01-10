<?php

namespace MTForms\Services;

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
	public function validate( FormSubmission $submission ) {
		/**
		 * Allow custom validation before MTForms runs its own rules.
		 *
		 * Return a \WP_Error to short-circuit validation.
		 */
		$pre = apply_filters( 'mtforms_before_validate_submission', null, $submission );
		if ( $pre instanceof \WP_Error ) {
			return $pre;
		}

		if ( empty( $submission->name ) || empty( $submission->email ) || empty( $submission->message ) ) {
			return new \WP_Error(
				'mtforms_required',
				__( 'Please fill in all required fields.', MTFORMS_TEXT_DOMAIN )
			);
		}

		if ( ! is_email( $submission->email ) ) {
			return new \WP_Error(
				'mtforms_invalid_email',
				__( 'Invalid email address.', MTFORMS_TEXT_DOMAIN )
			);
		}

		if ( $submission->gdpr_enabled && ! $submission->gdpr_accepted ) {
			return new \WP_Error(
				'mtforms_gdpr_required',
				__( 'You must accept the GDPR terms.', MTFORMS_TEXT_DOMAIN )
			);
		}

		/**
		 * Allow additional custom validation after core checks.
		 *
		 * Return a \WP_Error to make the submission invalid.
		 */
		$post = apply_filters( 'mtforms_after_validate_submission', null, $submission );
		if ( $post instanceof \WP_Error ) {
			return $post;
		}

		return true;
	}
}

