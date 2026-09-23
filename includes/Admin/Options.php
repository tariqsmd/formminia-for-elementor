<?php

namespace MTEF\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Centralized option keys for FormMinia for Elementor admin settings.
 */
class Options
{

	const GROUP_SETTINGS = 'mtef_settings';
	const GROUP_GENERAL = 'mtef_settings_general';
	const GROUP_EMAIL = 'mtef_settings_email';
	const CAPTCHA_PROVIDER = 'mtef_captcha_provider';
	const RECAPTCHA_SITE_KEY = 'mtef_recaptcha_site_key';
	const RECAPTCHA_SECRET_KEY = 'mtef_recaptcha_secret_key';
	const TURNSTILE_SITE_KEY = 'mtef_turnstile_site_key';
	const TURNSTILE_SECRET_KEY = 'mtef_turnstile_secret_key';
	const ADMIN_EMAIL = 'mtef_admin_email';
	const EMAIL_SUBJECT = 'mtef_email_subject';
	const EMAIL_FROM_NAME = 'mtef_email_from_name';
	const ENABLE_HTML_EMAIL = 'mtef_enable_html_email';
	const EMAIL_ACCENT_COLOR = 'mtef_email_accent_color';
	const EMAIL_LOGO_URL = 'mtef_email_logo_url';
	const EMAIL_FOOTER_TEXT = 'mtef_email_footer_text';
	const EMAIL_BG_COLOR = 'mtef_email_bg_color';
	const EMAIL_CONTENT_BG_COLOR = 'mtef_email_content_bg_color';
	const EMAIL_TEXT_COLOR = 'mtef_email_text_color';
	const EMAIL_SHOW_FOOTER_CREDIT = 'mtef_email_show_footer_credit';
	const EMAIL_CC = 'mtef_email_cc';
	const EMAIL_BCC = 'mtef_email_bcc';
}

