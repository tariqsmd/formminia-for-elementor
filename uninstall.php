<?php
/**
 * FormMinia for Elementor uninstall handler.
 *
 * Removes the submissions table, all plugin options and rate-limit transients.
 *
 * @package FormMinia for Elementor
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
$table = $wpdb->prefix . 'formminia_submissions';
$wpdb->query( 'DROP TABLE IF EXISTS `' . esc_sql( $table ) . '`' ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared

// 2. Delete all plugin options.
$options = array(
	'formminia_captcha_provider',
	'formminia_recaptcha_site_key',
	'formminia_recaptcha_secret_key',
	'formminia_turnstile_site_key',
	'formminia_turnstile_secret_key',
	'formminia_admin_email',
	'formminia_email_cc',
	'formminia_email_bcc',
	'formminia_email_subject',
	'formminia_email_from_name',
	'formminia_enable_html_email',
	'formminia_email_accent_color',
	'formminia_email_logo_url',
	'formminia_email_footer_text',
	'formminia_email_bg_color',
	'formminia_email_content_bg_color',
	'formminia_email_text_color',
	'formminia_email_show_footer_credit',
	'formminia_submissions_table_ready',
);

foreach ( $options as $option ) {
	delete_option( $option );
}

// 3. Delete IP rate-limit transients.
$wpdb->query(
	"DELETE FROM {$wpdb->options} WHERE option_name LIKE '%\\_transient\\_formminia\\_rate\\_%' OR option_name LIKE '%\\_transient\\_timeout\\_formminia\\_rate\\_%'" // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
);