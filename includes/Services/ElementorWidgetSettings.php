<?php

namespace MTForms\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
	 * @param string $widget_id Elementor element/widget ID.
	 *
	 * @return array
	 */
	public function get( $widget_id ) {
		if ( empty( $widget_id ) || ! class_exists( '\Elementor\Plugin' ) ) {
			return array();
		}

		$cache_key = 'mtforms_widget_settings_' . md5( $widget_id );
		$cached = wp_cache_get( $cache_key );

		if ( false !== $cached ) {
			return is_array( $cached ) ? $cached : array();
		}

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
		$rows = $wpdb->get_results( $wpdb->prepare( $sql, $params ), ARRAY_A );

		$settings = array();

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				$data = json_decode( $row['meta_value'], true );
				if ( ! is_array( $data ) ) {
					continue;
				}

				$widget = $this->find_widget_by_id( $data, $widget_id );
				if ( null !== $widget && isset( $widget['settings'] ) && is_array( $widget['settings'] ) ) {
					$settings = $widget['settings'];
					break;
				}
			}
		}

		wp_cache_set( $cache_key, $settings, '', 5 * MINUTE_IN_SECONDS );

		return $settings;
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