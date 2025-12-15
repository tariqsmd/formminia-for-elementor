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
class MTForms_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'mtforms';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('MTForms', MTFORMS_TEXT_DOMAIN);
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
        return ['mtforms'];
    }

    /**
     * Get script dependencies.
     *
     * @since 1.1.0
     * @return array Script handles.
     */
    public function get_script_depends()
    {
        return ['mtforms', 'just-validate'];
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

        // ---- Layouts & Presets Section ----
        $this->start_controls_section(
            'section_preset',
            [
                'label' => esc_html__('Layouts & Presets', MTFORMS_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'skin',
            [
                'label' => esc_html__('Preset Skin', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => MTForms_Form_Renderer::get_skins(),
                'description' => esc_html__('Choose a visual style for the form.', MTFORMS_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Form Layout', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'stacked',
                'options' => MTForms_Form_Renderer::get_layouts(),
                'description' => esc_html__('Controls how labels and fields are arranged.', MTFORMS_TEXT_DOMAIN),
            ]
        );

        $this->add_responsive_control(
            'form_alignment',
            [
                'label' => esc_html__('Form Alignment', MTFORMS_TEXT_DOMAIN),
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
                'default' => 'center',
            ]
        );

        // ---- Form Fields Heading ----
        $this->add_control(
            'heading_form_fields',
            [
                'label' => esc_html__('Form Fields', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
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
            'hr_display_options',
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
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', MTFORMS_TEXT_DOMAIN),
                    'right' => esc_html__('Right', MTFORMS_TEXT_DOMAIN),
                ],
                'condition' => [
                    'show_icons' => 'yes',
                ],
            ]
        );

        // ---- Input Style Heading ----
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
                'options' => MTForms_Form_Renderer::get_input_styles(),
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

        $this->end_controls_section();

        // ---- Labels & Placeholders Section ----
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
                'label' => esc_html__('GDPR Text', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('I consent to having this website store my submitted information so they can respond to my inquiry.', MTFORMS_TEXT_DOMAIN),
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
            'button_style',
            [
                'label' => esc_html__('Button Style', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => MTForms_Form_Renderer::get_button_styles(),
                'description' => esc_html__('Choose the button visual style.', MTFORMS_TEXT_DOMAIN),
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
                'options' => MTForms_Form_Renderer::get_button_icons(),
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

        // ---- Messages Section ----
        $this->start_controls_section(
            'section_messages',
            [
                'label' => esc_html__('Messages', MTFORMS_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

        // =====================================================
        // STYLE TAB
        // =====================================================

        // ---- Form Container Style Section ----
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
                    '{{WRAPPER}} .mtforms-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_max_width',
            [
                'label' => esc_html__('Max Width', MTFORMS_TEXT_DOMAIN),
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
                    '{{WRAPPER}} .mtforms-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'form_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .mtforms-container',
            ]
        );

        $this->add_responsive_control(
            'form_padding',
            [
                'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'form_border',
                'selector' => '{{WRAPPER}} .mtforms-container',
            ]
        );

        $this->add_responsive_control(
            'form_border_radius',
            [
                'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'form_box_shadow',
                'selector' => '{{WRAPPER}} .mtforms-container',
            ]
        );

        $this->end_controls_section();

        // ---- Labels Style Section ----
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

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .mtforms-form-group label',
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

        $this->add_control(
            'required_color',
            [
                'label' => esc_html__('Required Asterisk Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#dc3232',
                'selectors' => [
                    '{{WRAPPER}} .mtforms-form-group .required' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_spacing',
            [
                'label' => esc_html__('Label Bottom Spacing', MTFORMS_TEXT_DOMAIN),
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
                    '{{WRAPPER}} .mtforms-form-group label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ---- Inputs Style Section ----
        $this->start_controls_section(
            'section_style_inputs',
            [
                'label' => esc_html__('Input Fields', MTFORMS_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea',
            ]
        );

        $this->add_responsive_control(
            'field_spacing',
            [
                'label' => esc_html__('Field Spacing', MTFORMS_TEXT_DOMAIN),
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
                    '{{WRAPPER}} .mtforms-form-group' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_input_style');

        // Normal State
        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => esc_html__('Normal', MTFORMS_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mtforms-input::placeholder, {{WRAPPER}} .mtforms-textarea::placeholder' => 'color: {{VALUE}};',
                ],
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

        $this->add_control(
            'input_border_color',
            [
                'label' => esc_html__('Border Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Focus State
        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label' => esc_html__('Focus', MTFORMS_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'input_focus_color',
            [
                'label' => esc_html__('Border Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mtforms-input:focus, {{WRAPPER}} .mtforms-textarea:focus' => 'border-color: {{VALUE}}; box-shadow: 0 0 0 2px {{VALUE}}33;',
                ],
            ]
        );

        $this->add_control(
            'input_focus_bg_color',
            [
                'label' => esc_html__('Background Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mtforms-input:focus, {{WRAPPER}} .mtforms-textarea:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Error State
        $this->start_controls_tab(
            'tab_input_error',
            [
                'label' => esc_html__('Error', MTFORMS_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'error_color',
            [
                'label' => esc_html__('Error Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#dc3232',
                'selectors' => [
                    '{{WRAPPER}} .just-validate-error-field' => 'border-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .just-validate-error-label' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mtforms-response-message.error' => 'color: {{VALUE}}; border-color: {{VALUE}};',
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
                'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_border_width',
            [
                'label' => esc_html__('Border Width', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_border_radius',
            [
                'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow',
                'selector' => '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea',
            ]
        );

        $this->end_controls_section();

        // ---- Button Style Section ----
        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__('Submit Button', MTFORMS_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .mtforms-submit-btn',
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        // Normal State
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
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .mtforms-submit-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .mtforms-submit-btn',
            ]
        );

        $this->end_controls_tab();

        // Hover State
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

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__('Background Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mtforms-submit-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mtforms-submit-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => esc_html__('Hover Animation', MTFORMS_TEXT_DOMAIN),
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
                'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .mtforms-submit-btn',
            ]
        );

        $this->end_controls_section();

        // ---- Messages Style Section ----
        $this->start_controls_section(
            'section_style_messages',
            [
                'label' => esc_html__('Messages', MTFORMS_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'message_typography',
                'selector' => '{{WRAPPER}} .mtforms-response-message',
            ]
        );

        $this->add_control(
            'success_color',
            [
                'label' => esc_html__('Success Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#46b450',
                'selectors' => [
                    '{{WRAPPER}} .mtforms-response-message.success' => 'color: {{VALUE}}; border-color: {{VALUE}}; background-color: {{VALUE}}1a;',
                ],
            ]
        );

        $this->add_control(
            'error_message_color',
            [
                'label' => esc_html__('Error Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#dc3232',
                'selectors' => [
                    '{{WRAPPER}} .mtforms-response-message.error' => 'color: {{VALUE}}; border-color: {{VALUE}}; background-color: {{VALUE}}1a;',
                ],
            ]
        );

        $this->add_responsive_control(
            'message_padding',
            [
                'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-response-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'message_border_radius',
            [
                'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-response-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ---- Field Icons Style Section ----
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
                    '{{WRAPPER}} .mtforms-icon, {{WRAPPER}} .mtforms-field-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', MTFORMS_TEXT_DOMAIN),
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
                    '{{WRAPPER}} .mtforms-icon svg, {{WRAPPER}} .mtforms-field-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ---- GDPR Consent Style Section ----
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
            'gdpr_checkbox_color',
            [
                'label' => esc_html__('Checkbox Color', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mtforms-checkbox-label input[type="checkbox"]:checked + .mtforms-checkbox-custom' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'gdpr_text_typography',
                'selector' => '{{WRAPPER}} .mtforms-checkbox-text',
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

        $this->add_responsive_control(
            'gdpr_spacing',
            [
                'label' => esc_html__('Top Spacing', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 40,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mtforms-gdpr-group' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // ---- Advanced Section ----
        $this->start_controls_section(
            'section_advanced',
            [
                'label' => esc_html__('Advanced', MTFORMS_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_id',
            [
                'label' => esc_html__('Form ID', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Set a custom ID for this form instance.', MTFORMS_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'custom_css_class',
            [
                'label' => esc_html__('Custom CSS Class', MTFORMS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__('Add custom CSS class(es) to the form.', MTFORMS_TEXT_DOMAIN),
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
            'skin' => !empty($settings['skin']) ? $settings['skin'] : 'default',
            'layout' => !empty($settings['layout']) ? $settings['layout'] : 'stacked',
            'animation' => 'none',
            'form_alignment' => !empty($settings['form_alignment']) ? $settings['form_alignment'] : 'center',
            'show_name' => !empty($settings['show_name']) ? $settings['show_name'] : '',
            'show_email' => !empty($settings['show_email']) ? $settings['show_email'] : '',
            'show_phone' => !empty($settings['show_phone']) ? $settings['show_phone'] : '',
            'show_website' => !empty($settings['show_website']) ? $settings['show_website'] : '',
            'show_subject' => !empty($settings['show_subject']) ? $settings['show_subject'] : '',
            'show_message' => !empty($settings['show_message']) ? $settings['show_message'] : '',
            'show_gdpr' => !empty($settings['show_gdpr']) ? $settings['show_gdpr'] : '',
            'show_captcha' => !empty($settings['show_captcha']) ? $settings['show_captcha'] : '',
            'show_labels' => !empty($settings['show_labels']) ? $settings['show_labels'] : '',
            'show_placeholders' => !empty($settings['show_placeholders']) ? $settings['show_placeholders'] : '',
            'show_icons' => !empty($settings['show_icons']) ? $settings['show_icons'] : '',
            'icon_position' => !empty($settings['icon_position']) ? $settings['icon_position'] : 'left',
            'label_name' => !empty($settings['label_name']) ? $settings['label_name'] : '',
            'label_email' => !empty($settings['label_email']) ? $settings['label_email'] : '',
            'label_phone' => !empty($settings['label_phone']) ? $settings['label_phone'] : '',
            'label_website' => !empty($settings['label_website']) ? $settings['label_website'] : '',
            'label_subject' => !empty($settings['label_subject']) ? $settings['label_subject'] : '',
            'label_message' => !empty($settings['label_message']) ? $settings['label_message'] : '',
            'placeholder_name' => !empty($settings['placeholder_name']) ? $settings['placeholder_name'] : '',
            'placeholder_email' => !empty($settings['placeholder_email']) ? $settings['placeholder_email'] : '',
            'placeholder_phone' => !empty($settings['placeholder_phone']) ? $settings['placeholder_phone'] : '',
            'placeholder_website' => !empty($settings['placeholder_website']) ? $settings['placeholder_website'] : '',
            'placeholder_subject' => !empty($settings['placeholder_subject']) ? $settings['placeholder_subject'] : '',
            'placeholder_message' => !empty($settings['placeholder_message']) ? $settings['placeholder_message'] : '',
            'gdpr_text' => !empty($settings['gdpr_text']) ? $settings['gdpr_text'] : '',
            'button_text' => !empty($settings['button_text']) ? $settings['button_text'] : '',
            'button_style' => !empty($settings['button_style']) ? $settings['button_style'] : 'solid',
            'button_width' => !empty($settings['button_width']) ? $settings['button_width'] : 'auto',
            'button_align' => !empty($settings['button_align']) ? $settings['button_align'] : 'left',
            'button_icon' => !empty($settings['button_icon']) ? $settings['button_icon'] : 'none',
            'button_icon_position' => !empty($settings['button_icon_position']) ? $settings['button_icon_position'] : 'right',
            'input_style' => !empty($settings['input_style']) ? $settings['input_style'] : 'default',
            'input_size' => !empty($settings['input_size']) ? $settings['input_size'] : 'medium',
            'textarea_rows' => !empty($settings['textarea_rows']) ? $settings['textarea_rows'] : 5,
            'success_message' => !empty($settings['success_message']) ? $settings['success_message'] : '',
            'error_message' => !empty($settings['error_message']) ? $settings['error_message'] : '',
            'form_id' => !empty($settings['form_id']) ? $settings['form_id'] : '',
            'custom_css_class' => !empty($settings['custom_css_class']) ? $settings['custom_css_class'] : '',
        );

        // Add hover animation class
        if (!empty($settings['button_hover_animation'])) {
            $form_settings['button_hover_class'] = 'elementor-animation-' . $settings['button_hover_animation'];
        }

        echo MTForms_Form_Renderer::render($form_settings);
    }

    /**
     * Render widget output in the editor (server-side rendered).
     *
     * @since 1.1.0
     */
    protected function content_template()
    {
        // Server-side rendered widget — no JS template needed
    }

}
