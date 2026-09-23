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
				'label' => esc_html__('Basic ', 'quick-modern-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Form Title', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Contact Us', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__('Skin', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'skin-0',
				'options' => [
					'skin-0' => __('None', 'quick-modern-forms-for-elementor'),
					'skin-1' => __('1. Modern Indigo', 'quick-modern-forms-for-elementor'),
					'skin-2' => __('2. Nature\'s Breath', 'quick-modern-forms-for-elementor'),
					'skin-3' => __('3. Sleek Corporate', 'quick-modern-forms-for-elementor'),
					'skin-4' => __('4. Cotton Candy', 'quick-modern-forms-for-elementor'),
					'skin-5' => __('5. Neumorphic', 'quick-modern-forms-for-elementor'),
					'skin-6' => __('6. Purple Haze', 'quick-modern-forms-for-elementor'),
					'skin-7' => __('7. Sunset Vibes', 'quick-modern-forms-for-elementor'),
					'skin-8' => __('8. Ocean Deep', 'quick-modern-forms-for-elementor'),
					'skin-9' => __('9. Crystal White', 'quick-modern-forms-for-elementor'),
					'skin-10' => __('10. Vibrant Coral', 'quick-modern-forms-for-elementor'),
					'skin-11' => __('11. Platinum Luxury', 'quick-modern-forms-for-elementor'),
					'skin-12' => __('12. Midnight Glow', 'quick-modern-forms-for-elementor'),
					'skin-13' => __('13. Cyberpunk Glitch', 'quick-modern-forms-for-elementor'),
					'skin-14' => __('14. Paper Stack', 'quick-modern-forms-for-elementor'),
					'skin-15' => __('15. Liquid Metal', 'quick-modern-forms-for-elementor'),
					'skin-16' => __('16. Vintage Terminal', 'quick-modern-forms-for-elementor'),
					'skin-17' => __('17. Minimalist Tech', 'quick-modern-forms-for-elementor'),
					'skin-18' => __('18. Vibrant Pulse', 'quick-modern-forms-for-elementor'),
					'skin-19' => __('19. Clean Material', 'quick-modern-forms-for-elementor'),
					'skin-20' => __('20. Social Connect', 'quick-modern-forms-for-elementor'),
					'skin-21' => __('21. Soft Clay', 'quick-modern-forms-for-elementor'),
					'skin-22' => __('22. Pop Brutalist', 'quick-modern-forms-for-elementor'),
					'skin-23' => __('23. Aura Gradient', 'quick-modern-forms-for-elementor'),
					'skin-24' => __('24. Royal Executive', 'quick-modern-forms-for-elementor'),
					'skin-25' => __('25. Organic Flow', 'quick-modern-forms-for-elementor'),
					'skin-26' => __('26. Retro Pixel', 'quick-modern-forms-for-elementor'),
					'skin-27' => __('27. Dynamic Stream', 'quick-modern-forms-for-elementor'),
					'skin-28' => __('28. Corporate Network', 'quick-modern-forms-for-elementor'),
					'skin-29' => __('29. Marketplace Hub', 'quick-modern-forms-for-elementor'),
					'skin-30' => __('30. Cinema Spotlight', 'quick-modern-forms-for-elementor'),
					'skin-31' => __('31. Team Collaboration', 'quick-modern-forms-for-elementor'),
					'skin-32' => __('32. Travel Explorer', 'quick-modern-forms-for-elementor'),
					'skin-33' => __('33. Frosted Glass', 'quick-modern-forms-for-elementor'),
					'skin-34' => __('34. Floating Depth', 'quick-modern-forms-for-elementor'),
					'skin-35' => __('35. Serif Elegance', 'quick-modern-forms-for-elementor'),
					'skin-36' => __('36. Geometric Pop', 'quick-modern-forms-for-elementor'),
					'skin-37' => __('37. Gradient Aura', 'quick-modern-forms-for-elementor'),
					'skin-38' => __('38. Organic Playful', 'quick-modern-forms-for-elementor'),
					'skin-39' => __('39. Luxury Earth', 'quick-modern-forms-for-elementor'),
					'skin-40' => __('40. Midnight Mint', 'quick-modern-forms-for-elementor'),
					'skin-41' => __('41. Playful Modernist', 'quick-modern-forms-for-elementor'),
					'skin-42' => __('42. Zesty Lemon Squeeze', 'quick-modern-forms-for-elementor'),
					'skin-43' => __('43. Artisanal Butcher', 'quick-modern-forms-for-elementor'),
					'skin-44' => __('44. Elite Athlete', 'quick-modern-forms-for-elementor'),
					'skin-45' => __('45. Fintech Neo', 'quick-modern-forms-for-elementor'),
					'skin-46' => __('46. Sketchy Peanuts', 'quick-modern-forms-for-elementor'),
					'skin-47' => __('47. Solar Vault', 'quick-modern-forms-for-elementor'),
					'skin-48' => __('48. Social Mastodon', 'quick-modern-forms-for-elementor'),
					'skin-49' => __('49. Prime Butcher', 'quick-modern-forms-for-elementor'),
					'skin-50' => __('50. Holographic Aurora', 'quick-modern-forms-for-elementor'),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('None', 'quick-modern-forms-for-elementor'),
					'floating' => __('Floating Labels', 'quick-modern-forms-for-elementor'),
					'material' => __('Material Minimal', 'quick-modern-forms-for-elementor'),
					'compact' => __('Compact Style', 'quick-modern-forms-for-elementor'),
					'boxed-border' => __('Boxed Borderless', 'quick-modern-forms-for-elementor'),
					'inset' => __('Inset Shadow Style', 'quick-modern-forms-for-elementor'),
					'inline' => __('Inline Layout', 'quick-modern-forms-for-elementor'),
				],
			]
		);

		$this->add_responsive_control(
			'inline_label_width',
			[
				'label' => esc_html__('Label Width', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Field Width', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Gap Between Label & Field', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Columns', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __('1 Column', 'quick-modern-forms-for-elementor'),
					'2' => __('2 Columns', 'quick-modern-forms-for-elementor'),
					'3' => __('3 Columns', 'quick-modern-forms-for-elementor'),
					'4' => __('4 Columns', 'quick-modern-forms-for-elementor'),
					'5' => __('5 Columns', 'quick-modern-forms-for-elementor'),
					'6' => __('6 Columns', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Fields', 'quick-modern-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' => esc_html__('Show Labels', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' => esc_html__('Show Placeholders', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => esc_html__('Show Icons', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
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
					'label' => sprintf(esc_html__('Show %s Field', 'quick-modern-forms-for-elementor'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
					'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
					'return_value' => 'yes',
					'default' => $default,
				]
			);

			$this->add_control(
				"required_{$field}",
				[
					/* translators: %s: the form field name (name, email, phone, website, subject, or message). */
					'label' => sprintf(esc_html__('%s Required', 'quick-modern-forms-for-elementor'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
					'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Show GDPR Consent', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Show Captcha', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('See captcha configuration in Quick & Modern Forms for Elementor settings.', 'quick-modern-forms-for-elementor'),
			]
		);

		$this->add_control(
			'enable_honeypot',
			[
				'label' => esc_html__('Enable Honeypot', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('A hidden field to catch spam bots.', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Labels', 'quick-modern-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_name',
			[
				'label' => esc_html__('Name Label', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_name',
			[
				'label' => esc_html__('Name Placeholder', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your name', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_email',
			[
				'label' => esc_html__('Email Label', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_email',
			[
				'label' => esc_html__('Email Placeholder', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your email', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_phone',
			[
				'label' => esc_html__('Phone Label', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_phone',
			[
				'label' => esc_html__('Phone Placeholder', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your phone number', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_website',
			[
				'label' => esc_html__('Website Label', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_website',
			[
				'label' => esc_html__('Website Placeholder', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Your website URL', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_subject',
			[
				'label' => esc_html__('Subject Label', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_subject',
			[
				'label' => esc_html__('Subject Placeholder', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter subject', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_message',
			[
				'label' => esc_html__('Message Label', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_message',
			[
				'label' => esc_html__('Message Placeholder', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Write your message here...', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('GDPR Label', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('GDPR Consent', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_text',
			[
				'label' => esc_html__('GDPR Text', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('I consent to having this website store my submitted information so they can respond to my inquiry.', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Messages', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => esc_html__('Success Message', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Thank you! Your message has been sent successfully.', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Validation Messages', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_required_msg',
			[
				'label' => esc_html__('Name Required', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name is required', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Email Required', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is required', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Email Invalid', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is invalid', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Phone Required', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone number is required', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Phone Invalid', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid phone number', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Website Required', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website URL is required', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Website Invalid', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid URL', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Subject Required', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject is required', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Message Required', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message is required', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('GDPR Required', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('You must agree to the terms', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Sending Text', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Sending...', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'submit_btn_text',
			[
				'label' => esc_html__('Submit Button Text', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Icons', 'quick-modern-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_location',
			[
				'label' => esc_html__('Location', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'label',
				'options' => [
					'label' => [
						'title' => esc_html__('Label', 'quick-modern-forms-for-elementor'),
						'icon' => 'eicon-ellipsis-h',

					],
					'input' => [
						'title' => esc_html__('Input', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Position', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'before' => [
						'title' => esc_html__('Before Text', 'quick-modern-forms-for-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__('After Text', 'quick-modern-forms-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'before',
			]
		);

		$this->add_control(
			'show_textarea_icons',
			[
				'label' => esc_html__('Message Icon', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('GDPR Icon', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Icon Assignment', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$icons = [
			'name' => [
				'label' => esc_html__('Name Icon', 'quick-modern-forms-for-elementor'),
				'default' => 'fas fa-user',
			],
			'email' => [
				'label' => esc_html__('Email Icon', 'quick-modern-forms-for-elementor'),
				'default' => 'fas fa-envelope',
			],
			'phone' => [
				'label' => esc_html__('Phone Icon', 'quick-modern-forms-for-elementor'),
				'default' => 'fas fa-phone',
			],
			'website' => [
				'label' => esc_html__('Website Icon', 'quick-modern-forms-for-elementor'),
				'default' => 'fas fa-globe',
			],
			'subject' => [
				'label' => esc_html__('Subject Icon', 'quick-modern-forms-for-elementor'),
				'default' => 'fas fa-tag',
			],
			'message' => [
				'label' => esc_html__('Message Icon', 'quick-modern-forms-for-elementor'),
				'default' => 'fas fa-comment',
			],
			'gdpr' => [
				'label' => esc_html__('GDPR Icon', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Submit Button', 'quick-modern-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'quick-modern-forms-for-elementor'),
			]
		);

		$this->add_control(
			'button_width',
			[
				'label' => esc_html__('Button Width', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__('Auto', 'quick-modern-forms-for-elementor'),
					'full' => esc_html__('Full Width', 'quick-modern-forms-for-elementor'),
				],
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Button Alignment', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'quick-modern-forms-for-elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'quick-modern-forms-for-elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Button Icon', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Before Text', 'quick-modern-forms-for-elementor'),
					'right' => esc_html__('After Text', 'quick-modern-forms-for-elementor'),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'loader_style',
			[
				'label' => esc_html__('Loader Style', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'spinner',
				'options' => [
					'spinner' => esc_html__('Premium Spinner', 'quick-modern-forms-for-elementor'),
					'dots' => esc_html__('Pulsing Dots', 'quick-modern-forms-for-elementor'),
					'bars' => esc_html__('Bouncing Bars', 'quick-modern-forms-for-elementor'),
					'dual-ring' => esc_html__('Dual Ring', 'quick-modern-forms-for-elementor'),
					'grow' => esc_html__('Growing Circles', 'quick-modern-forms-for-elementor'),
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
				'label' => esc_html__('Advanced Settings', 'quick-modern-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Form HTML ID', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Unique ID for the form element (optional).', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__('Custom CSS Classes', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_email_settings',
			[
				'label' => esc_html__('Email Settings', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mail_to',
			[
				'label' => esc_html__('Recipient Email', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional recipient email address. If empty, global settings will be used.', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_cc',
			[
				'label' => esc_html__('CC Email', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional CC email addresses, separate with commas.', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_bcc',
			[
				'label' => esc_html__('BCC Email', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional BCC email addresses, separate with commas.', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_autoresponder_settings',
			[
				'label' => esc_html__('Auto-Responder', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_autoresponder',
			[
				'label' => esc_html__('Enable Auto-Responder', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'autoresponder_subject',
			[
				'label' => esc_html__('Subject', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Thank you for contacting us!', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoresponder_message',
			[
				'label' => esc_html__('Message', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Hi {name}, thank you for your message. We will get back to you soon.', 'quick-modern-forms-for-elementor'),
				'description' => esc_html__('Available tags: {name}, {email}, {subject}', 'quick-modern-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_redirect_settings',
			[
				'label' => esc_html__('Redirect After Submit', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'redirect_on_success',
			[
				'label' => esc_html__('Enable Redirect', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-modern-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-modern-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'success_redirect_url',
			[
				'label' => esc_html__('Redirect URL', 'quick-modern-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'quick-modern-forms-for-elementor'),
				'condition' => [
					'redirect_on_success' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
}