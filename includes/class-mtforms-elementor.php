<?php
/**
 * The Elementor Integration Class
 *
 * @since      1.0.0
 * @package    MTForms
 * @subpackage MTForms/includes
 */
class MTForms_Elementor
{

	/**
	 * Initialize the class.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		add_action('elementor/widgets/register', array($this, 'register_widgets'));
	}

	/**
	 * Register Widgets
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{
		require_once MTFORMS_PLUGIN_DIR . 'includes/elementor/class-mtforms-widget.php';

		$widgets_manager->register(new \MTForms_Widget());
	}

}
