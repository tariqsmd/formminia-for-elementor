<?php

namespace FORMMINIA\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Centralized option keys for FormMinia for Elementor admin settings.
 */
class Options
{

	const GROUP_SETTINGS = 'formminia_settings';
	const GROUP_GENERAL = 'formminia_settings_general';
	const GROUP_EMAIL = 'formminia_settings_email';
	const GROUP_TEMPLATE = 'formminia_settings_template';
	const CAPTCHA_PROVIDER = 'formminia_captcha_provider';
	const RECAPTCHA_SITE_KEY = 'formminia_recaptcha_site_key';
	const RECAPTCHA_SECRET_KEY = 'formminia_recaptcha_secret_key';
	const TURNSTILE_SITE_KEY = 'formminia_turnstile_site_key';
	const TURNSTILE_SECRET_KEY = 'formminia_turnstile_secret_key';
	const ADMIN_EMAIL = 'formminia_admin_email';
	const EMAIL_SUBJECT = 'formminia_email_subject';
	const EMAIL_FROM_NAME = 'formminia_email_from_name';
	const ENABLE_HTML_EMAIL = 'formminia_enable_html_email';
	const EMAIL_ACCENT_COLOR = 'formminia_email_accent_color';
	const EMAIL_LOGO_URL = 'formminia_email_logo_url';
	const EMAIL_FOOTER_TEXT = 'formminia_email_footer_text';
	const EMAIL_BG_COLOR = 'formminia_email_bg_color';
	const EMAIL_CONTENT_BG_COLOR = 'formminia_email_content_bg_color';
	const EMAIL_TEXT_COLOR = 'formminia_email_text_color';
	const EMAIL_SHOW_FOOTER_CREDIT = 'formminia_email_show_footer_credit';
	const EMAIL_CC = 'formminia_email_cc';
	const EMAIL_BCC = 'formminia_email_bcc';
}

