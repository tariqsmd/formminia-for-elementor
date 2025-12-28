<?php
/**
 * Legacy Elementor integration class.
 *
 * Kept for backwards compatibility and now proxies to the modern
 * MTForms\Elementor\Integration class.
 */
class MTForms_Elementor {

	public function __construct() {
		new \MTForms\Elementor\Integration();
	}
}
