<?php

namespace MTForms\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This repository is the sanctioned database access layer for the custom
 * mtforms_submissions table, so direct $wpdb usage is deliberate.
 */
// phpcs:disable WordPress.DB.DirectDatabaseQuery

/**
 * Repository for managing form submissions in the database.
 */
class SubmissionRepository
{
	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $table_name;

	/**
	 * Whether the table existence has been verified this request.
	 *
	 * @var bool
	 */
	protected static $table_verified = false;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'mtforms_submissions';
	}

	/**
	 * Ensure the submissions table exists.
	 *
	 * The table is normally created on plugin activation, but a failed or
	 * skipped activation would make every insert fail silently. Running the
	 * schema check here (at most once per request) makes storage self-healing.
	 */
	public function ensure_table()
	{
		global $wpdb;

		if (self::$table_verified) {
			return;
		}
		self::$table_verified = true;

		if (get_option('mtforms_submissions_table_ready') === '1') {
			return;
		}

		$exists = $wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $this->table_name));
		if ($exists) {
			update_option('mtforms_submissions_table_ready', '1');
			return;
		}

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$this->table_name} (
			id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			name varchar(255) DEFAULT '' NOT NULL,
			email varchar(255) DEFAULT '' NOT NULL,
			phone varchar(50) DEFAULT '' NOT NULL,
			website varchar(255) DEFAULT '' NOT NULL,
			subject varchar(255) DEFAULT '' NOT NULL,
			message text NOT NULL,
			form_id varchar(100) DEFAULT '' NOT NULL,
			ip_address varchar(100) DEFAULT '' NOT NULL,
			user_agent text NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			PRIMARY KEY  (id),
			KEY email (email),
			KEY created_at (created_at)
		) $charset_collate;";

		dbDelta( $sql );

		$exists = $wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $this->table_name));
		if ($exists) {
			update_option('mtforms_submissions_table_ready', '1');
		}
	}

	/**
	 * Save a submission to the database.
	 *
	 * @param FormSubmission $submission Submission data.
	 * @param array          $meta       Additional metadata (IP, user agent, etc.).
	 *
	 * @return int|false The ID of the inserted row, or false on failure.
	 */
	public function save(FormSubmission $submission, array $meta = [])
	{
		global $wpdb;

		$this->ensure_table();

		$data = [
			'name'       => $submission->name,
			'email'      => $submission->email,
			'phone'      => $submission->phone,
			'website'    => $submission->website,
			'subject'    => $submission->subject,
			'message'    => $submission->message,
			'form_id'    => isset($submission->raw['mtforms_form_id']) ? sanitize_text_field($submission->raw['mtforms_form_id']) : '',
			'ip_address' => isset($meta['ip_address']) ? sanitize_text_field($meta['ip_address']) : '',
			'user_agent' => isset($meta['user_agent']) ? sanitize_textarea_field($meta['user_agent']) : '',
		];

		$format = [
			'%s', // name
			'%s', // email
			'%s', // phone
			'%s', // website
			'%s', // subject
			'%s', // message
			'%s', // form_id
			'%s', // ip_address
			'%s', // user_agent
		];

		$result = $wpdb->insert($this->table_name, $data, $format);

		if (false === $result) {
			if (defined('WP_DEBUG') && WP_DEBUG) {
				// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log -- Debug-only diagnostics behind WP_DEBUG.
				error_log('[MTForms] Submission insert failed (table: ' . $this->table_name . '): ' . $wpdb->last_error);
			}

			return false;
		}

		return $wpdb->insert_id;
	}

	/**
	 * Get submissions.
	 *
	 * @param int    $limit   Number of submissions to retrieve.
	 * @param int    $offset  Offset.
	 * @param string $search  Search query.
	 * @param string $orderby Column to sort by (name, email, subject, created_at).
	 * @param string $order   Sort direction (ASC or DESC).
	 *
	 * @return array
	 */
	public function get_submissions($limit = 20, $offset = 0, $search = '', $orderby = 'created_at', $order = 'DESC')
	{
		global $wpdb;

		$this->ensure_table();

		$allowed_sort = array('name', 'email', 'subject', 'created_at');
		$orderby = in_array($orderby, $allowed_sort, true) ? $orderby : 'created_at';
		$order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

		$query = "SELECT * FROM {$this->table_name}";
		$where = [];
		$params = [];

		if (!empty($search)) {
			$where[] = "(name LIKE %s OR email LIKE %s OR subject LIKE %s OR message LIKE %s)";
			$search_term = '%' . $wpdb->esc_like($search) . '%';
			$params[] = $search_term;
			$params[] = $search_term;
			$params[] = $search_term;
			$params[] = $search_term;
		}

		if (!empty($where)) {
			$query .= " WHERE " . implode(" AND ", $where);
		}

		$query .= " ORDER BY {$orderby} {$order} LIMIT %d OFFSET %d";
		$params[] = $limit;
		$params[] = $offset;

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared, PluginCheck.Security.DirectDB.UnescapedDBParameter -- Query is fully prepared below; only the table name is interpolated.
		return $wpdb->get_results($wpdb->prepare($query, $params), ARRAY_A);
	}

	/**
	 * Get total count of submissions.
	 *
	 * @param string $search Search query.
	 *
	 * @return int
	 */
	public function get_total_count($search = '')
	{
		global $wpdb;

		$this->ensure_table();

		if (empty($search)) {
			return (int) $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}mtforms_submissions");
		}

		$search_term = '%' . $wpdb->esc_like($search) . '%';

		return (int) $wpdb->get_var(
			$wpdb->prepare(
				'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'mtforms_submissions WHERE (name LIKE %s OR email LIKE %s OR subject LIKE %s OR message LIKE %s)',
				$search_term,
				$search_term,
				$search_term,
				$search_term
			)
		);
	}

	/**
	 * Delete a submission.
	 *
	 * @param int $id Submission ID.
	 *
	 * @return bool
	 */
	public function delete($id)
	{
		global $wpdb;
		return (bool) $wpdb->delete($this->table_name, ['id' => $id], ['%d']);
	}
}
