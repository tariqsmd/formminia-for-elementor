<?php

namespace FORMMINIA\Integrations\Elementor\WidgetControls;

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
				'label' => esc_html__('Basic ', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Form Title', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Contact Us', 'formminia-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'skin',
			[
				'label' => esc_html__('Skin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'skin-0',
				'options' => [
					'skin-0' => __('None', 'formminia-for-elementor'),
					'skin-1' => __('1. Modern Indigo', 'formminia-for-elementor'),
					'skin-2' => __('2. Nature\'s Breath', 'formminia-for-elementor'),
					'skin-3' => __('3. Sleek Corporate', 'formminia-for-elementor'),
					'skin-4' => __('4. Cotton Candy', 'formminia-for-elementor'),
					'skin-5' => __('5. Neumorphic', 'formminia-for-elementor'),
					'skin-6' => __('6. Purple Haze', 'formminia-for-elementor'),
					'skin-7' => __('7. Sunset Vibes', 'formminia-for-elementor'),
					'skin-8' => __('8. Ocean Deep', 'formminia-for-elementor'),
					'skin-9' => __('9. Crystal White', 'formminia-for-elementor'),
					'skin-10' => __('10. Vibrant Coral', 'formminia-for-elementor'),
					'skin-11' => __('11. Platinum Luxury', 'formminia-for-elementor'),
					'skin-12' => __('12. Midnight Glow', 'formminia-for-elementor'),
					'skin-13' => __('13. Cyberpunk Glitch', 'formminia-for-elementor'),
					'skin-14' => __('14. Paper Stack', 'formminia-for-elementor'),
					'skin-15' => __('15. Liquid Metal', 'formminia-for-elementor'),
					'skin-16' => __('16. Vintage Terminal', 'formminia-for-elementor'),
					'skin-17' => __('17. Minimalist Tech', 'formminia-for-elementor'),
					'skin-18' => __('18. Vibrant Pulse', 'formminia-for-elementor'),
					'skin-19' => __('19. Clean Material', 'formminia-for-elementor'),
					'skin-20' => __('20. Social Connect', 'formminia-for-elementor'),
					'skin-21' => __('21. Soft Clay', 'formminia-for-elementor'),
					'skin-22' => __('22. Pop Brutalist', 'formminia-for-elementor'),
					'skin-23' => __('23. Aura Gradient', 'formminia-for-elementor'),
					'skin-24' => __('24. Royal Executive', 'formminia-for-elementor'),
					'skin-25' => __('25. Organic Flow', 'formminia-for-elementor'),
					'skin-26' => __('26. Retro Pixel', 'formminia-for-elementor'),
					'skin-27' => __('27. Dynamic Stream', 'formminia-for-elementor'),
					'skin-28' => __('28. Corporate Network', 'formminia-for-elementor'),
					'skin-29' => __('29. Marketplace Hub', 'formminia-for-elementor'),
					'skin-30' => __('30. Cinema Spotlight', 'formminia-for-elementor'),
					'skin-31' => __('31. Team Collaboration', 'formminia-for-elementor'),
					'skin-32' => __('32. Travel Explorer', 'formminia-for-elementor'),
					'skin-33' => __('33. Frosted Glass', 'formminia-for-elementor'),
					'skin-34' => __('34. Floating Depth', 'formminia-for-elementor'),
					'skin-35' => __('35. Serif Elegance', 'formminia-for-elementor'),
					'skin-36' => __('36. Geometric Pop', 'formminia-for-elementor'),
					'skin-37' => __('37. Gradient Aura', 'formminia-for-elementor'),
					'skin-38' => __('38. Organic Playful', 'formminia-for-elementor'),
					'skin-39' => __('39. Luxury Earth', 'formminia-for-elementor'),
					'skin-40' => __('40. Midnight Mint', 'formminia-for-elementor'),
					'skin-41' => __('41. Playful Modernist', 'formminia-for-elementor'),
					'skin-42' => __('42. Zesty Lemon Squeeze', 'formminia-for-elementor'),
					'skin-43' => __('43. Artisanal Butcher', 'formminia-for-elementor'),
					'skin-44' => __('44. Elite Athlete', 'formminia-for-elementor'),
					'skin-45' => __('45. Fintech Neo', 'formminia-for-elementor'),
					'skin-46' => __('46. Sketchy Peanuts', 'formminia-for-elementor'),
					'skin-47' => __('47. Solar Vault', 'formminia-for-elementor'),
					'skin-48' => __('48. Social Mastodon', 'formminia-for-elementor'),
					'skin-49' => __('49. Prime Butcher', 'formminia-for-elementor'),
					'skin-50' => __('50. Holographic Aurora', 'formminia-for-elementor'),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('None', 'formminia-for-elementor'),
					'floating' => __('Floating Labels', 'formminia-for-elementor'),
					'material' => __('Material Minimal', 'formminia-for-elementor'),
					'compact' => __('Compact Style', 'formminia-for-elementor'),
					'boxed-border' => __('Boxed Borderless', 'formminia-for-elementor'),
					'inset' => __('Inset Shadow Style', 'formminia-for-elementor'),
					'inline' => __('Inline Layout', 'formminia-for-elementor'),
				],
			]
		);

		$this->add_responsive_control(
			'inline_label_width',
			[
				'label' => esc_html__('Label Width', 'formminia-for-elementor'),
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
					'{{WRAPPER}} .formminia-layout-inline .formminia-form-group label' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_field_width',
			[
				'label' => esc_html__('Field Width', 'formminia-for-elementor'),
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
					'{{WRAPPER}} .formminia-layout-inline .formminia-input-wrap' => 'flex: 1 1 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'inline_gap',
			[
				'label' => esc_html__('Gap Between Label & Field', 'formminia-for-elementor'),
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
					'{{WRAPPER}} .formminia-layout-inline .formminia-form-group' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => 'inline',
				],
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' => esc_html__('Columns', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __('1 Column', 'formminia-for-elementor'),
					'2' => __('2 Columns', 'formminia-for-elementor'),
					'3' => __('3 Columns', 'formminia-for-elementor'),
					'4' => __('4 Columns', 'formminia-for-elementor'),
					'5' => __('5 Columns', 'formminia-for-elementor'),
					'6' => __('6 Columns', 'formminia-for-elementor'),
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-fields-wrapper' => '--formminia-columns: {{VALUE}};',
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
				'label' => esc_html__('Fields', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' => esc_html__('Show Labels', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' => esc_html__('Show Placeholders', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_icons',
			[
				'label' => esc_html__('Show Icons', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
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
					'label' => sprintf(esc_html__('Show %s Field', 'formminia-for-elementor'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
					'label_off' => esc_html__('No', 'formminia-for-elementor'),
					'return_value' => 'yes',
					'default' => $default,
				]
			);

			$this->add_control(
				"required_{$field}",
				[
					/* translators: %s: the form field name (name, email, phone, website, subject, or message). */
					'label' => sprintf(esc_html__('%s Required', 'formminia-for-elementor'), ucfirst($field)),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
					'label_off' => esc_html__('No', 'formminia-for-elementor'),
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
				'label' => esc_html__('Show GDPR Consent', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
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
				'label' => esc_html__('Show Captcha', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('See captcha configuration in FormMinia for Elementor settings.', 'formminia-for-elementor'),
			]
		);

		$this->add_control(
			'enable_honeypot',
			[
				'label' => esc_html__('Enable Honeypot', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('A hidden field to catch spam bots.', 'formminia-for-elementor'),
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
				'label' => esc_html__('Labels', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'label_name',
			[
				'label' => esc_html__('Name Label', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_name',
			[
				'label' => esc_html__('Name Placeholder', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your name', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_email',
			[
				'label' => esc_html__('Email Label', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_email',
			[
				'label' => esc_html__('Email Placeholder', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your email', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_email' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_phone',
			[
				'label' => esc_html__('Phone Label', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_phone',
			[
				'label' => esc_html__('Phone Placeholder', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter your phone number', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_phone' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_website',
			[
				'label' => esc_html__('Website Label', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_website',
			[
				'label' => esc_html__('Website Placeholder', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Your website URL', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_website' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_subject',
			[
				'label' => esc_html__('Subject Label', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_subject',
			[
				'label' => esc_html__('Subject Placeholder', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Enter subject', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_subject' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_message',
			[
				'label' => esc_html__('Message Label', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_message' => 'yes',
				],
			]
		);

		$this->add_control(
			'placeholder_message',
			[
				'label' => esc_html__('Message Placeholder', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Write your message here...', 'formminia-for-elementor'),
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
				'label' => esc_html__('GDPR Label', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('GDPR Consent', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_control(
			'gdpr_text',
			[
				'label' => esc_html__('GDPR Text', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('I consent to having this website store my submitted information so they can respond to my inquiry.', 'formminia-for-elementor'),
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
				'label' => esc_html__('Messages', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => esc_html__('Success Message', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Thank you! Your message has been sent successfully.', 'formminia-for-elementor'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__('Error Message', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Oops! Something went wrong. Please try again.', 'formminia-for-elementor'),
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
				'label' => esc_html__('Validation Messages', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_required_msg',
			[
				'label' => esc_html__('Name Required', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name is required', 'formminia-for-elementor'),
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
				'label' => esc_html__('Email Required', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is required', 'formminia-for-elementor'),
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
				'label' => esc_html__('Email Invalid', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email is invalid', 'formminia-for-elementor'),
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
				'label' => esc_html__('Phone Required', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Phone number is required', 'formminia-for-elementor'),
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
				'label' => esc_html__('Phone Invalid', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid phone number', 'formminia-for-elementor'),
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
				'label' => esc_html__('Website Required', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website URL is required', 'formminia-for-elementor'),
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
				'label' => esc_html__('Website Invalid', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Please enter a valid URL', 'formminia-for-elementor'),
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
				'label' => esc_html__('Subject Required', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Subject is required', 'formminia-for-elementor'),
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
				'label' => esc_html__('Message Required', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Message is required', 'formminia-for-elementor'),
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
				'label' => esc_html__('GDPR Required', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('You must agree to the terms', 'formminia-for-elementor'),
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
				'label' => esc_html__('Sending Text', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Sending...', 'formminia-for-elementor'),
				'label_block' => true,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'submit_btn_text',
			[
				'label' => esc_html__('Submit Button Text', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'formminia-for-elementor'),
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
				'label' => esc_html__('Icons', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_location',
			[
				'label' => esc_html__('Location', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'label',
				'options' => [
					'label' => [
						'title' => esc_html__('Label', 'formminia-for-elementor'),
						'icon' => 'eicon-ellipsis-h',

					],
					'input' => [
						'title' => esc_html__('Input', 'formminia-for-elementor'),
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
				'label' => esc_html__('Position', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'before' => [
						'title' => esc_html__('Before Text', 'formminia-for-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => esc_html__('After Text', 'formminia-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'before',
			]
		);

		$this->add_control(
			'show_textarea_icons',
			[
				'label' => esc_html__('Message Icon', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
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
				'label' => esc_html__('GDPR Icon', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
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
				'label' => esc_html__('Icon Assignment', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$icons = [
			'name' => [
				'label' => esc_html__('Name Icon', 'formminia-for-elementor'),
				'default' => 'fas fa-user',
			],
			'email' => [
				'label' => esc_html__('Email Icon', 'formminia-for-elementor'),
				'default' => 'fas fa-envelope',
			],
			'phone' => [
				'label' => esc_html__('Phone Icon', 'formminia-for-elementor'),
				'default' => 'fas fa-phone',
			],
			'website' => [
				'label' => esc_html__('Website Icon', 'formminia-for-elementor'),
				'default' => 'fas fa-globe',
			],
			'subject' => [
				'label' => esc_html__('Subject Icon', 'formminia-for-elementor'),
				'default' => 'fas fa-tag',
			],
			'message' => [
				'label' => esc_html__('Message Icon', 'formminia-for-elementor'),
				'default' => 'fas fa-comment',
			],
			'gdpr' => [
				'label' => esc_html__('GDPR Icon', 'formminia-for-elementor'),
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
				'label' => esc_html__('Submit Button', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Send Message', 'formminia-for-elementor'),
			]
		);

		$this->add_control(
			'button_width',
			[
				'label' => esc_html__('Button Width', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__('Auto', 'formminia-for-elementor'),
					'full' => esc_html__('Full Width', 'formminia-for-elementor'),
				],
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Button Alignment', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'formminia-for-elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'formminia-for-elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'formminia-for-elementor'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'condition' => [
					'button_width!' => 'full',
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-actions' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__('Button Icon', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_icon_position',
			[
				'label' => esc_html__('Icon Position', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => esc_html__('Before Text', 'formminia-for-elementor'),
					'right' => esc_html__('After Text', 'formminia-for-elementor'),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'loader_style',
			[
				'label' => esc_html__('Loader Style', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'spinner',
				'options' => [
					'spinner' => esc_html__('Premium Spinner', 'formminia-for-elementor'),
					'dots' => esc_html__('Pulsing Dots', 'formminia-for-elementor'),
					'bars' => esc_html__('Bouncing Bars', 'formminia-for-elementor'),
					'dual-ring' => esc_html__('Dual Ring', 'formminia-for-elementor'),
					'grow' => esc_html__('Growing Circles', 'formminia-for-elementor'),
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
				'label' => esc_html__('Advanced Settings', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Form HTML ID', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Unique ID for the form element (optional).', 'formminia-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__('Custom CSS Classes', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_email_settings',
			[
				'label' => esc_html__('Email Settings', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mail_to',
			[
				'label' => esc_html__('Recipient Email', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional recipient email address. If empty, global settings will be used.', 'formminia-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_cc',
			[
				'label' => esc_html__('CC Email', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional CC email addresses, separate with commas.', 'formminia-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'mail_bcc',
			[
				'label' => esc_html__('BCC Email', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__('Optional BCC email addresses, separate with commas.', 'formminia-for-elementor'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'heading_autoresponder_settings',
			[
				'label' => esc_html__('Auto-Responder', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'enable_autoresponder',
			[
				'label' => esc_html__('Enable Auto-Responder', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'autoresponder_subject',
			[
				'label' => esc_html__('Subject', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Thank you for contacting us!', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoresponder_message',
			[
				'label' => esc_html__('Message', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Hi {name}, thank you for your message. We will get back to you soon.', 'formminia-for-elementor'),
				'description' => esc_html__('Available tags: {name}, {email}, {subject}', 'formminia-for-elementor'),
				'label_block' => true,
				'condition' => [
					'enable_autoresponder' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_redirect_settings',
			[
				'label' => esc_html__('Redirect After Submit', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'redirect_on_success',
			[
				'label' => esc_html__('Enable Redirect', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'formminia-for-elementor'),
				'label_off' => esc_html__('No', 'formminia-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'success_redirect_url',
			[
				'label' => esc_html__('Redirect URL', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'formminia-for-elementor'),
				'condition' => [
					'redirect_on_success' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
}