<?php

namespace FORMMINIA\Services\Captcha;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use FORMMINIA\Services\FormSubmission;

/**
 * Contract for captcha verification providers.
 */
interface CaptchaVerifierInterface {

	/**
	 * Verify captcha for a submission.
	 *
	 * @param FormSubmission      $submission Submission data.
	 * @param array<string,mixed> $request    Sanitized, already-unslashed payload
	 *                                       (FormSubmission::$raw). Implementations
	 *                                       must not unslash it again.
	 *
	 * @return true|\WP_Error
	 */
	public function verify( FormSubmission $submission, array $request );
}

