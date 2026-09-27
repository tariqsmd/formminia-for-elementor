<?php

namespace FORMMINIA\Integrations\Elementor\WidgetControls;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait StyleControls {

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
				'label' => esc_html__('Field Group', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'group_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'group_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'group_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'group_border',
				'selector' => '{{WRAPPER}} .formminia-form-group',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'group_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-form-group',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'group_background',
				'selector' => '{{WRAPPER}} .formminia-form-group',
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
				'label' => esc_html__('Form Container', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'form_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'field_row_gap',
			[
				'label' => esc_html__('Row Gap', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-inner, {{WRAPPER}} .formminia-fields-wrapper' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_column_gap',
			[
				'label' => esc_html__('Column Gap', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-fields-wrapper' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'selector' => '{{WRAPPER}} .formminia-form-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-form-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'form_background',
				'selector' => '{{WRAPPER}} .formminia-form-wrapper',
			]
		);

		$this->add_control(
			'accent_color',
			[
				'label' => esc_html__('Accent Color (Native Fields)', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__('Styles native checkboxes, radio buttons, and range sliders.', 'formminia-for-elementor'),
				'selectors' => [
					'{{WRAPPER}} .formminia-form-wrapper' => 'accent-color: {{VALUE}};',
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
				'label' => esc_html__('Form Title', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'form_title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .formminia-form-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .formminia-form-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .formminia-form-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-form-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_background',
				'selector' => '{{WRAPPER}} .formminia-form-title',
			]
		);

		$this->add_control(
			'title_align',
			[
				'label' => esc_html__('Alignment', 'formminia-for-elementor'),
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
				'selectors' => [
					'{{WRAPPER}} .formminia-form-title' => 'text-align: {{VALUE}};',
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
				'label' => esc_html__('Fields Wrapper', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-fields-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-fields-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-fields-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'fields_wrapper_border',
				'selector' => '{{WRAPPER}} .formminia-fields-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fields_wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-fields-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'fields_wrapper_background',
				'selector' => '{{WRAPPER}} .formminia-fields-wrapper',
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
				'label' => esc_html__('Labels', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_labels' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'label_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-group label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-group label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-form-group label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'label_border',
				'selector' => '{{WRAPPER}} .formminia-form-group label',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'label_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-form-group label',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .formminia-form-group label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__('Label Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-form-group label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'label_background',
				'selector' => '{{WRAPPER}} .formminia-form-group label',
			]
		);

		// Field Icons Controls
		$this->add_control(
			'heading_field_icons',
			[
				'label' => esc_html__('Field Icons', 'formminia-for-elementor'),
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
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .formminia-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .formminia-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-icon-left .formminia-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .formminia-icon-right .formminia-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .formminia-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__('Background Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-icon' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .formminia-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		// Inline Layout Controls
		$this->add_control(
			'heading_inline_layout',
			[
				'label' => esc_html__('Inline Layout', 'formminia-for-elementor'),
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
				'label' => esc_html__('Fields Global Settings', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_input_style',
			[
				'label' => esc_html__('Input Options', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'input_style',
			[
				'label' => esc_html__('Input Style', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default', 'formminia-for-elementor'),
					'underline' => __('Underline Only', 'formminia-for-elementor'),
					'rounded' => __('Rounded', 'formminia-for-elementor'),
					'pill' => __('Pill Shape', 'formminia-for-elementor'),
					'shadow' => __('Shadow', 'formminia-for-elementor'),
				],
				'description' => esc_html__('Sets the visual style for input fields.', 'formminia-for-elementor'),
			]
		);

		$this->add_control(
			'textarea_rows',
			[
				'label' => esc_html__('Textarea Rows', 'formminia-for-elementor'),
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
				'label' => esc_html__('Normal', 'formminia-for-elementor'),
			]
		);

		$this->add_control(
			'input_bg_color',
			[
				'label' => esc_html__('Background Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => esc_html__('Text Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => esc_html__('Focus', 'formminia-for-elementor'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_focus_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-input:focus, {{WRAPPER}} .formminia-textarea:focus',
			]
		);

		$this->add_responsive_control(
			'input_focus_scale',
			[
				'label' => esc_html__('Focus Scale', 'formminia-for-elementor'),
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
					'{{WRAPPER}} .formminia-input:focus, {{WRAPPER}} .formminia-textarea:focus' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'input_focus_border_color',
			[
				'label' => esc_html__('Focus Border Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-input:focus, {{WRAPPER}} .formminia-textarea:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_focus_bg_color',
			[
				'label' => esc_html__('Background Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-input:focus, {{WRAPPER}} .formminia-textarea:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_focus_text_color',
			[
				'label' => esc_html__('Text Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-input:focus, {{WRAPPER}} .formminia-textarea:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_input_advanced',
			[
				'label' => esc_html__('Advanced Style', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'input_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'input_border',
				'selector' => '{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'selector' => '{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea',
			]
		);

		$this->add_control(
			'placeholder_color',
			[
				'label' => esc_html__('Placeholder Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-input::placeholder, {{WRAPPER}} .formminia-textarea::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'input_background',
				'selector' => '{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea',
			]
		);

		$this->add_control(
			'input_transition',
			[
				'label' => esc_html__('Transition Duration', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-input, {{WRAPPER}} .formminia-textarea' => 'transition: all {{SIZE}}s ease-in-out;',
				],
			]
		);

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
				'label' => esc_html__('Submit Button', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'button_text_shadow',
				'selector' => '{{WRAPPER}} .formminia-submit-btn',
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-submit-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'selector' => '{{WRAPPER}} .formminia-submit-btn',
			]
		);

		$this->add_control(
			'heading_button_advanced',
			[
				'label' => esc_html__('Advanced Style', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-submit-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .formminia-submit-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-submit-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .formminia-submit-btn',
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => esc_html__('Icon Size', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .formminia-btn-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-btn-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .formminia-btn-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label' => esc_html__('Icon Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .formminia-btn-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'heading_button_hover',
			[
				'label' => esc_html__('Hover', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_hover_scale',
			[
				'label' => esc_html__('Hover Scale', 'formminia-for-elementor'),
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
					'{{WRAPPER}} .formminia-submit-btn:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_responsive_control(
			'button_hover_translate',
			[
				'label' => esc_html__('Hover Offset (Y)', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .formminia-submit-btn:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'button_hover_scale[size]' => '', // Only show if scale is not set to avoid conflicts, or use a group transform
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .formminia-submit-btn:hover',
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-submit-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_background',
				'selector' => '{{WRAPPER}} .formminia-submit-btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-submit-btn:hover',
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

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
				'label' => esc_html__('Messages', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'message_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-response-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'message_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-response-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'message_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-response-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'message_typography',
				'selector' => '{{WRAPPER}} .formminia-response-message',
			]
		);

		$this->add_control(
			'success_color',
			[
				'label' => esc_html__('Success Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#4caf50',
				'selectors' => [
					'{{WRAPPER}} .formminia-response-message.success' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'error_color',
			[
				'label' => esc_html__('Error Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f44336',
				'selectors' => [
					'{{WRAPPER}} .formminia-response-message.error' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'message_background',
				'selector' => '{{WRAPPER}} .formminia-response-message',
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
				'label' => esc_html__('Name Field', 'formminia-for-elementor'),
				'selector' => '.formminia-field-name .formminia-input',
				'wrapper' => '.formminia-form-group.formminia-field-name',
				'field_key' => 'name',
			],
			'email' => [
				'label' => esc_html__('Email Field', 'formminia-for-elementor'),
				'selector' => '.formminia-field-email .formminia-input',
				'wrapper' => '.formminia-form-group.formminia-field-email',
				'field_key' => 'email',
			],
			'phone' => [
				'label' => esc_html__('Phone Field', 'formminia-for-elementor'),
				'selector' => '.formminia-field-tel .formminia-input',
				'wrapper' => '.formminia-form-group.formminia-field-tel',
				'field_key' => 'phone',
			],
			'website' => [
				'label' => esc_html__('Website Field', 'formminia-for-elementor'),
				'selector' => '.formminia-field-url .formminia-input',
				'wrapper' => '.formminia-form-group.formminia-field-url',
				'field_key' => 'website',
			],
			'subject' => [
				'label' => esc_html__('Subject Field', 'formminia-for-elementor'),
				'selector' => '.formminia-field-subject .formminia-input',
				'wrapper' => '.formminia-form-group.formminia-field-subject',
				'field_key' => 'subject',
			],
			'message' => [
				'label' => esc_html__('Message Field', 'formminia-for-elementor'),
				'selector' => '.formminia-field-textarea .formminia-textarea',
				'wrapper' => '.formminia-form-group.formminia-field-textarea',
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
					'label' => esc_html__('Column Width', 'formminia-for-elementor'),
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
				'label' => esc_html__('Normal', 'formminia-for-elementor'),
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
				'label' => esc_html__('Background Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}" => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			"{$id}_text_color",
			[
				'label' => esc_html__('Text Color', 'formminia-for-elementor'),
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
				'label' => esc_html__('Focus', 'formminia-for-elementor'),
			]
		);

		$this->add_control(
			"{$id}_focus_border_color",
			[
				'label' => esc_html__('Border Color', 'formminia-for-elementor'),
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
				'label' => esc_html__('Background Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}:focus" => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			"{$id}_focus_text_color",
			[
				'label' => esc_html__('Text Color', 'formminia-for-elementor'),
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
				'label' => esc_html__('Advanced Style', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			"{$id}_margin",
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
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
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
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
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
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
				'label' => esc_html__('Placeholder Color', 'formminia-for-elementor'),
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
				'label' => esc_html__('GDPR Consent', 'formminia-for-elementor'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_margin',
			[
				'label' => esc_html__('Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-gdpr-consent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_padding',
			[
				'label' => esc_html__('Padding', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-gdpr-consent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_border_radius',
			[
				'label' => esc_html__('Border Radius', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-gdpr-consent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'gdpr_border',
				'selector' => '{{WRAPPER}} .formminia-gdpr-consent',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'gdpr_box_shadow',
				'selector' => '{{WRAPPER}} .formminia-gdpr-consent',
			]
		);

		$this->add_responsive_control(
			'gdpr_label_margin',
			[
				'label' => esc_html__('Label Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-gdpr-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_checkbox_margin',
			[
				'label' => esc_html__('Checkbox Margin', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .formminia-checkbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'gdpr_label_typography',
				'selector' => '{{WRAPPER}} .formminia-gdpr-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'gdpr_typography',
				'selector' => '{{WRAPPER}} .formminia-checkbox-text',
			]
		);

		$this->add_control(
			'gdpr_label_color',
			[
				'label' => esc_html__('Label Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-gdpr-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'gdpr_text_color',
			[
				'label' => esc_html__('Text Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-checkbox-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'gdpr_link_color',
			[
				'label' => esc_html__('Link Color', 'formminia-for-elementor'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .formminia-checkbox-text a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_checkbox_width',
			[
				'label' => esc_html__('Checkbox Label Width', 'formminia-for-elementor'),
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
					'{{WRAPPER}} .formminia-layout-inline .formminia-gdpr-group .formminia-checkbox-label' => 'width: {{SIZE}}{{UNIT}};'
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
				'selector' => '{{WRAPPER}} .formminia-gdpr-consent',
			]
		);

		$this->end_controls_section();
	}
}
