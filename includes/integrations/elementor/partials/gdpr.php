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

// Add class if GDPR icons are enabled
$gdpr_group_classes = array( 'mtforms-form-group', 'mtforms-gdpr-group' );
if ( $settings['show_icons'] === 'yes' && $settings['show_gdpr_icons'] === 'yes' ) {
	$gdpr_group_classes[] = 'mtforms-gdpr-has-icon';
}

if ( $settings['show_gdpr'] === 'yes' ): ?>
    <div class="<?php echo esc_attr( implode( ' ', $gdpr_group_classes ) ); ?>">        <?php if ( $settings['show_labels'] === 'yes' ): ?>
            <label class="mtforms-gdpr-heading" for="gdpr-<?php echo esc_attr( $widget_id ); ?>">
                <?php echo esc_html( $settings['gdpr_label'] ); ?>
            </label>
        <?php endif; ?>
        <label class="mtforms-checkbox-label">
            <!-- Icon before checkbox -->
            <?php if ( $settings['show_icons'] === 'yes' && $settings['show_gdpr_icons'] === 'yes' ): ?>
                <span class="mtforms-icon mtforms-gdpr-icon">
                    <?php
                    $gdpr_icon = $settings['icon_gdpr'] ?? [];
                    if (!empty($gdpr_icon['value'])) {
                        \Elementor\Icons_Manager::render_icon($gdpr_icon, ['aria-hidden' => 'true']);
                    } else {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>';
                    }
                    ?>
                </span>
            <?php endif; ?>

            <input type="checkbox" name="mtforms_gdpr" class="mtforms-checkbox" id="gdpr-<?php echo esc_attr( $widget_id ); ?>" required>
            <span class="mtforms-checkbox-custom"></span>
            <span class="mtforms-checkbox-text">
                <?php echo esc_html( $settings['gdpr_text'] ); ?>
            </span>
        </label>
        <input type="hidden" name="mtforms_gdpr_enabled" value="yes">
    </div>
<?php endif;