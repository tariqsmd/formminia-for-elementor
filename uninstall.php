<?php
/**
 * MTForms uninstall handler.
 *
 * Removes the submissions table, all plugin options and rate-limit transients.
 *
 * @package MTForms
 */

// Exit if this file is not called by the WordPress uninstall procedure.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

// 1. Drop the submissions table.
$table = $wpdb->prefix . 'mtforms_submissions';
$wpdb->query( 'DROP TABLE IF EXISTS `' . esc_sql( $table ) . '`' ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

// 2. Delete all plugin options.
$options = array(
	'mtforms_captcha_provider',
	'mtforms_recaptcha_site_key',
	'mtforms_recaptcha_secret_key',
	'mtforms_turnstile_site_key',
	'mtforms_turnstile_secret_key',
	'mtforms_admin_email',
	'mtforms_email_cc',
	'mtforms_email_bcc',
	'mtforms_email_subject',
	'mtforms_email_from_name',
	'mtforms_enable_html_email',
	'mtforms_email_accent_color',
	'mtforms_email_logo_url',
	'mtforms_email_footer_text',
	'mtforms_email_bg_color',
	'mtforms_email_content_bg_color',
	'mtforms_email_text_color',
	'mtforms_email_show_footer_credit',
);

foreach ( $options as $option ) {
	delete_option( $option );
}

// 3. Delete IP rate-limit transients.
$wpdb->query(
	"DELETE FROM {$wpdb->options} WHERE option_name LIKE '%\\_transient\\_mtforms\\_rate\\_%' OR option_name LIKE '%\\_transient\\_timeout\\_mtforms\\_rate\\_%'" // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
);