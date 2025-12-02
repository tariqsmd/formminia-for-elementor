<?php

/**
 * The Blocks Registration Class
 *
 * @since      1.0.0
 * @package    MT_Contact_Forms
 * @subpackage MT_Contact_Forms/includes
 */
class MTCF_Blocks {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
    }

    /**
     * Register Blocks
     */
    public function register_blocks() {
        register_block_type( MTCF_PLUGIN_DIR . 'blocks/mtcfcontact-form', array(
            'render_callback' => array( $this, 'render_callback' ),
        ) );
    }

    /**
     * Render Callback for the block
     */
    public function render_callback( $attributes ) {
        $skin = isset( $attributes['skin'] ) ? $attributes['skin'] : 'default';
        
        // Use the shortcode handler or manually render
        // Since the public class handles rendering and we need to pass attributes,
        // it's easiest to just invoke the public render method if accessible, 
        // or just re-implement the shortcode logic here (or do_shortcode).
        
        return do_shortcode( '[mtcf_form skin="' . esc_attr( $skin ) . '"]' );
    }

}
