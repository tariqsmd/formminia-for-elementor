<?php

/**
 * Provide an admin area view for the plugin
 *
 * @package    MTForms
 */
?>

<?php
$active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'general';

$tabs = [
    'general' => [
        'label' => __('General', MTFORMS_TEXT_DOMAIN),
        'icon' => 'dashicons-admin-settings',
    ],
    'email' => [
        'label' => __('Email Settings', MTFORMS_TEXT_DOMAIN),
        'icon' => 'dashicons-email-alt',
    ],
    'recaptcha' => [
        'label' => __('Google reCAPTCHA', MTFORMS_TEXT_DOMAIN),
        'icon' => 'dashicons-shield',
    ],
    'turnstile' => [
        'label' => __('Turnstile', MTFORMS_TEXT_DOMAIN),
        'icon' => 'dashicons-cloud',
    ],
];
?>

<div class="wrap mtforms-admin-wrap">

    <!-- ══════════════════════════════════════════════════════ -->
    <!-- FULL-WIDTH PAGE HEADER                                  -->
    <!-- ══════════════════════════════════════════════════════ -->
    <header class="mtforms-page-header">
        <div class="mtforms-page-header-brand">
            <span class="dashicons dashicons-email"></span>
            <h1><?php esc_html_e('MTForms', MTFORMS_TEXT_DOMAIN); ?></h1>
            <span class="version-tag">v<?php echo esc_html(MTFORMS_VERSION); ?></span>
        </div>
        <div class="mtforms-page-header-meta">
            <span class="mtforms-page-header-tab-label">
                <?php echo esc_html($tabs[$active_tab]['label']); ?>
            </span>
        </div>
    </header>

    <!-- ══════════════════════════════════════════════════════ -->
    <!-- THREE-COLUMN BODY                                       -->
    <!-- ══════════════════════════════════════════════════════ -->
    <div class="mtforms-admin-layout">

        <!-- ═══ LEFT SIDEBAR ═══ -->
        <aside class="mtforms-admin-sidebar">

            <nav class="mtforms-sidebar-nav">
                <?php foreach ($tabs as $tab_key => $tab): ?>
                    <a href="?page=mtforms&tab=<?php echo esc_attr($tab_key); ?>"
                        class="mtforms-sidebar-nav-item <?php echo $active_tab === $tab_key ? 'is-active' : ''; ?>">
                        <span class="dashicons <?php echo esc_attr($tab['icon']); ?>"></span>
                        <?php echo esc_html($tab['label']); ?>
                    </a>
                <?php endforeach; ?>
            </nav>

        </aside>
        <!-- ═══ /LEFT SIDEBAR ═══ -->

        <!-- ═══ MAIN CONTENT ═══ -->
        <main class="mtforms-admin-main">

            <?php if ($active_tab === 'general'): ?>

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

            <?php elseif ($active_tab === 'email'): ?>

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
                                    <?php esc_html_e('Email CC', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <input type="text" name="mtforms_email_cc"
                                        value="<?php echo esc_attr(get_option('mtforms_email_cc', '')); ?>"
                                        class="regular-text" />
                                    <p class="description">
                                        <?php esc_html_e('Comma separated list of email addresses to CC.', MTFORMS_TEXT_DOMAIN); ?>
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email BCC', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <input type="text" name="mtforms_email_bcc"
                                        value="<?php echo esc_attr(get_option('mtforms_email_bcc', '')); ?>"
                                        class="regular-text" />
                                    <p class="description">
                                        <?php esc_html_e('Comma separated list of email addresses to BCC.', MTFORMS_TEXT_DOMAIN); ?>
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

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Header Accent Color', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <input type="text" id="mtforms_email_accent_color" name="mtforms_email_accent_color"
                                        value="<?php echo esc_attr(get_option('mtforms_email_accent_color', '#6366f1')); ?>"
                                        class="mtforms-color-picker" />
                                    <p class="description">
                                        <?php esc_html_e('Background color for the email header bar.', MTFORMS_TEXT_DOMAIN); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email Background Color', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <input type="text" id="mtforms_email_bg_color" name="mtforms_email_bg_color"
                                        value="<?php echo esc_attr(get_option('mtforms_email_bg_color', '#f4f7f6')); ?>"
                                        class="mtforms-color-picker" />
                                    <p class="description">
                                        <?php esc_html_e('Background color of the email context.', MTFORMS_TEXT_DOMAIN); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Content Background Color', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <input type="text" id="mtforms_email_content_bg_color"
                                        name="mtforms_email_content_bg_color"
                                        value="<?php echo esc_attr(get_option('mtforms_email_content_bg_color', '#ffffff')); ?>"
                                        class="mtforms-color-picker" />
                                    <p class="description">
                                        <?php esc_html_e('Background color of the email content container.', MTFORMS_TEXT_DOMAIN); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email Text Color', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <input type="text" id="mtforms_email_text_color" name="mtforms_email_text_color"
                                        value="<?php echo esc_attr(get_option('mtforms_email_text_color', '#1e293b')); ?>"
                                        class="mtforms-color-picker" />
                                    <p class="description">
                                        <?php esc_html_e('Primary text color for the email content.', MTFORMS_TEXT_DOMAIN); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email Logo', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <?php $logo_url = get_option('mtforms_email_logo_url', ''); ?>
                                    <div class="mtforms-media-field">
                                        <input type="text" id="mtforms_email_logo_url" name="mtforms_email_logo_url"
                                            value="<?php echo esc_attr($logo_url); ?>"
                                            class="regular-text mtforms-media-url" placeholder="https://..." />
                                        <button type="button" class="button mtforms-media-upload-btn">
                                            <?php esc_html_e('Select Image', MTFORMS_TEXT_DOMAIN); ?>
                                        </button>
                                        <button type="button" class="button mtforms-media-remove-btn" <?php echo empty($logo_url) ? ' style="display:none"' : ''; ?>>
                                            <?php esc_html_e('Remove', MTFORMS_TEXT_DOMAIN); ?>
                                        </button>
                                    </div>
                                    <div class="mtforms-logo-preview" <?php echo empty($logo_url) ? ' style="display:none"' : ''; ?>>
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="" />
                                    </div>
                                    <p class="description">
                                        <?php esc_html_e('Displayed inside the email header. Recommended height: 40–50px.', MTFORMS_TEXT_DOMAIN); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Footer Text', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <textarea name="mtforms_email_footer_text" rows="2"
                                        class="regular-text"><?php echo esc_textarea(get_option('mtforms_email_footer_text', '')); ?></textarea>
                                    <p class="description">
                                        <?php esc_html_e('Optional extra line in the email footer (e.g. your address or a note).', MTFORMS_TEXT_DOMAIN); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Show Footer Credit', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td>
                                    <label class="mtforms-switch">
                                        <input type="checkbox" name="mtforms_email_show_footer_credit" value="yes" <?php checked(get_option('mtforms_email_show_footer_credit', 'yes'), 'yes'); ?>>
                                        <span class="mtforms-slider round"></span>
                                    </label>
                                    <p class="description">
                                        <?php esc_html_e('Show "Submitted via [Site Name]" in the email footer.', MTFORMS_TEXT_DOMAIN); ?>
                                    </p>
                                </td>
                            </tr>

                        </table>
                        <?php submit_button(__('Save Changes', MTFORMS_TEXT_DOMAIN), 'primary'); ?>
                    </form>
                </div>

            <?php elseif ($active_tab === 'recaptcha'): ?>

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
                                        value="<?php echo esc_attr(get_option('mtforms_recaptcha_site_key', '')); ?>"
                                        class="regular-text" placeholder="6L..." /></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Secret Key', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td><input type="password" name="mtforms_recaptcha_secret_key"
                                        value="<?php echo esc_attr(get_option('mtforms_recaptcha_secret_key', '')); ?>"
                                        class="regular-text" /></td>
                            </tr>
                        </table>
                        <?php submit_button(__('Save Changes', MTFORMS_TEXT_DOMAIN), 'primary'); ?>
                    </form>
                </div>

            <?php elseif ($active_tab === 'turnstile'): ?>

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
                                        value="<?php echo esc_attr(get_option('mtforms_turnstile_site_key', '')); ?>"
                                        class="regular-text" placeholder="0x..." /></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Secret Key', MTFORMS_TEXT_DOMAIN); ?>
                                </th>
                                <td><input type="password" name="mtforms_turnstile_secret_key"
                                        value="<?php echo esc_attr(get_option('mtforms_turnstile_secret_key', '')); ?>"
                                        class="regular-text" /></td>
                            </tr>
                        </table>
                        <?php submit_button(__('Save Changes', MTFORMS_TEXT_DOMAIN), 'primary'); ?>
                    </form>
                </div>

            <?php endif; ?>

        </main>
        <!-- ═══ /MAIN CONTENT ═══ -->

        <!-- ═══ RIGHT SIDEBAR ═══ -->
        <aside class="mtforms-info-sidebar">
            <div class="mtforms-info-sticky-wrapper">

                <!-- Sub-tab nav -->
                <div class="mtforms-info-tabs">
                    <button class="mtforms-info-tab is-active" data-target="panel-about">
                        <?php esc_html_e('About', MTFORMS_TEXT_DOMAIN); ?>
                    </button>
                    <button class="mtforms-info-tab" data-target="panel-features">
                        <?php esc_html_e('Features', MTFORMS_TEXT_DOMAIN); ?>
                    </button>
                    <button class="mtforms-info-tab" data-target="panel-support">
                        <?php esc_html_e('Support', MTFORMS_TEXT_DOMAIN); ?>
                    </button>
                </div>

                <!-- Panel: About -->
                <div class="mtforms-info-panel is-active" id="panel-about">

                    <div class="mtforms-info-logo">
                        <span class="dashicons dashicons-email"></span>
                        <div>
                            <strong>MTForms</strong>
                            <span>v<?php echo esc_html(MTFORMS_VERSION); ?></span>
                        </div>
                    </div>

                    <p class="mtforms-info-desc">
                        <?php esc_html_e('A modern, lightweight Elementor contact form plugin built with clean PHP architecture and extensibility in mind.', MTFORMS_TEXT_DOMAIN); ?>
                    </p>

                    <div class="mtforms-info-links">
                        <a href="https://mhtas.com" target="_blank" class="mtforms-info-link">
                            <span class="dashicons dashicons-admin-site-alt3"></span>
                            <?php esc_html_e('Visit Website', MTFORMS_TEXT_DOMAIN); ?>
                        </a>
                        <a href="https://mhtas.com/mtforms/docs" target="_blank" class="mtforms-info-link">
                            <span class="dashicons dashicons-book"></span>
                            <?php esc_html_e('Documentation', MTFORMS_TEXT_DOMAIN); ?>
                        </a>
                        <a href="https://wordpress.org/plugins/mtforms/" target="_blank" class="mtforms-info-link">
                            <span class="dashicons dashicons-wordpress"></span>
                            <?php esc_html_e('WP Plugin Page', MTFORMS_TEXT_DOMAIN); ?>
                        </a>
                        <a href="https://wordpress.org/support/plugin/mtforms/" target="_blank"
                            class="mtforms-info-link">
                            <span class="dashicons dashicons-sos"></span>
                            <?php esc_html_e('Community Forum', MTFORMS_TEXT_DOMAIN); ?>
                        </a>
                    </div>

                </div>
                <!-- /Panel: About -->

                <!-- Panel: Features -->
                <div class="mtforms-info-panel" id="panel-features">

                    <p class="mtforms-info-panel-title"><?php esc_html_e("What's included", MTFORMS_TEXT_DOMAIN); ?></p>

                    <ul class="mtforms-features-list">
                        <li>
                            <span class="mtforms-feature-icon">✦</span>
                            <div>
                                <strong><?php esc_html_e('Preset Skins', MTFORMS_TEXT_DOMAIN); ?></strong>
                                <span><?php esc_html_e('5 ready-made form styles', MTFORMS_TEXT_DOMAIN); ?></span>
                            </div>
                        </li>
                        <li>
                            <span class="mtforms-feature-icon">✦</span>
                            <div>
                                <strong><?php esc_html_e('Field Icons', MTFORMS_TEXT_DOMAIN); ?></strong>
                                <span><?php esc_html_e('Inline SVG icons per field', MTFORMS_TEXT_DOMAIN); ?></span>
                            </div>
                        </li>
                        <li>
                            <span class="mtforms-feature-icon">✦</span>
                            <div>
                                <strong><?php esc_html_e('HTML Email Template', MTFORMS_TEXT_DOMAIN); ?></strong>
                                <span><?php esc_html_e('Professional email layout', MTFORMS_TEXT_DOMAIN); ?></span>
                            </div>
                        </li>
                        <li>
                            <span class="mtforms-feature-icon">✦</span>
                            <div>
                                <strong><?php esc_html_e('Spam Protection', MTFORMS_TEXT_DOMAIN); ?></strong>
                                <span><?php esc_html_e('reCAPTCHA, Turnstile & honeypot', MTFORMS_TEXT_DOMAIN); ?></span>
                            </div>
                        </li>
                        <li>
                            <span class="mtforms-feature-icon">✦</span>
                            <div>
                                <strong><?php esc_html_e('Rate Limiting', MTFORMS_TEXT_DOMAIN); ?></strong>
                                <span><?php esc_html_e('IP-based flood protection', MTFORMS_TEXT_DOMAIN); ?></span>
                            </div>
                        </li>
                        <li>
                            <span class="mtforms-feature-icon">✦</span>
                            <div>
                                <strong><?php esc_html_e('GDPR Consent', MTFORMS_TEXT_DOMAIN); ?></strong>
                                <span><?php esc_html_e('Built-in consent checkbox', MTFORMS_TEXT_DOMAIN); ?></span>
                            </div>
                        </li>
                        <li>
                            <span class="mtforms-feature-icon">✦</span>
                            <div>
                                <strong><?php esc_html_e('Floating Labels', MTFORMS_TEXT_DOMAIN); ?></strong>
                                <span><?php esc_html_e('CSS animated placeholders', MTFORMS_TEXT_DOMAIN); ?></span>
                            </div>
                        </li>
                        <li>
                            <span class="mtforms-feature-icon">✦</span>
                            <div>
                                <strong><?php esc_html_e('Responsive Design', MTFORMS_TEXT_DOMAIN); ?></strong>
                                <span><?php esc_html_e('Works on all screen sizes', MTFORMS_TEXT_DOMAIN); ?></span>
                            </div>
                        </li>
                    </ul>

                </div>
                <!-- /Panel: Features -->

                <!-- Panel: Support -->
                <div class="mtforms-info-panel" id="panel-support">

                    <p class="mtforms-info-panel-title"><?php esc_html_e('Enjoying MTForms?', MTFORMS_TEXT_DOMAIN); ?>
                    </p>
                    <p class="mtforms-info-desc">
                        <?php esc_html_e('If this plugin saves you time, consider supporting its development.', MTFORMS_TEXT_DOMAIN); ?>
                    </p>

                    <a href="https://buymeacoffee.com/mhtas" target="_blank" class="mtforms-btn-coffee">
                        <span>☕</span>
                        <?php esc_html_e('Buy Me a Coffee', MTFORMS_TEXT_DOMAIN); ?>
                    </a>

                    <a href="https://paypal.me/mhtas" target="_blank" class="mtforms-btn-donate">
                        <span class="dashicons dashicons-heart"></span>
                        <?php esc_html_e('Donate via PayPal', MTFORMS_TEXT_DOMAIN); ?>
                    </a>

                    <div class="mtforms-info-divider"></div>

                    <p class="mtforms-info-panel-title"><?php esc_html_e('Found a bug?', MTFORMS_TEXT_DOMAIN); ?></p>

                    <div class="mtforms-info-links">
                        <a href="https://github.com/mhtas/mtforms/issues" target="_blank" class="mtforms-info-link">
                            <span class="dashicons dashicons-warning"></span>
                            <?php esc_html_e('Report an Issue', MTFORMS_TEXT_DOMAIN); ?>
                        </a>
                        <a href="https://wordpress.org/support/plugin/mtforms/reviews/#new-post" target="_blank"
                            class="mtforms-info-link">
                            <span class="dashicons dashicons-star-filled"></span>
                            <?php esc_html_e('Leave a Review', MTFORMS_TEXT_DOMAIN); ?>
                        </a>
                    </div>

                </div>
            </div>
        </aside>
        <!-- ═══ /RIGHT SIDEBAR ═══ -->

    </div><!-- .mtforms-admin-layout -->

</div><!-- .mtforms-admin-wrap -->