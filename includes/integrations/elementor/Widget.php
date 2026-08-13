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
					'name_required' => __('Name is required', MTFORMS_TEXT_DOMAIN),
					'name_min' => __('Name must be at least 2 characters', MTFORMS_TEXT_DOMAIN),
					'email_required' => __('Email is required', MTFORMS_TEXT_DOMAIN),
					'email_invalid' => __('Email is invalid', MTFORMS_TEXT_DOMAIN),
					'phone_required' => __('Phone number is required', MTFORMS_TEXT_DOMAIN),
					'phone_invalid' => __('Please enter a valid phone number', MTFORMS_TEXT_DOMAIN),
					'website_required' => __('Website URL is required', MTFORMS_TEXT_DOMAIN),
					'website_invalid' => __('Please enter a valid URL', MTFORMS_TEXT_DOMAIN),
					'subject_required' => __('Subject is required', MTFORMS_TEXT_DOMAIN),
					'message_required' => __('Message is required', MTFORMS_TEXT_DOMAIN),
					'gdpr_required' => __('You must agree to the terms', MTFORMS_TEXT_DOMAIN),
					'sending' => __('Sending...', MTFORMS_TEXT_DOMAIN),
					'send_message' => __('Send Message', MTFORMS_TEXT_DOMAIN),
					'error_generic' => __('An unexpected error occurred. Please try again.', MTFORMS_TEXT_DOMAIN),
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
		return esc_html__('MTForms', MTFORMS_TEXT_DOMAIN);
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
		return ['general'];
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