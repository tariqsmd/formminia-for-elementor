<?php

namespace MTForms\Services\Email;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use MTForms\Services\FormSubmission;
use MTForms\Services\WpMailMailer;
use MTForms\Services\WpOptionsConfig;
use MTForms\Services\ElementorWidgetSettings;

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
		$form_fields = array();

		if (!empty($submission->name)) {
			$form_fields[__('Name', MTFORMS_TEXT_DOMAIN)] = $submission->name;
		}

		if (!empty($submission->email)) {
			$form_fields[__('Email', MTFORMS_TEXT_DOMAIN)] = $submission->email;
		}

		if (!empty($submission->phone)) {
			$form_fields[__('Phone', MTFORMS_TEXT_DOMAIN)] = $submission->phone;
		}

		if (!empty($submission->website)) {
			$form_fields[__('Website', MTFORMS_TEXT_DOMAIN)] = $submission->website;
		}

		if (!empty($submission->subject)) {
			$form_fields[__('Subject', MTFORMS_TEXT_DOMAIN)] = $submission->subject;
		}

		if (!empty($submission->message)) {
			$form_fields[__('Message', MTFORMS_TEXT_DOMAIN)] = $submission->message;
		}

		$widget_id = isset($submission->raw['mtforms_form_id']) ? sanitize_text_field(wp_unslash($submission->raw['mtforms_form_id'])) : '';
		$widget_settings = $this->get_widget_mail_settings($widget_id);

		$to = (isset($widget_settings['mail_to']) && is_string($widget_settings['mail_to']) && is_email($widget_settings['mail_to']))
			? sanitize_email($widget_settings['mail_to'])
			: $this->config->get('mtforms_admin_email', get_option('admin_email'));

		$from_name = $this->config->get('mtforms_email_from_name', get_bloginfo('name'));
		$default_sub = $this->config->get('mtforms_email_subject', 'New Contact Form Submission');
		$use_html = $this->config->get('mtforms_enable_html_email', 'yes') === 'yes';

		$to = apply_filters('mtforms_email_to', $to, $submission, $form_fields);
		$from_name = apply_filters('mtforms_email_from_name', $from_name, $submission, $form_fields);

		// Basic header injection protection.
		$from_name_safe = str_replace(array("\r", "\n"), '', (string) $from_name);
		$reply_to_name = str_replace(array("\r", "\n"), '', (string) $submission->name);
		$reply_to_email = is_email(str_replace(array("\r", "\n"), '', (string) $submission->email));

		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . wp_specialchars_decode($from_name_safe, ENT_QUOTES) . ' <' . get_option('admin_email') . '>',
		);

		if ($reply_to_email) {
			$headers[] = 'Reply-To: ' . wp_specialchars_decode($reply_to_name, ENT_QUOTES) . ' <' . $reply_to_email . '>';
		}

		// Handle CC (server-side only).
		$cc_emails = $this->resolve_email_list($widget_settings, 'mail_cc', $this->config->get('mtforms_email_cc', ''));
		if (!empty($cc_emails)) {
			$headers[] = 'Cc: ' . implode(', ', $cc_emails);
		}

		// Handle BCC (server-side only).
		$bcc_emails = $this->resolve_email_list($widget_settings, 'mail_bcc', $this->config->get('mtforms_email_bcc', ''));
		if (!empty($bcc_emails)) {
			$headers[] = 'Bcc: ' . implode(', ', $bcc_emails);
		}

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
	 * Send auto-responder email to the user.
	 *
	 * @param FormSubmission $submission Submission data.
	 *
	 * @return bool|\WP_Error
	 */
	public function send_autoresponder(FormSubmission $submission)
	{
		if (empty($submission->email)) {
			return false;
		}

		$enabled = isset($submission->raw['mtforms_enable_autoresponder']) && $submission->raw['mtforms_enable_autoresponder'] === 'yes';
		if (!$enabled) {
			return false;
		}

		$subject = isset($submission->raw['mtforms_autoresponder_subject']) ? sanitize_text_field($submission->raw['mtforms_autoresponder_subject']) : __('Thank you for your submission', MTFORMS_TEXT_DOMAIN);
		$message = isset($submission->raw['mtforms_autoresponder_message']) ? sanitize_textarea_field($submission->raw['mtforms_autoresponder_message']) : '';

		if (empty($message)) {
			return false;
		}

		// Replace tags (escaped for HTML context).
		$tags = [
			'{name}'    => esc_html($submission->name),
			'{email}'   => esc_html($submission->email),
			'{subject}' => esc_html($submission->subject),
		];
		$message = str_replace(array_keys($tags), array_values($tags), $message);
		$message = nl2br($message);

		$from_name = $this->config->get('mtforms_email_from_name', get_bloginfo('name'));
		$from_email = get_option('admin_email');

		$headers = [
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . wp_specialchars_decode($from_name, ENT_QUOTES) . ' <' . $from_email . '>',
		];

		return $this->mailer->send($submission->email, $subject, $message, $headers);
	}

	/**
	 * Resolve a comma-separated email list, preferring per-widget overrides
	 * and falling back to the global setting. Every address is validated.
	 *
	 * @param array  $widget_settings Per-widget Elementor settings.
	 * @param string $key             Widget settings key.
	 * @param string $global_value    Global option value.
	 *
	 * @return array
	 */
	protected function resolve_email_list(array $widget_settings, $key, $global_value)
	{
		$value = '';
		if (isset($widget_settings[$key]) && is_string($widget_settings[$key]) && trim($widget_settings[$key]) !== '') {
			$value = $widget_settings[$key];
		} elseif (is_string($global_value)) {
			$value = $global_value;
		}

		if (trim($value) === '') {
			return array();
		}

		$emails = array_map('trim', explode(',', $value));

		return array_unique(array_filter($emails, 'is_email'));
	}

	/**
	 * Fetch the Elementor widget settings for a given widget ID.
	 *
	 * Settings are read from the Elementor document data stored in post meta,
	 * so only admin-controlled recipient addresses are used (no client input).
	 *
	 * @param string $widget_id Elementor element/widget ID.
	 *
	 * @return array
	 */
	protected function get_widget_mail_settings($widget_id)
	{
		return (new ElementorWidgetSettings())->get($widget_id);
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
		if ($use_html) {
			$template_path = MTFORMS_PLUGIN_DIR . 'includes/Integrations/Elementor/Partials/email-template.php';

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

