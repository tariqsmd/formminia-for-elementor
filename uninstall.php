<?php
/**
 * Quick & Modern Forms for Elementor uninstall handler.
 *
 * Removes the submissions table, all plugin options and rate-limit transients.
 *
 * @package Quick & Modern Forms for Elementor
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if this file is not called by the WordPress uninstall procedure.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Uninstall cleanup is a deliberate, direct database operation; script-local variable names need no prefix.
// phpcs:disable WordPress.DB.DirectDatabaseQuery
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

global $wpdb;

// 1. Drop the submissions table.
$table = $wpdb->prefix . 'mtef_submissions';
$wpdb->query( 'DROP TABLE IF EXISTS `' . esc_sql( $table ) . '`' ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

// 2. Delete all plugin options.
$options = array(
	'mtef_captcha_provider',
	'mtef_recaptcha_site_key',
	'mtef_recaptcha_secret_key',
	'mtef_turnstile_site_key',
	'mtef_turnstile_secret_key',
	'mtef_admin_email',
	'mtef_email_cc',
	'mtef_email_bcc',
	'mtef_email_subject',
	'mtef_email_from_name',
	'mtef_enable_html_email',
	'mtef_email_accent_color',
	'mtef_email_logo_url',
	'mtef_email_footer_text',
	'mtef_email_bg_color',
	'mtef_email_content_bg_color',
	'mtef_email_text_color',
	'mtef_email_show_footer_credit',
	'mtef_submissions_table_ready',
);

foreach ( $options as $option ) {
	delete_option( $option );
}

// 3. Delete IP rate-limit transients.
$wpdb->query(
	"DELETE FROM {$wpdb->options} WHERE option_name LIKE '%\\_transient\\_mtef\\_rate\\_%' OR option_name LIKE '%\\_transient\\_timeout\\_mtef\\_rate\\_%'" // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
);