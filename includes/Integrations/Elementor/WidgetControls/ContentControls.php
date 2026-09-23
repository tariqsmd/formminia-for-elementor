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
				'label' => esc_html__('Basic ', 'quick-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Form Title', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Contact Us', 'quick-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__('Skin', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'skin-0',
				'options' => [
					'skin-0' => __('None', 'quick-forms-for-elementor'),
					'skin-1' => __('1. Modern Indigo', 'quick-forms-for-elementor'),
					'skin-2' => __('2. Nature\'s Breath', 'quick-forms-for-elementor'),
					'skin-3' => __('3. Sleek Corporate', 'quick-forms-for-elementor'),
					'skin-4' => __('4. Cotton Candy', 'quick-forms-for-elementor'),
					'skin-5' => __('5. Neumorphic', 'quick-forms-for-elementor'),
					'skin-6' => __('6. Purple Haze', 'quick-forms-for-elementor'),
					'skin-7' => __('7. Sunset Vibes', 'quick-forms-for-elementor'),
					'skin-8' => __('8. Ocean Deep', 'quick-forms-for-elementor'),
					'skin-9' => __('9. Crystal White', 'quick-forms-for-elementor'),
					'skin-10' => __('10. Vibrant Coral', 'quick-forms-for-elementor'),
					'skin-11' => __('11. Platinum Luxury', 'quick-forms-for-elementor'),
					'skin-12' => __('12. Midnight Glow', 'quick-forms-for-elementor'),
					'skin-13' => __('13. Cyberpunk Glitch', 'quick-forms-for-elementor'),
					'skin-14' => __('14. Paper Stack', 'quick-forms-for-elementor'),
					'skin-15' => __('15. Liquid Metal', 'quick-forms-for-elementor'),
					'skin-16' => __('16. Vintage Terminal', 'quick-forms-for-elementor'),
					'skin-17' => __('17. Minimalist Tech', 'quick-forms-for-elementor'),
					'skin-18' => __('18. Vibrant Pulse', 'quick-forms-for-elementor'),
					'skin-19' => __('19. Clean Material', 'quick-forms-for-elementor'),
					'skin-20' => __('20. Social Connect', 'quick-forms-for-elementor'),
					'skin-21' => __('21. Soft Clay', 'quick-forms-for-elementor'),
					'skin-22' => __('22. Pop Brutalist', 'quick-forms-for-elementor'),
					'skin-23' => __('23. Aura Gradient', 'quick-forms-for-elementor'),
					'skin-24' => __('24. Royal Executive', 'quick-forms-for-elementor'),
					'skin-25' => __('25. Organic Flow', 'quick-forms-for-elementor'),
					'skin-26' => __('26. Retro Pixel', 'quick-forms-for-elementor'),
					'skin-27' => __('27. Dynamic Stream', 'quick-forms-for-elementor'),
					'skin-28' => __('28. Corporate Network', 'quick-forms-for-elementor'),
					'skin-29' => __('29. Marketplace Hub', 'quick-forms-for-elementor'),
					'skin-30' => __('30. Cinema Spotlight', 'quick-forms-for-elementor'),
					'skin-31' => __('31. Team Collaboration', 'quick-forms-for-elementor'),
					'skin-32' => __('32. Travel Explorer', 'quick-forms-for-elementor'),
					'skin-33' => __('33. Frosted Glass', 'quick-forms-for-elementor'),
					'skin-34' => __('34. Floating Depth', 'quick-forms-for-elementor'),
					'skin-35' => __('35. Serif Elegance', 'quick-forms-for-elementor'),
					'skin-36' => __('36. Geometric Pop', 'quick-forms-for-elementor'),
					'skin-37' => __('37. Gradient Aura', 'quick-forms-for-elementor'),
					'skin-38' => __('38. Organic Playful', 'quick-forms-for-elementor'),
					'skin-39' => __('39. Luxury Earth', 'quick-forms-for-elementor'),
					'skin-40' => __('40. Midnight Mint', 'quick-forms-for-elementor'),
					'skin-41' => __('41. Playful Modernist', 'quick-forms-for-elementor'),
					'skin-42' => __('42. Zesty Lemon Squeeze', 'quick-forms-for-elementor'),
					'skin-43' => __('43. Artisanal Butcher', 'quick-forms-for-elementor'),
					'skin-44' => __('44. Elite Athlete', 'quick-forms-for-elementor'),
					'skin-45' => __('45. Fintech Neo', 'quick-forms-for-elementor'),
					'skin-46' => __('46. Sketchy Peanuts', 'quick-forms-for-elementor'),
					'skin-47' => __('47. Solar Vault', 'quick-forms-for-elementor'),
					'skin-48' => __('48. Social Mastodon', 'quick-forms-for-elementor'),
					'skin-49' => __('49. Prime Butcher', 'quick-forms-for-elementor'),
					'skin-50' => __('50. Holographic Aurora', 'quick-forms-for-elementor'),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('None', 'quick-forms-for-elementor'),
					'floating' => __('Floating Labels', 'quick-forms-for-elementor'),
					'material' => __('Material Minimal', 'quick-forms-for-elementor'),
					'compact' => __('Compact Style', 'quick-forms-for-elementor'),
					'boxed-border' => __('Boxed Borderless', 'quick-forms-for-elementor'),
					'inset' => __('Inset Shadow Style', 'quick-forms-for-elementor'),
					'inline' => __('Inline Layout', 'quick-forms-for-elementor'),
				],
			]
		);

		$this->add_responsive_control(
			'inline_label_width',
			[
				'label' => esc_html__('Label Width', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Field Width', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Gap Between Label & Field', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Columns', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __('1 Column', 'quick-forms-for-elementor'),
					'2' => __('2 Columns', 'quick-forms-for-elementor'),
					'3' => __('3 Columns', 'quick-forms-for-elementor'),
					'4' => __('4 Columns', 'quick-forms-for-elementor'),
					'5' => __('5 Columns', 'quick-forms-for-elementor'),
					'6' => __('6 Columns', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Fields', 'quick-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' => esc_html__('Show Labels', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' => esc_html__('Show Placeholders', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => esc_html__('Show Icons', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
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
					'label' => sprintf(esc_html__('Show %s Field', 'quick-forms-for-elementor'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
					'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
					'return_value' => 'yes',
					'default' => $default,
				]
			);

			$this->add_control(
				"required_{$field}",
				[
					/* translators: %s: the form field name (name, email, phone, website, subject, or message). */
					'label' => sprintf(esc_html__('%s Required', 'quick-forms-for-elementor'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
					'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Show GDPR Consent', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Show Captcha', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('See captcha configuration in Quick Forms for Elementor settings.', 'quick-forms-for-elementor'),
			]
		);

		$this->add_control(
			'enable_honeypot',
			[
				'label' => esc_html__('Enable Honeypot', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('A hidden field to catch spam bots.', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Labels', 'quick-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_name',
			[
				'label' => esc_html__('Name Label', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_name',
			[
				'label' => esc_html__('Name Placeholder', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your name', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_email',
			[
				'label' => esc_html__('Email Label', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_email',
			[
				'label' => esc_html__('Email Placeholder', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your email', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_phone',
			[
				'label' => esc_html__('Phone Label', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_phone',
			[
				'label' => esc_html__('Phone Placeholder', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your phone number', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_website',
			[
				'label' => esc_html__('Website Label', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_website',
			[
				'label' => esc_html__('Website Placeholder', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Your website URL', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_subject',
			[
				'label' => esc_html__('Subject Label', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_subject',
			[
				'label' => esc_html__('Subject Placeholder', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter subject', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_message',
			[
				'label' => esc_html__('Message Label', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_message',
			[
				'label' => esc_html__('Message Placeholder', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Write your message here...', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('GDPR Label', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('GDPR Consent', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_text',
			[
				'label' => esc_html__('GDPR Text', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('I consent to having this website store my submitted information so they can respond to my inquiry.', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Messages', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => esc_html__('Success Message', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Thank you! Your message has been sent successfully.', 'quick-forms-for-elementor'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Validation Messages', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_required_msg',
			[
				'label' => esc_html__('Name Required', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name is required', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Email Required', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is required', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Email Invalid', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is invalid', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Phone Required', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone number is required', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Phone Invalid', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid phone number', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Website Required', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website URL is required', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Website Invalid', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid URL', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Subject Required', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject is required', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Message Required', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message is required', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('GDPR Required', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('You must agree to the terms', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Sending Text', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Sending...', 'quick-forms-for-elementor'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'submit_btn_text',
			[
				'label' => esc_html__('Submit Button Text', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Icons', 'quick-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_location',
			[
				'label' => esc_html__('Location', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'label',
				'options' => [
					'label' => [
						'title' => esc_html__('Label', 'quick-forms-for-elementor'),
						'icon' => 'eicon-ellipsis-h',

					],
					'input' => [
						'title' => esc_html__('Input', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Position', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'before' => [
						'title' => esc_html__('Before Text', 'quick-forms-for-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__('After Text', 'quick-forms-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'before',
			]
		);

		$this->add_control(
			'show_textarea_icons',
			[
				'label' => esc_html__('Message Icon', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('GDPR Icon', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Icon Assignment', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$icons = [
			'name' => [
				'label' => esc_html__('Name Icon', 'quick-forms-for-elementor'),
				'default' => 'fas fa-user',
			],
			'email' => [
				'label' => esc_html__('Email Icon', 'quick-forms-for-elementor'),
				'default' => 'fas fa-envelope',
			],
			'phone' => [
				'label' => esc_html__('Phone Icon', 'quick-forms-for-elementor'),
				'default' => 'fas fa-phone',
			],
			'website' => [
				'label' => esc_html__('Website Icon', 'quick-forms-for-elementor'),
				'default' => 'fas fa-globe',
			],
			'subject' => [
				'label' => esc_html__('Subject Icon', 'quick-forms-for-elementor'),
				'default' => 'fas fa-tag',
			],
			'message' => [
				'label' => esc_html__('Message Icon', 'quick-forms-for-elementor'),
				'default' => 'fas fa-comment',
			],
			'gdpr' => [
				'label' => esc_html__('GDPR Icon', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Submit Button', 'quick-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'quick-forms-for-elementor'),
			]
		);

		$this->add_control(
			'button_width',
			[
				'label' => esc_html__('Button Width', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__('Auto', 'quick-forms-for-elementor'),
					'full' => esc_html__('Full Width', 'quick-forms-for-elementor'),
				],
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Button Alignment', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'quick-forms-for-elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'quick-forms-for-elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Button Icon', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Before Text', 'quick-forms-for-elementor'),
					'right' => esc_html__('After Text', 'quick-forms-for-elementor'),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'loader_style',
			[
				'label' => esc_html__('Loader Style', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'spinner',
				'options' => [
					'spinner' => esc_html__('Premium Spinner', 'quick-forms-for-elementor'),
					'dots' => esc_html__('Pulsing Dots', 'quick-forms-for-elementor'),
					'bars' => esc_html__('Bouncing Bars', 'quick-forms-for-elementor'),
					'dual-ring' => esc_html__('Dual Ring', 'quick-forms-for-elementor'),
					'grow' => esc_html__('Growing Circles', 'quick-forms-for-elementor'),
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
				'label' => esc_html__('Advanced Settings', 'quick-forms-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Form HTML ID', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Unique ID for the form element (optional).', 'quick-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__('Custom CSS Classes', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_email_settings',
			[
				'label' => esc_html__('Email Settings', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mail_to',
			[
				'label' => esc_html__('Recipient Email', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional recipient email address. If empty, global settings will be used.', 'quick-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_cc',
			[
				'label' => esc_html__('CC Email', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional CC email addresses, separate with commas.', 'quick-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_bcc',
			[
				'label' => esc_html__('BCC Email', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional BCC email addresses, separate with commas.', 'quick-forms-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_autoresponder_settings',
			[
				'label' => esc_html__('Auto-Responder', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_autoresponder',
			[
				'label' => esc_html__('Enable Auto-Responder', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'autoresponder_subject',
			[
				'label' => esc_html__('Subject', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Thank you for contacting us!', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoresponder_message',
			[
				'label' => esc_html__('Message', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Hi {name}, thank you for your message. We will get back to you soon.', 'quick-forms-for-elementor'),
				'description' => esc_html__('Available tags: {name}, {email}, {subject}', 'quick-forms-for-elementor'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_redirect_settings',
			[
				'label' => esc_html__('Redirect After Submit', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'redirect_on_success',
			[
				'label' => esc_html__('Enable Redirect', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'quick-forms-for-elementor'),
				'label_off' => esc_html__('No', 'quick-forms-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'success_redirect_url',
			[
				'label' => esc_html__('Redirect URL', 'quick-forms-for-elementor'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'quick-forms-for-elementor'),
				'condition' => [
					'redirect_on_success' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
}