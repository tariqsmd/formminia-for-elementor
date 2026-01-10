<?php

namespace MTForms\Integrations\Elementor;

/**
 * Namespaced Elementor integration for MTForms.
 */
class Integration {

	public function __construct() {
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
	}

	/**
	 * Register MTForms Elementor widget.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		$widgets_manager->register( new Widget() );
	}
}
