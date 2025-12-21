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
$unique_id = $args['unique_id'];

if ( $settings['show_gdpr'] === 'yes' ): ?>
    <input type="hidden" name="mtforms_gdpr_enabled" value="yes">
    <div class="mtforms-form-group mtforms-gdpr-group">
        <label class="mtforms-checkbox-label">
            <input type="checkbox" name="mtforms_gdpr" id="gdpr-<?php echo esc_attr( $unique_id ); ?>" required>
            <span class="mtforms-checkbox-custom"></span>
            <span class="mtforms-checkbox-text">
                <?php echo esc_html( $settings['gdpr_text'] ); ?>
            </span>
        </label>
    </div>
<?php endif;
