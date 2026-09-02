<?php

namespace MTForms\Integrations\Elementor;

use MTForms\Integrations\Elementor\WidgetControls\ContentControls;
use MTForms\Integrations\Elementor\WidgetControls\StyleControls;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Widget Class - MT Contact Form
 *
 * Comprehensive contact form widget with extensive customization options.
 *
 * @since 1.0.0
 */
class Widget extends \Elementor\Widget_Base
{
	use ContentControls, StyleControls, WidgetRenderer;

	public function __construct(array $data = [], $args = null)
	{
		parent::__construct($data, $args);

		wp_register_style(
			'mtforms',
			MTFORMS_PLUGIN_URL . 'assets/css/mtforms.css',
			[],
			MTFORMS_VERSION
		);

		wp_register_script(
			'mtforms',
			MTFORMS_PLUGIN_URL . 'assets/js/mtforms.js',
			['elementor-frontend', 'mtforms-just-validate'],
			MTFORMS_VERSION,
			true
		);

		wp_localize_script(
			'mtforms',
			'mtforms_ajax',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('mtforms-submit-form'),
				'i18n' => array(
					'name_required' => esc_html__('Name is required', 'mtforms'),
					'name_min' => esc_html__('Name must be at least 2 characters', 'mtforms'),
					'email_required' => esc_html__('Email is required', 'mtforms'),
					'email_invalid' => esc_html__('Email is invalid', 'mtforms'),
					'phone_required' => esc_html__('Phone number is required', 'mtforms'),
					'phone_invalid' => esc_html__('Please enter a valid phone number', 'mtforms'),
					'website_required' => esc_html__('Website URL is required', 'mtforms'),
					'website_invalid' => esc_html__('Please enter a valid URL', 'mtforms'),
					'subject_required' => esc_html__('Subject is required', 'mtforms'),
					'message_required' => esc_html__('Message is required', 'mtforms'),
					'gdpr_required' => esc_html__('You must agree to the terms', 'mtforms'),
					'sending' => esc_html__('Sending...', 'mtforms'),
					'send_message' => esc_html__('Send Message', 'mtforms'),
					'error_generic' => esc_html__('An unexpected error occurred. Please try again.', 'mtforms'),
				),
				'captcha_provider' => get_option('mtforms_captcha_provider', 'none'),
			)
		);

	}

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'mtforms';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('MT Contact Form', 'mtforms');
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-form-horizontal';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['mtforms'];
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['contact', 'form', 'email', 'message', 'feedback'];
	}

	/**
	 * Get style dependencies.
	 *
	 * @return array Style handles.
	 */
	public function get_style_depends()
	{
		return ['mtforms'];
	}

	/**
	 * Get script dependencies.
	 *
	 * @return array Script handles.
	 */
	public function get_script_depends()
	{
		return ['mtforms'];
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls()
	{
		$this->register_content_tab_controls();
		$this->register_style_tab_controls();
	}
}
