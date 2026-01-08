<?php

namespace MTForms\Services\Captcha;

use MTForms\Services\FormSubmission;

/**
 * No-op captcha verifier used when captcha provider is disabled.
 */
class NullCaptchaVerifier implements CaptchaVerifierInterface
{

	/**
	 * @inheritDoc
	 */
	public function verify(FormSubmission $submission, array $request)
	{
		unset($submission, $request);

		return true;
	}
}

