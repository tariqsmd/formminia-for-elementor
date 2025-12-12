<?php

/**
 * The Blocks Registration Class
 *
 * @since      1.0.0
 * @package    MTForms
 * @subpackage MTForms/includes
 */
class MTForms_Blocks
{

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
    }

    /**
     * Register Blocks
     */
    public function register_blocks()
    {
        register_block_type(MTFORMS_PLUGIN_DIR . 'blocks/contact-form', array(
            'render_callback' => array($this, 'render_callback'),
        ));
    }

    /**
     * Render Callback for the block
     * 
     * @param array $attributes Block attributes
     * @return string Rendered HTML
     */
    public function render_callback($attributes)
    {
        // Get defaults from Form Renderer
        $defaults = MTForms_Form_Renderer::get_default_settings();

        // Merge with block attributes
        $settings = array();
        foreach ($defaults as $key => $default_value) {
            if (isset($attributes[$key])) {
                $settings[$key] = $attributes[$key];
            } else {
                $settings[$key] = $default_value;
            }
        }

        // Render using the Form Renderer
        return MTForms_Form_Renderer::render($settings);
    }

}
