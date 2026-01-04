<?php

/**
 * Provide an admin area view for the plugin
 *
 * @package    MTForms
 */
?>

<?php
$active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';
?>

<div class="wrap mtforms-admin-wrap">
    <h1 class="wp-heading-inline">
        <span class="dashicons dashicons-email"></span>
        <?php esc_html_e('MTForms', MTFORMS_TEXT_DOMAIN); ?>
        <span class="version-tag">v<?php echo MTFORMS_VERSION; ?></span>
    </h1>

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
            <div class="mtforms-card">
                <h2><?php esc_html_e('General Settings', MTFORMS_TEXT_DOMAIN); ?></h2>
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
                                        <?php esc_html_e('None (Not recommended)', MTFORMS_TEXT_DOMAIN); ?>
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
                    <?php submit_button(__('Save Changes', MTFORMS_TEXT_DOMAIN), 'primary'); ?>
                </form>
            </div>

        <?php elseif ($active_tab == 'recaptcha'): ?>
            <div class="mtforms-card">
                <h2><?php esc_html_e('Google reCAPTCHA v2', MTFORMS_TEXT_DOMAIN); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtforms_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Site Key', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td><input type="text" name="mtforms_recaptcha_site_key"
                                    value="<?php echo esc_attr(get_option('mtforms_recaptcha_site_key')); ?>"
                                    class="regular-text" placeholder="6L..." /></td>
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
                    <?php submit_button(__('Save Changes', MTFORMS_TEXT_DOMAIN), 'primary'); ?>
                </form>
            </div>

        <?php elseif ($active_tab == 'turnstile'): ?>
            <div class="mtforms-card">
                <h2><?php esc_html_e('Cloudflare Turnstile', MTFORMS_TEXT_DOMAIN); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields('mtforms_settings'); ?>

                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <?php esc_html_e('Site Key', MTFORMS_TEXT_DOMAIN); ?>
                            </th>
                            <td><input type="text" name="mtforms_turnstile_site_key"
                                    value="<?php echo esc_attr(get_option('mtforms_turnstile_site_key')); ?>"
                                    class="regular-text" placeholder="0x..." /></td>
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
                    <?php submit_button(__('Save Changes', MTFORMS_TEXT_DOMAIN), 'primary'); ?>
                </form>
            </div>

        <?php elseif ($active_tab == 'email'): ?>
            <div class="mtforms-card">
                <h2><?php esc_html_e('Email Settings', MTFORMS_TEXT_DOMAIN); ?></h2>
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
                                    <?php esc_html_e('The email address where form submissions will be sent.', MTFORMS_TEXT_DOMAIN); ?>
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
                    <?php submit_button(__('Save Changes', MTFORMS_TEXT_DOMAIN), 'primary'); ?>
                </form>
            </div>

            <div class="mtforms-card">
                <h3>🎯 <?php esc_html_e('Getting Started', MTFORMS_TEXT_DOMAIN); ?></h3>
                <p>
                    <?php printf(esc_html__('MTForms is designed specifically for Elementor. Search for %s in the Elementor editor and drag it to your page to get started.', MTFORMS_TEXT_DOMAIN), '<strong>"MTForms"</strong>'); ?>
                </p>
                <ul>
                    <li><?php esc_html_e('Modern Preset Skins', MTFORMS_TEXT_DOMAIN); ?></li>
                    <li><?php esc_html_e('Fully Responsive Layouts', MTFORMS_TEXT_DOMAIN); ?></li>
                    <li><?php esc_html_e('Advanced Typography & Color controls', MTFORMS_TEXT_DOMAIN); ?></li>
                    <li><?php esc_html_e('Built-in Spam Protection', MTFORMS_TEXT_DOMAIN); ?></li>
                </ul>
            </div>

        <?php endif; ?>

    </div>
</div>