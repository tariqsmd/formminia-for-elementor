<?php

namespace MTForms\Core;

/**
 * Fired during plugin activation.
 *
 * @since      1.0.0
 * @package    MTForms
 * @author     Muhammad Tariq
 */
class Activator {
	/**
	 * Run activation logic.
	 */
	public static function activate() {
		global $wpdb;

		$table_name = $wpdb->prefix . 'mtforms_submissions';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			name varchar(255) DEFAULT '' NOT NULL,
			email varchar(255) DEFAULT '' NOT NULL,
			phone varchar(50) DEFAULT '' NOT NULL,
			website varchar(255) DEFAULT '' NOT NULL,
			subject varchar(255) DEFAULT '' NOT NULL,
			message text NOT NULL,
			form_id varchar(100) DEFAULT '' NOT NULL,
			ip_address varchar(100) DEFAULT '' NOT NULL,
			user_agent text DEFAULT '' NOT NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			PRIMARY KEY  (id),
			KEY email (email),
			KEY created_at (created_at)
		) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}
}
