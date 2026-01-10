<?php

namespace MTForms\Services;

/**
 * Adapter around wp_mail to allow easier testing/extensibility.
 */
class WpMailMailer {

	/**
	 * Send an email.
	 *
	 * @param string       $to      Recipient email.
	 * @param string       $subject Email subject.
	 * @param string       $message Email body.
	 * @param string|array $headers Headers.
	 *
	 * @return bool
	 */
	public function send( $to, $subject, $message, $headers ) {
		/**
		 * Filter the final email arguments before sending.
		 *
		 * @param array       $args {
		 *
		 * @type string       $to
		 * @type string       $subject
		 * @type string       $message
		 * @type string|array $headers
		 * }
		 */
		$args = apply_filters(
			'mtforms_email_args',
			array(
				'to'      => $to,
				'subject' => $subject,
				'message' => $message,
				'headers' => $headers,
			)
		);

		return wp_mail( $args['to'], $args['subject'], $args['message'], $args['headers'] );
	}
}

