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
?>

<div class="<?php echo esc_attr( implode( ' ', $group_classes ) ); ?>">
	<?php if ( $settings['show_labels'] === 'yes' ): ?>
        <label for="<?php echo esc_attr( $field_id ); ?>">
			<?php if ( $settings['show_icons'] === 'yes' && ! empty( $icon_svg ) ): ?>
                <span class="mtforms-icon">
                    <?php echo $icon_svg; ?>
                </span>
			<?php endif; ?>
			<?php echo esc_html( $label ); ?>
			<?php if ( $required ): ?>
                <span class="required">*</span>
			<?php endif; ?>
        </label>
	<?php endif; ?>

    <div class="mtforms-input-wrap">
		<?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' && ! empty( $icon_svg ) ): ?>
            <span class="mtforms-field-icon <?php echo ( 'textarea' === $type ) ? 'mtforms-field-icon-textarea' : ''; ?>">
                <?php echo $icon_svg; ?>
            </span>
		<?php endif; ?>

		<?php if ( 'textarea' === $type ): ?>
            <textarea name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $field_id ); ?>" class="mtforms-textarea mtforms-input-<?php echo esc_attr( $type ); ?>" rows="<?php echo esc_attr( $settings['textarea_rows'] ); ?>" <?php if ( $settings['show_placeholders'] === 'yes' ): ?>placeholder="<?php echo esc_attr( $placeholder ); ?>"<?php endif; ?><?php echo $required; ?>></textarea>
		<?php else: ?>
            <input type="<?php echo esc_attr( $type ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $field_id ); ?>" class="mtforms-input mtforms-input-<?php echo esc_attr( $type ); ?>" <?php if ( $settings['show_placeholders'] === 'yes' ): ?>placeholder="<?php echo esc_attr( $placeholder ); ?>"<?php endif; ?><?php echo $required; ?>>
        <?php endif; ?>

		<?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ): ?>
            <label class="mtforms-floating-label" for="<?php echo esc_attr( $field_id ); ?>">
				<?php echo esc_html( $label ); ?>
				<?php if ( $required ): ?>
                    <span class="required">*</span>
				<?php endif; ?>
            </label>
		<?php endif; ?>
    </div>
</div>