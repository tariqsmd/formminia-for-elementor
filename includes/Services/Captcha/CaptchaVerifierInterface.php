<?php

namespace MTEF\Services\Captcha;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MTEF\Services\FormSubmission;

/**
 * Contract for captcha verification providers.
 */
interface CaptchaVerifierInterface {

	/**
	 * Verify captcha for a submission.
	 *
	 * @param FormSubmission      $submission Submission data.
	 * @param array<string,mixed> $request    Raw request data (typically $_POST).
	 *
	 * @return true|\WP_Error
	 */
	public function verify( FormSubmission $submission, array $request );
}

