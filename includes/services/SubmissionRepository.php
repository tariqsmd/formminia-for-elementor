<?php

namespace MTForms\Services;

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
	 * Constructor.
	 */
	public function __construct()
	{
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'mtforms_submissions';
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
			return false;
		}

		return $wpdb->insert_id;
	}

	/**
	 * Get submissions.
	 *
	 * @param int    $limit  Number of submissions to retrieve.
	 * @param int    $offset Offset.
	 * @param string $search Search query.
	 *
	 * @return array
	 */
	public function get_submissions($limit = 20, $offset = 0, $search = '')
	{
		global $wpdb;

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

		$query .= " ORDER BY created_at DESC LIMIT %d OFFSET %d";
		$params[] = $limit;
		$params[] = $offset;

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

		$query = "SELECT COUNT(*) FROM {$this->table_name}";
		$params = [];

		if (!empty($search)) {
			$query .= " WHERE (name LIKE %s OR email LIKE %s OR subject LIKE %s OR message LIKE %s)";
			$search_term = '%' . $wpdb->esc_like($search) . '%';
			$params[] = $search_term;
			$params[] = $search_term;
			$params[] = $search_term;
			$params[] = $search_term;
		}

		if (!empty($params)) {
			return (int) $wpdb->get_var($wpdb->prepare($query, $params));
		}

		return (int) $wpdb->get_var($query);
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
