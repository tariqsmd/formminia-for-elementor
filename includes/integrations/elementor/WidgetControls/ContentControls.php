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
					'skin-43' => __('43. Artisanal Butcher', MTFORMS_TEXT_DOMAIN),
					'skin-44' => __('44. Elite Athlete', MTFORMS_TEXT_DOMAIN),
					'skin-45' => __('45. Fintech Neo', MTFORMS_TEXT_DOMAIN),
					'skin-46' => __('46. Sketchy Peanuts', MTFORMS_TEXT_DOMAIN),
					'skin-47' => __('47. Solar Vault', MTFORMS_TEXT_DOMAIN),
					'skin-48' => __('48. Social Mastodon', MTFORMS_TEXT_DOMAIN),
					'skin-49' => __('49. Prime Butcher', MTFORMS_TEXT_DOMAIN),
					'skin-50' => __('50. Holographic Aurora', MTFORMS_TEXT_DOMAIN),
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
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Validation Messages', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_required_msg',
			[
				'label' => esc_html__('Name Required', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name is required', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Email Required', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is required', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Email Invalid', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is invalid', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Phone Required', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone number is required', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Phone Invalid', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid phone number', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Website Required', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website URL is required', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Website Invalid', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid URL', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Subject Required', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject is required', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Message Required', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message is required', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('GDPR Required', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('You must agree to the terms', MTFORMS_TEXT_DOMAIN),
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
				'label' => esc_html__('Sending Text', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Sending...', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'submit_btn_text',
			[
				'label' => esc_html__('Submit Button Text', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', MTFORMS_TEXT_DOMAIN),
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

		$this->add_control(
			'loader_style',
			[
				'label' => esc_html__('Loader Style', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'spinner',
				'options' => [
					'spinner' => esc_html__('Premium Spinner', MTFORMS_TEXT_DOMAIN),
					'dots' => esc_html__('Pulsing Dots', MTFORMS_TEXT_DOMAIN),
					'bars' => esc_html__('Bouncing Bars', MTFORMS_TEXT_DOMAIN),
					'dual-ring' => esc_html__('Dual Ring', MTFORMS_TEXT_DOMAIN),
					'grow' => esc_html__('Growing Circles', MTFORMS_TEXT_DOMAIN),
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
			'heading_autoresponder_settings',
			[
				'label' => esc_html__('Auto-Responder', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_autoresponder',
			[
				'label' => esc_html__('Enable Auto-Responder', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', MTFORMS_TEXT_DOMAIN),
				'label_off' => esc_html__('No', MTFORMS_TEXT_DOMAIN),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'autoresponder_subject',
			[
				'label' => esc_html__('Subject', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Thank you for contacting us!', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoresponder_message',
			[
				'label' => esc_html__('Message', MTFORMS_TEXT_DOMAIN),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Hi {name}, thank you for your message. We will get back to you soon.', MTFORMS_TEXT_DOMAIN),
				'description' => esc_html__('Available tags: {name}, {email}, {subject}', MTFORMS_TEXT_DOMAIN),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
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
}