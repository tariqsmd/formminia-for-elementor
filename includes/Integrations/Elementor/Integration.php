<?php

namespace FORMMINIA\Integrations\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Namespaced Elementor integration for FormMinia for Elementor.
 */
class Integration {

	public function __construct() {
		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_categories' ) );
	}

	/**
	 * Register the FormMinia for Elementor Elementor category.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Elements manager.
	 */
	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'formminia',
			array(
				'title' => esc_html__( 'FormMinia', 'formminia-for-elementor' ),
				'icon'  => 'eicon-form-horizontal',
			)
		);
	}

	/**
	 * Register FormMinia for Elementor Elementor widget.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		$widgets_manager->register( new Widget() );
	}
}
