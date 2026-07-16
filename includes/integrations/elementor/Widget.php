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
		$this->register_fields_controls();
		$this->register_icons_controls();
		$this->register_label_controls();
		$this->register_button_controls();
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
				'label_block' => true,
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__('Skin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'skin-0',
				// 'label_block' => true,
				'options' => [
					'skin-0' => __('None', MTFORMS_TEXT_DOMAIN),
					'skin-1' => __('1. Modern Indigo', MTFORMS_TEXT_DOMAIN),
					'skin-2' => __('2. Nature\'s Breath', MTFORMS_TEXT_DOMAIN),
					'skin-3' => __('3. Sleek Corporate', MTFORMS_TEXT_DOMAIN),
					'skin-4' => __('4. Cotton Candy', MTFORMS_TEXT_DOMAIN),
					'skin-5' => __('5. Neumorphic', MTFORMS_TEXT_DOMAIN),
					'skin-6' => __('6. Purple Haze', MTFORMS_TEXT_DOMAIN),
					'skin-7' => __('7. Sunset Vibes', MTFORMS_TEXT_DOMAIN),
					'skin-8' => __('8. Ocean Deep', MTFORMS_TEXT_DOMAIN),
					'skin-9' => __('9. Crystal White', MTFORMS_TEXT_DOMAIN),
					'skin-10' => __('10. Vibrant Coral', MTFORMS_TEXT_DOMAIN),
					'skin-11' => __('11. Platinum Luxury', MTFORMS_TEXT_DOMAIN),
					'skin-12' => __('12. Midnight Glow', MTFORMS_TEXT_DOMAIN),
					'skin-13' => __('13. Cyberpunk Glitch', MTFORMS_TEXT_DOMAIN),
					'skin-14' => __('14. Paper Stack', MTFORMS_TEXT_DOMAIN),
					'skin-15' => __('15. Liquid Metal', MTFORMS_TEXT_DOMAIN),
					'skin-16' => __('16. Vintage Terminal', MTFORMS_TEXT_DOMAIN),
					'skin-17' => __('17. Minimalist Tech', MTFORMS_TEXT_DOMAIN),
					'skin-18' => __('18. Vibrant Pulse', MTFORMS_TEXT_DOMAIN),
					'skin-19' => __('19. Clean Material', MTFORMS_TEXT_DOMAIN),
					'skin-20' => __('20. Social Connect', MTFORMS_TEXT_DOMAIN),
					'skin-21' => __('21. Soft Clay', MTFORMS_TEXT_DOMAIN),
					'skin-22' => __('22. Pop Brutalist', MTFORMS_TEXT_DOMAIN),
					'skin-23' => __('23. Aura Gradient', MTFORMS_TEXT_DOMAIN),
					'skin-24' => __('24. Royal Executive', MTFORMS_TEXT_DOMAIN),
					'skin-25' => __('25. Organic Flow', MTFORMS_TEXT_DOMAIN),
					'skin-26' => __('26. Retro Pixel', MTFORMS_TEXT_DOMAIN),
					'skin-27' => __('27. Dynamic Stream', MTFORMS_TEXT_DOMAIN),
					'skin-28' => __('28. Corporate Network', MTFORMS_TEXT_DOMAIN),
					'skin-29' => __('29. Marketplace Hub', MTFORMS_TEXT_DOMAIN),
					'skin-30' => __('30. Cinema Spotlight', MTFORMS_TEXT_DOMAIN),
					'skin-31' => __('31. Team Collaboration', MTFORMS_TEXT_DOMAIN),
					'skin-32' => __('32. Travel Explorer', MTFORMS_TEXT_DOMAIN),
					'skin-33' => __('33. Frosted Glass', MTFORMS_TEXT_DOMAIN),
					'skin-34' => __('34. Floating Depth', MTFORMS_TEXT_DOMAIN),
					'skin-35' => __('35. Serif Elegance', MTFORMS_TEXT_DOMAIN),
					'skin-36' => __('36. Geometric Pop', MTFORMS_TEXT_DOMAIN),
					'skin-37' => __('37. Gradient Aura', MTFORMS_TEXT_DOMAIN),
					'skin-38' => __('38. Organic Playful', MTFORMS_TEXT_DOMAIN),
					'skin-39' => __('39. Luxury Earth', MTFORMS_TEXT_DOMAIN),
					'skin-40' => __('40. Midnight Mint', MTFORMS_TEXT_DOMAIN),
					'skin-41' => __('41. Playful Modernist', MTFORMS_TEXT_DOMAIN),
					'skin-42' => __('42. Zesty Lemon Squeeze', MTFORMS_TEXT_DOMAIN),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('None', MTFORMS_TEXT_DOMAIN),
					'floating' => __('Floating Labels', MTFORMS_TEXT_DOMAIN),
					'material' => __('Material Minimal', MTFORMS_TEXT_DOMAIN),
					'compact' => __('Compact Style', MTFORMS_TEXT_DOMAIN),
					'boxed-border' => __('Boxed Borderless', MTFORMS_TEXT_DOMAIN),
					'inset' => __('Inset Shadow Style', MTFORMS_TEXT_DOMAIN),
					'inline' => __('Inline Layout', MTFORMS_TEXT_DOMAIN),
				],
			]
		);

		$this->add_responsive_control(
			'inline_label_width',
			[
				'label' => esc_html__('Label Width', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
					'%' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-layout-inline .mtforms-form-group label' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_field_width',
			[
				'label' => esc_html__('Field Width', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
					],
					'%' => [
						'min' => 20,
						'max' => 90,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-layout-inline .mtforms-input-wrap' => 'flex: 1 1 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_gap',
			[
				'label' => esc_html__('Gap Between Label & Field', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-layout-inline .mtforms-form-group' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => esc_html__('Columns', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __('1 Column', MTFORMS_TEXT_DOMAIN),
					'2' => __('2 Columns', MTFORMS_TEXT_DOMAIN),
					'3' => __('3 Columns', MTFORMS_TEXT_DOMAIN),
					'4' => __('4 Columns', MTFORMS_TEXT_DOMAIN),
					'5' => __('5 Columns', MTFORMS_TEXT_DOMAIN),
					'6' => __('6 Columns', MTFORMS_TEXT_DOMAIN),
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-fields-wrapper' => '--mtforms-columns: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Fields Section.
	 */
	protected function register_fields_controls()
	{
		$this->start_controls_section(
			'section_fields',
			[
				'label' => esc_html__('Fields', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => esc_html__('Show Icons', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'hr_display_2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		foreach (['name' => 'yes', 'email' => 'yes', 'phone' => 'no', 'website' => 'no', 'subject' => 'yes', 'message' => 'yes'] as $field => $default) {
			$this->add_control(
				"show_{$field}",
				[
					'label' => sprintf(esc_html__('Show %s Field', MTFORMS_TEXT_DOMAIN), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
					'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
					'return_value' => 'yes',
					'default' => $default,
				]
			);

			$this->add_control(
				"required_{$field}",
				[
					'label' => sprintf(esc_html__('%s Required', MTFORMS_TEXT_DOMAIN), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
					'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
					'return_value' => 'yes',
					'default' => ($field === 'name' || $field === 'email' || $field === 'message') ? 'yes' : 'no',
					'condition' => [
						"show_{$field}" => 'yes',
					],
				]
			);

			$this->add_control(
				"hr_field_{$field}",
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
		}

		$this->add_control(
			'show_gdpr',
			[
				'label' => esc_html__('Show GDPR Consent', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'hr_display_3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
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
				'default' => 'no',
				'description' => esc_html__('See captcha configuration in MTForms settings.', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			'enable_honeypot',
			[
				'label' => esc_html__('Enable Honeypot', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('A hidden field to catch spam bots.', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Labels', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_name',
			[
				'label' => esc_html__('Name Label', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		// GDPR consent label shown above checkbox (maintains layout consistency)
		$this->add_control(
			'gdpr_label',
			[
				'label' => esc_html__('GDPR Label', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('GDPR Consent', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
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
				'label_block' => true,
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
				'label_block' => true,
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Register Icons Controls.
	 */
	protected function register_icons_controls()
	{
		$this->start_controls_section(
			'section_field_icons',
			[
				'label' => esc_html__('Icons', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_location',
			[
				'label' => esc_html__('Location', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'label',
				'options' => [
					'label' => [
						'title' => esc_html__('Label', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-ellipsis-h',

					],
					'input' => [
						'title' => esc_html__('Input', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-ellipsis-v',
					],
				],
				'toggle' => false,
			]
		);

		// Icon Position Control
		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__('Position', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'before' => [
						'title' => esc_html__('Before Text', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__('After Text', MTFORMS_TEXT_DOMAIN),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'before',
			]
		);

		// Icons in Textarea Section
		// $this->add_control(
		// 	'heading_textarea_icons',
		// 	[
		// 		'label' => esc_html__('Icons in Message Field', MTFORMS_TEXT_DOMAIN),
		// 		'type' => \Elementor\Controls_Manager::HEADING,
		// 		'separator' => 'before',
		// 		'condition' => [
		// 			'show_message' => 'yes',
		// 			'icon_location' => 'input',
		// 		],
		// 	]
		// );

		$this->add_control(
			'show_textarea_icons',
			[
				'label' => esc_html__('Message Icon', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_message' => 'yes',
					'icon_location' => 'input',
				],
			]
		);

		// $this->add_control(
		// 	'textarea_icon_position',
		// 	[
		// 		'label' => esc_html__('Message Icon Position', MTFORMS_TEXT_DOMAIN),
		// 		'type' => \Elementor\Controls_Manager::CHOOSE,
		// 		'options' => [
		// 			'left' => [
		// 				'title' => esc_html__('Left', MTFORMS_TEXT_DOMAIN),
		// 				'icon' => 'eicon-h-align-left',
		// 			],
		// 			'right' => [
		// 				'title' => esc_html__('Right', MTFORMS_TEXT_DOMAIN),
		// 				'icon' => 'eicon-h-align-right',
		// 			],
		// 		],
		// 		'default' => 'left',
		// 		'condition' => [
		// 			'show_textarea_icons' => 'yes',
		// 			'show_message' => 'yes',
		// 			'icon_location' => 'input',
		// 		],
		// 	]
		// );

		// Icons in GDPR Section
		// $this->add_control(
		// 	'heading_gdpr_icons',
		// 	[
		// 		'label' => esc_html__('Icons in GDPR Checkbox', MTFORMS_TEXT_DOMAIN),
		// 		'type' => \Elementor\Controls_Manager::HEADING,
		// 		'separator' => 'before',
		// 		'condition' => [
		// 			'show_gdpr' => 'yes',
		// 			'icon_location' => 'input',
		// 		],
		// 	]
		// );

		$this->add_control(
			'show_gdpr_icons',
			[
				'label' => esc_html__('GDPR Icon', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		// Field Icons Assignment
		$this->add_control(
			'heading_icons_assignment',
			[
				'label' => esc_html__('Icon Assignment', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$icons = [
			'name' => [
				'label' => esc_html__('Name Icon', MTFORMS_TEXT_DOMAIN),
				'default' => 'fas fa-user',
			],
			'email' => [
				'label' => esc_html__('Email Icon', MTFORMS_TEXT_DOMAIN),
				'default' => 'fas fa-envelope',
			],
			'phone' => [
				'label' => esc_html__('Phone Icon', MTFORMS_TEXT_DOMAIN),
				'default' => 'fas fa-phone',
			],
			'website' => [
				'label' => esc_html__('Website Icon', MTFORMS_TEXT_DOMAIN),
				'default' => 'fas fa-globe',
			],
			'subject' => [
				'label' => esc_html__('Subject Icon', MTFORMS_TEXT_DOMAIN),
				'default' => 'fas fa-tag',
			],
			'message' => [
				'label' => esc_html__('Message Icon', MTFORMS_TEXT_DOMAIN),
				'default' => 'fas fa-comment',
			],
			'gdpr' => [
				'label' => esc_html__('GDPR Icon', MTFORMS_TEXT_DOMAIN),
				'default' => 'fas fa-shield-alt',
			],
		];

		foreach ($icons as $field => $data) {
			$this->add_control(
				"icon_{$field}",
				[
					'label' => $data['label'],
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => $data['default'],
						'library' => 'fa-solid',
					],
				]
			);
		}

		$this->end_controls_section();
	}

	/**
	 * Register Submit Button Controls.
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

		$this->add_responsive_control(
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
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-actions' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__('Button Icon', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::ICONS,
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
					'button_icon[value]!' => '',
				],
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
				'label_block' => true,
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__('Custom CSS Classes', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_email_settings',
			[
				'label' => esc_html__('Email Settings', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mail_to',
			[
				'label' => esc_html__('Recipient Email', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional recipient email address. If empty, global settings will be used.', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_cc',
			[
				'label' => esc_html__('CC Email', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional CC email addresses, separate with commas.', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_bcc',
			[
				'label' => esc_html__('BCC Email', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional BCC email addresses, separate with commas.', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_redirect_settings',
			[
				'label' => esc_html__('Redirect After Submit', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'redirect_on_success',
			[
				'label' => esc_html__('Enable Redirect', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'success_redirect_url',
			[
				'label' => esc_html__('Redirect URL', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', MTFORMS_TEXT_DOMAIN),
				'condition' => [
					'redirect_on_success' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Style Tab controls.
	 */
	protected function register_style_tab_controls()
	{
		$this->register_style_title_controls();
		$this->register_style_container_controls();
		$this->register_style_fields_wrapper_controls();
		$this->register_style_group_controls();
		$this->register_style_label_controls();
		$this->register_style_field_controls();
		$this->register_style_message_controls();
		$this->register_style_gdpr_controls();
		$this->register_style_button_controls();
	}

	/**
	 * Style: Field Group Controls.
	 */
	protected function register_style_group_controls()
	{
		$this->start_controls_section(
			'section_style_field_group',
			[
				'label' => esc_html__('Field Group (Wrapper)', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'group_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'group_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'group_border_radius',
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'group_border',
				'selector' => '{{WRAPPER}} .mtforms-form-group',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'group_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-form-group',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'group_background',
				'selector' => '{{WRAPPER}} .mtforms-form-group',
			]
		);

		$this->end_controls_section();
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

		// $this->add_responsive_control(
		// 	'form_width',
		// 	[
		// 		'label' => esc_html__('Form Width', MTFORMS_TEXT_DOMAIN),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => ['px', '%', 'vw'],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .mtforms-form-wrapper' => 'width: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		$this->add_responsive_control(
			'form_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-form-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'field_row_gap',
			[
				'label' => esc_html__('Row Gap', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-inner-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_column_gap',
			[
				'label' => esc_html__('Column Gap', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-inner-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_border_radius',
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'selector' => '{{WRAPPER}} .mtforms-form-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-form-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'form_background',
				'selector' => '{{WRAPPER}} .mtforms-form-wrapper',
			]
		);

		$this->add_control(
			'accent_color',
			[
				'label' => esc_html__('Accent Color (Native Fields)', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__('Styles native checkboxes, radio buttons, and range sliders.', MTFORMS_TEXT_DOMAIN),
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => 'accent-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Style: Form Title Controls.
	 */
	protected function register_style_title_controls()
	{
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__('Form Title', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'form_title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .mtforms-form-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .mtforms-form-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .mtforms-form-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-title-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_background',
				'selector' => '{{WRAPPER}} .mtforms-form-title',
			]
		);

		$this->add_control(
			'title_align',
			[
				'label' => esc_html__('Alignment', MTFORMS_TEXT_DOMAIN),
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
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Style: Field Widths Controls.
	 */


	/**
	 * Style: Fields Wrapper Controls.
	 */
	protected function register_style_fields_wrapper_controls()
	{
		$this->start_controls_section(
			'section_style_fields_wrapper',
			[
				'label' => esc_html__('Fields Wrapper', MTFORMS_TEXT_DOMAIN),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-fields-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-fields-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_border_radius',
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-fields-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'fields_wrapper_border',
				'selector' => '{{WRAPPER}} .mtforms-fields-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fields_wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-fields-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'fields_wrapper_background',
				'selector' => '{{WRAPPER}} .mtforms-fields-wrapper',
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

		$this->add_responsive_control(
			'label_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-group label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-group label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_border_radius',
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-group label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'label_border',
				'selector' => '{{WRAPPER}} .mtforms-form-group label',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'label_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-form-group label',
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
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-label-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'label_background',
				'selector' => '{{WRAPPER}} .mtforms-form-group label',
			]
		);

		// Field Icons Controls
		$this->add_control(
			'heading_field_icons',
			[
				'label' => esc_html__('Field Icons', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .mtforms-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mtforms-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-icon-left .mtforms-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mtforms-icon-right .mtforms-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .mtforms-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .mtforms-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__('Background Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'selector' => '{{WRAPPER}} .mtforms-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		// Inline Layout Controls
		$this->add_control(
			'heading_inline_layout',
			[
				'label' => esc_html__('Inline Layout', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_label_width',
			[
				'label' => esc_html__('Label Width', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
					'%' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-layout-inline .mtforms-form-group label' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_field_width',
			[
				'label' => esc_html__('Field Width', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
					],
					'%' => [
						'min' => 20,
						'max' => 90,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-layout-inline .mtforms-input-wrap' => 'flex: 1 1 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_gap',
			[
				'label' => esc_html__('Gap Between Label & Field', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-layout-inline .mtforms-form-group' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
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
				'label' => esc_html__('Fields Global Settings', MTFORMS_TEXT_DOMAIN),
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
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-input-bg: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-input-color: {{VALUE}};',
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

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_focus_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-input:focus, {{WRAPPER}} .mtforms-textarea:focus',
			]
		);

		$this->add_responsive_control(
			'input_focus_scale',
			[
				'label' => esc_html__('Focus Scale', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.9,
						'max' => 1.2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-input:focus, {{WRAPPER}} .mtforms-textarea:focus' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'input_focus_border_color',
			[
				'label' => esc_html__('Focus Border Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-input-focus-border: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_focus_bg_color',
			[
				'label' => esc_html__('Background Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-input-focus-bg: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_focus_text_color',
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-input-focus-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_input_advanced',
			[
				'label' => esc_html__('Advanced Style', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'input_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-field-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-field-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'input_border',
				'selector' => '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'selector' => '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea',
			]
		);

		$this->add_control(
			'placeholder_color',
			[
				'label' => esc_html__('Placeholder Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-placeholder: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'input_background',
				'selector' => '{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea',
			]
		);

		$this->add_control(
			'input_transition',
			[
				'label' => esc_html__('Transition Duration', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-input, {{WRAPPER}} .mtforms-textarea' => 'transition: all {{SIZE}}s ease-in-out;',
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

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'button_text_shadow',
				'selector' => '{{WRAPPER}} .mtforms-submit-btn',
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-btn-color: {{VALUE}};',
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

		$this->add_responsive_control(
			'button_hover_scale',
			[
				'label' => esc_html__('Hover Scale', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.5,
						'max' => 1.5,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-submit-btn:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_responsive_control(
			'button_hover_translate',
			[
				'label' => esc_html__('Hover Offset (Y)', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-submit-btn:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'button_hover_scale[size]' => '', // Only show if scale is not set to avoid conflicts, or use a group transform
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

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-btn-hover-color: {{VALUE}};',
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

		$this->add_control(
			'heading_button_advanced',
			[
				'label' => esc_html__('Advanced Style', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-submit-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-btn-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .mtforms-form-wrapper' => '--mtforms-btn-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .mtforms-submit-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-submit-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .mtforms-submit-btn',
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => esc_html__('Icon Size', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mtforms-btn-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-btn-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mtforms-btn-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label' => esc_html__('Icon Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .mtforms-btn-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
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

		$this->add_responsive_control(
			'message_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-response-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'message_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
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
				'default' => '#4caf50',
				'selectors' => [
					'{{WRAPPER}} .mtforms-response-message.success' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'error_color',
			[
				'label' => esc_html__('Error Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f44336',
				'selectors' => [
					'{{WRAPPER}} .mtforms-response-message.error' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'message_background',
				'selector' => '{{WRAPPER}} .mtforms-response-message',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register Specific Field Styles.
	 */
	protected function register_style_specific_fields()
	{
		$fields = [
			'name' => [
				'label' => esc_html__('Name Field', MTFORMS_TEXT_DOMAIN),
				'selector' => '.mtforms-field-name .mtforms-input',
				'wrapper' => '.mtforms-form-group.mtforms-field-name',
				'field_key' => 'name',
			],
			'email' => [
				'label' => esc_html__('Email Field', MTFORMS_TEXT_DOMAIN),
				'selector' => '.mtforms-field-email .mtforms-input',
				'wrapper' => '.mtforms-form-group.mtforms-field-email',
				'field_key' => 'email',
			],
			'phone' => [
				'label' => esc_html__('Phone Field', MTFORMS_TEXT_DOMAIN),
				'selector' => '.mtforms-field-tel .mtforms-input',
				'wrapper' => '.mtforms-form-group.mtforms-field-tel',
				'field_key' => 'phone',
			],
			'website' => [
				'label' => esc_html__('Website Field', MTFORMS_TEXT_DOMAIN),
				'selector' => '.mtforms-field-url .mtforms-input',
				'wrapper' => '.mtforms-form-group.mtforms-field-url',
				'field_key' => 'website',
			],
			'subject' => [
				'label' => esc_html__('Subject Field', MTFORMS_TEXT_DOMAIN),
				'selector' => '.mtforms-field-subject .mtforms-input',
				'wrapper' => '.mtforms-form-group.mtforms-field-subject',
				'field_key' => 'subject',
			],
			'message' => [
				'label' => esc_html__('Message Field', MTFORMS_TEXT_DOMAIN),
				'selector' => '.mtforms-field-textarea .mtforms-textarea',
				'wrapper' => '.mtforms-form-group.mtforms-field-textarea',
				'field_key' => 'message',
			],
		];

		foreach ($fields as $id => $data) {
			$this->add_field_style_section("specific_{$id}", $data['label'] . ' Style', $data['selector'], $data['wrapper'], $data['field_key']);
		}
	}

	protected function add_field_style_section($id, $label, $selector, $wrapper = '', $field_key = '')
	{
		$this->start_controls_section(
			"section_{$id}_style",
			[
				'label' => $label,
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					"show_{$field_key}" => 'yes',
				],
			]
		);

		if ($wrapper && $field_key) {
			$this->add_responsive_control(
				"width_{$field_key}",
				[
					'label' => esc_html__('Column Width', MTFORMS_TEXT_DOMAIN),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => ['%'],
					'range' => [
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
						"{{WRAPPER}} {$wrapper}" => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
		}

		$this->start_controls_tabs("tabs_{$id}_style");

		$this->start_controls_tab(
			"tab_{$id}_normal",
			[
				'label' => esc_html__('Normal', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => "{$id}_border",
				'selector' => "{{WRAPPER}} {$selector}",
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => "{$id}_box_shadow",
				'selector' => "{{WRAPPER}} {$selector}",
			]
		);

		$this->add_control(
			"{$id}_bg_color",
			[
				'label' => esc_html__('Background Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}" => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			"{$id}_text_color",
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}" => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			"tab_{$id}_focus",
			[
				'label' => esc_html__('Focus', MTFORMS_TEXT_DOMAIN),
			]
		);

		$this->add_control(
			"{$id}_focus_border_color",
			[
				'label' => esc_html__('Border Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}:focus" => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => "{$id}_focus_box_shadow",
				'selector' => "{{WRAPPER}} {$selector}:focus",
			]
		);

		$this->add_control(
			"{$id}_focus_bg_color",
			[
				'label' => esc_html__('Background Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}:focus" => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			"{$id}_focus_text_color",
			[
				'label' => esc_html__('Text Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}:focus" => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			"heading_{$id}_advanced",
			[
				'label' => esc_html__('Advanced Style', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			"{$id}_margin",
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					"{{WRAPPER}} {$selector}" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			"{$id}_padding",
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					"{{WRAPPER}} {$selector}" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			"{$id}_border_radius",
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					"{{WRAPPER}} {$selector}" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => "{$id}_typography",
				'selector' => "{{WRAPPER}} {$selector}",
			]
		);

		$this->add_control(
			"{$id}_placeholder_color",
			[
				'label' => esc_html__('Placeholder Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}::placeholder" => 'color: {{VALUE}} !important;',
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

		$this->add_responsive_control(
			'gdpr_margin',
			[
				'label' => esc_html__('Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-gdpr-consent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_padding',
			[
				'label' => esc_html__('Padding', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-gdpr-consent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_border_radius',
			[
				'label' => esc_html__('Border Radius', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-gdpr-consent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'gdpr_border',
				'selector' => '{{WRAPPER}} .mtforms-gdpr-consent',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'gdpr_box_shadow',
				'selector' => '{{WRAPPER}} .mtforms-gdpr-consent',
			]
		);

		$this->add_responsive_control(
			'gdpr_label_margin',
			[
				'label' => esc_html__('Label Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-gdpr-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_checkbox_margin',
			[
				'label' => esc_html__('Checkbox Margin', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtforms-checkbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'gdpr_label_typography',
				'selector' => '{{WRAPPER}} .mtforms-gdpr-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'gdpr_typography',
				'selector' => '{{WRAPPER}} .mtforms-checkbox-text',
			]
		);

		$this->add_control(
			'gdpr_label_color',
			[
				'label' => esc_html__('Label Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-gdpr-heading' => 'color: {{VALUE}};',
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

		$this->add_control(
			'gdpr_link_color',
			[
				'label' => esc_html__('Link Color', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtforms-checkbox-text a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_checkbox_width',
			[
				'label' => esc_html__('Checkbox Label Width', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 400,
					],
					'%' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtforms-layout-inline .mtforms-gdpr-group .mtforms-checkbox-label' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'layout' => 'inline',
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'gdpr_background',
				'selector' => '{{WRAPPER}} .mtforms-gdpr-consent',
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

		// Enqueue Captcha scripts on-demand if enabled in widget settings
		if ($settings['show_captcha'] === 'yes') {
			$captcha_provider = get_option('mtforms_captcha_provider', 'none');
			if ($captcha_provider === 'recaptcha') {
				wp_enqueue_script('google-recaptcha');
			} elseif ($captcha_provider === 'turnstile') {
				wp_enqueue_script('cloudflare-turnstile');
			}
		}

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
		echo '<div class="mtforms-fields-wrapper">';

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

		echo '</div>'; // .mtforms-fields-wrapper

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
			'required' => false,
			'field_id' => 'field-' . $type . '-' . $widget_id,
		];

		// Get dynamic icon if available
		$field_args['icon'] = isset($settings['icon_' . $type]) ? $settings['icon_' . $type] : null;
		$field_args['required'] = (isset($settings['required_' . $type]) && $settings['required_' . $type] === 'yes');

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
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>';
				break;
			case 'website':
				$field_args['name'] = 'mtforms_website';
				$field_args['label'] = $settings['label_website'];
				$field_args['placeholder'] = $settings['placeholder_website'];
				$field_args['type'] = 'url';
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2z"/></svg>';
				break;
			case 'subject':
				$field_args['name'] = 'mtforms_subject';
				$field_args['label'] = $settings['label_subject'];
				$field_args['placeholder'] = $settings['placeholder_subject'];
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
		$this->get_partial(
			'button',
			[
				'settings' => $settings,
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
