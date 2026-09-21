<?php
/**
 * Form Header Partial
 *
 * @var array $args Partial arguments
 */

if (!defined('ABSPATH')) {
	exit;
}

// View template: variables below are injected by the widget renderer.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$settings = $args['settings'];
$widget_id = $args['widget_id'];

// Classes
$skin_class = !empty($settings['skin']) ? 'mtef-' . sanitize_html_class($settings['skin']) : '';
$container_classes = array(
	'mtef-form-wrapper',
	$skin_class,
	'mtef-layout-' . sanitize_html_class($settings['layout']),
	'mtef-input-style-' . sanitize_html_class($settings['input_style']),
	'mtef-button-style-' . sanitize_html_class($settings['button_style'] ?? 'default'),
);

if (isset($settings['animation']) && !empty($settings['animation']) && $settings['animation'] !== 'none') {
	$container_classes[] = 'mtef-animation-' . sanitize_html_class($settings['animation']);
}

if ($settings['icon_location'] === 'label') {
	$container_classes[] = 'mtef-with-icons';
	$container_classes[] = 'mtef-label-icon-' . sanitize_html_class($settings['icon_position'] ?? 'before');
}

if ($settings['show_labels'] !== 'yes') {
	$container_classes[] = 'mtef-no-labels';
}

if (!empty($settings['custom_css_class'])) {
	$container_classes[] = sanitize_html_class($settings['custom_css_class']);
}

if ($settings['button_width'] === 'full') {
	$container_classes[] = 'mtef-button-full';
}

$wrapper_id = "mtef-wrapper-$widget_id";
$form_id = "mtef-form-$widget_id";

if (!empty($settings['form_id'])) {
	$wrapper_id = 'mtef-wrapper-' . $settings['form_id'];
	$form_id = 'mtef-form-' . $settings['form_id'];
}
?>
<div id="<?php echo esc_attr($wrapper_id); ?>" class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
	<form id="<?php echo esc_attr($form_id); ?>" class="mtef-form" action="" method="POST" novalidate 
		<?php if ($settings['redirect_on_success'] === 'yes' && !empty($settings['success_redirect_url']['url'])): ?>data-redirect="<?php echo esc_url($settings['success_redirect_url']['url']); ?>" <?php endif; ?>>
		<?php if ($settings['enable_honeypot'] === 'yes'): ?>
			<div style="display:none !important;" aria-hidden="true">
				<input type="text" name="mtef_hp" tabindex="-1" autocomplete="off">
			</div>
		<?php endif; ?>
		<?php if (!empty($args['required_fields'])): ?>
			<input type="hidden" name="mtef_required_fields" value="<?php echo esc_attr(implode(',', $args['required_fields'])); ?>">
		<?php endif; ?>
		<input type="hidden" name="mtef_form_id" value="<?php echo esc_attr($widget_id); ?>">
		<input type="hidden" name="mtef_post_id" value="<?php echo esc_attr((int) get_the_ID()); ?>">
		<div class="mtef-form-inner">