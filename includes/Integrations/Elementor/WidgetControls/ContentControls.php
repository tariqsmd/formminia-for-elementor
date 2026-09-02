<?php

namespace MTForms\Integrations\Elementor\WidgetControls;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait ContentControls {

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
				'label' => esc_html__('Basic ', 'mtforms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Form Title', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Contact Us', 'mtforms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__('Skin', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'skin-0',
				'options' => [
					'skin-0' => __('None', 'mtforms'),
					'skin-1' => __('1. Modern Indigo', 'mtforms'),
					'skin-2' => __('2. Nature\'s Breath', 'mtforms'),
					'skin-3' => __('3. Sleek Corporate', 'mtforms'),
					'skin-4' => __('4. Cotton Candy', 'mtforms'),
					'skin-5' => __('5. Neumorphic', 'mtforms'),
					'skin-6' => __('6. Purple Haze', 'mtforms'),
					'skin-7' => __('7. Sunset Vibes', 'mtforms'),
					'skin-8' => __('8. Ocean Deep', 'mtforms'),
					'skin-9' => __('9. Crystal White', 'mtforms'),
					'skin-10' => __('10. Vibrant Coral', 'mtforms'),
					'skin-11' => __('11. Platinum Luxury', 'mtforms'),
					'skin-12' => __('12. Midnight Glow', 'mtforms'),
					'skin-13' => __('13. Cyberpunk Glitch', 'mtforms'),
					'skin-14' => __('14. Paper Stack', 'mtforms'),
					'skin-15' => __('15. Liquid Metal', 'mtforms'),
					'skin-16' => __('16. Vintage Terminal', 'mtforms'),
					'skin-17' => __('17. Minimalist Tech', 'mtforms'),
					'skin-18' => __('18. Vibrant Pulse', 'mtforms'),
					'skin-19' => __('19. Clean Material', 'mtforms'),
					'skin-20' => __('20. Social Connect', 'mtforms'),
					'skin-21' => __('21. Soft Clay', 'mtforms'),
					'skin-22' => __('22. Pop Brutalist', 'mtforms'),
					'skin-23' => __('23. Aura Gradient', 'mtforms'),
					'skin-24' => __('24. Royal Executive', 'mtforms'),
					'skin-25' => __('25. Organic Flow', 'mtforms'),
					'skin-26' => __('26. Retro Pixel', 'mtforms'),
					'skin-27' => __('27. Dynamic Stream', 'mtforms'),
					'skin-28' => __('28. Corporate Network', 'mtforms'),
					'skin-29' => __('29. Marketplace Hub', 'mtforms'),
					'skin-30' => __('30. Cinema Spotlight', 'mtforms'),
					'skin-31' => __('31. Team Collaboration', 'mtforms'),
					'skin-32' => __('32. Travel Explorer', 'mtforms'),
					'skin-33' => __('33. Frosted Glass', 'mtforms'),
					'skin-34' => __('34. Floating Depth', 'mtforms'),
					'skin-35' => __('35. Serif Elegance', 'mtforms'),
					'skin-36' => __('36. Geometric Pop', 'mtforms'),
					'skin-37' => __('37. Gradient Aura', 'mtforms'),
					'skin-38' => __('38. Organic Playful', 'mtforms'),
					'skin-39' => __('39. Luxury Earth', 'mtforms'),
					'skin-40' => __('40. Midnight Mint', 'mtforms'),
					'skin-41' => __('41. Playful Modernist', 'mtforms'),
					'skin-42' => __('42. Zesty Lemon Squeeze', 'mtforms'),
					'skin-43' => __('43. Artisanal Butcher', 'mtforms'),
					'skin-44' => __('44. Elite Athlete', 'mtforms'),
					'skin-45' => __('45. Fintech Neo', 'mtforms'),
					'skin-46' => __('46. Sketchy Peanuts', 'mtforms'),
					'skin-47' => __('47. Solar Vault', 'mtforms'),
					'skin-48' => __('48. Social Mastodon', 'mtforms'),
					'skin-49' => __('49. Prime Butcher', 'mtforms'),
					'skin-50' => __('50. Holographic Aurora', 'mtforms'),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('None', 'mtforms'),
					'floating' => __('Floating Labels', 'mtforms'),
					'material' => __('Material Minimal', 'mtforms'),
					'compact' => __('Compact Style', 'mtforms'),
					'boxed-border' => __('Boxed Borderless', 'mtforms'),
					'inset' => __('Inset Shadow Style', 'mtforms'),
					'inline' => __('Inline Layout', 'mtforms'),
				],
			]
		);

		$this->add_responsive_control(
			'inline_label_width',
			[
				'label' => esc_html__('Label Width', 'mtforms'),
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
				'label' => esc_html__('Field Width', 'mtforms'),
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
				'label' => esc_html__('Gap Between Label & Field', 'mtforms'),
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
				'label' => esc_html__('Columns', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __('1 Column', 'mtforms'),
					'2' => __('2 Columns', 'mtforms'),
					'3' => __('3 Columns', 'mtforms'),
					'4' => __('4 Columns', 'mtforms'),
					'5' => __('5 Columns', 'mtforms'),
					'6' => __('6 Columns', 'mtforms'),
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
				'label' => esc_html__('Fields', 'mtforms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' => esc_html__('Show Labels', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' => esc_html__('Show Placeholders', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => esc_html__('Show Icons', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
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
					'label' => sprintf(esc_html__('Show %s Field', 'mtforms'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'mtforms'),
					'label_off' => esc_html__('No', 'mtforms'),
					'return_value' => 'yes',
					'default' => $default,
				]
			);

			$this->add_control(
				"required_{$field}",
				[
					'label' => sprintf(esc_html__('%s Required', 'mtforms'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'mtforms'),
					'label_off' => esc_html__('No', 'mtforms'),
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
				'label' => esc_html__('Show GDPR Consent', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
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
				'label' => esc_html__('Show Captcha', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('See captcha configuration in MTForms settings.', 'mtforms'),
			]
		);

		$this->add_control(
			'enable_honeypot',
			[
				'label' => esc_html__('Enable Honeypot', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('A hidden field to catch spam bots.', 'mtforms'),
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
				'label' => esc_html__('Labels', 'mtforms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_name',
			[
				'label' => esc_html__('Name Label', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_name',
			[
				'label' => esc_html__('Name Placeholder', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your name', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_email',
			[
				'label' => esc_html__('Email Label', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_email',
			[
				'label' => esc_html__('Email Placeholder', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your email', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_phone',
			[
				'label' => esc_html__('Phone Label', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_phone',
			[
				'label' => esc_html__('Phone Placeholder', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your phone number', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_website',
			[
				'label' => esc_html__('Website Label', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_website',
			[
				'label' => esc_html__('Website Placeholder', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Your website URL', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_subject',
			[
				'label' => esc_html__('Subject Label', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_subject',
			[
				'label' => esc_html__('Subject Placeholder', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter subject', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_message',
			[
				'label' => esc_html__('Message Label', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_message',
			[
				'label' => esc_html__('Message Placeholder', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Write your message here...', 'mtforms'),
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
				'label' => esc_html__('GDPR Label', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('GDPR Consent', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_text',
			[
				'label' => esc_html__('GDPR Text', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('I consent to having this website store my submitted information so they can respond to my inquiry.', 'mtforms'),
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
				'label' => esc_html__('Messages', 'mtforms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => esc_html__('Success Message', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Thank you! Your message has been sent successfully.', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		/**
		 * Validation Messages Controls.
		 */
		$this->add_control(
			'heading_validation_messages',
			[
				'label' => esc_html__('Validation Messages', 'mtforms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_required_msg',
			[
				'label' => esc_html__('Name Required', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name is required', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_name' => 'yes',
					'required_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'email_required_msg',
			[
				'label' => esc_html__('Email Required', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is required', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_email' => 'yes',
					'required_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'email_invalid_msg',
			[
				'label' => esc_html__('Email Invalid', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is invalid', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'phone_required_msg',
			[
				'label' => esc_html__('Phone Required', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone number is required', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_phone' => 'yes',
					'required_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'phone_invalid_msg',
			[
				'label' => esc_html__('Phone Invalid', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid phone number', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'website_required_msg',
			[
				'label' => esc_html__('Website Required', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website URL is required', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_website' => 'yes',
					'required_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'website_invalid_msg',
			[
				'label' => esc_html__('Website Invalid', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid URL', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'subject_required_msg',
			[
				'label' => esc_html__('Subject Required', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject is required', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_subject' => 'yes',
					'required_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'message_required_msg',
			[
				'label' => esc_html__('Message Required', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message is required', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_message' => 'yes',
					'required_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_required_msg',
			[
				'label' => esc_html__('GDPR Required', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('You must agree to the terms', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_control(
			'sending_msg',
			[
				'label' => esc_html__('Sending Text', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Sending...', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'submit_btn_text',
			[
				'label' => esc_html__('Submit Button Text', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'mtforms'),
				'label_block' => true,
				'frontend_available' => true,
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
				'label' => esc_html__('Icons', 'mtforms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_location',
			[
				'label' => esc_html__('Location', 'mtforms'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'label',
				'options' => [
					'label' => [
						'title' => esc_html__('Label', 'mtforms'),
						'icon' => 'eicon-ellipsis-h',

					],
					'input' => [
						'title' => esc_html__('Input', 'mtforms'),
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
				'label' => esc_html__('Position', 'mtforms'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'before' => [
						'title' => esc_html__('Before Text', 'mtforms'),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__('After Text', 'mtforms'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'before',
			]
		);

		$this->add_control(
			'show_textarea_icons',
			[
				'label' => esc_html__('Message Icon', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_message' => 'yes',
					'icon_location' => 'input',
				],
			]
		);

		$this->add_control(
			'show_gdpr_icons',
			[
				'label' => esc_html__('GDPR Icon', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
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
				'label' => esc_html__('Icon Assignment', 'mtforms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$icons = [
			'name' => [
				'label' => esc_html__('Name Icon', 'mtforms'),
				'default' => 'fas fa-user',
			],
			'email' => [
				'label' => esc_html__('Email Icon', 'mtforms'),
				'default' => 'fas fa-envelope',
			],
			'phone' => [
				'label' => esc_html__('Phone Icon', 'mtforms'),
				'default' => 'fas fa-phone',
			],
			'website' => [
				'label' => esc_html__('Website Icon', 'mtforms'),
				'default' => 'fas fa-globe',
			],
			'subject' => [
				'label' => esc_html__('Subject Icon', 'mtforms'),
				'default' => 'fas fa-tag',
			],
			'message' => [
				'label' => esc_html__('Message Icon', 'mtforms'),
				'default' => 'fas fa-comment',
			],
			'gdpr' => [
				'label' => esc_html__('GDPR Icon', 'mtforms'),
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
				'label' => esc_html__('Submit Button', 'mtforms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'mtforms'),
			]
		);

		$this->add_control(
			'button_width',
			[
				'label' => esc_html__('Button Width', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__('Auto', 'mtforms'),
					'full' => esc_html__('Full Width', 'mtforms'),
				],
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Button Alignment', 'mtforms'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'mtforms'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'mtforms'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'mtforms'),
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
				'label' => esc_html__('Button Icon', 'mtforms'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Before Text', 'mtforms'),
					'right' => esc_html__('After Text', 'mtforms'),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'loader_style',
			[
				'label' => esc_html__('Loader Style', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'spinner',
				'options' => [
					'spinner' => esc_html__('Premium Spinner', 'mtforms'),
					'dots' => esc_html__('Pulsing Dots', 'mtforms'),
					'bars' => esc_html__('Bouncing Bars', 'mtforms'),
					'dual-ring' => esc_html__('Dual Ring', 'mtforms'),
					'grow' => esc_html__('Growing Circles', 'mtforms'),
				],
				'separator' => 'before',
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
				'label' => esc_html__('Advanced Settings', 'mtforms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Form HTML ID', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Unique ID for the form element (optional).', 'mtforms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__('Custom CSS Classes', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_email_settings',
			[
				'label' => esc_html__('Email Settings', 'mtforms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mail_to',
			[
				'label' => esc_html__('Recipient Email', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional recipient email address. If empty, global settings will be used.', 'mtforms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_cc',
			[
				'label' => esc_html__('CC Email', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional CC email addresses, separate with commas.', 'mtforms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_bcc',
			[
				'label' => esc_html__('BCC Email', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional BCC email addresses, separate with commas.', 'mtforms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_autoresponder_settings',
			[
				'label' => esc_html__('Auto-Responder', 'mtforms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_autoresponder',
			[
				'label' => esc_html__('Enable Auto-Responder', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'autoresponder_subject',
			[
				'label' => esc_html__('Subject', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Thank you for contacting us!', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoresponder_message',
			[
				'label' => esc_html__('Message', 'mtforms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Hi {name}, thank you for your message. We will get back to you soon.', 'mtforms'),
				'description' => esc_html__('Available tags: {name}, {email}, {subject}', 'mtforms'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_redirect_settings',
			[
				'label' => esc_html__('Redirect After Submit', 'mtforms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'redirect_on_success',
			[
				'label' => esc_html__('Enable Redirect', 'mtforms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mtforms'),
				'label_off' => esc_html__('No', 'mtforms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'success_redirect_url',
			[
				'label' => esc_html__('Redirect URL', 'mtforms'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'mtforms'),
				'condition' => [
					'redirect_on_success' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
}