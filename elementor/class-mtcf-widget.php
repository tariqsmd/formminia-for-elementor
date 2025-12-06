<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Widget Class - MT Contact Form
 * 
 * Comprehensive contact form widget with extensive customization options
 *
 * @since 1.1.0
 */
class MTCF_Widget extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'mtcf_form';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('MT Contact Form', 'mt-contact-forms');
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-form-horizontal';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['general'];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.1.0
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['contact', 'form', 'email', 'message', 'feedback'];
	}

	/**
	 * Get style dependencies.
	 *
	 * @since 1.1.0
	 * @return array Style handles.
	 */
	public function get_style_depends()
	{
		return ['mt-contact-forms'];
	}

	/**
	 * Get script dependencies.
	 *
	 * @since 1.1.0
	 * @return array Script handles.
	 */
	public function get_script_depends()
	{
		return ['mt-contact-forms', 'just-validate'];
	}

	/**
	 * Register widget controls.
	 *
	 * @since 1.0.0
	 */
	protected function register_controls()
	{

		// =====================================================
		// CONTENT TAB
		// =====================================================

		// ---- Preset & Layout Section ----
		$this->start_controls_section(
			'section_preset',
			[
				'label' => esc_html__('Preset & Layout', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__('Preset Skin', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => MTCF_Form_Renderer::get_skins(),
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Form Layout', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'stacked',
				'options' => MTCF_Form_Renderer::get_layouts(),
			]
		);

		$this->add_control(
			'animation',
			[
				'label' => esc_html__('Form Animation', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => MTCF_Form_Renderer::get_animations(),
			]
		);

		$this->add_responsive_control(
			'form_alignment',
			[
				'label' => esc_html__('Form Alignment', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'mt-contact-forms'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'mt-contact-forms'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'mt-contact-forms'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
			]
		);

		$this->end_controls_section();

		// ---- Fields Configuration Section ----
		$this->start_controls_section(
			'section_fields',
			[
				'label' => esc_html__('Form Fields', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_name',
			[
				'label' => esc_html__('Show Name Field', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_email',
			[
				'label' => esc_html__('Show Email Field', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_phone',
			[
				'label' => esc_html__('Show Phone Field', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_website',
			[
				'label' => esc_html__('Show Website Field', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_subject',
			[
				'label' => esc_html__('Show Subject Field', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_message',
			[
				'label' => esc_html__('Show Message Field', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_gdpr',
			[
				'label' => esc_html__('Show GDPR Consent', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hr_labels_section',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' => esc_html__('Show Labels', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' => esc_html__('Show Placeholders', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => esc_html__('Show Field Icons', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-contact-forms'),
				'label_off' => esc_html__('No', 'mt-contact-forms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__('Icon Position', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__('Left', 'mt-contact-forms'),
					'right' => esc_html__('Right', 'mt-contact-forms'),
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// ---- Labels & Placeholders Section ----
		$this->start_controls_section(
			'section_labels',
			[
				'label' => esc_html__('Labels & Placeholders', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_name',
			[
				'label' => esc_html__('Name Label', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name', 'mt-contact-forms'),
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_name',
			[
				'label' => esc_html__('Name Placeholder', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your name', 'mt-contact-forms'),
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr_email_labels',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_email',
			[
				'label' => esc_html__('Email Label', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'mt-contact-forms'),
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_email',
			[
				'label' => esc_html__('Email Placeholder', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your email', 'mt-contact-forms'),
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr_phone_labels',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_phone',
			[
				'label' => esc_html__('Phone Label', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone', 'mt-contact-forms'),
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_phone',
			[
				'label' => esc_html__('Phone Placeholder', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your phone number', 'mt-contact-forms'),
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr_website_labels',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_website',
			[
				'label' => esc_html__('Website Label', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website', 'mt-contact-forms'),
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_website',
			[
				'label' => esc_html__('Website Placeholder', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Your website URL', 'mt-contact-forms'),
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr_subject_labels',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_subject',
			[
				'label' => esc_html__('Subject Label', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject', 'mt-contact-forms'),
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_subject',
			[
				'label' => esc_html__('Subject Placeholder', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter subject', 'mt-contact-forms'),
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr_message_labels',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_message',
			[
				'label' => esc_html__('Message Label', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message', 'mt-contact-forms'),
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_message',
			[
				'label' => esc_html__('Message Placeholder', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Write your message here...', 'mt-contact-forms'),
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'hr_gdpr_labels',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_text',
			[
				'label' => esc_html__('GDPR Text', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('I consent to having this website store my submitted information so they can respond to my inquiry.', 'mt-contact-forms'),
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// ---- Submit Button Section ----
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('Submit Button', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'mt-contact-forms'),
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => esc_html__('Button Style', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => MTCF_Form_Renderer::get_button_styles(),
			]
		);

		$this->add_control(
			'button_width',
			[
				'label' => esc_html__('Button Width', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__('Auto', 'mt-contact-forms'),
					'full' => esc_html__('Full Width', 'mt-contact-forms'),
				],
			]
		);

		$this->add_control(
			'button_align',
			[
				'label' => esc_html__('Button Alignment', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'mt-contact-forms'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'mt-contact-forms'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'mt-contact-forms'),
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
				'label' => esc_html__('Button Icon', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => MTCF_Form_Renderer::get_button_icons(),
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Before Text', 'mt-contact-forms'),
					'right' => esc_html__('After Text', 'mt-contact-forms'),
				],
				'condition' => [
					'button_icon!' => 'none',
				],
			]
		);

		$this->end_controls_section();

		// ---- Messages Section ----
		$this->start_controls_section(
			'section_messages',
			[
				'label' => esc_html__('Messages', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => esc_html__('Success Message', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Thank you! Your message has been sent successfully.', 'mt-contact-forms'),
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', 'mt-contact-forms'),
			]
		);

		$this->end_controls_section();

		// =====================================================
		// STYLE TAB
		// =====================================================

		// ---- Form Container Style Section ----
		$this->start_controls_section(
			'section_style_form',
			[
				'label' => esc_html__('Form Container', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'form_width',
			[
				'label' => esc_html__('Form Width', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'vw'],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .mtcf-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_max_width',
			[
				'label' => esc_html__('Max Width', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 600,
				],
				'selectors' => [
					'{{WRAPPER}} .mtcf-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__('Background Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'form_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .mtcf-container',
			]
		);

		$this->add_responsive_control(
			'form_padding',
			[
				'label' => esc_html__('Padding', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'top' => 30,
					'right' => 30,
					'bottom' => 30,
					'left' => 30,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .mtcf-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'selector' => '{{WRAPPER}} .mtcf-container',
			]
		);

		$this->add_responsive_control(
			'form_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtcf-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_box_shadow',
				'selector' => '{{WRAPPER}} .mtcf-container',
			]
		);

		$this->end_controls_section();

		// ---- Labels Style Section ----
		$this->start_controls_section(
			'section_style_labels',
			[
				'label' => esc_html__('Labels', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_labels' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .mtcf-form-group label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__('Label Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-form-group label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'required_color',
			[
				'label' => esc_html__('Required Asterisk Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#dc3232',
				'selectors' => [
					'{{WRAPPER}} .mtcf-form-group .required' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_spacing',
			[
				'label' => esc_html__('Label Bottom Spacing', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 8,
				],
				'selectors' => [
					'{{WRAPPER}} .mtcf-form-group label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// ---- Inputs Style Section ----
		$this->start_controls_section(
			'section_style_inputs',
			[
				'label' => esc_html__('Input Fields', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'input_style',
			[
				'label' => esc_html__('Input Style', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => MTCF_Form_Renderer::get_input_styles(),
			]
		);

		$this->add_control(
			'input_size',
			[
				'label' => esc_html__('Input Size', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => [
					'small' => esc_html__('Small', 'mt-contact-forms'),
					'medium' => esc_html__('Medium', 'mt-contact-forms'),
					'large' => esc_html__('Large', 'mt-contact-forms'),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'selector' => '{{WRAPPER}} .mtcf-input, {{WRAPPER}} .mtcf-textarea',
			]
		);

		$this->add_responsive_control(
			'field_spacing',
			[
				'label' => esc_html__('Field Spacing', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .mtcf-form-group' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_input_style');

		// Normal State
		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => esc_html__('Normal', 'mt-contact-forms'),
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' => esc_html__('Text Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-input, {{WRAPPER}} .mtcf-textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'placeholder_color',
			[
				'label' => esc_html__('Placeholder Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-input::placeholder, {{WRAPPER}} .mtcf-textarea::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_bg_color',
			[
				'label' => esc_html__('Background Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-input, {{WRAPPER}} .mtcf-textarea' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label' => esc_html__('Border Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-input, {{WRAPPER}} .mtcf-textarea' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Focus State
		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => esc_html__('Focus', 'mt-contact-forms'),
			]
		);

		$this->add_control(
			'input_focus_color',
			[
				'label' => esc_html__('Border Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-input:focus, {{WRAPPER}} .mtcf-textarea:focus' => 'border-color: {{VALUE}}; box-shadow: 0 0 0 2px {{VALUE}}33;',
				],
			]
		);

		$this->add_control(
			'input_focus_bg_color',
			[
				'label' => esc_html__('Background Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-input:focus, {{WRAPPER}} .mtcf-textarea:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Error State
		$this->start_controls_tab(
			'tab_input_error',
			[
				'label' => esc_html__('Error', 'mt-contact-forms'),
			]
		);

		$this->add_control(
			'error_color',
			[
				'label' => esc_html__('Error Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#dc3232',
				'selectors' => [
					'{{WRAPPER}} .just-validate-error-field' => 'border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .just-validate-error-label' => 'color: {{VALUE}};',
					'{{WRAPPER}} .mtcf-response-message.error' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_input_dimensions',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'input_padding',
			[
				'label' => esc_html__('Padding', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .mtcf-input, {{WRAPPER}} .mtcf-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_border_width',
			[
				'label' => esc_html__('Border Width', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtcf-input, {{WRAPPER}} .mtcf-textarea' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtcf-input, {{WRAPPER}} .mtcf-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow',
				'selector' => '{{WRAPPER}} .mtcf-input, {{WRAPPER}} .mtcf-textarea',
			]
		);

		$this->end_controls_section();

		// ---- Button Style Section ----
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => esc_html__('Submit Button', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .mtcf-submit-btn',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		// Normal State
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'mt-contact-forms'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-submit-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__('Background Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-submit-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .mtcf-submit-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .mtcf-submit-btn',
			]
		);

		$this->end_controls_tab();

		// Hover State
		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'mt-contact-forms'),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-submit-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-submit-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-submit-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_button_dimensions',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .mtcf-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtcf-submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .mtcf-submit-btn',
			]
		);

		$this->end_controls_section();

		// ---- Messages Style Section ----
		$this->start_controls_section(
			'section_style_messages',
			[
				'label' => esc_html__('Messages', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'message_typography',
				'selector' => '{{WRAPPER}} .mtcf-response-message',
			]
		);

		$this->add_control(
			'success_color',
			[
				'label' => esc_html__('Success Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#46b450',
				'selectors' => [
					'{{WRAPPER}} .mtcf-response-message.success' => 'color: {{VALUE}}; border-color: {{VALUE}}; background-color: {{VALUE}}1a;',
				],
			]
		);

		$this->add_control(
			'error_message_color',
			[
				'label' => esc_html__('Error Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#dc3232',
				'selectors' => [
					'{{WRAPPER}} .mtcf-response-message.error' => 'color: {{VALUE}}; border-color: {{VALUE}}; background-color: {{VALUE}}1a;',
				],
			]
		);

		$this->add_responsive_control(
			'message_padding',
			[
				'label' => esc_html__('Padding', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .mtcf-response-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'message_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtcf-response-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// ---- Field Icons Style Section ----
		$this->start_controls_section(
			'section_style_icons',
			[
				'label' => esc_html__('Field Icons', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtcf-icon, {{WRAPPER}} .mtcf-field-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 12,
						'max' => 32,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .mtcf-icon svg, {{WRAPPER}} .mtcf-field-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// ---- Advanced Section ----
		$this->start_controls_section(
			'section_advanced',
			[
				'label' => esc_html__('Advanced', 'mt-contact-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Form ID', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Set a custom ID for this form instance.', 'mt-contact-forms'),
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__('Custom CSS Class', 'mt-contact-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Add custom CSS class(es) to the form.', 'mt-contact-forms'),
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @since 1.0.0
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		// Prepare settings for the renderer
		$form_settings = array(
			'skin' => $settings['skin'],
			'layout' => $settings['layout'],
			'animation' => $settings['animation'],
			'form_alignment' => $settings['form_alignment'],
			'show_name' => $settings['show_name'],
			'show_email' => $settings['show_email'],
			'show_phone' => $settings['show_phone'],
			'show_website' => $settings['show_website'],
			'show_subject' => $settings['show_subject'],
			'show_message' => $settings['show_message'],
			'show_gdpr' => $settings['show_gdpr'],
			'show_labels' => $settings['show_labels'],
			'show_placeholders' => $settings['show_placeholders'],
			'show_icons' => $settings['show_icons'],
			'icon_position' => $settings['icon_position'],
			'label_name' => $settings['label_name'],
			'label_email' => $settings['label_email'],
			'label_phone' => isset($settings['label_phone']) ? $settings['label_phone'] : '',
			'label_website' => isset($settings['label_website']) ? $settings['label_website'] : '',
			'label_subject' => $settings['label_subject'],
			'label_message' => $settings['label_message'],
			'placeholder_name' => $settings['placeholder_name'],
			'placeholder_email' => $settings['placeholder_email'],
			'placeholder_phone' => isset($settings['placeholder_phone']) ? $settings['placeholder_phone'] : '',
			'placeholder_website' => isset($settings['placeholder_website']) ? $settings['placeholder_website'] : '',
			'placeholder_subject' => $settings['placeholder_subject'],
			'placeholder_message' => $settings['placeholder_message'],
			'gdpr_text' => $settings['gdpr_text'],
			'button_text' => $settings['button_text'],
			'button_style' => $settings['button_style'],
			'button_width' => $settings['button_width'],
			'button_align' => $settings['button_align'],
			'button_icon' => $settings['button_icon'],
			'button_icon_position' => $settings['button_icon_position'],
			'input_style' => $settings['input_style'],
			'input_size' => $settings['input_size'],
			'success_message' => $settings['success_message'],
			'error_message' => $settings['error_message'],
			'form_id' => isset($settings['form_id']) ? $settings['form_id'] : '',
			'custom_css_class' => isset($settings['custom_css_class']) ? $settings['custom_css_class'] : '',
		);

		// Add hover animation class
		if (!empty($settings['button_hover_animation'])) {
			$form_settings['button_hover_class'] = 'elementor-animation-' . $settings['button_hover_animation'];
		}

		echo MTCF_Form_Renderer::render($form_settings);
	}

	/**
	 * Render widget output in the editor.
	 *
	 * @since 1.1.0
	 */
	protected function content_template()
	{
		?>
		<# var skinLabel='{{ settings.skin }}' ; var layoutLabel='{{ settings.layout }}' ; #>
			<div class="mtcf-container mtcf-skin-{{ settings.skin }} mtcf-layout-{{ settings.layout }} mtcf-elementor-preview">
				<div
					style="padding: 30px; background: #f9f9f9; border: 2px dashed #ddd; border-radius: 8px; text-align: center;">
					<div style="font-size: 48px; margin-bottom: 10px;">📧</div>
					<h3 style="margin: 0 0 10px; color: #333;">MT Contact Form</h3>
					<p style="margin: 0; color: #666;">Skin: <strong>{{ settings.skin }}</strong> | Layout: <strong>{{
							settings.layout }}</strong></p>
					<p style="margin: 10px 0 0; color: #888; font-size: 12px;">Form preview will appear on the frontend</p>
				</div>
			</div>
			<?php
	}

}
