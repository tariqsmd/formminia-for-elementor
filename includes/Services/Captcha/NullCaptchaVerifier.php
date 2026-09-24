<?php

namespace FORMMINIA\Services\Captcha;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use FORMMINIA\Services\FormSubmission;

/**
 * No-op captcha verifier used when captcha provider is disabled.
 */
class NullCaptchaVerifier implements CaptchaVerifierInterface {

	/**
	 * @inheritDoc
	 */
	public function verify( FormSubmission $submission, array $request ) {
		unset( $submission, $request );

		return true;
	}
}

