<?php
/**
 * GDPR Partial
 *
 * @var array $args Partial arguments
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// View template: variables below are injected by the widget renderer.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$settings  = $args['settings'];
$widget_id = $args['widget_id'];

$show_input_icon = false;
$show_label_icon = false;
$icon_position = $settings['icon_position'] ?? 'before';

if ($settings['show_gdpr_icons'] === 'yes') {
    if ($settings['icon_location'] === 'label') {
        $show_label_icon = true;
    } elseif ($settings['icon_location'] === 'input') {
        $show_input_icon = true;
    }
}

// Add class if GDPR icons are enabled
$gdpr_group_classes = array( 'mtef-form-group', 'mtef-gdpr-group' );
if ( $show_input_icon ) {
	$gdpr_group_classes[] = 'mtef-gdpr-has-icon';
}

if ( $settings['show_gdpr'] === 'yes' ): ?>
    <div class="<?php echo esc_attr( implode( ' ', $gdpr_group_classes ) ); ?>">
        <?php if ( $settings['show_labels'] === 'yes' ): ?>
            <label class="mtef-gdpr-heading" for="gdpr-<?php echo esc_attr( $widget_id ); ?>">
                <?php if ($show_label_icon && $icon_position === 'before'): ?>
                    <span class="mtef-icon mtef-label-icon">
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

                <span class="mtef-label-text">
                    <?php echo esc_html( $settings['gdpr_label'] ); ?>
                </span>

                <?php if ($show_label_icon && $icon_position === 'after'): ?>
                    <span class="mtef-icon mtef-label-icon">
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
            </label>
        <?php endif; ?>
        <label class="mtef-checkbox-label">
            <!-- Icon before checkbox -->
            <?php if ( $show_input_icon ): ?>
                <span class="mtef-icon mtef-gdpr-icon">
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

            <input type="checkbox" name="mtef_gdpr" class="mtef-checkbox" id="gdpr-<?php echo esc_attr( $widget_id ); ?>" required>
            <span class="mtef-checkbox-custom"></span>
            <span class="mtef-checkbox-text">
                <?php echo wp_kses_post( $settings['gdpr_text'] ); ?>
            </span>
        </label>
        <input type="hidden" name="mtef_gdpr_enabled" value="yes">
    </div>
<?php endif;