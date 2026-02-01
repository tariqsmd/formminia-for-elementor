<?php

namespace MTForms\Integrations\Elementor;

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

	/**
	 * Register Content Tab controls.
	 */
	protected function register_content_tab_controls()
	{
		$this->register_basic_controls();
		$this->register_button_controls();
		$this->register_label_controls();
		$this->register_advanced_controls();
	}

	/**
	 * Register Basic Section.
	 */
	protected function register_basic_controls()
	{
		$this->start_controls_section(
			'section_preset',
			[
				'label' => esc_html__('Basic ', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Form Title', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Contact Us', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__('Preset Skin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default', MTFORMS_TEXT_DOMAIN),
					'01' => __('Skin 1', MTFORMS_TEXT_DOMAIN),
					'02' => __('Skin 2', MTFORMS_TEXT_DOMAIN),
					'03' => __('Skin 3', MTFORMS_TEXT_DOMAIN),
					'04' => __('Skin 4', MTFORMS_TEXT_DOMAIN),
					'05' => __('Skin 5', MTFORMS_TEXT_DOMAIN),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Form Layout', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default', MTFORMS_TEXT_DOMAIN),
				],
			]
		);

		$this->add_control(
			'hr_display_1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'show_name',
			[
				'label' => esc_html__('Show Name Field', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_email',
			[
				'label' => esc_html__('Show Email Field', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_phone',
			[
				'label' => esc_html__('Show Phone Field', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_website',
			[
				'label' => esc_html__('Show Website Field', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_subject',
			[
				'label' => esc_html__('Show Subject Field', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_message',
			[
				'label' => esc_html__('Show Message Field', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_gdpr',
			[
				'label' => esc_html__('Show GDPR Consent', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_captcha',
			[
				'label' => esc_html__('Show Captcha', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('Uses the captcha provider configured in MTForms settings.', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'hr_display_2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' => esc_html__('Show Labels', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' => esc_html__('Show Placeholders', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => esc_html__('Show Field Icons', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__('Icon Position', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__('Right', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Button Controls.
	 */
	protected function register_button_controls()
	{
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Submit Button', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'button_width',
			[
				'label' => esc_html__('Button Width', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__('Auto', MTFORMS_TEXT_DOMAIN),
					'full' => esc_html__('Full Width', MTFORMS_TEXT_DOMAIN),
				],
			]
		);

		$this->add_control(
			'button_align',
			[
				'label' => esc_html__('Button Alignment', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'condition' => [
					'button_width!' => 'full',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__('Button Icon', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __('None', MTFORMS_TEXT_DOMAIN),
					'send' => __('Send (Paper Plane)', MTFORMS_TEXT_DOMAIN),
					'arrow-right' => __('Arrow Right', MTFORMS_TEXT_DOMAIN),
					'check' => __('Checkmark', MTFORMS_TEXT_DOMAIN),
					'mail' => __('Mail Icon', MTFORMS_TEXT_DOMAIN),
				],
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Before Text', MTFORMS_TEXT_DOMAIN),
					'right' => esc_html__('After Text', MTFORMS_TEXT_DOMAIN),
				],
				'condition' => [
					'button_icon!' => 'none',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Label Controls.
	 */
	protected function register_label_controls()
	{
		$this->start_controls_section(
			'section_labels',
			[
				'label' => esc_html__('Labels & Placeholders', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_name',
			[
				'label' => esc_html__('Name Label', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_name',
			[
				'label' => esc_html__('Name Placeholder', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your name', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_email',
			[
				'label' => esc_html__('Email Label', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_email',
			[
				'label' => esc_html__('Email Placeholder', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your email', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_phone',
			[
				'label' => esc_html__('Phone Label', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_phone',
			[
				'label' => esc_html__('Phone Placeholder', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your phone number', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_website',
			[
				'label' => esc_html__('Website Label', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_website',
			[
				'label' => esc_html__('Website Placeholder', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Your website URL', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_subject',
			[
				'label' => esc_html__('Subject Label', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_subject',
			[
				'label' => esc_html__('Subject Placeholder', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter subject', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_message',
			[
				'label' => esc_html__('Message Label', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_message',
			[
				'label' => esc_html__('Message Placeholder', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Write your message here...', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_text',
			[
				'label' => esc_html__('GDPR Text', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('I consent to having this website store my submitted information so they can respond to my inquiry.', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		/**
		 * Message Controls.
		 */
		$this->add_control(
			'heading_messages_section',
			[
				'label' => esc_html__('Messages', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => esc_html__('Success Message', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Thank you! Your message has been sent successfully.', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Advanced Controls.
	 */
	protected function register_advanced_controls()
	{
		$this->start_controls_section(
			'section_advanced',
			[
				'label' => esc_html__('Advanced Settings', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Form HTML ID', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Unique ID for the form element (optional).', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__('Custom CSS Classes', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Style Tab controls.
	 */
	protected function register_style_tab_controls()
	{
		$this->register_style_container_controls();
		$this->register_style_label_controls();
		$this->register_style_field_controls();
		$this->register_style_button_controls();
		$this->register_style_message_controls();
		$this->register_style_icon_controls();
		$this->register_style_gdpr_controls();
	}

	/**
	 * Style: Form Container Controls.
	 */
	protected function register_style_container_controls()
	{
		$this->start_controls_section(
			'section_style_form',
			[
				'label' => esc_html__('Form Container', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'form_width',
			[
				'label' => esc_html__('Form Width', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'form_background',
				'selector' => '{{WRAPPER}} .mtforms-form-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'selector' => '{{WRAPPER}} .mtforms-form-wrapper',
			]
		);

		$this->add_responsive_control(
			'form_border_radius',
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-form-wrapper',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Style: Label Controls.
	 */
	protected function register_style_label_controls()
	{
		$this->start_controls_section(
			'section_style_labels',
			[
				'label' => esc_html__('Labels', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_labels' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__('Label Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-group label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .mtforms-form-group label',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Style: Input Fields Controls.
	 */
	protected function register_style_field_controls()
	{
		$this->start_controls_section(
			'section_style_inputs',
			[
				'label' => esc_html__('Input Fields', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_input_style',
			[
				'label' => esc_html__('Input Options', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'input_style',
			[
				'label' => esc_html__('Input Style', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default', MTFORMS_TEXT_DOMAIN),
					'underline' => __('Underline Only', MTFORMS_TEXT_DOMAIN),
					'rounded' => __('Rounded', MTFORMS_TEXT_DOMAIN),
					'pill' => __('Pill Shape', MTFORMS_TEXT_DOMAIN),
					'shadow' => __('Shadow', MTFORMS_TEXT_DOMAIN),
				],
				'description' => esc_html__('Sets the visual style for input fields.', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'input_size',
			[
				'label' => esc_html__('Input Size', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => [
					'small' => esc_html__('Small', MTFORMS_TEXT_DOMAIN),
					'medium' => esc_html__('Medium', MTFORMS_TEXT_DOMAIN),
					'large' => esc_html__('Large', MTFORMS_TEXT_DOMAIN),
				],
			]
		);

		$this->add_control(
			'textarea_rows',
			[
				'label' => esc_html__('Textarea Rows', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 20,
				'step' => 1,
				'default' => 5,
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_input_style');

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => esc_html__('Normal', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'input_bg_color',
			[
				'label' => esc_html__('Background Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => esc_html__('Focus', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'input_focus_border_color',
			[
				'label' => esc_html__('Focus Border Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-input:focus, {{WRAPPER}} .mtforms-textarea:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Style: Button Controls.
	 */
	protected function register_style_button_controls()
	{
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__('Submit Button', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-submit-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'selector' => '{{WRAPPER}} .mtforms-submit-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-submit-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_background',
				'selector' => '{{WRAPPER}} .mtforms-submit-btn:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Style: Message Controls.
	 */
	protected function register_style_message_controls()
	{
		$this->start_controls_section(
			'section_style_messages',
			[
				'label' => esc_html__('Messages', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'success_color',
			[
				'label' => esc_html__('Success Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#4caf50',
				'selectors' => [
					'{{WRAPPER}} .mtforms-response-message.success' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Style: Icon Controls.
	 */
	protected function register_style_icon_controls()
	{
		$this->start_controls_section(
			'section_style_icons',
			[
				'label' => esc_html__('Field Icons', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-field-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Style: GDPR Controls.
	 */
	protected function register_style_gdpr_controls()
	{
		$this->start_controls_section(
			'section_style_gdpr',
			[
				'label' => esc_html__('GDPR Consent', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_text_color',
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-checkbox-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		$this->get_partial(
			'form-header',
			[
				'settings' => $settings,
				'widget_id' => $widget_id,
			]
		);

		if ($settings['form_title']) {
			printf('<h2 class="mtforms-form-title">%s</h2>', esc_html($settings['form_title']));
		}

		$this->render_form_content($settings, $widget_id);

		$this->get_partial(
			'form-footer',
			[
				'settings' => $settings,
				'widget_id' => $widget_id,
			]
		);
	}

	/**
	 * Render the form contents.
	 */
	public function render_form_content($settings, $widget_id)
	{
		if ($settings['show_name'] === 'yes') {
			$this->render_field('name', $settings, $widget_id);
		}

		if ($settings['show_email'] === 'yes') {
			$this->render_field('email', $settings, $widget_id);
		}

		if ($settings['show_phone'] === 'yes') {
			$this->render_field('phone', $settings, $widget_id);
		}

		if ($settings['show_website'] === 'yes') {
			$this->render_field('website', $settings, $widget_id);
		}

		if ($settings['show_subject'] === 'yes') {
			$this->render_field('subject', $settings, $widget_id);
		}

		if ($settings['show_message'] === 'yes') {
			$this->render_field('message', $settings, $widget_id);
		}

		$this->get_partial(
			'gdpr',
			[
				'settings' => $settings,
				'widget_id' => $widget_id,
			]
		);

		$this->get_partial(
			'captcha',
			[
				'settings' => $settings,
			]
		);

		$this->render_button($settings);

		$this->get_partial('response', []);
	}

	/**
	 * Render a form field.
	 */
	public function render_field($type, $settings, $widget_id)
	{
		$field_args = [
			'settings' => $settings,
			'widget_id' => $widget_id,
			'type' => $type,
			'required' => true,
			'field_id' => 'field-' . $type . '-' . $widget_id,
		];

		switch ($type) {
			case 'name':
				$field_args['name'] = 'mtforms_name';
				$field_args['label'] = $settings['label_name'];
				$field_args['placeholder'] = $settings['placeholder_name'];
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>';
				break;
			case 'email':
				$field_args['name'] = 'mtforms_email';
				$field_args['label'] = $settings['label_email'];
				$field_args['placeholder'] = $settings['placeholder_email'];
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>';
				break;
			case 'phone':
				$field_args['name'] = 'mtforms_phone';
				$field_args['label'] = $settings['label_phone'];
				$field_args['placeholder'] = $settings['placeholder_phone'];
				$field_args['type'] = 'tel';
				$field_args['required'] = false;
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>';
				break;
			case 'website':
				$field_args['name'] = 'mtforms_website';
				$field_args['label'] = $settings['label_website'];
				$field_args['placeholder'] = $settings['placeholder_website'];
				$field_args['type'] = 'url';
				$field_args['required'] = false;
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2z"/></svg>';
				break;
			case 'subject':
				$field_args['name'] = 'mtforms_subject';
				$field_args['label'] = $settings['label_subject'];
				$field_args['placeholder'] = $settings['placeholder_subject'];
				$field_args['required'] = false;
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6z"/></svg>';
				break;
			case 'message':
				$field_args['name'] = 'mtforms_message';
				$field_args['label'] = $settings['label_message'];
				$field_args['placeholder'] = $settings['placeholder_message'];
				$field_args['type'] = 'textarea';
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>';
				break;
		}

		$this->get_partial('field-item', $field_args);
	}

	/**
	 * Render the submit button.
	 */
	public function render_button($settings)
	{
		$icons = [
			'send' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>',
			'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>',
			'check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>',
			'mail' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
		];

		$icon_svg = isset($icons[$settings['button_icon']]) ? $icons[$settings['button_icon']] : '';

		$this->get_partial(
			'button',
			[
				'settings' => $settings,
				'icon_svg' => $icon_svg,
			]
		);
	}

	/**
	 * Get partial template file.
	 *
	 * @param string $template Template name.
	 * @param array  $args     Arguments to pass to the template.
	 */
	public function get_partial($template, $args = [])
	{
		$path = MTFORMS_PLUGIN_DIR . 'includes/integrations/elementor/partials/' . $template . '.php';
		if (file_exists($path)) {
			include $path;
		}
	}
}
