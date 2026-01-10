<?php

/**
 * MTForms Core Bootstrap
 *
 * Registers a lightweight PSR-4 style autoloader for the MTForms namespace.
 */

if ( ! defined( 'MTFORMS_VERSION' ) ) {
	// If the main plugin file hasn't defined constants yet, bail early.
	return;
}

// Register a simple PSR-4 like autoloader for the MTForms namespace.
spl_autoload_register(
	static function ( $class ) {
		if ( strpos( $class, 'MTForms\\' ) !== 0 ) {
			return;
		}

		$relative = substr( $class, strlen( 'MTForms\\' ) );
		$relative = str_replace( '\\', DIRECTORY_SEPARATOR, $relative );

		// Convert to lowercase for consistent lowercase file naming.
		$file = MTFORMS_PLUGIN_DIR . 'includes/' . strtolower( $relative ) . '.php';

		if ( file_exists( $file ) ) {
			require_once $file;
		}
	}
);

