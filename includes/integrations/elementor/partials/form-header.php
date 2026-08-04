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
	empty($settings['skin']) ? 'mtforms-skin-' : 'mtforms-' . sanitize_html_class($settings['skin']),
	'mtforms-layout-' . sanitize_html_class($settings['layout']),
	'mtforms-input-style-' . sanitize_html_class($settings['input_style']),
	'mtforms-button-style-' . sanitize_html_class($settings['button_style'] ?? 'default'),
);

if (isset($settings['animation']) && !empty($settings['animation']) && $settings['animation'] !== 'none') {
	$container_classes[] = 'mtforms-animation-' . sanitize_html_class($settings['animation']);
}

if ($settings['icon_location'] === 'label') {
	$container_classes[] = 'mtforms-with-icons';
	$container_classes[] = 'mtforms-label-icon-' . sanitize_html_class($settings['icon_position'] ?? 'before');
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

$wrapper_id = "mtforms-wrapper-$widget_id";
$form_id = "mtforms-form-$widget_id";

if (!empty($settings['form_id'])) {
	$wrapper_id = 'mtforms-wrapper-' . $settings['form_id'];
	$form_id = 'mtforms-form-' . $settings['form_id'];
}
?>
<div id="<?php echo esc_attr($wrapper_id); ?>" class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
	<form id="<?php echo esc_attr($form_id); ?>" class="mtforms-form" action="" method="POST" novalidate 
		<?php if ($settings['redirect_on_success'] === 'yes' && !empty($settings['success_redirect_url']['url'])): ?>data-redirect="<?php echo esc_url($settings['success_redirect_url']['url']); ?>" <?php endif; ?>>
		<?php if ($settings['enable_honeypot'] === 'yes'): ?>
			<div style="display:none !important;">
				<input type="text" name="mtforms_hp" tabindex="-1" autocomplete="off">
			</div>
		<?php endif; ?>
		<?php if (!empty($settings['mail_to'])): ?>
			<input type="hidden" name="mtforms_to" value="<?php echo esc_attr($settings['mail_to']); ?>">
		<?php endif; ?>
		<?php if (!empty($settings['mail_cc'])): ?>
			<input type="hidden" name="mtforms_cc" value="<?php echo esc_attr($settings['mail_cc']); ?>">
		<?php endif; ?>
		<?php if (!empty($settings['mail_bcc'])): ?>
			<input type="hidden" name="mtforms_bcc" value="<?php echo esc_attr($settings['mail_bcc']); ?>">
		<?php endif; ?>
		<?php if (!empty($args['required_fields'])): ?>
			<input type="hidden" name="mtforms_required_fields" value="<?php echo esc_attr(implode(',', $args['required_fields'])); ?>">
		<?php endif; ?>
		<div class="mtforms-form-inner">