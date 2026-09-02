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

$btn_classes = array('mtforms-submit-btn');

if ($settings['button_width'] === 'full') {
    $btn_classes[] = 'mtforms-button-full-width'; // Note: wrapper already has mtforms-button-full
}

$button_align = isset($settings['button_align']) ? $settings['button_align'] : 'left';
$align_class = 'mtforms-button-align-' . $button_align;
$btn_icon_data = isset($settings['button_icon']) ? $settings['button_icon'] : [];
$has_icon = ! empty($btn_icon_data['value']);
$icon_left = ($has_icon && $settings['button_icon_position'] === 'left');
$icon_right = ($has_icon && $settings['button_icon_position'] === 'right');
?>

<div class="mtforms-form-actions <?php echo esc_attr($align_class); ?>">
    <?php 
    $loader_style = isset($settings['loader_style']) ? $settings['loader_style'] : 'spinner';
    $btn_classes[] = 'mtforms-loader-' . $loader_style;
    ?>
    <button type="submit" class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>" data-loader="<?php echo esc_attr($loader_style); ?>">
        <?php if ($icon_left && $has_icon): ?>
            <span class="mtforms-btn-icon mtforms-btn-icon-left">
                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php endif; ?>

        <span class="mtforms-btn-text">
            <?php echo esc_html($settings['button_text']); ?>
        </span>

        <?php if ($icon_right && $has_icon): ?>
            <span class="mtforms-btn-icon mtforms-btn-icon-right">
                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php endif; ?>

        <div class="mtforms-loader-container">
            <span class="mtforms-loader-element"></span>
            <span class="mtforms-loader-element"></span>
            <span class="mtforms-loader-element"></span>
        </div>
    </button>
</div>