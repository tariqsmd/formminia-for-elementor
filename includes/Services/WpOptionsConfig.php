<?php

namespace MTEF\Services;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Small wrapper around WordPress options for MT Elementor Forms.
 */
class WpOptionsConfig {

	/**
	 * Get an option value with default.
	 *
	 * @param string $key     Option name.
	 * @param mixed  $default Default value.
	 *
	 * @return mixed
	 */
	public function get( $key, $default = false ) {
		return get_option( $key, $default );
	}
}

