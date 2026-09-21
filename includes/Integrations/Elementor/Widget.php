<?php

namespace MTEF\Integrations\Elementor;

use MTEF\Integrations\Elementor\WidgetControls\ContentControls;
use MTEF\Integrations\Elementor\WidgetControls\StyleControls;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Widget Class - MT Elementor Forms
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
			'mtef',
			MTEF_PLUGIN_URL . 'assets/css/mtef.min.css',
			[],
			MTEF_VERSION
		);

		wp_register_script(
			'mtef',
			MTEF_PLUGIN_URL . 'assets/js/mtef.js',
			['elementor-frontend', 'mtef-just-validate'],
			MTEF_VERSION,
			true
		);

		wp_localize_script(
			'mtef',
			'mtef_ajax',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('mtef-submit-form'),
				'i18n' => array(
					'name_required' => esc_html__('Name is required', 'mt-elementor-forms'),
					'name_min' => esc_html__('Name must be at least 2 characters', 'mt-elementor-forms'),
					'email_required' => esc_html__('Email is required', 'mt-elementor-forms'),
					'email_invalid' => esc_html__('Email is invalid', 'mt-elementor-forms'),
					'phone_required' => esc_html__('Phone number is required', 'mt-elementor-forms'),
					'phone_invalid' => esc_html__('Please enter a valid phone number', 'mt-elementor-forms'),
					'website_required' => esc_html__('Website URL is required', 'mt-elementor-forms'),
					'website_invalid' => esc_html__('Please enter a valid URL', 'mt-elementor-forms'),
					'subject_required' => esc_html__('Subject is required', 'mt-elementor-forms'),
					'message_required' => esc_html__('Message is required', 'mt-elementor-forms'),
					'gdpr_required' => esc_html__('You must agree to the terms', 'mt-elementor-forms'),
					'sending' => esc_html__('Sending...', 'mt-elementor-forms'),
					'send_message' => esc_html__('Send Message', 'mt-elementor-forms'),
					'error_generic' => esc_html__('An unexpected error occurred. Please try again.', 'mt-elementor-forms'),
				),
				'captcha_provider' => get_option('mtef_captcha_provider', 'none'),
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
		return 'mtef';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('MT Contact Form', 'mt-elementor-forms');
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
		return ['mtef'];
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
		return ['mtef'];
	}

	/**
	 * Get script dependencies.
	 *
	 * @return array Script handles.
	 */
	public function get_script_depends()
	{
		return ['mtef'];
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
