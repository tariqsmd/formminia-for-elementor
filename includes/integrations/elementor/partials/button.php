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

$align_class = 'mtforms-button-align-' . $settings['button_align'];
$icon_left = ($settings['button_icon'] !== 'none' && $settings['button_icon_position'] === 'left');
$icon_right = ($settings['button_icon'] !== 'none' && $settings['button_icon_position'] === 'right');
?>

<div class="mtforms-form-actions <?php echo esc_attr($align_class); ?>">
    <button type="submit" class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>">
        <?php if ($icon_left): ?>
            <span class="mtforms-btn-icon mtforms-btn-icon-left">
                <?php echo $args['icon_svg']; ?>
            </span>
        <?php endif; ?>

        <span class="mtforms-btn-text">
            <?php echo esc_html($settings['button_text']); ?>
        </span>

        <?php if ($icon_right): ?>
            <span class="mtforms-btn-icon mtforms-btn-icon-right">
                <?php echo $args['icon_svg']; ?>
            </span>
        <?php endif; ?>

        <span class="mtforms-spinner"></span>
    </button>
</div>