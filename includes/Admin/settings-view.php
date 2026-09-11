<?php

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// View template: variables below are injected by Admin\SettingsPage.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

/**
 * Provide an admin area view for the plugin
 *
 * @package    MTForms
 */
?>

<?php
// Active tab is read from the URL to decide which panel renders (display only).
// phpcs:ignore WordPress.Security.NonceVerification.Recommended
$active_tab = isset($_GET['tab']) ? sanitize_text_field(wp_unslash($_GET['tab'])) : 'general';

$tabs = [
    'general' => [
        'label' => __('General', 'mtforms'),
        'icon' => 'dashicons-admin-settings',
    ],
    'email' => [
        'label' => __('Email Settings', 'mtforms'),
        'icon' => 'dashicons-email-alt',
    ],
    'support' => [
        'label' => __('Support', 'mtforms'),
        'icon' => 'dashicons-sos',
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
            <h1><?php esc_html_e('MTForms', 'mtforms'); ?></h1>
            <span class="version-tag">v<?php echo esc_html(MTFORMS_VERSION); ?></span>
        </div>
        <!-- <div class="mtforms-page-header-meta">
            <span class="mtforms-page-header-tab-label"></span>
        </div> -->
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
                    <h2><?php esc_html_e('General', 'mtforms'); ?></h2>
                    <form method="post" action="options.php">
                        <?php settings_fields(\MTForms\Admin\Options::GROUP_GENERAL); ?>
                        <h3><?php esc_html_e('Security Settings', 'mtforms'); ?></h3>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Captcha Provider', 'mtforms'); ?>
                                </th>
                                <td>
                                    <select name="mtforms_captcha_provider" id="mtforms_captcha_provider"
                                        class="mtforms-provider-select">
                                        <option value="none" <?php selected(get_option('mtforms_captcha_provider'), 'none'); ?>>
                                            <?php esc_html_e('None', 'mtforms'); ?>
                                        </option>
                                        <option value="recaptcha" <?php selected(get_option('mtforms_captcha_provider'), 'recaptcha'); ?>>
                                            <?php esc_html_e('Google reCAPTCHA v2', 'mtforms'); ?>
                                        </option>
                                        <option value="turnstile" <?php selected(get_option('mtforms_captcha_provider'), 'turnstile'); ?>>
                                            <?php esc_html_e('Cloudflare Turnstile', 'mtforms'); ?>
                                        </option>
                                    </select>
                                    <p class="description">
                                        <?php esc_html_e('Select the validation service you want to use to prevent spam.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <!-- Google reCAPTCHA Settings -->
                            <tr valign="top" class="mtforms-captcha-fields recaptcha-fields" <?php echo get_option('mtforms_captcha_provider') !== 'recaptcha' ? 'style="display:none"' : ''; ?>>
                                <th scope="row">
                                    <?php esc_html_e('reCAPTCHA Site Key', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" name="mtforms_recaptcha_site_key"
                                        value="<?php echo esc_attr(get_option('mtforms_recaptcha_site_key', '')); ?>"
                                        class="regular-text" />
                                </td>
                            </tr>
                            <tr valign="top" class="mtforms-captcha-fields recaptcha-fields" <?php echo get_option('mtforms_captcha_provider') !== 'recaptcha' ? 'style="display:none"' : ''; ?>>
                                <th scope="row">
                                    <?php esc_html_e('reCAPTCHA Secret Key', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="password" name="mtforms_recaptcha_secret_key"
                                        value="<?php echo esc_attr(get_option('mtforms_recaptcha_secret_key', '')); ?>"
                                        class="regular-text" />
                                </td>
                            </tr>

                            <!-- Cloudflare Turnstile Settings -->
                            <tr valign="top" class="mtforms-captcha-fields turnstile-fields" <?php echo get_option('mtforms_captcha_provider') !== 'turnstile' ? 'style="display:none"' : ''; ?>>
                                <th scope="row">
                                    <?php esc_html_e('Turnstile Site Key', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" name="mtforms_turnstile_site_key"
                                        value="<?php echo esc_attr(get_option('mtforms_turnstile_site_key', '')); ?>"
                                        class="regular-text" />
                                </td>
                            </tr>
                            <tr valign="top" class="mtforms-captcha-fields turnstile-fields" <?php echo get_option('mtforms_captcha_provider') !== 'turnstile' ? 'style="display:none"' : ''; ?>>
                                <th scope="row">
                                    <?php esc_html_e('Turnstile Secret Key', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="password" name="mtforms_turnstile_secret_key"
                                        value="<?php echo esc_attr(get_option('mtforms_turnstile_secret_key', '')); ?>"
                                        class="regular-text" />
                                </td>
                            </tr>
                        </table>
                        <?php submit_button(__('Save Changes', 'mtforms'), 'primary'); ?>
                    </form>
                </div>

            <?php elseif ($active_tab === 'email'): ?>

                <div class="mtforms-card">
                    <h2><?php esc_html_e('Email Settings', 'mtforms'); ?></h2>
                    <form method="post" action="options.php">
                        <?php settings_fields(\MTForms\Admin\Options::GROUP_EMAIL); ?>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Recipient Email', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="email" name="mtforms_admin_email"
                                        value="<?php echo esc_attr(get_option('mtforms_admin_email', get_option('admin_email'))); ?>"
                                        class="regular-text" />
                                    <p class="description">
                                        <?php esc_html_e('The email address where form submissions will be sent.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email CC', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" name="mtforms_email_cc"
                                        value="<?php echo esc_attr(get_option('mtforms_email_cc', '')); ?>"
                                        class="regular-text" />
                                    <p class="description">
                                        <?php esc_html_e('Comma separated list of email addresses to CC.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email BCC', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" name="mtforms_email_bcc"
                                        value="<?php echo esc_attr(get_option('mtforms_email_bcc', '')); ?>"
                                        class="regular-text" />
                                    <p class="description">
                                        <?php esc_html_e('Comma separated list of email addresses to BCC.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Default Subject', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" name="mtforms_email_subject"
                                        value="<?php echo esc_attr(get_option('mtforms_email_subject', 'New Contact Form Submission')); ?>"
                                        class="regular-text" />
                                    <p class="description">
                                        <?php esc_html_e('The subject line used for notification emails.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('From Name', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" name="mtforms_email_from_name"
                                        value="<?php echo esc_attr(get_option('mtforms_email_from_name', get_bloginfo('name'))); ?>"
                                        class="regular-text" />
                                    <p class="description">
                                        <?php esc_html_e('The name that appears in the "From" field of the email.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Enable HTML Template', 'mtforms'); ?>
                                </th>
                                <td>
                                    <label class="mtforms-switch">
                                        <input type="checkbox" name="mtforms_enable_html_email" value="yes" <?php checked(get_option('mtforms_enable_html_email', 'yes'), 'yes'); ?>>
                                        <span class="mtforms-slider round"></span>
                                    </label>
                                    <p class="description">
                                        <?php esc_html_e('Use the professional HTML email template for notifications.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Header Accent Color', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" id="mtforms_email_accent_color" name="mtforms_email_accent_color"
                                        value="<?php echo esc_attr(get_option('mtforms_email_accent_color', '#6366f1')); ?>"
                                        class="mtforms-color-picker" />
                                    <p class="description">
                                        <?php esc_html_e('Background color for the email header bar.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email Background Color', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" id="mtforms_email_bg_color" name="mtforms_email_bg_color"
                                        value="<?php echo esc_attr(get_option('mtforms_email_bg_color', '#f4f7f6')); ?>"
                                        class="mtforms-color-picker" />
                                    <p class="description">
                                        <?php esc_html_e('Background color of the email context.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Content Background Color', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" id="mtforms_email_content_bg_color"
                                        name="mtforms_email_content_bg_color"
                                        value="<?php echo esc_attr(get_option('mtforms_email_content_bg_color', '#ffffff')); ?>"
                                        class="mtforms-color-picker" />
                                    <p class="description">
                                        <?php esc_html_e('Background color of the email content container.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email Text Color', 'mtforms'); ?>
                                </th>
                                <td>
                                    <input type="text" id="mtforms_email_text_color" name="mtforms_email_text_color"
                                        value="<?php echo esc_attr(get_option('mtforms_email_text_color', '#1e293b')); ?>"
                                        class="mtforms-color-picker" />
                                    <p class="description">
                                        <?php esc_html_e('Primary text color for the email content.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Email Logo', 'mtforms'); ?>
                                </th>
                                <td>
                                    <?php $logo_url = get_option('mtforms_email_logo_url', ''); ?>
                                    <div class="mtforms-media-field">
                                        <input type="text" id="mtforms_email_logo_url" name="mtforms_email_logo_url"
                                            value="<?php echo esc_attr($logo_url); ?>"
                                            class="regular-text mtforms-media-url" placeholder="https://..." />
                                        <button type="button" class="button mtforms-media-upload-btn">
                                            <?php esc_html_e('Select Image', 'mtforms'); ?>
                                        </button>
                                        <button type="button" class="button mtforms-media-remove-btn" <?php echo empty($logo_url) ? ' style="display:none"' : ''; ?>>
                                            <?php esc_html_e('Remove', 'mtforms'); ?>
                                        </button>
                                    </div>
                                    <div class="mtforms-logo-preview" <?php echo empty($logo_url) ? ' style="display:none"' : ''; ?>>
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="" />
                                    </div>
                                    <p class="description">
                                        <?php esc_html_e('Displayed inside the email header. Recommended height: 40–50px.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Footer Text', 'mtforms'); ?>
                                </th>
                                <td>
                                    <textarea name="mtforms_email_footer_text" rows="2"
                                        class="regular-text"><?php echo esc_textarea(get_option('mtforms_email_footer_text', '')); ?></textarea>
                                    <p class="description">
                                        <?php esc_html_e('Optional extra line in the email footer (e.g. your address or a note).', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row">
                                    <?php esc_html_e('Show Footer Credit', 'mtforms'); ?>
                                </th>
                                <td>
                                    <label class="mtforms-switch">
                                        <input type="checkbox" name="mtforms_email_show_footer_credit" value="yes" <?php checked(get_option('mtforms_email_show_footer_credit', 'yes'), 'yes'); ?>>
                                        <span class="mtforms-slider round"></span>
                                    </label>
                                    <p class="description">
                                        <?php esc_html_e('Show "Submitted via [Site Name]" in the email footer.', 'mtforms'); ?>
                                    </p>
                                </td>
                            </tr>

                        </table>
                        <?php submit_button(__('Save Changes', 'mtforms'), 'primary'); ?>
                    </form>
                </div>

            <?php elseif ($active_tab === 'support'): ?>

                <div class="mtforms-card mtforms-support-card">

                    <div class="mtforms-support-sections">

                        <section class="mtforms-support-section">
                            <h3 class="mtforms-support-section-title"><?php esc_html_e('Features', 'mtforms'); ?></h3>

                            <ul class="mtforms-features-list">
                                <li>
                                    <span class="mtforms-feature-icon">✦</span>
                                    <div>
                                        <strong><?php esc_html_e('Preset Skins', 'mtforms'); ?></strong>
                                        <span><?php esc_html_e('5 ready-made form styles', 'mtforms'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="mtforms-feature-icon">✦</span>
                                    <div>
                                        <strong><?php esc_html_e('Field Icons', 'mtforms'); ?></strong>
                                        <span><?php esc_html_e('Inline SVG icons per field', 'mtforms'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="mtforms-feature-icon">✦</span>
                                    <div>
                                        <strong><?php esc_html_e('HTML Email Template', 'mtforms'); ?></strong>
                                        <span><?php esc_html_e('Professional email layout', 'mtforms'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="mtforms-feature-icon">✦</span>
                                    <div>
                                        <strong><?php esc_html_e('Spam Protection', 'mtforms'); ?></strong>
                                        <span><?php esc_html_e('reCAPTCHA, Turnstile & honeypot', 'mtforms'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="mtforms-feature-icon">✦</span>
                                    <div>
                                        <strong><?php esc_html_e('Rate Limiting', 'mtforms'); ?></strong>
                                        <span><?php esc_html_e('IP-based flood protection', 'mtforms'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="mtforms-feature-icon">✦</span>
                                    <div>
                                        <strong><?php esc_html_e('GDPR Consent', 'mtforms'); ?></strong>
                                        <span><?php esc_html_e('Built-in consent checkbox', 'mtforms'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="mtforms-feature-icon">✦</span>
                                    <div>
                                        <strong><?php esc_html_e('Floating Labels', 'mtforms'); ?></strong>
                                        <span><?php esc_html_e('CSS animated placeholders', 'mtforms'); ?></span>
                                    </div>
                                </li>
                                <li>
                                    <span class="mtforms-feature-icon">✦</span>
                                    <div>
                                        <strong><?php esc_html_e('Responsive Design', 'mtforms'); ?></strong>
                                        <span><?php esc_html_e('Works on all screen sizes', 'mtforms'); ?></span>
                                    </div>
                                </li>
                            </ul>
                        </section>

                        <section class="mtforms-support-section">
                            <h3 class="mtforms-support-section-title"><?php esc_html_e('Support', 'mtforms'); ?></h3>

                            <p class="mtforms-info-desc">
                                <?php esc_html_e('If this plugin saves you time, consider supporting its development.', 'mtforms'); ?>
                            </p>

                            <a href="https://buymeacoffee.com/mhtas" target="_blank" class="mtforms-btn-coffee">
                                <span>☕</span>
                                <?php esc_html_e('Buy Me a Coffee', 'mtforms'); ?>
                            </a>

                            <a href="https://paypal.me/mhtas" target="_blank" class="mtforms-btn-donate">
                                <span class="dashicons dashicons-heart"></span>
                                <?php esc_html_e('Donate via PayPal', 'mtforms'); ?>
                            </a>

                            <div class="mtforms-info-divider"></div>

                            <p class="mtforms-info-panel-title"><?php esc_html_e('Found a bug?', 'mtforms'); ?></p>

                            <div class="mtforms-info-links">
                                <a href="https://github.com/mhtas/mtforms/issues" target="_blank" class="mtforms-info-link">
                                    <span class="dashicons dashicons-warning"></span>
                                    <?php esc_html_e('Report an Issue', 'mtforms'); ?>
                                </a>
                                <a href="https://wordpress.org/support/plugin/mtforms/reviews/#new-post" target="_blank"
                                    class="mtforms-info-link">
                                    <span class="dashicons dashicons-star-filled"></span>
                                    <?php esc_html_e('Leave a Review', 'mtforms'); ?>
                                </a>
                            </div>
                        </section>

                    </div>

                </div>

            <?php endif; ?>

        </main>
        <!-- ═══ /MAIN CONTENT ═══ -->

        
    </div><!-- .mtforms-admin-layout -->

</div><!-- .mtforms-admin-wrap -->