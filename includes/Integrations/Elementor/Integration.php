<?php

namespace MTEF\Integrations\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Namespaced Elementor integration for Quick Forms for Elementor.
 */
class Integration {

	public function __construct() {
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_categories' ) );
	}

	/**
	 * Register the Quick Forms for Elementor Elementor category.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Elements manager.
	 */
	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'mtef',
			array(
				'title' => esc_html__( 'Quick Forms for Elementor', 'quick-forms-for-elementor' ),
				'icon'  => 'eicon-form-horizontal',
			)
		);
	}

	/**
	 * Register Quick Forms for Elementor Elementor widget.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		$widgets_manager->register( new Widget() );
	}
}
