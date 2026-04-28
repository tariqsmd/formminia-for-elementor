<?php
/**
 * GDPR Partial
 *
 * @var array $args Partial arguments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$settings  = $args['settings'];
$widget_id = $args['widget_id'];

if ( $settings['show_gdpr'] === 'yes' ): ?>
    <div class="mtforms-form-group mtforms-gdpr-group">        <?php if ( $settings['show_labels'] === 'yes' ): ?>
            <label class="mtforms-gdpr-heading" for="gdpr-<?php echo esc_attr( $widget_id ); ?>">
                <?php echo esc_html( $settings['gdpr_label'] ); ?>
            </label>
        <?php endif; ?>
        <label class="mtforms-checkbox-label">
            <input type="checkbox" name="mtforms_gdpr" class="mtforms-checkbox" id="gdpr-<?php echo esc_attr( $widget_id ); ?>" required>
            <span class="mtforms-checkbox-custom"></span>
            <span class="mtforms-checkbox-text">
                <?php echo esc_html( $settings['gdpr_text'] ); ?>
            </span>
        </label>
        <input type="hidden" name="mtforms_gdpr_enabled" value="yes">
    </div>
<?php endif;