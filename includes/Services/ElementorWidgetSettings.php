<?php

namespace FORMMINIA\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This class is the sanctioned database access layer used to read Elementor
 * document data from post meta; direct $wpdb usage is deliberate here.
 */
// phpcs:disable WordPress.DB.DirectDatabaseQuery

/**
 * Loads a single Elementor widget's saved settings from post meta.
 *
 * Settings are read from the _elementor_data document data, so only
 * admin-controlled values are ever used (no client input is trusted).
 * Lookups are cached for 5 minutes to keep AJAX handling cheap.
 */
class ElementorWidgetSettings {

	/**
	 * Fetch the settings for a given Elementor widget ID.
	 *
	 * When a post ID is known the document data is loaded straight from that
	 * post's meta (using the primary key index). Otherwise a wildcard scan of
	 * _elementor_data is used as a fallback. Settings are cached for 5 minutes.
	 *
	 * @param string $widget_id Elementor element/widget ID.
	 * @param int    $post_id   Optional post containing the widget.
	 *
	 * @return array
	 */
	public function get( $widget_id, $post_id = 0 ) {
		if ( empty( $widget_id ) || ! class_exists( '\Elementor\Plugin' ) ) {
			return array();
		}

		$cache_key = 'formminia_widget_settings_' . md5( $widget_id );
		$cached = wp_cache_get( $cache_key );

		if ( false !== $cached ) {
			return is_array( $cached ) ? $cached : array();
		}

		$settings = $this->find_widget_on_post( $widget_id, (int) $post_id );

		if ( empty( $settings ) ) {
			$settings = $this->find_widget_anywhere( $widget_id );
		}

		wp_cache_set( $cache_key, $settings, '', 5 * MINUTE_IN_SECONDS );

		return $settings;
	}

	/**
	 * Look for the widget inside a single post's _elementor_data meta.
	 *
	 * Avoids the wildcard scan entirely when the containing post is known.
	 *
	 * @param string $widget_id Elementor element/widget ID.
	 * @param int    $post_id   Post ID.
	 *
	 * @return array
	 */
	protected function find_widget_on_post( $widget_id, $post_id ) {
		if ( $post_id <= 0 ) {
			return array();
		}

		$data = get_post_meta( $post_id, '_elementor_data', true );

		if ( is_string( $data ) ) {
			$data = json_decode( $data, true );
		}

		if ( ! is_array( $data ) ) {
			return array();
		}

		$widget = $this->find_widget_by_id( $data, $widget_id );

		if ( null !== $widget && isset( $widget['settings'] ) && is_array( $widget['settings'] ) ) {
			return $widget['settings'];
		}

		return array();
	}

	/**
	 * Fall back to scanning _elementor_data across all posts.
	 *
	 * @param string $widget_id Elementor element/widget ID.
	 *
	 * @return array
	 */
	protected function find_widget_anywhere( $widget_id ) {
		global $wpdb;

		$like_lookup = array(
			'%"id":"' . $wpdb->esc_like( $widget_id ) . '"%',
			'%"id": "' . $wpdb->esc_like( $widget_id ) . '"%',
		);

		$like_conditions = array();
		$params = array( '_elementor_data' );
		foreach ( $like_lookup as $like ) {
			$like_conditions[] = 'meta_value LIKE %s';
			$params[] = $like;
		}

		$sql = "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s AND (" . implode( ' OR ', $like_conditions ) . ') LIMIT 10';
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared, PluginCheck.Security.DirectDB.UnescapedDBParameter -- Query is fully prepared below; only the table name is interpolated.
		$rows = $wpdb->get_results( $wpdb->prepare( $sql, $params ), ARRAY_A );

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				$data = json_decode( $row['meta_value'], true );
				if ( ! is_array( $data ) ) {
					continue;
				}

				$widget = $this->find_widget_by_id( $data, $widget_id );
				if ( null !== $widget && isset( $widget['settings'] ) && is_array( $widget['settings'] ) ) {
					return $widget['settings'];
				}
			}
		}

		return array();
	}

	/**
	 * Recursively find an element by ID within Elementor data.
	 *
	 * @param array  $elements  Nested Elementor elements.
	 * @param string $widget_id Elementor element ID.
	 *
	 * @return array|null
	 */
	protected function find_widget_by_id( array $elements, $widget_id ) {
		foreach ( $elements as $element ) {
			if ( ! is_array( $element ) ) {
				continue;
			}

			if ( isset( $element['id'] ) && (string) $element['id'] === (string) $widget_id ) {
				return $element;
			}

			if ( ! empty( $element['elements'] ) && is_array( $element['elements'] ) ) {
				$found = $this->find_widget_by_id( $element['elements'], $widget_id );
				if ( null !== $found ) {
					return $found;
				}
			}
		}

		return null;
	}
}