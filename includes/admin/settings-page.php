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

    <div class="mtforms-admin-layout">

        <!-- Sidebar -->
        <aside class="mtforms-admin-sidebar">

            <div class="mtforms-sidebar-brand">
                <span class="dashicons dashicons-email"></span>
                <div>
                    <strong><?php esc_html_e('MTForms', MTFORMS_TEXT_DOMAIN); ?></strong>
                    <span class="version-tag">v<?php echo esc_html(MTFORMS_VERSION); ?></span>
                </div>
            </div>

            <nav class="mtforms-sidebar-nav">
                <?php foreach ($tabs as $tab_key => $tab): ?>
                    <a href="?page=mtforms&tab=<?php echo esc_attr($tab_key); ?>"
                        class="mtforms-sidebar-nav-item <?php echo $active_tab === $tab_key ? 'is-active' : ''; ?>">
                        <span class="dashicons <?php echo esc_attr($tab['icon']); ?>"></span>
                        <?php echo esc_html($tab['label']); ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="mtforms-sidebar-help">
                <p><?php printf(esc_html__('Search for %s in the Elementor editor to get started.', MTFORMS_TEXT_DOMAIN), '<strong>"MTForms"</strong>'); ?>
                </p>
                <ul>
                    <li><?php esc_html_e('Modern Preset Skins', MTFORMS_TEXT_DOMAIN); ?></li>
                    <li><?php esc_html_e('Fully Responsive Layouts', MTFORMS_TEXT_DOMAIN); ?></li>
                    <li><?php esc_html_e('Built-in Spam Protection', MTFORMS_TEXT_DOMAIN); ?></li>
                </ul>
            </div>

        </aside>
        <!-- /Sidebar -->

        <!-- Main Content -->
        <main class="mtforms-admin-main">

            <div class="mtforms-admin-header">
                <h1><?php echo esc_html($tabs[$active_tab]['label']); ?></h1>
            </div>

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

            <?php endif; ?>

        </main>
        <!-- /Main Content -->

    </div><!-- .mtforms-admin-layout -->

</div><!-- .mtforms-admin-wrap -->