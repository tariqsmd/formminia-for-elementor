<?php

namespace MTEF\Integrations\Elementor\WidgetControls;

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
				'label' => esc_html__('Basic ', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Form Title', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Contact Us', 'mt-elementor-forms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__('Skin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'skin-0',
				'options' => [
					'skin-0' => __('None', 'mt-elementor-forms'),
					'skin-1' => __('1. Modern Indigo', 'mt-elementor-forms'),
					'skin-2' => __('2. Nature\'s Breath', 'mt-elementor-forms'),
					'skin-3' => __('3. Sleek Corporate', 'mt-elementor-forms'),
					'skin-4' => __('4. Cotton Candy', 'mt-elementor-forms'),
					'skin-5' => __('5. Neumorphic', 'mt-elementor-forms'),
					'skin-6' => __('6. Purple Haze', 'mt-elementor-forms'),
					'skin-7' => __('7. Sunset Vibes', 'mt-elementor-forms'),
					'skin-8' => __('8. Ocean Deep', 'mt-elementor-forms'),
					'skin-9' => __('9. Crystal White', 'mt-elementor-forms'),
					'skin-10' => __('10. Vibrant Coral', 'mt-elementor-forms'),
					'skin-11' => __('11. Platinum Luxury', 'mt-elementor-forms'),
					'skin-12' => __('12. Midnight Glow', 'mt-elementor-forms'),
					'skin-13' => __('13. Cyberpunk Glitch', 'mt-elementor-forms'),
					'skin-14' => __('14. Paper Stack', 'mt-elementor-forms'),
					'skin-15' => __('15. Liquid Metal', 'mt-elementor-forms'),
					'skin-16' => __('16. Vintage Terminal', 'mt-elementor-forms'),
					'skin-17' => __('17. Minimalist Tech', 'mt-elementor-forms'),
					'skin-18' => __('18. Vibrant Pulse', 'mt-elementor-forms'),
					'skin-19' => __('19. Clean Material', 'mt-elementor-forms'),
					'skin-20' => __('20. Social Connect', 'mt-elementor-forms'),
					'skin-21' => __('21. Soft Clay', 'mt-elementor-forms'),
					'skin-22' => __('22. Pop Brutalist', 'mt-elementor-forms'),
					'skin-23' => __('23. Aura Gradient', 'mt-elementor-forms'),
					'skin-24' => __('24. Royal Executive', 'mt-elementor-forms'),
					'skin-25' => __('25. Organic Flow', 'mt-elementor-forms'),
					'skin-26' => __('26. Retro Pixel', 'mt-elementor-forms'),
					'skin-27' => __('27. Dynamic Stream', 'mt-elementor-forms'),
					'skin-28' => __('28. Corporate Network', 'mt-elementor-forms'),
					'skin-29' => __('29. Marketplace Hub', 'mt-elementor-forms'),
					'skin-30' => __('30. Cinema Spotlight', 'mt-elementor-forms'),
					'skin-31' => __('31. Team Collaboration', 'mt-elementor-forms'),
					'skin-32' => __('32. Travel Explorer', 'mt-elementor-forms'),
					'skin-33' => __('33. Frosted Glass', 'mt-elementor-forms'),
					'skin-34' => __('34. Floating Depth', 'mt-elementor-forms'),
					'skin-35' => __('35. Serif Elegance', 'mt-elementor-forms'),
					'skin-36' => __('36. Geometric Pop', 'mt-elementor-forms'),
					'skin-37' => __('37. Gradient Aura', 'mt-elementor-forms'),
					'skin-38' => __('38. Organic Playful', 'mt-elementor-forms'),
					'skin-39' => __('39. Luxury Earth', 'mt-elementor-forms'),
					'skin-40' => __('40. Midnight Mint', 'mt-elementor-forms'),
					'skin-41' => __('41. Playful Modernist', 'mt-elementor-forms'),
					'skin-42' => __('42. Zesty Lemon Squeeze', 'mt-elementor-forms'),
					'skin-43' => __('43. Artisanal Butcher', 'mt-elementor-forms'),
					'skin-44' => __('44. Elite Athlete', 'mt-elementor-forms'),
					'skin-45' => __('45. Fintech Neo', 'mt-elementor-forms'),
					'skin-46' => __('46. Sketchy Peanuts', 'mt-elementor-forms'),
					'skin-47' => __('47. Solar Vault', 'mt-elementor-forms'),
					'skin-48' => __('48. Social Mastodon', 'mt-elementor-forms'),
					'skin-49' => __('49. Prime Butcher', 'mt-elementor-forms'),
					'skin-50' => __('50. Holographic Aurora', 'mt-elementor-forms'),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('None', 'mt-elementor-forms'),
					'floating' => __('Floating Labels', 'mt-elementor-forms'),
					'material' => __('Material Minimal', 'mt-elementor-forms'),
					'compact' => __('Compact Style', 'mt-elementor-forms'),
					'boxed-border' => __('Boxed Borderless', 'mt-elementor-forms'),
					'inset' => __('Inset Shadow Style', 'mt-elementor-forms'),
					'inline' => __('Inline Layout', 'mt-elementor-forms'),
				],
			]
		);

		$this->add_responsive_control(
			'inline_label_width',
			[
				'label' => esc_html__('Label Width', 'mt-elementor-forms'),
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
					'{{WRAPPER}} .mtef-layout-inline .mtef-form-group label' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_field_width',
			[
				'label' => esc_html__('Field Width', 'mt-elementor-forms'),
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
					'{{WRAPPER}} .mtef-layout-inline .mtef-input-wrap' => 'flex: 1 1 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_gap',
			[
				'label' => esc_html__('Gap Between Label & Field', 'mt-elementor-forms'),
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
					'{{WRAPPER}} .mtef-layout-inline .mtef-form-group' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => esc_html__('Columns', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __('1 Column', 'mt-elementor-forms'),
					'2' => __('2 Columns', 'mt-elementor-forms'),
					'3' => __('3 Columns', 'mt-elementor-forms'),
					'4' => __('4 Columns', 'mt-elementor-forms'),
					'5' => __('5 Columns', 'mt-elementor-forms'),
					'6' => __('6 Columns', 'mt-elementor-forms'),
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-fields-wrapper' => '--mtef-columns: {{VALUE}};',
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
				'label' => esc_html__('Fields', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' => esc_html__('Show Labels', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' => esc_html__('Show Placeholders', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => esc_html__('Show Icons', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
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
					/* translators: %s: the form field name (name, email, phone, website, subject, or message). */
					'label' => sprintf(esc_html__('Show %s Field', 'mt-elementor-forms'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
					'label_off' => esc_html__('No', 'mt-elementor-forms'),
					'return_value' => 'yes',
					'default' => $default,
				]
			);

			$this->add_control(
				"required_{$field}",
				[
					/* translators: %s: the form field name (name, email, phone, website, subject, or message). */
					'label' => sprintf(esc_html__('%s Required', 'mt-elementor-forms'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
					'label_off' => esc_html__('No', 'mt-elementor-forms'),
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
				'label' => esc_html__('Show GDPR Consent', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
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
				'label' => esc_html__('Show Captcha', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('See captcha configuration in MT Elementor Forms settings.', 'mt-elementor-forms'),
			]
		);

		$this->add_control(
			'enable_honeypot',
			[
				'label' => esc_html__('Enable Honeypot', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('A hidden field to catch spam bots.', 'mt-elementor-forms'),
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
				'label' => esc_html__('Labels', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_name',
			[
				'label' => esc_html__('Name Label', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_name',
			[
				'label' => esc_html__('Name Placeholder', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your name', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_email',
			[
				'label' => esc_html__('Email Label', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_email',
			[
				'label' => esc_html__('Email Placeholder', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your email', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_phone',
			[
				'label' => esc_html__('Phone Label', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_phone',
			[
				'label' => esc_html__('Phone Placeholder', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your phone number', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_website',
			[
				'label' => esc_html__('Website Label', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_website',
			[
				'label' => esc_html__('Website Placeholder', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Your website URL', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_subject',
			[
				'label' => esc_html__('Subject Label', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_subject',
			[
				'label' => esc_html__('Subject Placeholder', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter subject', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_message',
			[
				'label' => esc_html__('Message Label', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_message',
			[
				'label' => esc_html__('Message Placeholder', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Write your message here...', 'mt-elementor-forms'),
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
				'label' => esc_html__('GDPR Label', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('GDPR Consent', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_text',
			[
				'label' => esc_html__('GDPR Text', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('I consent to having this website store my submitted information so they can respond to my inquiry.', 'mt-elementor-forms'),
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
				'label' => esc_html__('Messages', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => esc_html__('Success Message', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Thank you! Your message has been sent successfully.', 'mt-elementor-forms'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', 'mt-elementor-forms'),
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
				'label' => esc_html__('Validation Messages', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_required_msg',
			[
				'label' => esc_html__('Name Required', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name is required', 'mt-elementor-forms'),
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
				'label' => esc_html__('Email Required', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is required', 'mt-elementor-forms'),
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
				'label' => esc_html__('Email Invalid', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is invalid', 'mt-elementor-forms'),
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
				'label' => esc_html__('Phone Required', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone number is required', 'mt-elementor-forms'),
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
				'label' => esc_html__('Phone Invalid', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid phone number', 'mt-elementor-forms'),
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
				'label' => esc_html__('Website Required', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website URL is required', 'mt-elementor-forms'),
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
				'label' => esc_html__('Website Invalid', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid URL', 'mt-elementor-forms'),
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
				'label' => esc_html__('Subject Required', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject is required', 'mt-elementor-forms'),
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
				'label' => esc_html__('Message Required', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message is required', 'mt-elementor-forms'),
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
				'label' => esc_html__('GDPR Required', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('You must agree to the terms', 'mt-elementor-forms'),
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
				'label' => esc_html__('Sending Text', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Sending...', 'mt-elementor-forms'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'submit_btn_text',
			[
				'label' => esc_html__('Submit Button Text', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'mt-elementor-forms'),
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
				'label' => esc_html__('Icons', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_location',
			[
				'label' => esc_html__('Location', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'label',
				'options' => [
					'label' => [
						'title' => esc_html__('Label', 'mt-elementor-forms'),
						'icon' => 'eicon-ellipsis-h',

					],
					'input' => [
						'title' => esc_html__('Input', 'mt-elementor-forms'),
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
				'label' => esc_html__('Position', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'before' => [
						'title' => esc_html__('Before Text', 'mt-elementor-forms'),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__('After Text', 'mt-elementor-forms'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'before',
			]
		);

		$this->add_control(
			'show_textarea_icons',
			[
				'label' => esc_html__('Message Icon', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
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
				'label' => esc_html__('GDPR Icon', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
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
				'label' => esc_html__('Icon Assignment', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$icons = [
			'name' => [
				'label' => esc_html__('Name Icon', 'mt-elementor-forms'),
				'default' => 'fas fa-user',
			],
			'email' => [
				'label' => esc_html__('Email Icon', 'mt-elementor-forms'),
				'default' => 'fas fa-envelope',
			],
			'phone' => [
				'label' => esc_html__('Phone Icon', 'mt-elementor-forms'),
				'default' => 'fas fa-phone',
			],
			'website' => [
				'label' => esc_html__('Website Icon', 'mt-elementor-forms'),
				'default' => 'fas fa-globe',
			],
			'subject' => [
				'label' => esc_html__('Subject Icon', 'mt-elementor-forms'),
				'default' => 'fas fa-tag',
			],
			'message' => [
				'label' => esc_html__('Message Icon', 'mt-elementor-forms'),
				'default' => 'fas fa-comment',
			],
			'gdpr' => [
				'label' => esc_html__('GDPR Icon', 'mt-elementor-forms'),
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
				'label' => esc_html__('Submit Button', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'mt-elementor-forms'),
			]
		);

		$this->add_control(
			'button_width',
			[
				'label' => esc_html__('Button Width', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__('Auto', 'mt-elementor-forms'),
					'full' => esc_html__('Full Width', 'mt-elementor-forms'),
				],
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Button Alignment', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'mt-elementor-forms'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'mt-elementor-forms'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'mt-elementor-forms'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'condition' => [
					'button_width!' => 'full',
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-actions' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__('Button Icon', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Before Text', 'mt-elementor-forms'),
					'right' => esc_html__('After Text', 'mt-elementor-forms'),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'loader_style',
			[
				'label' => esc_html__('Loader Style', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'spinner',
				'options' => [
					'spinner' => esc_html__('Premium Spinner', 'mt-elementor-forms'),
					'dots' => esc_html__('Pulsing Dots', 'mt-elementor-forms'),
					'bars' => esc_html__('Bouncing Bars', 'mt-elementor-forms'),
					'dual-ring' => esc_html__('Dual Ring', 'mt-elementor-forms'),
					'grow' => esc_html__('Growing Circles', 'mt-elementor-forms'),
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
				'label' => esc_html__('Advanced Settings', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Form HTML ID', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Unique ID for the form element (optional).', 'mt-elementor-forms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__('Custom CSS Classes', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_email_settings',
			[
				'label' => esc_html__('Email Settings', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mail_to',
			[
				'label' => esc_html__('Recipient Email', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional recipient email address. If empty, global settings will be used.', 'mt-elementor-forms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_cc',
			[
				'label' => esc_html__('CC Email', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional CC email addresses, separate with commas.', 'mt-elementor-forms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_bcc',
			[
				'label' => esc_html__('BCC Email', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional BCC email addresses, separate with commas.', 'mt-elementor-forms'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_autoresponder_settings',
			[
				'label' => esc_html__('Auto-Responder', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_autoresponder',
			[
				'label' => esc_html__('Enable Auto-Responder', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'autoresponder_subject',
			[
				'label' => esc_html__('Subject', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Thank you for contacting us!', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoresponder_message',
			[
				'label' => esc_html__('Message', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Hi {name}, thank you for your message. We will get back to you soon.', 'mt-elementor-forms'),
				'description' => esc_html__('Available tags: {name}, {email}, {subject}', 'mt-elementor-forms'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_redirect_settings',
			[
				'label' => esc_html__('Redirect After Submit', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'redirect_on_success',
			[
				'label' => esc_html__('Enable Redirect', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'mt-elementor-forms'),
				'label_off' => esc_html__('No', 'mt-elementor-forms'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'success_redirect_url',
			[
				'label' => esc_html__('Redirect URL', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'mt-elementor-forms'),
				'condition' => [
					'redirect_on_success' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
}