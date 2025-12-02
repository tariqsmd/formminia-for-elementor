<?php

/**
 * The Elementor Integration Class
 *
 * @since      1.0.0
 * @package    MT_Contact_Forms
 * @subpackage MT_Contact_Forms/includes
 */
class MTCF_Elementor {

    /**
     * Initialize the class.
     *
     * @since    1.0.0
     */
    public function __construct() {
        add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
    }

    /**
     * Register Widgets
     * 
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets( $widgets_manager ) {
        require_once MTCF_PLUGIN_DIR . 'elementor/class-mtcf-widget.php';

        $widgets_manager->register( new \MTCF_Widget() );
    }

}
