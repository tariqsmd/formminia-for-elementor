<?php

/**
 * Provide a admin area view for the plugin
 *
 * @link       https://developer.developer.developer
 * @since      1.0.0
 *
 * @package    MTForms
 * @subpackage MTForms/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'general';
?>

<div class="wrap mtforms-admin-wrap">
    <h1 class="wp-heading-inline">
        <span class="dashicons dashicons-email" style="font-size: 30px; width: 30px; height: 30px; margin-right: 10px;"></span>
		<?php esc_html_e( 'MTForms', MTFORMS_TEXT_DOMAIN ); ?>
        <span style="font-size: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 3px 10px; border-radius: 12px; margin-left: 10px; font-weight: normal;">v1.1.0</span>
    </h1>
    <hr class="wp-header-end">

    <nav class="nav-tab-wrapper mtforms-nav-tab-wrapper">
        <a href="?page=mtforms&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
			<?php esc_html_e( 'General', MTFORMS_TEXT_DOMAIN ); ?>
        </a>
        <a href="?page=mtforms&tab=recaptcha" class="nav-tab <?php echo $active_tab == 'recaptcha' ? 'nav-tab-active' : ''; ?>">
			<?php esc_html_e( 'Google reCAPTCHA', MTFORMS_TEXT_DOMAIN ); ?>
        </a>
        <a href="?page=mtforms&tab=turnstile" class="nav-tab <?php echo $active_tab == 'turnstile' ? 'nav-tab-active' : ''; ?>">
			<?php esc_html_e( 'Turnstile', MTFORMS_TEXT_DOMAIN ); ?>
        </a>
        <a href="?page=mtforms&tab=docs" class="nav-tab <?php echo $active_tab == 'docs' ? 'nav-tab-active' : ''; ?>">
			<?php esc_html_e( 'Documentation', MTFORMS_TEXT_DOMAIN ); ?>
        </a>
    </nav>

    <div class="mtforms-tab-content">

		<?php if ( $active_tab == 'general' ): ?>
            <div class="card mtforms-card">
                <h2>
					<?php esc_html_e( 'General Settings', MTFORMS_TEXT_DOMAIN ); ?>
                </h2>
                <form method="post" action="options.php">
					<?php settings_fields( 'mtforms_settings' ); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
								<?php esc_html_e( 'Captcha Provider', MTFORMS_TEXT_DOMAIN ); ?>
                            </th>
                            <td>
                                <select name="mtforms_captcha_provider" id="mtforms_captcha_provider">
                                    <option value="none" <?php selected( get_option( 'mtforms_captcha_provider' ), 'none' ); ?>>
										<?php esc_html_e( 'None', MTFORMS_TEXT_DOMAIN ); ?>
                                    </option>
                                    <option value="recaptcha" <?php selected( get_option( 'mtforms_captcha_provider' ), 'recaptcha' ); ?>>
										<?php esc_html_e( 'Google reCAPTCHA v2', MTFORMS_TEXT_DOMAIN ); ?>
                                    </option>
                                    <option value="turnstile" <?php selected( get_option( 'mtforms_captcha_provider' ), 'turnstile' ); ?>>
										<?php esc_html_e( 'Cloudflare Turnstile', MTFORMS_TEXT_DOMAIN ); ?>
                                    </option>
                                </select>
                                <p class="description">
									<?php esc_html_e( 'Select the validation service you want to use to prevent spam.', MTFORMS_TEXT_DOMAIN ); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
					<?php submit_button(); ?>
                </form>
            </div>

		<?php elseif ( $active_tab == 'recaptcha' ): ?>
            <div class="card mtforms-card">
                <h2>
					<?php esc_html_e( 'Google reCAPTCHA v2', MTFORMS_TEXT_DOMAIN ); ?>
                </h2>
                <form method="post" action="options.php">
					<?php settings_fields( 'mtforms_settings' ); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
								<?php esc_html_e( 'Site Key', MTFORMS_TEXT_DOMAIN ); ?>
                            </th>
                            <td><input type="text" name="mtforms_recaptcha_site_key" value="<?php echo esc_attr( get_option( 'mtforms_recaptcha_site_key' ) ); ?>" class="regular-text" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
								<?php esc_html_e( 'Secret Key', MTFORMS_TEXT_DOMAIN ); ?>
                            </th>
                            <td><input type="password" name="mtforms_recaptcha_secret_key" value="<?php echo esc_attr( get_option( 'mtforms_recaptcha_secret_key' ) ); ?>" class="regular-text" /></td>
                        </tr>
                    </table>
					<?php submit_button(); ?>
                </form>
            </div>

		<?php elseif ( $active_tab == 'turnstile' ): ?>
            <div class="card mtforms-card">
                <h2>
					<?php esc_html_e( 'Cloudflare Turnstile', MTFORMS_TEXT_DOMAIN ); ?>
                </h2>
                <form method="post" action="options.php">
					<?php settings_fields( 'mtforms_settings' ); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
								<?php esc_html_e( 'Site Key', MTFORMS_TEXT_DOMAIN ); ?>
                            </th>
                            <td><input type="text" name="mtforms_turnstile_site_key" value="<?php echo esc_attr( get_option( 'mtforms_turnstile_site_key' ) ); ?>" class="regular-text" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
								<?php esc_html_e( 'Secret Key', MTFORMS_TEXT_DOMAIN ); ?>
                            </th>
                            <td><input type="password" name="mtforms_turnstile_secret_key" value="<?php echo esc_attr( get_option( 'mtforms_turnstile_secret_key' ) ); ?>" class="regular-text" /></td>
                        </tr>
                    </table>
					<?php submit_button(); ?>
                </form>
            </div>

		<?php else: ?>

            <div class="mtforms-docs-grid">
                <!-- Getting Started -->
                <div class="card mtforms-card mtforms-card-full">
                    <h2>🚀
						<?php esc_html_e( 'Getting Started', MTFORMS_TEXT_DOMAIN ); ?>
                    </h2>
                    <p class="mtforms-intro">
						<?php esc_html_e( 'Welcome to MTForms! Create beautiful, customizable contact forms with multiple preset skins and extensive styling options.', MTFORMS_TEXT_DOMAIN ); ?>
                    </p>
                </div>

                <!-- Shortcode Usage -->
                <div class="card mtforms-card">
                    <h3>📝
						<?php esc_html_e( 'Shortcode Usage', MTFORMS_TEXT_DOMAIN ); ?>
                    </h3>
                    <p>
						<?php esc_html_e( 'Add a form to any page using shortcodes:', MTFORMS_TEXT_DOMAIN ); ?>
                    </p>

                    <h4>
						<?php esc_html_e( 'Basic Usage', MTFORMS_TEXT_DOMAIN ); ?>
                    </h4>
                    <div class="mtforms-code-block">
                        <code>[mtforms]</code>
                    </div>

                    <h4>
						<?php esc_html_e( 'With Skin', MTFORMS_TEXT_DOMAIN ); ?>
                    </h4>
                    <div class="mtforms-code-block">
                        <code>[mtforms skin="modern"]</code>
                    </div>

                    <h4>
						<?php esc_html_e( 'Full Customization', MTFORMS_TEXT_DOMAIN ); ?>
                    </h4>
                    <div class="mtforms-code-block">
                        <code>[mtforms skin="dark" layout="floating" button_style="gradient" show_phone="yes"]</code>
                    </div>
                </div>

                <!-- Available Skins -->
                <div class="card mtforms-card">
                    <h3>🎨
						<?php esc_html_e( 'Available Skins', MTFORMS_TEXT_DOMAIN ); ?>
                    </h3>
                    <div class="mtforms-feature-grid">
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">🔵</span>
                            <strong>default</strong>
                            <span>
                                <?php esc_html_e( 'Clean blue theme', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">💜</span>
                            <strong>modern</strong>
                            <span>
                                <?php esc_html_e( 'Purple gradient', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">🌙</span>
                            <strong>dark</strong>
                            <span>
                                <?php esc_html_e( 'Dark mode', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">🌈</span>
                            <strong>gradient</strong>
                            <span>
                                <?php esc_html_e( 'Colorful gradient', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">✨</span>
                            <strong>glassmorphism</strong>
                            <span>
                                <?php esc_html_e( 'Frosted glass effect', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">⚪</span>
                            <strong>minimal</strong>
                            <span>
                                <?php esc_html_e( 'Clean minimal', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">🃏</span>
                            <strong>card</strong>
                            <span>
                                <?php esc_html_e( 'Card style', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">💚</span>
                            <strong>neon</strong>
                            <span>
                                <?php esc_html_e( 'Neon glow', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">🏆</span>
                            <strong>elegant</strong>
                            <span>
                                <?php esc_html_e( 'Premium elegant', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                        <div class="mtforms-feature">
                            <span class="mtforms-feature-icon">⬛</span>
                            <strong>brutalist</strong>
                            <span>
                                <?php esc_html_e( 'Bold brutalist', MTFORMS_TEXT_DOMAIN ); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Layouts -->
                <div class="card mtforms-card">
                    <h3>📐
						<?php esc_html_e( 'Form Layouts', MTFORMS_TEXT_DOMAIN ); ?>
                    </h3>
                    <table class="mtforms-options-table">
                        <tr>
                            <td><code>stacked</code></td>
                            <td>
								<?php esc_html_e( 'Labels above inputs (default)', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>inline</code></td>
                            <td>
								<?php esc_html_e( 'Labels beside inputs', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>floating</code></td>
                            <td>
								<?php esc_html_e( 'Floating animated labels', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>material</code></td>
                            <td>
								<?php esc_html_e( 'Material Design style', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>side-by-side</code></td>
                            <td>
								<?php esc_html_e( 'Two columns layout', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>compact</code></td>
                            <td>
								<?php esc_html_e( 'Smaller padding and fonts', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Button Styles -->
                <div class="card mtforms-card">
                    <h3>🔘
						<?php esc_html_e( 'Button Styles', MTFORMS_TEXT_DOMAIN ); ?>
                    </h3>
                    <table class="mtforms-options-table">
                        <tr>
                            <td><code>solid</code></td>
                            <td>
								<?php esc_html_e( 'Solid background', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>outline</code></td>
                            <td>
								<?php esc_html_e( 'Border only', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>gradient</code></td>
                            <td>
								<?php esc_html_e( 'Gradient background', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>glow</code></td>
                            <td>
								<?php esc_html_e( 'Glowing shadow', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>pill</code></td>
                            <td>
								<?php esc_html_e( 'Rounded pill shape', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>3d</code></td>
                            <td>
								<?php esc_html_e( '3D pressed effect', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Input Styles -->
                <div class="card mtforms-card">
                    <h3>📄
						<?php esc_html_e( 'Input Styles', MTFORMS_TEXT_DOMAIN ); ?>
                    </h3>
                    <table class="mtforms-options-table">
                        <tr>
                            <td><code>default</code></td>
                            <td>
								<?php esc_html_e( 'Standard bordered', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>underline</code></td>
                            <td>
								<?php esc_html_e( 'Bottom border only', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>rounded</code></td>
                            <td>
								<?php esc_html_e( 'Rounded corners', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>pill</code></td>
                            <td>
								<?php esc_html_e( 'Pill shape', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>shadow</code></td>
                            <td>
								<?php esc_html_e( 'No border with shadow', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Shortcode Parameters -->
                <div class="card mtforms-card mtforms-card-full">
                    <h3>⚙️
						<?php esc_html_e( 'All Shortcode Parameters', MTFORMS_TEXT_DOMAIN ); ?>
                    </h3>
                    <table class="mtforms-params-table widefat">
                        <thead>
                        <tr>
                            <th>
								<?php esc_html_e( 'Parameter', MTFORMS_TEXT_DOMAIN ); ?>
                            </th>
                            <th>
								<?php esc_html_e( 'Default', MTFORMS_TEXT_DOMAIN ); ?>
                            </th>
                            <th>
								<?php esc_html_e( 'Description', MTFORMS_TEXT_DOMAIN ); ?>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><code>skin</code></td>
                            <td>default</td>
                            <td>
								<?php esc_html_e( 'Form skin/theme', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>layout</code></td>
                            <td>stacked</td>
                            <td>
								<?php esc_html_e( 'Form layout style', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>animation</code></td>
                            <td>none</td>
                            <td>
								<?php esc_html_e( 'Entry animation (fade-in, slide-up, zoom-in, bounce)', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_name</code></td>
                            <td>yes</td>
                            <td>
								<?php esc_html_e( 'Show/hide name field', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_email</code></td>
                            <td>yes</td>
                            <td>
								<?php esc_html_e( 'Show/hide email field', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_phone</code></td>
                            <td>no</td>
                            <td>
								<?php esc_html_e( 'Show/hide phone field', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_website</code></td>
                            <td>no</td>
                            <td>
								<?php esc_html_e( 'Show/hide website field', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_subject</code></td>
                            <td>yes</td>
                            <td>
								<?php esc_html_e( 'Show/hide subject field', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_message</code></td>
                            <td>yes</td>
                            <td>
								<?php esc_html_e( 'Show/hide message field', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_gdpr</code></td>
                            <td>yes</td>
                            <td>
								<?php esc_html_e( 'Show/hide GDPR consent', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_labels</code></td>
                            <td>yes</td>
                            <td>
								<?php esc_html_e( 'Show/hide field labels', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>show_icons</code></td>
                            <td>no</td>
                            <td>
								<?php esc_html_e( 'Show field icons', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>button_text</code></td>
                            <td>Send Message</td>
                            <td>
								<?php esc_html_e( 'Submit button text', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>button_style</code></td>
                            <td>solid</td>
                            <td>
								<?php esc_html_e( 'Button appearance', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>button_icon</code></td>
                            <td>none</td>
                            <td>
								<?php esc_html_e( 'Button icon (send, arrow-right, check, mail)', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>input_style</code></td>
                            <td>default</td>
                            <td>
								<?php esc_html_e( 'Input field style', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td><code>input_size</code></td>
                            <td>medium</td>
                            <td>
								<?php esc_html_e( 'Input size (small, medium, large)', MTFORMS_TEXT_DOMAIN ); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Elementor Widget -->
                <div class="card mtforms-card">
                    <h3>🎯
						<?php esc_html_e( 'Elementor Widget', MTFORMS_TEXT_DOMAIN ); ?>
                    </h3>
                    <p>
						<?php printf( esc_html__( 'In Elementor, search for %s and drag it to your page. All customization options are available in the sidebar!', MTFORMS_TEXT_DOMAIN ), '<strong>"MTForms"</strong>' ); ?>
                    </p>
                    <ul style="margin-left: 20px;">
                        <li>✅
							<?php esc_html_e( '50+ styling controls', MTFORMS_TEXT_DOMAIN ); ?>
                        </li>
                        <li>✅
							<?php esc_html_e( 'Typography controls', MTFORMS_TEXT_DOMAIN ); ?>
                        </li>
                        <li>✅
							<?php esc_html_e( 'Color pickers', MTFORMS_TEXT_DOMAIN ); ?>
                        </li>
                        <li>✅
							<?php esc_html_e( 'Spacing & dimensions', MTFORMS_TEXT_DOMAIN ); ?>
                        </li>
                        <li>✅
							<?php esc_html_e( 'Box shadows & borders', MTFORMS_TEXT_DOMAIN ); ?>
                        </li>
                        <li>✅
							<?php esc_html_e( 'Hover animations', MTFORMS_TEXT_DOMAIN ); ?>
                        </li>
                    </ul>
                </div>

            </div>

		<?php endif; ?>

    </div>
</div>

<style>
    .mtforms-admin-wrap {
        max-width: 1200px;
    }

    .mtforms-docs-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 20px;
    }

    .mtforms-docs-grid .mtforms-card-full {
        grid-column: span 2;
    }

    .mtforms-card {
        padding: 20px 25px;
    }

    .mtforms-card h2 {
        margin-top: 0;
    }

    .mtforms-card h3 {
        margin-top: 0;
        font-size: 16px;
    }

    .mtforms-intro {
        font-size: 15px;
        color: #555;
    }

    .mtforms-code-block {
        background: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px 15px;
        margin: 10px 0;
        font-family: monospace;
    }

    .mtforms-code-block code {
        background: none;
        padding: 0;
    }

    .mtforms-options-table {
        width: 100%;
        border-collapse: collapse;
    }

    .mtforms-options-table td {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .mtforms-options-table td:first-child {
        width: 120px;
    }

    .mtforms-params-table {
        margin-top: 15px;
    }

    .mtforms-params-table th {
        text-align: left;
        background: #f5f5f5;
    }

    .mtforms-params-table td,
    .mtforms-params-table th {
        padding: 10px;
    }

    .mtforms-feature-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .mtforms-feature {
        display: flex;
        flex-direction: column;
        background: #f9f9f9;
        padding: 10px;
        border-radius: 6px;
    }

    .mtforms-feature-icon {
        margin-right: 8px;
    }

    .mtforms-feature strong {
        font-size: 13px;
    }

    .mtforms-feature span:last-child {
        font-size: 11px;
        color: #666;
    }

    @media (max-width: 782px) {
        .mtforms-docs-grid {
            grid-template-columns: 1fr;
        }

        .mtforms-docs-grid .mtforms-card-full {
            grid-column: span 1;
        }
    }
</style>