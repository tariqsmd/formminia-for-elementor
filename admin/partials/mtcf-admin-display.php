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
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
$active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';
?>

<div class="wrap mtcf-admin-wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'MT Contact Forms', 'mt-contact-forms' ); ?></h1>
    <hr class="wp-header-end">

    <nav class="nav-tab-wrapper mtcf-nav-tab-wrapper">
        <a href="?page=mt-contact-forms&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'General', 'mt-contact-forms' ); ?></a>
        <a href="?page=mt-contact-forms&tab=recaptcha" class="nav-tab <?php echo $active_tab == 'recaptcha' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Google reCAPTCHA', 'mt-contact-forms' ); ?></a>
        <a href="?page=mt-contact-forms&tab=turnstile" class="nav-tab <?php echo $active_tab == 'turnstile' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Turnstile', 'mt-contact-forms' ); ?></a>
        <a href="?page=mt-contact-forms&tab=docs" class="nav-tab <?php echo $active_tab == 'docs' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Documentation', 'mt-contact-forms' ); ?></a>
    </nav>

    <div class="mtcf-tab-content">
        
        <?php if ( $active_tab == 'general' ): ?>
            <div class="card mtcf-card">
                <h2><?php esc_html_e( 'General Settings', 'mt-contact-forms' ); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields( 'mtcf_settings' ); ?>
                    
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Captcha Provider', 'mt-contact-forms' ); ?></th>
                            <td>
                                <select name="mtcf_captcha_provider" id="mtcf_captcha_provider">
                                    <option value="none" <?php selected( get_option('mtcf_captcha_provider'), 'none' ); ?>><?php esc_html_e( 'None', 'mt-contact-forms' ); ?></option>
                                    <option value="recaptcha" <?php selected( get_option('mtcf_captcha_provider'), 'recaptcha' ); ?>><?php esc_html_e( 'Google reCAPTCHA v2', 'mt-contact-forms' ); ?></option>
                                    <option value="turnstile" <?php selected( get_option('mtcf_captcha_provider'), 'turnstile' ); ?>><?php esc_html_e( 'Cloudflare Turnstile', 'mt-contact-forms' ); ?></option>
                                </select>
                                <p class="description"><?php esc_html_e( 'Select the validation service you want to use to prevent spam.', 'mt-contact-forms' ); ?></p>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>

        <?php elseif ( $active_tab == 'recaptcha' ): ?>
            <div class="card mtcf-card">
                <h2><?php esc_html_e( 'Google reCAPTCHA v2', 'mt-contact-forms' ); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields( 'mtcf_settings' ); ?>
                    
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Site Key', 'mt-contact-forms' ); ?></th>
                            <td><input type="text" name="mtcf_recaptcha_site_key" value="<?php echo esc_attr( get_option('mtcf_recaptcha_site_key') ); ?>" class="regular-text" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Secret Key', 'mt-contact-forms' ); ?></th>
                            <td><input type="password" name="mtcf_recaptcha_secret_key" value="<?php echo esc_attr( get_option('mtcf_recaptcha_secret_key') ); ?>" class="regular-text" /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>

        <?php elseif ( $active_tab == 'turnstile' ): ?>
            <div class="card mtcf-card">
                <h2><?php esc_html_e( 'Cloudflare Turnstile', 'mt-contact-forms' ); ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields( 'mtcf_settings' ); ?>
                    
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Site Key', 'mt-contact-forms' ); ?></th>
                            <td><input type="text" name="mtcf_turnstile_site_key" value="<?php echo esc_attr( get_option('mtcf_turnstile_site_key') ); ?>" class="regular-text" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e( 'Secret Key', 'mt-contact-forms' ); ?></th>
                            <td><input type="password" name="mtcf_turnstile_secret_key" value="<?php echo esc_attr( get_option('mtcf_turnstile_secret_key') ); ?>" class="regular-text" /></td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
            
        <?php else: ?>
            
            <div class="mtcf-grid">
                <!-- Documentation Content (Same as before) -->
                <div class="card mtcf-card">
                    <h2><?php esc_html_e( 'Getting Started', 'mt-contact-forms' ); ?></h2>
                    <p class="mtcf-intro"><?php esc_html_e( 'Welcome to MT Contact Forms! Use this lightweight, powerful plugin to add contact forms to your site.', 'mt-contact-forms' ); ?></p>
                    
                    <hr>

                    <h3><?php esc_html_e( '1. Using Shortcodes', 'mt-contact-forms' ); ?></h3>
                    <p><?php esc_html_e( 'You can add a form to any page using the following shortcode:', 'mt-contact-forms' ); ?></p>
                    <div class="mtcf-code-block">
                        <code>[mtcf_form]</code>
                        <button class="button button-small copy-btn" data-clipboard-text="[mtcf_form]">Copy</button>
                    </div>

                    <p><?php esc_html_e( 'You can also specify a skin:', 'mt-contact-forms' ); ?></p>
                    <div class="mtcf-code-block">
                        <code>[mtcf_form skin="modern"]</code>
                    </div>
                </div>

                <div class="card mtcf-card">
                   <h3><?php esc_html_e( '2. Gutenberg Block', 'mt-contact-forms' ); ?></h3>
                   <p><?php printf( esc_html__( 'In the Block Editor, search for %s to add it visually.', 'mt-contact-forms' ), '<strong>' . esc_html__( 'MT Contact Form', 'mt-contact-forms' ) . '</strong>' ); ?></p>
                   
                   <hr>

                   <h3><?php esc_html_e( '3. Elementor Widget', 'mt-contact-forms' ); ?></h3>
                   <p><?php printf( esc_html__( 'In Elementor, drag and drop the %s widget.', 'mt-contact-forms' ), '<strong>' . esc_html__( 'MT Contact Form', 'mt-contact-forms' ) . '</strong>' ); ?></p>
                </div>
            </div>

        <?php endif; ?>

    </div>
</div>
