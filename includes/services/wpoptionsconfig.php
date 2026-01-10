<?php

namespace MTForms\Services;

/**
 * Small wrapper around WordPress options for MTForms.
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

