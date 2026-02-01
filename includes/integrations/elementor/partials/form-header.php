<?php
/**
 * Form Header Partial
 *
 * @var array $args Partial arguments
 */

if (!defined('ABSPATH')) {
	exit;
}

$settings = $args['settings'];
$widget_id = $args['widget_id'];

// Classes
$container_classes = array(
	'mtforms-form-wrapper',
	'mtforms-skin-' . sanitize_html_class($settings['skin']),
	'mtforms-layout-' . sanitize_html_class($settings['layout']),
	//	'mtforms-input-style-' . sanitize_html_class( $settings['input_style'] ),
//	'mtforms-button-style-' . sanitize_html_class( $settings['button_style'] ),
);

if (isset($settings['animation']) && !empty($settings['animation']) && $settings['animation'] !== 'none') {
	$container_classes[] = 'mtforms-animation-' . sanitize_html_class($settings['animation']);
}

if ($settings['show_icons'] === 'yes') {
	$container_classes[] = 'mtforms-with-icons';
	$container_classes[] = 'mtforms-icon-' . sanitize_html_class($settings['icon_position'] ?? 'left');
}

if ($settings['show_labels'] !== 'yes') {
	$container_classes[] = 'mtforms-no-labels';
}

if (!empty($settings['custom_css_class'])) {
	$container_classes[] = sanitize_html_class($settings['custom_css_class']);
}

if ($settings['button_width'] === 'full') {
	$container_classes[] = 'mtforms-button-full';
}

//$container_classes[] = 'mtforms-align-' . sanitize_html_class( $settings['form_alignment'] );
$container_classes[] = 'mtforms-input-size-' . sanitize_html_class($settings['input_size']);

$wrapper_id = "mtforms-wrapper-$widget_id";
$form_id = "mtforms-form-$widget_id";

if (!empty($settings['form_id'])) {
	$wrapper_id = 'mtforms-wrapper-' . $settings['form_id'];
	$form_id = 'mtforms-form-' . $settings['form_id'];
}
?>
<div id="<?php echo esc_attr($wrapper_id); ?>" class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
	<form id="<?php echo esc_attr($form_id); ?>" class="mtforms-form" action="" method="POST" novalidate>
		<div class="mtforms-form-inner">