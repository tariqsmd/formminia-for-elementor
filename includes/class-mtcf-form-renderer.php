<?php

/**
 * Form Renderer Class
 * 
 * Handles rendering of forms with different layouts, skins, and customization options
 *
 * @since      1.1.0
 * @package    MT_Contact_Forms
 * @subpackage MT_Contact_Forms/includes
 */
class MTCF_Form_Renderer {

    /**
     * Available skins
     */
    public static function get_skins() {
        return array(
            'default'     => __( 'Default', 'mt-contact-forms' ),
            'modern'      => __( 'Modern', 'mt-contact-forms' ),
            'dark'        => __( 'Dark', 'mt-contact-forms' ),
            'gradient'    => __( 'Gradient', 'mt-contact-forms' ),
            'glassmorphism' => __( 'Glassmorphism', 'mt-contact-forms' ),
            'minimal'     => __( 'Minimal', 'mt-contact-forms' ),
            'card'        => __( 'Card', 'mt-contact-forms' ),
            'neon'        => __( 'Neon', 'mt-contact-forms' ),
            'elegant'     => __( 'Elegant', 'mt-contact-forms' ),
            'brutalist'   => __( 'Brutalist', 'mt-contact-forms' ),
        );
    }

    /**
     * Available layouts
     */
    public static function get_layouts() {
        return array(
            'stacked'        => __( 'Stacked (Default)', 'mt-contact-forms' ),
            'inline'         => __( 'Inline Labels', 'mt-contact-forms' ),
            'floating'       => __( 'Floating Labels', 'mt-contact-forms' ),
            'material'       => __( 'Material Design', 'mt-contact-forms' ),
            'side-by-side'   => __( 'Side by Side', 'mt-contact-forms' ),
            'compact'        => __( 'Compact', 'mt-contact-forms' ),
        );
    }

    /**
     * Available button styles
     */
    public static function get_button_styles() {
        return array(
            'solid'    => __( 'Solid', 'mt-contact-forms' ),
            'outline'  => __( 'Outline', 'mt-contact-forms' ),
            'gradient' => __( 'Gradient', 'mt-contact-forms' ),
            'glow'     => __( 'Glow', 'mt-contact-forms' ),
            'pill'     => __( 'Pill', 'mt-contact-forms' ),
            '3d'       => __( '3D Effect', 'mt-contact-forms' ),
        );
    }

    /**
     * Available input styles
     */
    public static function get_input_styles() {
        return array(
            'default'    => __( 'Default', 'mt-contact-forms' ),
            'underline'  => __( 'Underline Only', 'mt-contact-forms' ),
            'rounded'    => __( 'Rounded', 'mt-contact-forms' ),
            'pill'       => __( 'Pill Shape', 'mt-contact-forms' ),
            'shadow'     => __( 'Shadow', 'mt-contact-forms' ),
        );
    }

    /**
     * Available animations
     */
    public static function get_animations() {
        return array(
            'none'       => __( 'None', 'mt-contact-forms' ),
            'fade-in'    => __( 'Fade In', 'mt-contact-forms' ),
            'slide-up'   => __( 'Slide Up', 'mt-contact-forms' ),
            'slide-left' => __( 'Slide Left', 'mt-contact-forms' ),
            'zoom-in'    => __( 'Zoom In', 'mt-contact-forms' ),
            'bounce'     => __( 'Bounce', 'mt-contact-forms' ),
        );
    }

    /**
     * Get default settings
     */
    public static function get_default_settings() {
        return array(
            // General
            'skin'                  => 'default',
            'layout'                => 'stacked',
            'animation'             => 'none',
            'form_width'            => array( 'size' => 100, 'unit' => '%' ),
            'form_max_width'        => array( 'size' => 600, 'unit' => 'px' ),
            'form_alignment'        => 'center',

            // Fields Configuration
            'show_name'             => 'yes',
            'show_email'            => 'yes',
            'show_phone'            => 'no',
            'show_subject'          => 'yes',
            'show_message'          => 'yes',
            'show_website'          => 'no',
            'show_gdpr'             => 'yes',

            // Labels
            'show_labels'           => 'yes',
            'show_placeholders'     => 'yes',
            'label_name'            => __( 'Name', 'mt-contact-forms' ),
            'label_email'           => __( 'Email', 'mt-contact-forms' ),
            'label_phone'           => __( 'Phone', 'mt-contact-forms' ),
            'label_subject'         => __( 'Subject', 'mt-contact-forms' ),
            'label_message'         => __( 'Message', 'mt-contact-forms' ),
            'label_website'         => __( 'Website', 'mt-contact-forms' ),
            'gdpr_text'             => __( 'I consent to having this website store my submitted information so they can respond to my inquiry.', 'mt-contact-forms' ),

            // Placeholders
            'placeholder_name'      => __( 'Enter your name', 'mt-contact-forms' ),
            'placeholder_email'     => __( 'Enter your email', 'mt-contact-forms' ),
            'placeholder_phone'     => __( 'Enter your phone number', 'mt-contact-forms' ),
            'placeholder_subject'   => __( 'Enter subject', 'mt-contact-forms' ),
            'placeholder_message'   => __( 'Write your message here...', 'mt-contact-forms' ),
            'placeholder_website'   => __( 'Your website URL', 'mt-contact-forms' ),

            // Button
            'button_text'           => __( 'Send Message', 'mt-contact-forms' ),
            'button_style'          => 'solid',
            'button_width'          => 'auto',
            'button_align'          => 'left',
            'button_icon'           => 'none',
            'button_icon_position'  => 'right',

            // Input Styling
            'input_style'           => 'default',
            'input_size'            => 'medium',

            // Typography (will be Elementor group controls)
            'label_color'           => '',
            'input_color'           => '',
            'placeholder_color'     => '',

            // Colors
            'primary_color'         => '',
            'bg_color'              => '',
            'input_bg_color'        => '',
            'input_border_color'    => '',
            'input_focus_color'     => '',
            'button_bg_color'       => '',
            'button_text_color'     => '',
            'button_hover_bg_color' => '',
            'error_color'           => '',
            'success_color'         => '',

            // Spacing
            'form_padding'          => array( 'top' => 30, 'right' => 30, 'bottom' => 30, 'left' => 30, 'unit' => 'px' ),
            'field_spacing'         => array( 'size' => 20, 'unit' => 'px' ),
            'label_spacing'         => array( 'size' => 8, 'unit' => 'px' ),
            'input_padding'         => array( 'top' => 12, 'right' => 15, 'bottom' => 12, 'left' => 15, 'unit' => 'px' ),

            // Border
            'form_border_radius'    => array( 'size' => 8, 'unit' => 'px' ),
            'input_border_radius'   => array( 'size' => 4, 'unit' => 'px' ),
            'button_border_radius'  => array( 'size' => 4, 'unit' => 'px' ),
            'input_border_width'    => array( 'size' => 1, 'unit' => 'px' ),

            // Box Shadow
            'form_box_shadow'       => 'none',
            'input_box_shadow'      => 'none',
            'button_box_shadow'     => 'none',

            // Success/Error Messages
            'success_message'       => __( 'Thank you! Your message has been sent successfully.', 'mt-contact-forms' ),
            'error_message'         => __( 'Oops! Something went wrong. Please try again.', 'mt-contact-forms' ),

            // Icon Settings (for fields)
            'show_icons'            => 'no',
            'icon_position'         => 'left',

            // Advanced
            'custom_css_class'      => '',
            'form_id'               => '',
        );
    }

    /**
     * Generate inline styles from settings
     */
    public static function generate_inline_styles( $settings, $unique_id ) {
        $styles = array();
        $prefix = ".mtcf-form-{$unique_id}";

        // Form container styles
        $form_styles = array();
        
        if ( ! empty( $settings['bg_color'] ) ) {
            $form_styles[] = "background-color: {$settings['bg_color']}";
        }
        
        if ( ! empty( $settings['primary_color'] ) ) {
            $styles[] = "{$prefix} { --mtcf-primary-color: {$settings['primary_color']}; }";
        }

        if ( ! empty( $settings['form_padding'] ) && is_array( $settings['form_padding'] ) ) {
            $padding = $settings['form_padding'];
            if ( isset( $padding['top'] ) ) {
                $unit = isset( $padding['unit'] ) ? $padding['unit'] : 'px';
                $form_styles[] = "padding: {$padding['top']}{$unit} {$padding['right']}{$unit} {$padding['bottom']}{$unit} {$padding['left']}{$unit}";
            }
        }

        if ( ! empty( $settings['form_border_radius'] ) && is_array( $settings['form_border_radius'] ) ) {
            $br = $settings['form_border_radius'];
            if ( isset( $br['size'] ) ) {
                $unit = isset( $br['unit'] ) ? $br['unit'] : 'px';
                $form_styles[] = "border-radius: {$br['size']}{$unit}";
            }
        }

        if ( ! empty( $settings['form_width'] ) && is_array( $settings['form_width'] ) ) {
            $w = $settings['form_width'];
            if ( isset( $w['size'] ) ) {
                $unit = isset( $w['unit'] ) ? $w['unit'] : '%';
                $form_styles[] = "width: {$w['size']}{$unit}";
            }
        }

        if ( ! empty( $settings['form_max_width'] ) && is_array( $settings['form_max_width'] ) ) {
            $mw = $settings['form_max_width'];
            if ( isset( $mw['size'] ) ) {
                $unit = isset( $mw['unit'] ) ? $mw['unit'] : 'px';
                $form_styles[] = "max-width: {$mw['size']}{$unit}";
            }
        }

        if ( ! empty( $form_styles ) ) {
            $styles[] = "{$prefix} .mtcf-container { " . implode( '; ', $form_styles ) . "; }";
        }

        // Input styles
        $input_styles = array();
        
        if ( ! empty( $settings['input_bg_color'] ) ) {
            $input_styles[] = "background-color: {$settings['input_bg_color']}";
        }
        
        if ( ! empty( $settings['input_color'] ) ) {
            $input_styles[] = "color: {$settings['input_color']}";
        }
        
        if ( ! empty( $settings['input_border_color'] ) ) {
            $input_styles[] = "border-color: {$settings['input_border_color']}";
        }

        if ( ! empty( $settings['input_padding'] ) && is_array( $settings['input_padding'] ) ) {
            $padding = $settings['input_padding'];
            if ( isset( $padding['top'] ) ) {
                $unit = isset( $padding['unit'] ) ? $padding['unit'] : 'px';
                $input_styles[] = "padding: {$padding['top']}{$unit} {$padding['right']}{$unit} {$padding['bottom']}{$unit} {$padding['left']}{$unit}";
            }
        }

        if ( ! empty( $settings['input_border_radius'] ) && is_array( $settings['input_border_radius'] ) ) {
            $br = $settings['input_border_radius'];
            if ( isset( $br['size'] ) ) {
                $unit = isset( $br['unit'] ) ? $br['unit'] : 'px';
                $input_styles[] = "border-radius: {$br['size']}{$unit}";
            }
        }

        if ( ! empty( $input_styles ) ) {
            $styles[] = "{$prefix} .mtcf-input, {$prefix} .mtcf-textarea { " . implode( '; ', $input_styles ) . "; }";
        }

        // Focus styles
        if ( ! empty( $settings['input_focus_color'] ) ) {
            $styles[] = "{$prefix} .mtcf-input:focus, {$prefix} .mtcf-textarea:focus { border-color: {$settings['input_focus_color']}; box-shadow: 0 0 0 2px {$settings['input_focus_color']}33; }";
        }

        // Label styles
        if ( ! empty( $settings['label_color'] ) ) {
            $styles[] = "{$prefix} .mtcf-form-group label { color: {$settings['label_color']}; }";
        }

        if ( ! empty( $settings['label_spacing'] ) && is_array( $settings['label_spacing'] ) ) {
            $sp = $settings['label_spacing'];
            if ( isset( $sp['size'] ) ) {
                $unit = isset( $sp['unit'] ) ? $sp['unit'] : 'px';
                $styles[] = "{$prefix} .mtcf-form-group label { margin-bottom: {$sp['size']}{$unit}; }";
            }
        }

        // Field spacing
        if ( ! empty( $settings['field_spacing'] ) && is_array( $settings['field_spacing'] ) ) {
            $sp = $settings['field_spacing'];
            if ( isset( $sp['size'] ) ) {
                $unit = isset( $sp['unit'] ) ? $sp['unit'] : 'px';
                $styles[] = "{$prefix} .mtcf-form-group { margin-bottom: {$sp['size']}{$unit}; }";
            }
        }

        // Button styles
        $button_styles = array();
        
        if ( ! empty( $settings['button_bg_color'] ) ) {
            $button_styles[] = "background-color: {$settings['button_bg_color']}";
        }
        
        if ( ! empty( $settings['button_text_color'] ) ) {
            $button_styles[] = "color: {$settings['button_text_color']}";
        }

        if ( ! empty( $settings['button_border_radius'] ) && is_array( $settings['button_border_radius'] ) ) {
            $br = $settings['button_border_radius'];
            if ( isset( $br['size'] ) ) {
                $unit = isset( $br['unit'] ) ? $br['unit'] : 'px';
                $button_styles[] = "border-radius: {$br['size']}{$unit}";
            }
        }

        if ( ! empty( $button_styles ) ) {
            $styles[] = "{$prefix} .mtcf-submit-btn { " . implode( '; ', $button_styles ) . "; }";
        }

        if ( ! empty( $settings['button_hover_bg_color'] ) ) {
            $styles[] = "{$prefix} .mtcf-submit-btn:hover { background-color: {$settings['button_hover_bg_color']}; }";
        }

        // Error/Success colors
        if ( ! empty( $settings['error_color'] ) ) {
            $styles[] = "{$prefix} { --mtcf-error-color: {$settings['error_color']}; }";
        }
        
        if ( ! empty( $settings['success_color'] ) ) {
            $styles[] = "{$prefix} { --mtcf-success-color: {$settings['success_color']}; }";
        }

        // Placeholder color
        if ( ! empty( $settings['placeholder_color'] ) ) {
            $styles[] = "{$prefix} .mtcf-input::placeholder, {$prefix} .mtcf-textarea::placeholder { color: {$settings['placeholder_color']}; }";
        }

        return implode( "\n", $styles );
    }

    /**
     * Render the form
     */
    public static function render( $settings = array() ) {
        $defaults = self::get_default_settings();
        $settings = wp_parse_args( $settings, $defaults );

        // Generate unique ID for this form instance
        $unique_id = 'mtcf-' . uniqid();
        if ( ! empty( $settings['form_id'] ) ) {
            $unique_id = sanitize_html_class( $settings['form_id'] );
        }

        // Build CSS classes
        $container_classes = array(
            'mtcf-container',
            'mtcf-skin-' . sanitize_html_class( $settings['skin'] ),
            'mtcf-layout-' . sanitize_html_class( $settings['layout'] ),
            'mtcf-input-style-' . sanitize_html_class( $settings['input_style'] ),
            'mtcf-button-style-' . sanitize_html_class( $settings['button_style'] ),
        );

        if ( ! empty( $settings['animation'] ) && $settings['animation'] !== 'none' ) {
            $container_classes[] = 'mtcf-animation-' . sanitize_html_class( $settings['animation'] );
        }

        if ( $settings['show_icons'] === 'yes' ) {
            $container_classes[] = 'mtcf-with-icons';
            $container_classes[] = 'mtcf-icon-' . sanitize_html_class( $settings['icon_position'] );
        }

        if ( $settings['show_labels'] !== 'yes' ) {
            $container_classes[] = 'mtcf-no-labels';
        }

        if ( ! empty( $settings['custom_css_class'] ) ) {
            $container_classes[] = sanitize_html_class( $settings['custom_css_class'] );
        }

        // Button width class
        if ( $settings['button_width'] === 'full' ) {
            $container_classes[] = 'mtcf-button-full';
        }

        // Form alignment
        $container_classes[] = 'mtcf-align-' . sanitize_html_class( $settings['form_alignment'] );

        // Input size
        $container_classes[] = 'mtcf-input-size-' . sanitize_html_class( $settings['input_size'] );

        // Generate inline styles
        $inline_styles = self::generate_inline_styles( $settings, $unique_id );

        ob_start();
        ?>
        
        <?php if ( ! empty( $inline_styles ) ) : ?>
        <style>.mtcf-form-<?php echo esc_attr( $unique_id ); ?> { }
<?php echo $inline_styles; ?>
        </style>
        <?php endif; ?>

        <div class="mtcf-form-<?php echo esc_attr( $unique_id ); ?> <?php echo esc_attr( implode( ' ', $container_classes ) ); ?>">
            <form id="mtcf-form-<?php echo esc_attr( $unique_id ); ?>" class="mtcf-form" action="" method="POST" novalidate>
                
                <?php if ( $settings['show_name'] === 'yes' ) : ?>
                <div class="mtcf-form-group mtcf-field-name">
                    <?php if ( $settings['show_labels'] === 'yes' ) : ?>
                    <label for="mtcf_name_<?php echo esc_attr( $unique_id ); ?>">
                        <?php if ( $settings['show_icons'] === 'yes' ) : ?>
                        <span class="mtcf-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg></span>
                        <?php endif; ?>
                        <?php echo esc_html( $settings['label_name'] ); ?> <span class="required">*</span>
                    </label>
                    <?php endif; ?>
                    <div class="mtcf-input-wrap">
                        <?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                        <span class="mtcf-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg></span>
                        <?php endif; ?>
                        <input type="text" 
                               name="mtcf_name" 
                               id="mtcf_name_<?php echo esc_attr( $unique_id ); ?>" 
                               class="mtcf-input mtcf-input-name" 
                               <?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                               placeholder="<?php echo esc_attr( $settings['placeholder_name'] ); ?>"
                               <?php endif; ?>
                               required>
                        <?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                        <label class="mtcf-floating-label" for="mtcf_name_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_name'] ); ?> <span class="required">*</span></label>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $settings['show_email'] === 'yes' ) : ?>
                <div class="mtcf-form-group mtcf-field-email">
                    <?php if ( $settings['show_labels'] === 'yes' ) : ?>
                    <label for="mtcf_email_<?php echo esc_attr( $unique_id ); ?>">
                        <?php if ( $settings['show_icons'] === 'yes' ) : ?>
                        <span class="mtcf-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></span>
                        <?php endif; ?>
                        <?php echo esc_html( $settings['label_email'] ); ?> <span class="required">*</span>
                    </label>
                    <?php endif; ?>
                    <div class="mtcf-input-wrap">
                        <?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                        <span class="mtcf-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg></span>
                        <?php endif; ?>
                        <input type="email" 
                               name="mtcf_email" 
                               id="mtcf_email_<?php echo esc_attr( $unique_id ); ?>" 
                               class="mtcf-input mtcf-input-email" 
                               <?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                               placeholder="<?php echo esc_attr( $settings['placeholder_email'] ); ?>"
                               <?php endif; ?>
                               required>
                        <?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                        <label class="mtcf-floating-label" for="mtcf_email_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_email'] ); ?> <span class="required">*</span></label>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $settings['show_phone'] === 'yes' ) : ?>
                <div class="mtcf-form-group mtcf-field-phone">
                    <?php if ( $settings['show_labels'] === 'yes' ) : ?>
                    <label for="mtcf_phone_<?php echo esc_attr( $unique_id ); ?>">
                        <?php if ( $settings['show_icons'] === 'yes' ) : ?>
                        <span class="mtcf-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></span>
                        <?php endif; ?>
                        <?php echo esc_html( $settings['label_phone'] ); ?>
                    </label>
                    <?php endif; ?>
                    <div class="mtcf-input-wrap">
                        <?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                        <span class="mtcf-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg></span>
                        <?php endif; ?>
                        <input type="tel" 
                               name="mtcf_phone" 
                               id="mtcf_phone_<?php echo esc_attr( $unique_id ); ?>" 
                               class="mtcf-input mtcf-input-phone" 
                               <?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                               placeholder="<?php echo esc_attr( $settings['placeholder_phone'] ); ?>"
                               <?php endif; ?>>
                        <?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                        <label class="mtcf-floating-label" for="mtcf_phone_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_phone'] ); ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $settings['show_website'] === 'yes' ) : ?>
                <div class="mtcf-form-group mtcf-field-website">
                    <?php if ( $settings['show_labels'] === 'yes' ) : ?>
                    <label for="mtcf_website_<?php echo esc_attr( $unique_id ); ?>">
                        <?php if ( $settings['show_icons'] === 'yes' ) : ?>
                        <span class="mtcf-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2 0 .68.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c.96-1.66 2.49-2.93 4.33-3.56C8.81 5.55 8.35 6.75 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2 0-.68.07-1.35.16-2h4.68c.09.65.16 1.32.16 2 0 .68-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2 0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"/></svg></span>
                        <?php endif; ?>
                        <?php echo esc_html( $settings['label_website'] ); ?>
                    </label>
                    <?php endif; ?>
                    <div class="mtcf-input-wrap">
                        <?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                        <span class="mtcf-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2z"/></svg></span>
                        <?php endif; ?>
                        <input type="url" 
                               name="mtcf_website" 
                               id="mtcf_website_<?php echo esc_attr( $unique_id ); ?>" 
                               class="mtcf-input mtcf-input-website" 
                               <?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                               placeholder="<?php echo esc_attr( $settings['placeholder_website'] ); ?>"
                               <?php endif; ?>>
                        <?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                        <label class="mtcf-floating-label" for="mtcf_website_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_website'] ); ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $settings['show_subject'] === 'yes' ) : ?>
                <div class="mtcf-form-group mtcf-field-subject">
                    <?php if ( $settings['show_labels'] === 'yes' ) : ?>
                    <label for="mtcf_subject_<?php echo esc_attr( $unique_id ); ?>">
                        <?php if ( $settings['show_icons'] === 'yes' ) : ?>
                        <span class="mtcf-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg></span>
                        <?php endif; ?>
                        <?php echo esc_html( $settings['label_subject'] ); ?>
                    </label>
                    <?php endif; ?>
                    <div class="mtcf-input-wrap">
                        <?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                        <span class="mtcf-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6z"/></svg></span>
                        <?php endif; ?>
                        <input type="text" 
                               name="mtcf_subject" 
                               id="mtcf_subject_<?php echo esc_attr( $unique_id ); ?>" 
                               class="mtcf-input mtcf-input-subject" 
                               <?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                               placeholder="<?php echo esc_attr( $settings['placeholder_subject'] ); ?>"
                               <?php endif; ?>>
                        <?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                        <label class="mtcf-floating-label" for="mtcf_subject_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_subject'] ); ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $settings['show_message'] === 'yes' ) : ?>
                <div class="mtcf-form-group mtcf-field-message">
                    <?php if ( $settings['show_labels'] === 'yes' ) : ?>
                    <label for="mtcf_message_<?php echo esc_attr( $unique_id ); ?>">
                        <?php if ( $settings['show_icons'] === 'yes' ) : ?>
                        <span class="mtcf-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg></span>
                        <?php endif; ?>
                        <?php echo esc_html( $settings['label_message'] ); ?> <span class="required">*</span>
                    </label>
                    <?php endif; ?>
                    <div class="mtcf-input-wrap">
                        <?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                        <span class="mtcf-field-icon mtcf-field-icon-textarea"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg></span>
                        <?php endif; ?>
                        <textarea name="mtcf_message" 
                                  id="mtcf_message_<?php echo esc_attr( $unique_id ); ?>" 
                                  class="mtcf-textarea mtcf-input-message" 
                                  rows="5" 
                                  <?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                                  placeholder="<?php echo esc_attr( $settings['placeholder_message'] ); ?>"
                                  <?php endif; ?>
                                  required></textarea>
                        <?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                        <label class="mtcf-floating-label" for="mtcf_message_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_message'] ); ?> <span class="required">*</span></label>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $settings['show_gdpr'] === 'yes' ) : ?>
                <div class="mtcf-form-group mtcf-gdpr-group">
                    <label class="mtcf-checkbox-label">
                        <input type="checkbox" name="mtcf_gdpr" id="mtcf_gdpr_<?php echo esc_attr( $unique_id ); ?>" required>
                        <span class="mtcf-checkbox-custom"></span>
                        <span class="mtcf-checkbox-text"><?php echo esc_html( $settings['gdpr_text'] ); ?></span>
                    </label>
                </div>
                <?php endif; ?>

                <?php
                // Captcha
                $captcha_provider = get_option( 'mtcf_captcha_provider', 'none' );
                if ( $captcha_provider === 'recaptcha' ) {
                    $site_key = get_option( 'mtcf_recaptcha_site_key' );
                    if ( ! empty( $site_key ) ) {
                        echo '<div class="mtcf-captcha-wrap"><div class="g-recaptcha" data-sitekey="' . esc_attr( $site_key ) . '"></div></div>';
                    }
                } elseif ( $captcha_provider === 'turnstile' ) {
                    $site_key = get_option( 'mtcf_turnstile_site_key' );
                    if ( ! empty( $site_key ) ) {
                        echo '<div class="mtcf-captcha-wrap"><div class="cf-turnstile" data-sitekey="' . esc_attr( $site_key ) . '"></div></div>';
                    }
                }
                ?>

                <div class="mtcf-form-actions mtcf-button-align-<?php echo esc_attr( $settings['button_align'] ); ?>">
                    <button type="submit" class="mtcf-submit-btn">
                        <?php if ( $settings['button_icon'] !== 'none' && $settings['button_icon_position'] === 'left' ) : ?>
                        <span class="mtcf-btn-icon mtcf-btn-icon-left">
                            <?php echo self::get_button_icon( $settings['button_icon'] ); ?>
                        </span>
                        <?php endif; ?>
                        <span class="mtcf-btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
                        <?php if ( $settings['button_icon'] !== 'none' && $settings['button_icon_position'] === 'right' ) : ?>
                        <span class="mtcf-btn-icon mtcf-btn-icon-right">
                            <?php echo self::get_button_icon( $settings['button_icon'] ); ?>
                        </span>
                        <?php endif; ?>
                        <span class="mtcf-spinner"></span>
                    </button>
                </div>

                <div class="mtcf-response-message"></div>

            </form>
        </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Get button icon SVG
     */
    public static function get_button_icon( $icon ) {
        $icons = array(
            'send' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>',
            'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>',
            'check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>',
            'mail' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
        );

        return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
    }

    /**
     * Get available button icons
     */
    public static function get_button_icons() {
        return array(
            'none'        => __( 'None', 'mt-contact-forms' ),
            'send'        => __( 'Send', 'mt-contact-forms' ),
            'arrow-right' => __( 'Arrow Right', 'mt-contact-forms' ),
            'check'       => __( 'Check', 'mt-contact-forms' ),
            'mail'        => __( 'Mail', 'mt-contact-forms' ),
        );
    }

}
