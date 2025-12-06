<?php

/**
 * Provide a admin area view for the plugin
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    MT_Contact_Forms
 * @subpackage MT_Contact_Forms/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
$active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
?>

<div class="wrap mtcf-admin-wrap">
    <h1 class="wp-heading-inline">
        <span class="dashicons dashicons-email"
            style="font-size: 30px; width: 30px; height: 30px; margin-right: 10px;"></span>
        <?php esc_html_e('MT Contact Forms', 'mt-contact-forms'); ?>
        <span
            style="font-size: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 3px 10px; border-radius: 12px; margin-left: 10px; font-weight: normal;">v1.1.0</span>
    </h1>
    <hr class="wp-header-end">

    <nav class="nav-tab-wrapper mtcf-nav-tab-wrapper">
        <a href="?page=mt-contact-forms&tab=general"
            class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('General', 'mt-contact-forms'); ?></a>
        <a href="?page=mt-contact-forms&tab=recaptcha"
            class="nav-tab <?php echo $active_tab == 'recaptcha' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Google reCAPTCHA', 'mt-contact-forms'); ?></a>
        <a href="?page=mt-contact-forms&tab=turnstile"
            class="nav-tab <?php echo $active_tab == 'turnstile' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Turnstile', 'mt-contact-forms'); ?></a>
        <a href="?page=mt-contact-forms&tab=docs"
            class="nav-tab <?php echo $active_tab == 'docs' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Documentation', 'mt-contact-forms'); ?></a>
    </nav>

    <div class="mtcf-tab-content">

        <?php if ($active_tab == 'general'): ?>
            <div class="card mtcf-card">
                <h2><?php esc_html_e('General Settings', 'mt-contact-forms'); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtcf_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('Captcha Provider', 'mt-contact-forms'); ?></th>
                            <td>
                                <select name="mtcf_captcha_provider" id="mtcf_captcha_provider">
                                    <option value="none" <?php selected(get_option('mtcf_captcha_provider'), 'none'); ?>>
                                        <?php esc_html_e('None', 'mt-contact-forms'); ?></option>
                                    <option value="recaptcha" <?php selected(get_option('mtcf_captcha_provider'), 'recaptcha'); ?>><?php esc_html_e('Google reCAPTCHA v2', 'mt-contact-forms'); ?>
                                    </option>
                                    <option value="turnstile" <?php selected(get_option('mtcf_captcha_provider'), 'turnstile'); ?>><?php esc_html_e('Cloudflare Turnstile', 'mt-contact-forms'); ?>
                                    </option>
                                </select>
                                <p class="description">
                                    <?php esc_html_e('Select the validation service you want to use to prevent spam.', 'mt-contact-forms'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>

        <?php elseif ($active_tab == 'recaptcha'): ?>
            <div class="card mtcf-card">
                <h2><?php esc_html_e('Google reCAPTCHA v2', 'mt-contact-forms'); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtcf_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('Site Key', 'mt-contact-forms'); ?></th>
                            <td><input type="text" name="mtcf_recaptcha_site_key"
                                    value="<?php echo esc_attr(get_option('mtcf_recaptcha_site_key')); ?>"
                                    class="regular-text" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('Secret Key', 'mt-contact-forms'); ?></th>
                            <td><input type="password" name="mtcf_recaptcha_secret_key"
                                    value="<?php echo esc_attr(get_option('mtcf_recaptcha_secret_key')); ?>"
                                    class="regular-text" /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>

        <?php elseif ($active_tab == 'turnstile'): ?>
            <div class="card mtcf-card">
                <h2><?php esc_html_e('Cloudflare Turnstile', 'mt-contact-forms'); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtcf_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('Site Key', 'mt-contact-forms'); ?></th>
                            <td><input type="text" name="mtcf_turnstile_site_key"
                                    value="<?php echo esc_attr(get_option('mtcf_turnstile_site_key')); ?>"
                                    class="regular-text" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('Secret Key', 'mt-contact-forms'); ?></th>
                            <td><input type="password" name="mtcf_turnstile_secret_key"
                                    value="<?php echo esc_attr(get_option('mtcf_turnstile_secret_key')); ?>"
                                    class="regular-text" /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>

        <?php else: ?>

            <div class="mtcf-docs-grid">
                <!-- Getting Started -->
                <div class="card mtcf-card mtcf-card-full">
                    <h2>🚀 <?php esc_html_e('Getting Started', 'mt-contact-forms'); ?></h2>
                    <p class="mtcf-intro">
                        <?php esc_html_e('Welcome to MT Contact Forms! Create beautiful, customizable contact forms with multiple preset skins and extensive styling options.', 'mt-contact-forms'); ?>
                    </p>
                </div>

                <!-- Shortcode Usage -->
                <div class="card mtcf-card">
                    <h3>📝 <?php esc_html_e('Shortcode Usage', 'mt-contact-forms'); ?></h3>
                    <p><?php esc_html_e('Add a form to any page using shortcodes:', 'mt-contact-forms'); ?></p>

                    <h4><?php esc_html_e('Basic Usage', 'mt-contact-forms'); ?></h4>
                    <div class="mtcf-code-block">
                        <code>[mtcf_form]</code>
                    </div>

                    <h4><?php esc_html_e('With Skin', 'mt-contact-forms'); ?></h4>
                    <div class="mtcf-code-block">
                        <code>[mtcf_form skin="modern"]</code>
                    </div>

                    <h4><?php esc_html_e('Full Customization', 'mt-contact-forms'); ?></h4>
                    <div class="mtcf-code-block">
                        <code>[mtcf_form skin="dark" layout="floating" button_style="gradient" show_phone="yes"]</code>
                    </div>
                </div>

                <!-- Available Skins -->
                <div class="card mtcf-card">
                    <h3>🎨 <?php esc_html_e('Available Skins', 'mt-contact-forms'); ?></h3>
                    <div class="mtcf-feature-grid">
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">🔵</span>
                            <strong>default</strong>
                            <span><?php esc_html_e('Clean blue theme', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">💜</span>
                            <strong>modern</strong>
                            <span><?php esc_html_e('Purple gradient', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">🌙</span>
                            <strong>dark</strong>
                            <span><?php esc_html_e('Dark mode', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">🌈</span>
                            <strong>gradient</strong>
                            <span><?php esc_html_e('Colorful gradient', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">✨</span>
                            <strong>glassmorphism</strong>
                            <span><?php esc_html_e('Frosted glass effect', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">⚪</span>
                            <strong>minimal</strong>
                            <span><?php esc_html_e('Clean minimal', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">🃏</span>
                            <strong>card</strong>
                            <span><?php esc_html_e('Card style', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">💚</span>
                            <strong>neon</strong>
                            <span><?php esc_html_e('Neon glow', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">🏆</span>
                            <strong>elegant</strong>
                            <span><?php esc_html_e('Premium elegant', 'mt-contact-forms'); ?></span>
                        </div>
                        <div class="mtcf-feature">
                            <span class="mtcf-feature-icon">⬛</span>
                            <strong>brutalist</strong>
                            <span><?php esc_html_e('Bold brutalist', 'mt-contact-forms'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Layouts -->
                <div class="card mtcf-card">
                    <h3>📐 <?php esc_html_e('Form Layouts', 'mt-contact-forms'); ?></h3>
                    <table class="mtcf-options-table">
                        <tr>
                            <td><code>stacked</code></td>
                            <td><?php esc_html_e('Labels above inputs (default)', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>inline</code></td>
                            <td><?php esc_html_e('Labels beside inputs', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>floating</code></td>
                            <td><?php esc_html_e('Floating animated labels', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>material</code></td>
                            <td><?php esc_html_e('Material Design style', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>side-by-side</code></td>
                            <td><?php esc_html_e('Two columns layout', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>compact</code></td>
                            <td><?php esc_html_e('Smaller padding and fonts', 'mt-contact-forms'); ?></td>
                        </tr>
                    </table>
                </div>

                <!-- Button Styles -->
                <div class="card mtcf-card">
                    <h3>🔘 <?php esc_html_e('Button Styles', 'mt-contact-forms'); ?></h3>
                    <table class="mtcf-options-table">
                        <tr>
                            <td><code>solid</code></td>
                            <td><?php esc_html_e('Solid background', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>outline</code></td>
                            <td><?php esc_html_e('Border only', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>gradient</code></td>
                            <td><?php esc_html_e('Gradient background', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>glow</code></td>
                            <td><?php esc_html_e('Glowing shadow', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>pill</code></td>
                            <td><?php esc_html_e('Rounded pill shape', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>3d</code></td>
                            <td><?php esc_html_e('3D pressed effect', 'mt-contact-forms'); ?></td>
                        </tr>
                    </table>
                </div>

                <!-- Input Styles -->
                <div class="card mtcf-card">
                    <h3>📄 <?php esc_html_e('Input Styles', 'mt-contact-forms'); ?></h3>
                    <table class="mtcf-options-table">
                        <tr>
                            <td><code>default</code></td>
                            <td><?php esc_html_e('Standard bordered', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>underline</code></td>
                            <td><?php esc_html_e('Bottom border only', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>rounded</code></td>
                            <td><?php esc_html_e('Rounded corners', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>pill</code></td>
                            <td><?php esc_html_e('Pill shape', 'mt-contact-forms'); ?></td>
                        </tr>
                        <tr>
                            <td><code>shadow</code></td>
                            <td><?php esc_html_e('No border with shadow', 'mt-contact-forms'); ?></td>
                        </tr>
                    </table>
                </div>

                <!-- Shortcode Parameters -->
                <div class="card mtcf-card mtcf-card-full">
                    <h3>⚙️ <?php esc_html_e('All Shortcode Parameters', 'mt-contact-forms'); ?></h3>
                    <table class="mtcf-params-table widefat">
                        <thead>
                            <tr>
                                <th><?php esc_html_e('Parameter', 'mt-contact-forms'); ?></th>
                                <th><?php esc_html_e('Default', 'mt-contact-forms'); ?></th>
                                <th><?php esc_html_e('Description', 'mt-contact-forms'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>skin</code></td>
                                <td>default</td>
                                <td><?php esc_html_e('Form skin/theme', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>layout</code></td>
                                <td>stacked</td>
                                <td><?php esc_html_e('Form layout style', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>animation</code></td>
                                <td>none</td>
                                <td><?php esc_html_e('Entry animation (fade-in, slide-up, zoom-in, bounce)', 'mt-contact-forms'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><code>show_name</code></td>
                                <td>yes</td>
                                <td><?php esc_html_e('Show/hide name field', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>show_email</code></td>
                                <td>yes</td>
                                <td><?php esc_html_e('Show/hide email field', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>show_phone</code></td>
                                <td>no</td>
                                <td><?php esc_html_e('Show/hide phone field', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>show_website</code></td>
                                <td>no</td>
                                <td><?php esc_html_e('Show/hide website field', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>show_subject</code></td>
                                <td>yes</td>
                                <td><?php esc_html_e('Show/hide subject field', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>show_message</code></td>
                                <td>yes</td>
                                <td><?php esc_html_e('Show/hide message field', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>show_gdpr</code></td>
                                <td>yes</td>
                                <td><?php esc_html_e('Show/hide GDPR consent', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>show_labels</code></td>
                                <td>yes</td>
                                <td><?php esc_html_e('Show/hide field labels', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>show_icons</code></td>
                                <td>no</td>
                                <td><?php esc_html_e('Show field icons', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>button_text</code></td>
                                <td>Send Message</td>
                                <td><?php esc_html_e('Submit button text', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>button_style</code></td>
                                <td>solid</td>
                                <td><?php esc_html_e('Button appearance', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>button_icon</code></td>
                                <td>none</td>
                                <td><?php esc_html_e('Button icon (send, arrow-right, check, mail)', 'mt-contact-forms'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><code>input_style</code></td>
                                <td>default</td>
                                <td><?php esc_html_e('Input field style', 'mt-contact-forms'); ?></td>
                            </tr>
                            <tr>
                                <td><code>input_size</code></td>
                                <td>medium</td>
                                <td><?php esc_html_e('Input size (small, medium, large)', 'mt-contact-forms'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Elementor & Gutenberg -->
                <div class="card mtcf-card">
                    <h3>🎯 <?php esc_html_e('Elementor Widget', 'mt-contact-forms'); ?></h3>
                    <p><?php printf(esc_html__('In Elementor, search for %s and drag it to your page. All customization options are available in the sidebar!', 'mt-contact-forms'), '<strong>"MT Contact Form"</strong>'); ?>
                    </p>
                    <ul style="margin-left: 20px;">
                        <li>✅ <?php esc_html_e('50+ styling controls', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Typography controls', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Color pickers', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Spacing & dimensions', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Box shadows & borders', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Hover animations', 'mt-contact-forms'); ?></li>
                    </ul>
                </div>

                <div class="card mtcf-card">
                    <h3>📦 <?php esc_html_e('Gutenberg Block', 'mt-contact-forms'); ?></h3>
                    <p><?php printf(esc_html__('In the Block Editor, add the %s block. Configure all settings in the block sidebar.', 'mt-contact-forms'), '<strong>"MT Contact Form"</strong>'); ?>
                    </p>
                    <ul style="margin-left: 20px;">
                        <li>✅ <?php esc_html_e('Full preset support', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Layout selection', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Field toggles', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Custom labels & placeholders', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Button customization', 'mt-contact-forms'); ?></li>
                        <li>✅ <?php esc_html_e('Success/error messages', 'mt-contact-forms'); ?></li>
                    </ul>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>

<style>
    .mtcf-admin-wrap {
        max-width: 1200px;
    }

    .mtcf-docs-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 20px;
    }

    .mtcf-docs-grid .mtcf-card-full {
        grid-column: span 2;
    }

    .mtcf-card {
        padding: 20px 25px;
    }

    .mtcf-card h2 {
        margin-top: 0;
    }

    .mtcf-card h3 {
        margin-top: 0;
        font-size: 16px;
    }

    .mtcf-intro {
        font-size: 15px;
        color: #555;
    }

    .mtcf-code-block {
        background: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px 15px;
        margin: 10px 0;
        font-family: monospace;
    }

    .mtcf-code-block code {
        background: none;
        padding: 0;
    }

    .mtcf-options-table {
        width: 100%;
        border-collapse: collapse;
    }

    .mtcf-options-table td {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    .mtcf-options-table td:first-child {
        width: 120px;
    }

    .mtcf-params-table {
        margin-top: 15px;
    }

    .mtcf-params-table th {
        text-align: left;
        background: #f5f5f5;
    }

    .mtcf-params-table td,
    .mtcf-params-table th {
        padding: 10px;
    }

    .mtcf-feature-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .mtcf-feature {
        display: flex;
        flex-direction: column;
        background: #f9f9f9;
        padding: 10px;
        border-radius: 6px;
    }

    .mtcf-feature-icon {
        margin-right: 8px;
    }

    .mtcf-feature strong {
        font-size: 13px;
    }

    .mtcf-feature span:last-child {
        font-size: 11px;
        color: #666;
    }

    @media (max-width: 782px) {
        .mtcf-docs-grid {
            grid-template-columns: 1fr;
        }

        .mtcf-docs-grid .mtcf-card-full {
            grid-column: span 1;
        }
    }
</style>