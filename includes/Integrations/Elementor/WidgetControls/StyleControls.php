<?php

namespace MTEF\Integrations\Elementor\WidgetControls;

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
				'label' => esc_html__('Field Group', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'group_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'group_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'group_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-group' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'group_border',
				'selector' => '{{WRAPPER}} .mtef-form-group',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'group_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-form-group',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'group_background',
				'selector' => '{{WRAPPER}} .mtef-form-group',
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
				'label' => esc_html__('Form Container', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'form_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'field_row_gap',
			[
				'label' => esc_html__('Row Gap', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-inner, {{WRAPPER}} .mtef-fields-wrapper' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_column_gap',
			[
				'label' => esc_html__('Column Gap', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-fields-wrapper' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'selector' => '{{WRAPPER}} .mtef-form-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-form-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'form_background',
				'selector' => '{{WRAPPER}} .mtef-form-wrapper',
			]
		);

		$this->add_control(
			'accent_color',
			[
				'label' => esc_html__('Accent Color (Native Fields)', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__('Styles native checkboxes, radio buttons, and range sliders.', 'mt-elementor-forms'),
				'selectors' => [
					'{{WRAPPER}} .mtef-form-wrapper' => 'accent-color: {{VALUE}};',
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
				'label' => esc_html__('Form Title', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'form_title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .mtef-form-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .mtef-form-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .mtef-form-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-form-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_background',
				'selector' => '{{WRAPPER}} .mtef-form-title',
			]
		);

		$this->add_control(
			'title_align',
			[
				'label' => esc_html__('Alignment', 'mt-elementor-forms'),
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
				'selectors' => [
					'{{WRAPPER}} .mtef-form-title' => 'text-align: {{VALUE}};',
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
				'label' => esc_html__('Fields Wrapper', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-fields-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-fields-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_wrapper_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-fields-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'fields_wrapper_border',
				'selector' => '{{WRAPPER}} .mtef-fields-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'fields_wrapper_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-fields-wrapper',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'fields_wrapper_background',
				'selector' => '{{WRAPPER}} .mtef-fields-wrapper',
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
				'label' => esc_html__('Labels', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_labels' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'label_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-group label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-group label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'label_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-form-group label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'label_border',
				'selector' => '{{WRAPPER}} .mtef-form-group label',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'label_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-form-group label',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .mtef-form-group label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__('Label Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-form-group label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'label_background',
				'selector' => '{{WRAPPER}} .mtef-form-group label',
			]
		);

		// Field Icons Controls
		$this->add_control(
			'heading_field_icons',
			[
				'label' => esc_html__('Field Icons', 'mt-elementor-forms'),
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
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .mtef-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mtef-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-icon-left .mtef-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mtef-icon-right .mtef-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .mtef-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__('Background Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-icon' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .mtef-icon',
				'condition' => [
					'show_icons' => 'yes',
				],
			]
		);

		// Inline Layout Controls
		$this->add_control(
			'heading_inline_layout',
			[
				'label' => esc_html__('Inline Layout', 'mt-elementor-forms'),
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
				'label' => esc_html__('Fields Global Settings', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_input_style',
			[
				'label' => esc_html__('Input Options', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'input_style',
			[
				'label' => esc_html__('Input Style', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default', 'mt-elementor-forms'),
					'underline' => __('Underline Only', 'mt-elementor-forms'),
					'rounded' => __('Rounded', 'mt-elementor-forms'),
					'pill' => __('Pill Shape', 'mt-elementor-forms'),
					'shadow' => __('Shadow', 'mt-elementor-forms'),
				],
				'description' => esc_html__('Sets the visual style for input fields.', 'mt-elementor-forms'),
			]
		);

		$this->add_control(
			'textarea_rows',
			[
				'label' => esc_html__('Textarea Rows', 'mt-elementor-forms'),
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
				'label' => esc_html__('Normal', 'mt-elementor-forms'),
			]
		);

		$this->add_control(
			'input_bg_color',
			[
				'label' => esc_html__('Background Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => esc_html__('Text Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => esc_html__('Focus', 'mt-elementor-forms'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_focus_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-input:focus, {{WRAPPER}} .mtef-textarea:focus',
			]
		);

		$this->add_responsive_control(
			'input_focus_scale',
			[
				'label' => esc_html__('Focus Scale', 'mt-elementor-forms'),
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
					'{{WRAPPER}} .mtef-input:focus, {{WRAPPER}} .mtef-textarea:focus' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'input_focus_border_color',
			[
				'label' => esc_html__('Focus Border Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-input:focus, {{WRAPPER}} .mtef-textarea:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_focus_bg_color',
			[
				'label' => esc_html__('Background Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-input:focus, {{WRAPPER}} .mtef-textarea:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_focus_text_color',
			[
				'label' => esc_html__('Text Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-input:focus, {{WRAPPER}} .mtef-textarea:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_input_advanced',
			[
				'label' => esc_html__('Advanced Style', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'input_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'input_border',
				'selector' => '{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'selector' => '{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea',
			]
		);

		$this->add_control(
			'placeholder_color',
			[
				'label' => esc_html__('Placeholder Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-input::placeholder, {{WRAPPER}} .mtef-textarea::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'input_background',
				'selector' => '{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea',
			]
		);

		$this->add_control(
			'input_transition',
			[
				'label' => esc_html__('Transition Duration', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-input, {{WRAPPER}} .mtef-textarea' => 'transition: all {{SIZE}}s ease-in-out;',
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
				'label' => esc_html__('Submit Button', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'mt-elementor-forms'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'button_text_shadow',
				'selector' => '{{WRAPPER}} .mtef-submit-btn',
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-submit-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_background',
				'selector' => '{{WRAPPER}} .mtef-submit-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'mt-elementor-forms'),
			]
		);

		$this->add_responsive_control(
			'button_hover_scale',
			[
				'label' => esc_html__('Hover Scale', 'mt-elementor-forms'),
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
					'{{WRAPPER}} .mtef-submit-btn:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_responsive_control(
			'button_hover_translate',
			[
				'label' => esc_html__('Hover Offset (Y)', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-submit-btn:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'button_hover_scale[size]' => '', // Only show if scale is not set to avoid conflicts, or use a group transform
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-submit-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-submit-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_background',
				'selector' => '{{WRAPPER}} .mtef-submit-btn:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_button_advanced',
			[
				'label' => esc_html__('Advanced Style', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-submit-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .mtef-submit-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-submit-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .mtef-submit-btn',
			]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => esc_html__('Icon Size', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mtef-btn-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mtef-btn-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .mtef-btn-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'label' => esc_html__('Icon Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .mtef-btn-icon svg' => 'fill: {{VALUE}};',
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
				'label' => esc_html__('Messages', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'message_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-response-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'message_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-response-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'message_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-response-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'message_typography',
				'selector' => '{{WRAPPER}} .mtef-response-message',
			]
		);

		$this->add_control(
			'success_color',
			[
				'label' => esc_html__('Success Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#4caf50',
				'selectors' => [
					'{{WRAPPER}} .mtef-response-message.success' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'error_color',
			[
				'label' => esc_html__('Error Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f44336',
				'selectors' => [
					'{{WRAPPER}} .mtef-response-message.error' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'message_background',
				'selector' => '{{WRAPPER}} .mtef-response-message',
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
				'label' => esc_html__('Name Field', 'mt-elementor-forms'),
				'selector' => '.mtef-field-name .mtef-input',
				'wrapper' => '.mtef-form-group.mtef-field-name',
				'field_key' => 'name',
			],
			'email' => [
				'label' => esc_html__('Email Field', 'mt-elementor-forms'),
				'selector' => '.mtef-field-email .mtef-input',
				'wrapper' => '.mtef-form-group.mtef-field-email',
				'field_key' => 'email',
			],
			'phone' => [
				'label' => esc_html__('Phone Field', 'mt-elementor-forms'),
				'selector' => '.mtef-field-tel .mtef-input',
				'wrapper' => '.mtef-form-group.mtef-field-tel',
				'field_key' => 'phone',
			],
			'website' => [
				'label' => esc_html__('Website Field', 'mt-elementor-forms'),
				'selector' => '.mtef-field-url .mtef-input',
				'wrapper' => '.mtef-form-group.mtef-field-url',
				'field_key' => 'website',
			],
			'subject' => [
				'label' => esc_html__('Subject Field', 'mt-elementor-forms'),
				'selector' => '.mtef-field-subject .mtef-input',
				'wrapper' => '.mtef-form-group.mtef-field-subject',
				'field_key' => 'subject',
			],
			'message' => [
				'label' => esc_html__('Message Field', 'mt-elementor-forms'),
				'selector' => '.mtef-field-textarea .mtef-textarea',
				'wrapper' => '.mtef-form-group.mtef-field-textarea',
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
					'label' => esc_html__('Column Width', 'mt-elementor-forms'),
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
				'label' => esc_html__('Normal', 'mt-elementor-forms'),
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
				'label' => esc_html__('Background Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}" => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			"{$id}_text_color",
			[
				'label' => esc_html__('Text Color', 'mt-elementor-forms'),
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
				'label' => esc_html__('Focus', 'mt-elementor-forms'),
			]
		);

		$this->add_control(
			"{$id}_focus_border_color",
			[
				'label' => esc_html__('Border Color', 'mt-elementor-forms'),
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
				'label' => esc_html__('Background Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					"{{WRAPPER}} {$selector}:focus" => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			"{$id}_focus_text_color",
			[
				'label' => esc_html__('Text Color', 'mt-elementor-forms'),
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
				'label' => esc_html__('Advanced Style', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			"{$id}_margin",
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
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
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
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
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
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
				'label' => esc_html__('Placeholder Color', 'mt-elementor-forms'),
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
				'label' => esc_html__('GDPR Consent', 'mt-elementor-forms'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_gdpr' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_margin',
			[
				'label' => esc_html__('Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-gdpr-consent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_padding',
			[
				'label' => esc_html__('Padding', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-gdpr-consent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_border_radius',
			[
				'label' => esc_html__('Border Radius', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-gdpr-consent' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'gdpr_border',
				'selector' => '{{WRAPPER}} .mtef-gdpr-consent',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'gdpr_box_shadow',
				'selector' => '{{WRAPPER}} .mtef-gdpr-consent',
			]
		);

		$this->add_responsive_control(
			'gdpr_label_margin',
			[
				'label' => esc_html__('Label Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-gdpr-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_checkbox_margin',
			[
				'label' => esc_html__('Checkbox Margin', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .mtef-checkbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'gdpr_label_typography',
				'selector' => '{{WRAPPER}} .mtef-gdpr-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'gdpr_typography',
				'selector' => '{{WRAPPER}} .mtef-checkbox-text',
			]
		);

		$this->add_control(
			'gdpr_label_color',
			[
				'label' => esc_html__('Label Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-gdpr-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'gdpr_text_color',
			[
				'label' => esc_html__('Text Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-checkbox-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'gdpr_link_color',
			[
				'label' => esc_html__('Link Color', 'mt-elementor-forms'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mtef-checkbox-text a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'gdpr_checkbox_width',
			[
				'label' => esc_html__('Checkbox Label Width', 'mt-elementor-forms'),
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
					'{{WRAPPER}} .mtef-layout-inline .mtef-gdpr-group .mtef-checkbox-label' => 'width: {{SIZE}}{{UNIT}};'
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
				'selector' => '{{WRAPPER}} .mtef-gdpr-consent',
			]
		);

		$this->end_controls_section();
	}
}