<?php
/**
 * Button Partial
 *
 * @var array $args Partial arguments
 */

if (!defined('ABSPATH')) {
    exit;
}

$settings = $args['settings'];

$btn_classes = array('mtforms-submit-btn');

if ($settings['button_width'] === 'full') {
    $btn_classes[] = 'mtforms-button-full-width'; // Note: wrapper already has mtforms-button-full
}

$align_class = 'mtforms-button-align-' . $settings['button_align'];
$has_icon = ! empty($settings['button_icon']['value']);
$icon_left = ($has_icon && $settings['button_icon_position'] === 'left');
$icon_right = ($has_icon && $settings['button_icon_position'] === 'right');
?>

<div class="mtforms-form-actions <?php echo esc_attr($align_class); ?>">
    <button type="submit" class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>">
        <?php if ($icon_left): ?>
            <span class="mtforms-btn-icon mtforms-btn-icon-left">
                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php endif; ?>

        <span class="mtforms-btn-text">
            <?php echo esc_html($settings['button_text']); ?>
        </span>

        <?php if ($icon_right): ?>
            <span class="mtforms-btn-icon mtforms-btn-icon-right">
                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php endif; ?>

        <span class="mtforms-spinner"></span>
    </button>
</div>