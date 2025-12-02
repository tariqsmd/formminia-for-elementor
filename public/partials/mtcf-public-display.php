<?php
/**
 * Provide a public-facing view for the plugin
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    MT_Contact_Forms
 * @subpackage MT_Contact_Forms/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="mtcf-container mtcf-skin-<?php echo esc_attr( $atts['skin'] ); ?>">
    <form id="mtcf-form" class="mtcf-form" action="" method="POST" novalidate>
        
        <div class="mtcf-form-group">
            <label for="mtcf_name"><?php esc_html_e( 'Name', 'mt-contact-forms' ); ?> <span class="required">*</span></label>
            <input type="text" name="mtcf_name" id="mtcf_name" class="mtcf-input" required>
        </div>

        <div class="mtcf-form-group">
            <label for="mtcf_email"><?php esc_html_e( 'Email', 'mt-contact-forms' ); ?> <span class="required">*</span></label>
            <input type="email" name="mtcf_email" id="mtcf_email" class="mtcf-input" required>
        </div>

        <div class="mtcf-form-group">
            <label for="mtcf_subject"><?php esc_html_e( 'Subject', 'mt-contact-forms' ); ?></label>
            <input type="text" name="mtcf_subject" id="mtcf_subject" class="mtcf-input">
        </div>

        <div class="mtcf-form-group">
            <label for="mtcf_message"><?php esc_html_e( 'Message', 'mt-contact-forms' ); ?> <span class="required">*</span></label>
            <textarea name="mtcf_message" id="mtcf_message" class="mtcf-textarea" rows="5" required></textarea>
        </div>

        <div class="mtcf-form-group mtcf-gdpr-group">
            <label class="mtcf-checkbox-label">
                <input type="checkbox" name="mtcf_gdpr" id="mtcf_gdpr" required>
                <?php esc_html_e( 'I consent to having this website store my submitted information so they can respond to my inquiry.', 'mt-contact-forms' ); ?>
            </label>
        </div>

        <?php
        $captcha_provider = get_option('mtcf_captcha_provider', 'none');
        if ( $captcha_provider === 'recaptcha' ) {
            $site_key = get_option('mtcf_recaptcha_site_key');
            if ( ! empty( $site_key ) ) {
                echo '<div class="g-recaptcha" data-sitekey="' . esc_attr( $site_key ) . '"></div>';
            }
        } elseif ( $captcha_provider === 'turnstile' ) {
            $site_key = get_option('mtcf_turnstile_site_key');
            if ( ! empty( $site_key ) ) {
                echo '<div class="cf-turnstile" data-sitekey="' . esc_attr( $site_key ) . '"></div>';
            }
        }
        ?>

        <div class="mtcf-form-actions">
            <button type="submit" class="mtcf-submit-btn"><?php esc_html_e( 'Send Message', 'mt-contact-forms' ); ?></button>
            <span class="mtcf-spinner"></span>
        </div>

        <div class="mtcf-response-message"></div>

    </form>
</div>
