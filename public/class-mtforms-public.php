<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://developer.developer.developer
 * @since      1.0.0
 * @package    MTForms
 * @subpackage MTForms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    MTForms
 * @subpackage MTForms/public
 * @author     Muhammad Tariq
 */
class MTForms_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param    string    $plugin_name    The name of the plugin.
     * @param    string    $version        The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . '../assets/css/mtforms-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        // Enqueue JustValidate (using unpkg for demo, should be local for production)
        wp_enqueue_script('just-validate', 'https://unpkg.com/just-validate@4.3.0/dist/just-validate.production.min.js', array(), '4.3.0', true);

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . '../assets/js/mtforms-public.js', array('jquery', 'just-validate'), $this->version, true);

        $captcha_provider = get_option('mtforms_captcha_provider', 'none');
        if ($captcha_provider === 'recaptcha') {
            wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true);
        } elseif ($captcha_provider === 'turnstile') {
            wp_enqueue_script('cloudflare-turnstile', 'https://challenges.cloudflare.com/turnstile/v0/api.js', array(), null, true);
        }

        wp_localize_script($this->plugin_name, 'mtforms_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('mtforms-submit-form'),
            'i18n' => array(
                'name_required' => __('Name is required', MTFORMS_TEXT_DOMAIN),
                'name_min' => __('Name must be at least 2 characters', MTFORMS_TEXT_DOMAIN),
                'email_required' => __('Email is required', MTFORMS_TEXT_DOMAIN),
                'email_invalid' => __('Email is invalid', MTFORMS_TEXT_DOMAIN),
                'phone_invalid' => __('Please enter a valid phone number', MTFORMS_TEXT_DOMAIN),
                'message_required' => __('Message is required', MTFORMS_TEXT_DOMAIN),
                'gdpr_required' => __('You must agree to the terms', MTFORMS_TEXT_DOMAIN),
                'sending' => __('Sending...', MTFORMS_TEXT_DOMAIN),
                'send_message' => __('Send Message', MTFORMS_TEXT_DOMAIN),
                'error_generic' => __('An unexpected error occurred. Please try again.', MTFORMS_TEXT_DOMAIN),
            ),
        ));

    }

    /**
     * Register the shortcode
     */
    public function register_shortcodes()
    {
        add_shortcode('mtforms', array($this, 'render_form'));
        add_shortcode('mtcf_form', array($this, 'render_form')); // Backward compatibility
    }

    /**
     * Render the form
     */
    public function render_form($atts)
    {
        // Get all default settings from the renderer
        $defaults = MTForms_Form_Renderer::get_default_settings();

        // Convert defaults to shortcode format
        $shortcode_defaults = array();
        foreach ($defaults as $key => $value) {
            if (is_array($value)) {
                // Skip complex array values for shortcode
                continue;
            }
            $shortcode_defaults[$key] = $value;
        }

        // Parse shortcode attributes
        $atts = shortcode_atts($shortcode_defaults, $atts, 'mtforms');

        // Use the Form Renderer
        return MTForms_Form_Renderer::render($atts);
    }

    /**
     * Handle AJAX Form Submission
     */
    public function handle_form_submission()
    {
        // Verify Nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'mtforms-submit-form')) {
            wp_send_json_error(array('message' => __('Security check failed.', MTFORMS_TEXT_DOMAIN)));
        }

        // Validate Fields (PHP side validation as backup)
        $name = isset($_POST['mtforms_name']) ? sanitize_text_field($_POST['mtforms_name']) : '';
        $email = isset($_POST['mtforms_email']) ? sanitize_email($_POST['mtforms_email']) : '';
        $phone = isset($_POST['mtforms_phone']) ? sanitize_text_field($_POST['mtforms_phone']) : '';
        $website = isset($_POST['mtforms_website']) ? esc_url_raw($_POST['mtforms_website']) : '';
        $subject = isset($_POST['mtforms_subject']) ? sanitize_text_field($_POST['mtforms_subject']) : '';
        $message = isset($_POST['mtforms_message']) ? sanitize_textarea_field($_POST['mtforms_message']) : '';
        $gdpr_enabled = isset($_POST['mtforms_gdpr_enabled']) && sanitize_text_field($_POST['mtforms_gdpr_enabled']) === 'yes';
        $gdpr = isset($_POST['mtforms_gdpr']) ? 'yes' : 'no';

        // Check required fields (name, email, message are typically required)
        if (empty($name) || empty($email) || empty($message)) {
            wp_send_json_error(array('message' => __('Please fill in all required fields.', MTFORMS_TEXT_DOMAIN)));
        }

        if (!is_email($email)) {
            wp_send_json_error(array('message' => __('Invalid email address.', MTFORMS_TEXT_DOMAIN)));
        }

        // Only require GDPR consent if the GDPR field was shown on the form
        if ($gdpr_enabled && $gdpr !== 'yes') {
            wp_send_json_error(array('message' => __('You must accept the GDPR terms.', MTFORMS_TEXT_DOMAIN)));
        }

        // Verify Captcha based on settings
        $captcha_provider = get_option('mtforms_captcha_provider', 'none');

        if ($captcha_provider === 'recaptcha') {
            $secret = get_option('mtforms_recaptcha_secret_key');
            $response = isset($_POST['g-recaptcha-response']) ? sanitize_text_field($_POST['g-recaptcha-response']) : '';

            if (empty($response)) {
                wp_send_json_error(array('message' => __('Please complete the reCAPTCHA.', MTFORMS_TEXT_DOMAIN)));
            }

            $verify = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', array(
                'body' => array(
                    'secret' => $secret,
                    'response' => $response
                )
            ));

            $body = wp_remote_retrieve_body($verify);
            $result = json_decode($body);

            if (!isset($result->success) || !$result->success) {
                wp_send_json_error(array('message' => __('reCAPTCHA verification failed.', MTFORMS_TEXT_DOMAIN)));
            }

        } elseif ($captcha_provider === 'turnstile') {
            $secret = get_option('mtforms_turnstile_secret_key');
            $response = isset($_POST['cf-turnstile-response']) ? sanitize_text_field($_POST['cf-turnstile-response']) : '';

            if (empty($response)) {
                wp_send_json_error(array('message' => __('Please complete the Captcha.', MTFORMS_TEXT_DOMAIN)));
            }

            $verify = wp_remote_post('https://challenges.cloudflare.com/turnstile/v0/siteverify', array(
                'body' => array(
                    'secret' => $secret,
                    'response' => $response
                )
            ));

            $body = wp_remote_retrieve_body($verify);
            $result = json_decode($body);

            if (!isset($result->success) || !$result->success) {
                wp_send_json_error(array('message' => __('Captcha verification failed.', MTFORMS_TEXT_DOMAIN)));
            }
        }

        // Build email body
        $email_parts = array();
        $email_parts[] = '<strong>' . __('Name:', MTFORMS_TEXT_DOMAIN) . '</strong> ' . esc_html($name);
        $email_parts[] = '<strong>' . __('Email:', MTFORMS_TEXT_DOMAIN) . '</strong> ' . esc_html($email);

        if (!empty($phone)) {
            $email_parts[] = '<strong>' . __('Phone:', MTFORMS_TEXT_DOMAIN) . '</strong> ' . esc_html($phone);
        }

        if (!empty($website)) {
            $email_parts[] = '<strong>' . __('Website:', MTFORMS_TEXT_DOMAIN) . '</strong> ' . esc_url($website);
        }

        if (!empty($subject)) {
            $email_parts[] = '<strong>' . __('Subject:', MTFORMS_TEXT_DOMAIN) . '</strong> ' . esc_html($subject);
        }

        $email_parts[] = '<strong>' . __('Message:', MTFORMS_TEXT_DOMAIN) . '</strong><br>' . nl2br(esc_html($message));

        // Send Email
        $to = get_option('admin_email');
        $headers = array('Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>');
        $email_subject = !empty($subject) ? sprintf(__('New message from %s: %s', MTFORMS_TEXT_DOMAIN), $name, $subject) : sprintf(__('New message from %s', MTFORMS_TEXT_DOMAIN), $name);
        $email_body = implode('<br><br>', $email_parts);

        $sent = wp_mail($to, $email_subject, $email_body, $headers);

        if ($sent) {
            wp_send_json_success(array('message' => __('Message sent successfully!', MTFORMS_TEXT_DOMAIN)));
        } else {
            wp_send_json_error(array('message' => __('Failed to send message. Please try again.', MTFORMS_TEXT_DOMAIN)));
        }
    }

}
