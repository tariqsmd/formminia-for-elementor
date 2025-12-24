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
$active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
?>

<div class="wrap mtforms-admin-wrap">
    <h1 class="wp-heading-inline">
        <span class="dashicons dashicons-email"
            style="font-size: 30px; width: 30px; height: 30px; margin-right: 10px;"></span>
        <?php esc_html_e('MTForms', MTFORMS_TEXT_DOMAIN); ?>
        <span
            style="font-size: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 3px 10px; border-radius: 12px; margin-left: 10px; font-weight: normal;">v1.1.0</span>
    </h1>
    <hr class="wp-header-end">

    <nav class="nav-tab-wrapper mtforms-nav-tab-wrapper">
        <a href="?page=mtforms&tab=general"
            class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('General', MTFORMS_TEXT_DOMAIN); ?>
        </a>
        <a href="?page=mtforms&tab=recaptcha"
            class="nav-tab <?php echo $active_tab == 'recaptcha' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Google reCAPTCHA', MTFORMS_TEXT_DOMAIN); ?>
        </a>
        <a href="?page=mtforms&tab=turnstile"
            class="nav-tab <?php echo $active_tab == 'turnstile' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Turnstile', MTFORMS_TEXT_DOMAIN); ?>
        </a>
        <a href="?page=mtforms&tab=email" class="nav-tab <?php echo $active_tab == 'email' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Email Settings', MTFORMS_TEXT_DOMAIN); ?>
        </a>
    </nav>

    <div class="mtforms-tab-content">

        <?php if ($active_tab == 'general'): ?>
            <div class="card mtforms-card">
                <h2>
                    <?php esc_html_e('General Settings', MTFORMS_TEXT_DOMAIN); ?>
                </h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtforms_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Captcha Provider', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td>
                                <select name="mtforms_captcha_provider" id="mtforms_captcha_provider">
                                    <option value="none" <?php selected(get_option('mtforms_captcha_provider'), 'none'); ?>>
                                        <?php esc_html_e('None', MTFORMS_TEXT_DOMAIN); ?>
                                    </option>
                                    <option value="recaptcha" <?php selected(get_option('mtforms_captcha_provider'), 'recaptcha'); ?>>
                                        <?php esc_html_e('Google reCAPTCHA v2', MTFORMS_TEXT_DOMAIN); ?>
                                    </option>
                                    <option value="turnstile" <?php selected(get_option('mtforms_captcha_provider'), 'turnstile'); ?>>
                                        <?php esc_html_e('Cloudflare Turnstile', MTFORMS_TEXT_DOMAIN); ?>
                                    </option>
                                </select>
                                <p class="description">
                                    <?php esc_html_e('Select the validation service you want to use to prevent spam.', MTFORMS_TEXT_DOMAIN); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>

        <?php elseif ($active_tab == 'recaptcha'): ?>
            <div class="card mtforms-card">
                <h2>
                    <?php esc_html_e('Google reCAPTCHA v2', MTFORMS_TEXT_DOMAIN); ?>
                </h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtforms_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Site Key', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td><input type="text" name="mtforms_recaptcha_site_key"
                                    value="<?php echo esc_attr(get_option('mtforms_recaptcha_site_key')); ?>"
                                    class="regular-text" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Secret Key', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td><input type="password" name="mtforms_recaptcha_secret_key"
                                    value="<?php echo esc_attr(get_option('mtforms_recaptcha_secret_key')); ?>"
                                    class="regular-text" /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>

        <?php elseif ($active_tab == 'turnstile'): ?>
            <div class="card mtforms-card">
                <h2>
                    <?php esc_html_e('Cloudflare Turnstile', MTFORMS_TEXT_DOMAIN); ?>
                </h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtforms_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Site Key', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td><input type="text" name="mtforms_turnstile_site_key"
                                    value="<?php echo esc_attr(get_option('mtforms_turnstile_site_key')); ?>"
                                    class="regular-text" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Secret Key', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td><input type="password" name="mtforms_turnstile_secret_key"
                                    value="<?php echo esc_attr(get_option('mtforms_turnstile_secret_key')); ?>"
                                    class="regular-text" /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
        <?php elseif ($active_tab == 'email'): ?>
            <div class="card mtforms-card">
                <h2>
                    <?php esc_html_e('Email Settings', MTFORMS_TEXT_DOMAIN); ?>
                </h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtforms_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Recipient Email', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td>
                                <input type="email" name="mtforms_admin_email"
                                    value="<?php echo esc_attr(get_option('mtforms_admin_email', get_option('admin_email'))); ?>"
                                    class="regular-text" />
                                <p class="description">
                                    <?php esc_html_e('The email address where form submissions will be sent. Defaults to WordPress admin email.', MTFORMS_TEXT_DOMAIN); ?>
                                </p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Default Subject', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td>
                                <input type="text" name="mtforms_email_subject"
                                    value="<?php echo esc_attr(get_option('mtforms_email_subject', 'New Contact Form Submission')); ?>"
                                    class="regular-text" />
                                <p class="description">
                                    <?php esc_html_e('The subject line used for notification emails.', MTFORMS_TEXT_DOMAIN); ?>
                                </p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('From Name', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td>
                                <input type="text" name="mtforms_email_from_name"
                                    value="<?php echo esc_attr(get_option('mtforms_email_from_name', get_bloginfo('name'))); ?>"
                                    class="regular-text" />
                                <p class="description">
                                    <?php esc_html_e('The name that appears in the "From" field of the email.', MTFORMS_TEXT_DOMAIN); ?>
                                </p>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Enable HTML Template', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td>
                                <label class="mtforms-switch">
                                    <input type="checkbox" name="mtforms_enable_html_email" value="yes" <?php checked(get_option('mtforms_enable_html_email', 'yes'), 'yes'); ?>>
                                    <span class="mtforms-slider round"></span>
                                </label>
                                <p class="description">
                                    <?php esc_html_e('Use the professional HTML email template for notifications.', MTFORMS_TEXT_DOMAIN); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>


            <!-- Elementor Widget -->
            <div class="card mtforms-card">
                <h3>🎯
                    <?php esc_html_e('Elementor Widget', MTFORMS_TEXT_DOMAIN); ?>
                </h3>
                <p>
                    <?php printf(esc_html__('In Elementor, search for %s and drag it to your page. All customization options are available in the sidebar!', MTFORMS_TEXT_DOMAIN), '<strong>"MTForms"</strong>'); ?>
                </p>
                <ul style="margin-left: 20px;">
                    <li>✅
                        <?php esc_html_e('50+ styling controls', MTFORMS_TEXT_DOMAIN); ?>
                    </li>
                    <li>✅
                        <?php esc_html_e('Typography controls', MTFORMS_TEXT_DOMAIN); ?>
                    </li>
                    <li>✅
                        <?php esc_html_e('Color pickers', MTFORMS_TEXT_DOMAIN); ?>
                    </li>
                    <li>✅
                        <?php esc_html_e('Spacing & dimensions', MTFORMS_TEXT_DOMAIN); ?>
                    </li>
                    <li>✅
                        <?php esc_html_e('Box shadows & borders', MTFORMS_TEXT_DOMAIN); ?>
                    </li>
                    <li>✅
                        <?php esc_html_e('Hover animations', MTFORMS_TEXT_DOMAIN); ?>
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