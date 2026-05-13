<?php
/**
 * Field Item Partial
 *
 * @var array $args Partial arguments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$field_id    = $args['field_id'];
$type        = $args['type'];
$name        = $args['name'];
$label       = $args['label'];
$placeholder = $args['placeholder'];
$required    = $args['required'] ? 'required' : '';
$settings    = $args['settings'];
$icon_svg    = $args['icon_svg'];

$group_classes = array( 'mtforms-form-group', 'mtforms-field-' . $type );

// Determine if field icons should be shown
$show_input_icon = false;
if ( $type === 'textarea' && $settings['show_textarea_icons'] === 'yes' ) {
	$show_input_icon = true;
} elseif ( $type !== 'textarea' && $settings['show_input_icons'] === 'yes' ) {
	$show_input_icon = true;
}

if ( $show_input_icon ) {
	$group_classes[] = 'mtforms-form-has-icon';
	$group_classes[] = 'mtforms-icon-' . ( $type === 'textarea' ? $settings['textarea_icon_position'] : $settings['input_icon_position'] );
}
?>

<div class="<?php echo esc_attr( implode( ' ', $group_classes ) ); ?>">
    <?php 
    // Show icon before/left of input field
    $icon_position = $type === 'textarea' ? $settings['textarea_icon_position'] : $settings['input_icon_position'];
    if ( $show_input_icon && $icon_position === 'left' ): 
    ?>
        <span class="mtforms-icon mtforms-field-icon">
            <?php
            if (!empty($args['icon']['value'])) {
                \Elementor\Icons_Manager::render_icon($args['icon'], ['aria-hidden' => 'true']);
            } elseif (!empty($icon_svg)) {
                echo $icon_svg;
            }
            ?>
        </span>
    <?php endif; ?>

    <div class="mtforms-field-inner">
	<?php if ( $settings['show_labels'] === 'yes' ): ?>
        <label for="<?php echo esc_attr($field_id); ?>">
            <?php if ($settings['show_label_icons'] === 'yes' && $settings['label_icon_position'] === 'before'): ?>
                <span class="mtforms-icon mtforms-label-icon">
                    <?php
                    if (!empty($args['icon']['value'])) {
                        \Elementor\Icons_Manager::render_icon($args['icon'], ['aria-hidden' => 'true']);
                    } elseif (!empty($icon_svg)) {
                        echo $icon_svg;
                    }
                    ?>
                </span>
            <?php endif; ?>

            <span class="mtforms-label-text">
                <?php echo esc_html($label); ?>
                <?php if ($required): ?>
                    <span class="required">*</span>
                <?php endif; ?>
            </span>

            <?php if ($settings['show_label_icons'] === 'yes' && $settings['label_icon_position'] === 'after'): ?>
                <span class="mtforms-icon mtforms-label-icon">
                    <?php
                    if (!empty($args['icon']['value'])) {
                        \Elementor\Icons_Manager::render_icon($args['icon'], ['aria-hidden' => 'true']);
                    } elseif (!empty($icon_svg)) {
                        echo $icon_svg;
                    }
                    ?>
                </span>
            <?php endif; ?>
        </label>
	<?php endif; ?>
    <div class="mtforms-input-wrap">

		<?php if ( 'textarea' === $type ): ?>
            <textarea name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $field_id ); ?>" class="mtforms-textarea mtforms-input-<?php echo esc_attr( $type ); ?>" rows="<?php echo esc_attr( $settings['textarea_rows'] ); ?>" <?php if ( $settings['show_placeholders'] === 'yes' ): ?>placeholder="<?php echo esc_attr( $placeholder ); ?>"<?php endif; ?><?php echo $required; ?>></textarea>
		<?php else: ?>
            <input type="<?php echo esc_attr( $type ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $field_id ); ?>" class="mtforms-input mtforms-input-<?php echo esc_attr( $type ); ?>" <?php if ( $settings['show_placeholders'] === 'yes' ): ?>placeholder="<?php echo esc_attr( $placeholder ); ?>"<?php endif; ?><?php echo $required; ?>>
        <?php endif; ?>

        	<?php if ( $settings['layout'] === 'floating' ): ?>
            <label class="mtforms-floating-label" for="<?php echo esc_attr( $field_id ); ?>">
				<?php echo esc_html( $label ); ?>
				<?php if ( $required ): ?>
                    <span class="required">*</span>
				<?php endif; ?>
            </label>
	<?php endif; ?>

    </div>

    </div>

    <?php 
    // Show icon after/right of input field
    if ( $show_input_icon && $icon_position === 'right' ): 
    ?>
        <span class="mtforms-icon mtforms-field-icon">
            <?php
            if (!empty($args['icon']['value'])) {
                \Elementor\Icons_Manager::render_icon($args['icon'], ['aria-hidden' => 'true']);
            } elseif (!empty($icon_svg)) {
                echo $icon_svg;
            }
            ?>
        </span>
    <?php endif; ?>
</div>