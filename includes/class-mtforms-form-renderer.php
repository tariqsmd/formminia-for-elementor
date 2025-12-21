<?php

/**
 * Form Renderer Class
 *
 * Handles rendering of forms with different layouts, skins, and customization options
 *
 * @since      1.1.0
 * @package    MTForms
 * @subpackage MTForms/includes
 */
class MTForms_Form_Renderer {

	/**
	 * Available skins
	 */
	public static function get_skins() {
		return array(
			'default'       => __( 'Default', MTFORMS_TEXT_DOMAIN ),
			'modern'        => __( 'Modern', MTFORMS_TEXT_DOMAIN ),
			'dark'          => __( 'Dark', MTFORMS_TEXT_DOMAIN ),
			'gradient'      => __( 'Gradient', MTFORMS_TEXT_DOMAIN ),
			'glassmorphism' => __( 'Glassmorphism', MTFORMS_TEXT_DOMAIN ),
			'minimal'       => __( 'Minimal', MTFORMS_TEXT_DOMAIN ),
			'card'          => __( 'Card', MTFORMS_TEXT_DOMAIN ),
			'neon'          => __( 'Neon', MTFORMS_TEXT_DOMAIN ),
			'elegant'       => __( 'Elegant', MTFORMS_TEXT_DOMAIN ),
			'brutalist'     => __( 'Brutalist', MTFORMS_TEXT_DOMAIN ),
		);
	}

	/**
	 * Available layouts
	 */
	public static function get_layouts() {
		return array(
			'stacked'      => __( 'Stacked (Default)', MTFORMS_TEXT_DOMAIN ),
			'inline'       => __( 'Inline Labels', MTFORMS_TEXT_DOMAIN ),
			'floating'     => __( 'Floating Labels', MTFORMS_TEXT_DOMAIN ),
			'material'     => __( 'Material Design', MTFORMS_TEXT_DOMAIN ),
			'side-by-side' => __( 'Side by Side', MTFORMS_TEXT_DOMAIN ),
			'compact'      => __( 'Compact', MTFORMS_TEXT_DOMAIN ),
		);
	}

	/**
	 * Available button styles
	 */
	public static function get_button_styles() {
		return array(
			'solid'    => __( 'Solid', MTFORMS_TEXT_DOMAIN ),
			'outline'  => __( 'Outline', MTFORMS_TEXT_DOMAIN ),
			'gradient' => __( 'Gradient', MTFORMS_TEXT_DOMAIN ),
			'glow'     => __( 'Glow', MTFORMS_TEXT_DOMAIN ),
			'pill'     => __( 'Pill', MTFORMS_TEXT_DOMAIN ),
			'3d'       => __( '3D Effect', MTFORMS_TEXT_DOMAIN ),
		);
	}

	/**
	 * Available input styles
	 */
	public static function get_input_styles() {
		return array(
			'default'   => __( 'Default', MTFORMS_TEXT_DOMAIN ),
			'underline' => __( 'Underline Only', MTFORMS_TEXT_DOMAIN ),
			'rounded'   => __( 'Rounded', MTFORMS_TEXT_DOMAIN ),
			'pill'      => __( 'Pill Shape', MTFORMS_TEXT_DOMAIN ),
			'shadow'    => __( 'Shadow', MTFORMS_TEXT_DOMAIN ),
		);
	}

	/**
	 * Available animations
	 */
	public static function get_animations() {
		return array(
			'none'       => __( 'None', MTFORMS_TEXT_DOMAIN ),
			'fade-in'    => __( 'Fade In', MTFORMS_TEXT_DOMAIN ),
			'slide-up'   => __( 'Slide Up', MTFORMS_TEXT_DOMAIN ),
			'slide-left' => __( 'Slide Left', MTFORMS_TEXT_DOMAIN ),
			'zoom-in'    => __( 'Zoom In', MTFORMS_TEXT_DOMAIN ),
			'bounce'     => __( 'Bounce', MTFORMS_TEXT_DOMAIN ),
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
			'label_name'            => __( 'Name', MTFORMS_TEXT_DOMAIN ),
			'label_email'           => __( 'Email', MTFORMS_TEXT_DOMAIN ),
			'label_phone'           => __( 'Phone', MTFORMS_TEXT_DOMAIN ),
			'label_subject'         => __( 'Subject', MTFORMS_TEXT_DOMAIN ),
			'label_message'         => __( 'Message', MTFORMS_TEXT_DOMAIN ),
			'label_website'         => __( 'Website', MTFORMS_TEXT_DOMAIN ),
			'gdpr_text'             => __( 'I consent to having this website store my submitted information so they can respond to my inquiry.', MTFORMS_TEXT_DOMAIN ),

			// Placeholders
			'placeholder_name'      => __( 'Enter your name', MTFORMS_TEXT_DOMAIN ),
			'placeholder_email'     => __( 'Enter your email', MTFORMS_TEXT_DOMAIN ),
			'placeholder_phone'     => __( 'Enter your phone number', MTFORMS_TEXT_DOMAIN ),
			'placeholder_subject'   => __( 'Enter subject', MTFORMS_TEXT_DOMAIN ),
			'placeholder_message'   => __( 'Write your message here...', MTFORMS_TEXT_DOMAIN ),
			'placeholder_website'   => __( 'Your website URL', MTFORMS_TEXT_DOMAIN ),

			// Button
			'button_text'           => __( 'Send Message', MTFORMS_TEXT_DOMAIN ),
			'button_style'          => 'solid',
			'button_width'          => 'auto',
			'button_align'          => 'left',
			'button_icon'           => 'none',
			'button_icon_position'  => 'right',

			// Input Styling
			'input_style'           => 'default',
			'input_size'            => 'medium',
			'textarea_rows'         => 5,

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
			'success_message'       => __( 'Thank you! Your message has been sent successfully.', MTFORMS_TEXT_DOMAIN ),
			'error_message'         => __( 'Oops! Something went wrong. Please try again.', MTFORMS_TEXT_DOMAIN ),

			// Icon Settings (for fields)
			'show_icons'            => 'no',
			'icon_position'         => 'left',

			// Captcha
			'show_captcha'          => 'yes',

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
		$prefix = ".mtforms-form-{$unique_id}";

		// Form container styles
		$form_styles = array();

		if ( ! empty( $settings['bg_color'] ) ) {
			$form_styles[] = "background-color: {$settings['bg_color']}";
		}

		if ( ! empty( $settings['primary_color'] ) ) {
			$styles[] = "{$prefix} { --mtforms-primary-color: {$settings['primary_color']}; }";
		}

		if ( ! empty( $settings['form_padding'] ) && is_array( $settings['form_padding'] ) ) {
			$padding = $settings['form_padding'];
			if ( isset( $padding['top'] ) ) {
				$unit          = isset( $padding['unit'] ) ? $padding['unit'] : 'px';
				$form_styles[] = "padding: {$padding['top']}{$unit} {$padding['right']}{$unit} {$padding['bottom']}{$unit} {$padding['left']}{$unit}";
			}
		}

		if ( ! empty( $settings['form_border_radius'] ) && is_array( $settings['form_border_radius'] ) ) {
			$br = $settings['form_border_radius'];
			if ( isset( $br['size'] ) ) {
				$unit          = isset( $br['unit'] ) ? $br['unit'] : 'px';
				$form_styles[] = "border-radius: {$br['size']}{$unit}";
			}
		}

		if ( ! empty( $settings['form_width'] ) && is_array( $settings['form_width'] ) ) {
			$w = $settings['form_width'];
			if ( isset( $w['size'] ) ) {
				$unit          = isset( $w['unit'] ) ? $w['unit'] : '%';
				$form_styles[] = "width: {$w['size']}{$unit}";
			}
		}

		if ( ! empty( $settings['form_max_width'] ) && is_array( $settings['form_max_width'] ) ) {
			$mw = $settings['form_max_width'];
			if ( isset( $mw['size'] ) ) {
				$unit          = isset( $mw['unit'] ) ? $mw['unit'] : 'px';
				$form_styles[] = "max-width: {$mw['size']}{$unit}";
			}
		}

		if ( ! empty( $form_styles ) ) {
			$styles[] = "{$prefix} .mtforms-container { " . implode( '; ', $form_styles ) . "; }";
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
				$unit           = isset( $padding['unit'] ) ? $padding['unit'] : 'px';
				$input_styles[] = "padding: {$padding['top']}{$unit} {$padding['right']}{$unit} {$padding['bottom']}{$unit} {$padding['left']}{$unit}";
			}
		}

		if ( ! empty( $settings['input_border_radius'] ) && is_array( $settings['input_border_radius'] ) ) {
			$br = $settings['input_border_radius'];
			if ( isset( $br['size'] ) ) {
				$unit           = isset( $br['unit'] ) ? $br['unit'] : 'px';
				$input_styles[] = "border-radius: {$br['size']}{$unit}";
			}
		}

		if ( ! empty( $input_styles ) ) {
			$styles[] = "{$prefix} .mtforms-input, {$prefix} .mtforms-textarea { " . implode( '; ', $input_styles ) . "; }";
		}

		// Focus styles
		if ( ! empty( $settings['input_focus_color'] ) ) {
			$styles[] = "{$prefix} .mtforms-input:focus, {$prefix} .mtforms-textarea:focus { border-color: {$settings['input_focus_color']}; box-shadow: 0 0 0 2px {$settings['input_focus_color']}33; }";
		}

		// Label styles
		if ( ! empty( $settings['label_color'] ) ) {
			$styles[] = "{$prefix} .mtforms-form-group label { color: {$settings['label_color']}; }";
		}

		if ( ! empty( $settings['label_spacing'] ) && is_array( $settings['label_spacing'] ) ) {
			$sp = $settings['label_spacing'];
			if ( isset( $sp['size'] ) ) {
				$unit     = isset( $sp['unit'] ) ? $sp['unit'] : 'px';
				$styles[] = "{$prefix} .mtforms-form-group label { margin-bottom: {$sp['size']}{$unit}; }";
			}
		}

		// Field spacing
		if ( ! empty( $settings['field_spacing'] ) && is_array( $settings['field_spacing'] ) ) {
			$sp = $settings['field_spacing'];
			if ( isset( $sp['size'] ) ) {
				$unit     = isset( $sp['unit'] ) ? $sp['unit'] : 'px';
				$styles[] = "{$prefix} .mtforms-form-group { margin-bottom: {$sp['size']}{$unit}; }";
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
				$unit            = isset( $br['unit'] ) ? $br['unit'] : 'px';
				$button_styles[] = "border-radius: {$br['size']}{$unit}";
			}
		}

		if ( ! empty( $button_styles ) ) {
			$styles[] = "{$prefix} .mtforms-submit-btn { " . implode( '; ', $button_styles ) . "; }";
		}

		if ( ! empty( $settings['button_hover_bg_color'] ) ) {
			$styles[] = "{$prefix} .mtforms-submit-btn:hover { background-color: {$settings['button_hover_bg_color']}; }";
		}

		// Error/Success colors
		if ( ! empty( $settings['error_color'] ) ) {
			$styles[] = "{$prefix} { --mtforms-error-color: {$settings['error_color']}; }";
		}

		if ( ! empty( $settings['success_color'] ) ) {
			$styles[] = "{$prefix} { --mtforms-success-color: {$settings['success_color']}; }";
		}

		// Placeholder color
		if ( ! empty( $settings['placeholder_color'] ) ) {
			$styles[] = "{$prefix} .mtforms-input::placeholder, {$prefix} .mtforms-textarea::placeholder { color: {$settings['placeholder_color']}; }";
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
		$unique_id = 'mtforms-' . uniqid();
		if ( ! empty( $settings['form_id'] ) ) {
			$unique_id = sanitize_html_class( $settings['form_id'] );
		}

		// Build CSS classes
		$container_classes = array(
			'mtforms-container',
			'mtforms-skin-' . sanitize_html_class( $settings['skin'] ),
			'mtforms-layout-' . sanitize_html_class( $settings['layout'] ),
			'mtforms-input-style-' . sanitize_html_class( $settings['input_style'] ),
			'mtforms-button-style-' . sanitize_html_class( $settings['button_style'] ),
		);

		if ( ! empty( $settings['animation'] ) && $settings['animation'] !== 'none' ) {
			$container_classes[] = 'mtforms-animation-' . sanitize_html_class( $settings['animation'] );
		}

		if ( $settings['show_icons'] === 'yes' ) {
			$container_classes[] = 'mtforms-with-icons';
			$container_classes[] = 'mtforms-icon-' . sanitize_html_class( $settings['icon_position'] );
		}

		if ( $settings['show_labels'] !== 'yes' ) {
			$container_classes[] = 'mtforms-no-labels';
		}

		if ( ! empty( $settings['custom_css_class'] ) ) {
			$container_classes[] = sanitize_html_class( $settings['custom_css_class'] );
		}

		// Button width class
		if ( $settings['button_width'] === 'full' ) {
			$container_classes[] = 'mtforms-button-full';
		}

		// Form alignment
		$container_classes[] = 'mtforms-align-' . sanitize_html_class( $settings['form_alignment'] );

		// Input size
		$container_classes[] = 'mtforms-input-size-' . sanitize_html_class( $settings['input_size'] );

		// Generate inline styles
		$inline_styles = self::generate_inline_styles( $settings, $unique_id );

		ob_start();
		?>

		<?php if ( ! empty( $inline_styles ) ) : ?>
            <style>.mtforms-form-<?php echo esc_attr( $unique_id ); ?> {
                }

                <?php echo wp_strip_all_tags( $inline_styles ); ?>
            </style>
		<?php endif; ?>

        <div class="mtforms-form-<?php echo esc_attr( $unique_id ); ?> <?php echo esc_attr( implode( ' ', $container_classes ) ); ?>">
            <form id="mtforms-form-<?php echo esc_attr( $unique_id ); ?>" class="mtforms-form" action="" method="POST" novalidate>

				<?php if ( $settings['show_name'] === 'yes' ) : ?>
                    <div class="mtforms-form-group mtforms-field-name">
						<?php if ( $settings['show_labels'] === 'yes' ) : ?>
                            <label for="mtforms_name_<?php echo esc_attr( $unique_id ); ?>">
								<?php if ( $settings['show_icons'] === 'yes' ) : ?>
                                    <span class="mtforms-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" /></svg></span>
								<?php endif; ?>
								<?php echo esc_html( $settings['label_name'] ); ?> <span class="required">*</span>
                            </label>
						<?php endif; ?>
                        <div class="mtforms-input-wrap">
							<?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                                <span class="mtforms-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" /></svg></span>
							<?php endif; ?>
                            <input type="text" name="mtforms_name" id="mtforms_name_<?php echo esc_attr( $unique_id ); ?>" class="mtforms-input mtforms-input-name"
								<?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                                    placeholder="<?php echo esc_attr( $settings['placeholder_name'] ); ?>"
								<?php endif; ?>
                                   required>
							<?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                                <label class="mtforms-floating-label" for="mtforms_name_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_name'] ); ?> <span class="required">*</span></label>
							<?php endif; ?>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $settings['show_email'] === 'yes' ) : ?>
                    <div class="mtforms-form-group mtforms-field-email">
						<?php if ( $settings['show_labels'] === 'yes' ) : ?>
                            <label for="mtforms_email_<?php echo esc_attr( $unique_id ); ?>">
								<?php if ( $settings['show_icons'] === 'yes' ) : ?>
                                    <span class="mtforms-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" /></svg></span>
								<?php endif; ?>
								<?php echo esc_html( $settings['label_email'] ); ?> <span class="required">*</span>
                            </label>
						<?php endif; ?>
                        <div class="mtforms-input-wrap">
							<?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                                <span class="mtforms-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" /></svg></span>
							<?php endif; ?>
                            <input type="email" name="mtforms_email" id="mtforms_email_<?php echo esc_attr( $unique_id ); ?>" class="mtforms-input mtforms-input-email"
								<?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                                    placeholder="<?php echo esc_attr( $settings['placeholder_email'] ); ?>"
								<?php endif; ?>
                                   required>
							<?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                                <label class="mtforms-floating-label" for="mtforms_email_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_email'] ); ?> <span class="required">*</span></label>
							<?php endif; ?>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $settings['show_phone'] === 'yes' ) : ?>
                    <div class="mtforms-form-group mtforms-field-phone">
						<?php if ( $settings['show_labels'] === 'yes' ) : ?>
                            <label for="mtforms_phone_<?php echo esc_attr( $unique_id ); ?>">
								<?php if ( $settings['show_icons'] === 'yes' ) : ?>
                                    <span class="mtforms-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" /></svg></span>
								<?php endif; ?>
								<?php echo esc_html( $settings['label_phone'] ); ?>
                            </label>
						<?php endif; ?>
                        <div class="mtforms-input-wrap">
							<?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                                <span class="mtforms-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" /></svg></span>
							<?php endif; ?>
                            <input type="tel" name="mtforms_phone" id="mtforms_phone_<?php echo esc_attr( $unique_id ); ?>" class="mtforms-input mtforms-input-phone"
								<?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                                    placeholder="<?php echo esc_attr( $settings['placeholder_phone'] ); ?>"
								<?php endif; ?>>
							<?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                                <label class="mtforms-floating-label" for="mtforms_phone_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_phone'] ); ?></label>
							<?php endif; ?>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $settings['show_website'] === 'yes' ) : ?>
                    <div class="mtforms-form-group mtforms-field-website">
						<?php if ( $settings['show_labels'] === 'yes' ) : ?>
                            <label for="mtforms_website_<?php echo esc_attr( $unique_id ); ?>">
								<?php if ( $settings['show_icons'] === 'yes' ) : ?>
                                    <span class="mtforms-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2 0 .68.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c.96-1.66 2.49-2.93 4.33-3.56C8.81 5.55 8.35 6.75 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2 0-.68.07-1.35.16-2h4.68c.09.65.16 1.32.16 2 0 .68-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2 0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z" /></svg></span>
								<?php endif; ?>
								<?php echo esc_html( $settings['label_website'] ); ?>
                            </label>
						<?php endif; ?>
                        <div class="mtforms-input-wrap">
							<?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                                <span class="mtforms-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2z" /></svg></span>
							<?php endif; ?>
                            <input type="url" name="mtforms_website" id="mtforms_website_<?php echo esc_attr( $unique_id ); ?>" class="mtforms-input mtforms-input-website"
								<?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                                    placeholder="<?php echo esc_attr( $settings['placeholder_website'] ); ?>"
								<?php endif; ?>>
							<?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                                <label class="mtforms-floating-label" for="mtforms_website_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_website'] ); ?></label>
							<?php endif; ?>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $settings['show_subject'] === 'yes' ) : ?>
                    <div class="mtforms-form-group mtforms-field-subject">
						<?php if ( $settings['show_labels'] === 'yes' ) : ?>
                            <label for="mtforms_subject_<?php echo esc_attr( $unique_id ); ?>">
								<?php if ( $settings['show_icons'] === 'yes' ) : ?>
                                    <span class="mtforms-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" /></svg></span>
								<?php endif; ?>
								<?php echo esc_html( $settings['label_subject'] ); ?>
                            </label>
						<?php endif; ?>
                        <div class="mtforms-input-wrap">
							<?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                                <span class="mtforms-field-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6z" /></svg></span>
							<?php endif; ?>
                            <input type="text" name="mtforms_subject" id="mtforms_subject_<?php echo esc_attr( $unique_id ); ?>" class="mtforms-input mtforms-input-subject"
								<?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                                    placeholder="<?php echo esc_attr( $settings['placeholder_subject'] ); ?>"
								<?php endif; ?>>
							<?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                                <label class="mtforms-floating-label" for="mtforms_subject_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_subject'] ); ?></label>
							<?php endif; ?>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $settings['show_message'] === 'yes' ) : ?>
                    <div class="mtforms-form-group mtforms-field-message">
						<?php if ( $settings['show_labels'] === 'yes' ) : ?>
                            <label for="mtforms_message_<?php echo esc_attr( $unique_id ); ?>">
								<?php if ( $settings['show_icons'] === 'yes' ) : ?>
                                    <span class="mtforms-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z" /></svg></span>
								<?php endif; ?>
								<?php echo esc_html( $settings['label_message'] ); ?> <span class="required">*</span>
                            </label>
						<?php endif; ?>
                        <div class="mtforms-input-wrap">
							<?php if ( $settings['show_icons'] === 'yes' && $settings['show_labels'] !== 'yes' ) : ?>
                                <span class="mtforms-field-icon mtforms-field-icon-textarea"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" /></svg></span>
							<?php endif; ?>
                            <textarea name="mtforms_message" id="mtforms_message_<?php echo esc_attr( $unique_id ); ?>" class="mtforms-textarea mtforms-input-message" rows="<?php echo esc_attr( $settings['textarea_rows'] ); ?>"
                                  <?php if ( $settings['show_placeholders'] === 'yes' ) : ?>
                                      placeholder="<?php echo esc_attr( $settings['placeholder_message'] ); ?>"
                                  <?php endif; ?>
                                  required></textarea>
							<?php if ( $settings['layout'] === 'floating' || $settings['layout'] === 'material' ) : ?>
                                <label class="mtforms-floating-label" for="mtforms_message_<?php echo esc_attr( $unique_id ); ?>"><?php echo esc_html( $settings['label_message'] ); ?> <span class="required">*</span></label>
							<?php endif; ?>
                        </div>
                    </div>
				<?php endif; ?>

				<?php if ( $settings['show_gdpr'] === 'yes' ) : ?>
                    <input type="hidden" name="mtforms_gdpr_enabled" value="yes">
                    <div class="mtforms-form-group mtforms-gdpr-group">
                        <label class="mtforms-checkbox-label">
                            <input type="checkbox" name="mtforms_gdpr" id="mtforms_gdpr_<?php echo esc_attr( $unique_id ); ?>" required>
                            <span class="mtforms-checkbox-custom"></span>
                            <span class="mtforms-checkbox-text"><?php echo esc_html( $settings['gdpr_text'] ); ?></span>
                        </label>
                    </div>
				<?php endif; ?>

				<?php
				// Captcha (only if show_captcha is enabled)
				if ( $settings['show_captcha'] === 'yes' ) {
					$captcha_provider = get_option( 'mtforms_captcha_provider', 'none' );
					if ( $captcha_provider === 'recaptcha' ) {
						$site_key = get_option( 'mtforms_recaptcha_site_key' );
						if ( ! empty( $site_key ) ) {
							echo '<div class="mtforms-captcha-wrap"><div class="g-recaptcha" data-sitekey="' . esc_attr( $site_key ) . '"></div></div>';
						}
					} else if ( $captcha_provider === 'turnstile' ) {
						$site_key = get_option( 'mtforms_turnstile_site_key' );
						if ( ! empty( $site_key ) ) {
							echo '<div class="mtforms-captcha-wrap"><div class="cf-turnstile" data-sitekey="' . esc_attr( $site_key ) . '"></div></div>';
						}
					}
				}
				?>

                <div class="mtforms-form-actions mtforms-button-align-<?php echo esc_attr( $settings['button_align'] ); ?>">
                    <button type="submit" class="mtforms-submit-btn<?php echo ! empty( $settings['button_hover_class'] ) ? ' ' . esc_attr( $settings['button_hover_class'] ) : ''; ?>">
						<?php if ( $settings['button_icon'] !== 'none' && $settings['button_icon_position'] === 'left' ) : ?>
                            <span class="mtforms-btn-icon mtforms-btn-icon-left">
                            <?php echo self::get_button_icon( $settings['button_icon'] ); ?>
                        </span>
						<?php endif; ?>
                        <span class="mtforms-btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
						<?php if ( $settings['button_icon'] !== 'none' && $settings['button_icon_position'] === 'right' ) : ?>
                            <span class="mtforms-btn-icon mtforms-btn-icon-right">
                            <?php echo self::get_button_icon( $settings['button_icon'] ); ?>
                        </span>
						<?php endif; ?>
                        <span class="mtforms-spinner"></span>
                    </button>
                </div>

                <div class="mtforms-response-message"></div>

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
			'send'        => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>',
			'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>',
			'check'       => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>',
			'mail'        => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
		);

		return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
	}

	/**
	 * Get available button icons
	 */
	public static function get_button_icons() {
		return array(
			'none'        => __( 'None', MTFORMS_TEXT_DOMAIN ),
			'send'        => __( 'Send', MTFORMS_TEXT_DOMAIN ),
			'arrow-right' => __( 'Arrow Right', MTFORMS_TEXT_DOMAIN ),
			'check'       => __( 'Check', MTFORMS_TEXT_DOMAIN ),
			'mail'        => __( 'Mail', MTFORMS_TEXT_DOMAIN ),
		);
	}

}
