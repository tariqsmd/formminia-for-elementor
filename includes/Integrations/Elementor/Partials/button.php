<?php
/**
 * Button Partial
 *
 * @var array $args Partial arguments
 */

if (!defined('ABSPATH')) {
    exit;
}

// View template: variables below are injected by the widget renderer.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$settings = $args['settings'];

$btn_classes = array('mtef-submit-btn');

if ($settings['button_width'] === 'full') {
    $btn_classes[] = 'mtef-button-full-width'; // Note: wrapper already has mtef-button-full
}

$button_align = isset($settings['button_align']) ? $settings['button_align'] : 'left';
$align_class = 'mtef-button-align-' . $button_align;
$btn_icon_data = isset($settings['button_icon']) ? $settings['button_icon'] : [];
$has_icon = ! empty($btn_icon_data['value']);
$icon_left = ($has_icon && $settings['button_icon_position'] === 'left');
$icon_right = ($has_icon && $settings['button_icon_position'] === 'right');
?>

<div class="mtef-form-actions <?php echo esc_attr($align_class); ?>">
    <?php 
    $loader_style = isset($settings['loader_style']) ? $settings['loader_style'] : 'spinner';
    $btn_classes[] = 'mtef-loader-' . $loader_style;
    ?>
    <button type="submit" class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>" data-loader="<?php echo esc_attr($loader_style); ?>">
        <?php if ($icon_left && $has_icon): ?>
            <span class="mtef-btn-icon mtef-btn-icon-left">
                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php endif; ?>

        <span class="mtef-btn-text">
            <?php echo esc_html($settings['button_text']); ?>
        </span>

        <?php if ($icon_right && $has_icon): ?>
            <span class="mtef-btn-icon mtef-btn-icon-right">
                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php endif; ?>

        <div class="mtef-loader-container">
            <span class="mtef-loader-element"></span>
            <span class="mtef-loader-element"></span>
            <span class="mtef-loader-element"></span>
        </div>
    </button>
</div>