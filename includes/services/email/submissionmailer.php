<?php

namespace MTForms\Services\Email;

use MTForms\Services\FormSubmission;
use MTForms\Services\WpMailMailer;
use MTForms\Services\WpOptionsConfig;

/**
 * Builds and sends notification emails for form submissions.
 */
class SubmissionMailer
{

	/** @var WpOptionsConfig */
	protected $config;

	/** @var WpMailMailer */
	protected $mailer;

	public function __construct(WpOptionsConfig $config, WpMailMailer $mailer)
	{
		$this->config = $config;
		$this->mailer = $mailer;
	}

	/**
	 * Send submission email.
	 *
	 * @param FormSubmission $submission Submission data.
	 *
	 * @return bool|\WP_Error
	 */
	public function send(FormSubmission $submission)
	{
		$form_fields = array(
			__('Name', MTFORMS_TEXT_DOMAIN) => $submission->name,
			__('Email', MTFORMS_TEXT_DOMAIN) => $submission->email,
			__('Message', MTFORMS_TEXT_DOMAIN) => $submission->message,
		);

		if ($submission->phone !== '') {
			$form_fields[__('Phone', MTFORMS_TEXT_DOMAIN)] = $submission->phone;
		}

		if ($submission->website !== '') {
			$form_fields[__('Website', MTFORMS_TEXT_DOMAIN)] = $submission->website;
		}

		if ($submission->subject !== '') {
			$form_fields[__('Subject', MTFORMS_TEXT_DOMAIN)] = $submission->subject;
		}

		$to = $this->config->get('mtforms_admin_email', get_option('admin_email'));
		$from_name = $this->config->get('mtforms_email_from_name', get_bloginfo('name'));
		$default_sub = $this->config->get('mtforms_email_subject', 'New Contact Form Submission');
		$use_html = $this->config->get('mtforms_enable_html_email', 'yes') === 'yes';

		$to = apply_filters('mtforms_email_to', $to, $submission, $form_fields);
		$from_name = apply_filters('mtforms_email_from_name', $from_name, $submission, $form_fields);

		// Basic header injection protection.
		$from_name_safe = str_replace(array("\r", "\n"), '', (string) $from_name);
		$reply_to_name = str_replace(array("\r", "\n"), '', (string) $submission->name);
		$reply_to_email = str_replace(array("\r", "\n"), '', (string) $submission->email);

		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . wp_specialchars_decode($from_name_safe, ENT_QUOTES) . ' <' . get_option('admin_email') . '>',
			'Reply-To: ' . wp_specialchars_decode($reply_to_name, ENT_QUOTES) . ' <' . $reply_to_email . '>',
		);

		$headers = apply_filters('mtforms_email_headers', $headers, $submission, $form_fields);

		$email_subject = $default_sub;
		if ($submission->subject !== '') {
			$email_subject = sprintf(
				/* translators: 1: Default subject, 2: Submission subject */
				__('[%1$s] %2$s', MTFORMS_TEXT_DOMAIN),
				$default_sub,
				$submission->subject
			);
		}

		$email_subject = apply_filters('mtforms_email_subject', $email_subject, $submission, $form_fields);

		$email_body = $this->build_body($submission, $form_fields, $use_html);

		/**
		 * Filter the final email body.
		 *
		 * @param string         $email_body
		 * @param FormSubmission $submission
		 * @param array          $form_fields
		 */
		$email_body = apply_filters('mtforms_email_body', $email_body, $submission, $form_fields);

		/**
		 * Action before sending the email.
		 */
		do_action('mtforms_before_send', $submission, $email_subject, $email_body, $headers, $form_fields);

		$sent = $this->mailer->send($to, $email_subject, $email_body, $headers);

		/**
		 * Action after sending the email.
		 */
		do_action('mtforms_after_send', $sent, $submission, $email_subject, $email_body, $headers, $form_fields);

		return $sent;
	}

	/**
	 * Build email body, using HTML template when enabled.
	 *
	 * @param FormSubmission $submission  Submission data.
	 * @param array          $form_fields Label => value pairs.
	 * @param bool           $use_html    Whether to use HTML template.
	 *
	 * @return string
	 */
	protected function build_body(FormSubmission $submission, array $form_fields, $use_html)
	{
		unset($submission); // Currently unused but kept for future template context.

		if ($use_html) {
			$template_path = MTFORMS_PLUGIN_DIR . 'includes/integrations/elementor/partials/email-template.php';

			/**
			 * Filter the email template path.
			 *
			 * Allows themes/plugins to override the HTML template.
			 */
			$template_path = apply_filters('mtforms_email_template_path', $template_path, $form_fields);

			if (file_exists($template_path)) {
				ob_start();

				// Inject variables directly so the template can use $fields, $date, $site_name.
				$fields = $form_fields;
				$date = current_time('mysql');
				$site_name = get_bloginfo('name');

				include $template_path;

				return (string) ob_get_clean();
			}
		}

		// Fallback to simple HTML output.
		$email_parts = array();

		foreach ($form_fields as $label => $value) {
			$email_parts[] = '<strong>' . esc_html($label) . ':</strong> ' . esc_html($value);
		}

		return implode('<br><br>', $email_parts);
	}
}

