<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 * @package    MT_Contact_Forms
 * @subpackage MT_Contact_Forms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    MT_Contact_Forms
 * @subpackage MT_Contact_Forms/public
 * @author     Muhammad Tariq
 */
class MTCF_Public {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../assets/css/mtcf-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

        // Enqueue JustValidate (using unpkg for demo, should be local for production)
		wp_enqueue_script( 'just-validate', 'https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js', array(), '4.3.0', true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../assets/js/mtcf-public.js', array( 'jquery', 'just-validate' ), $this->version, true );

        $captcha_provider = get_option('mtcf_captcha_provider', 'none');
        if ( $captcha_provider === 'recaptcha' ) {
            wp_enqueue_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );
        } elseif ( $captcha_provider === 'turnstile' ) {
            wp_enqueue_script( 'cloudflare-turnstile', 'https://challenges.cloudflare.com/turnstile/v0/api.js', array(), null, true );
        }

        wp_localize_script( $this->plugin_name, 'mtcf_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'mtcf-submit-form' ),
            'i18n'     => array(
                'name_required'    => __( 'Name is required', 'mt-contact-forms' ),
                'name_min'         => __( 'Name must be at least 3 characters', 'mt-contact-forms' ),
                'email_required'   => __( 'Email is required', 'mt-contact-forms' ),
                'email_invalid'    => __( 'Email is invalid', 'mt-contact-forms' ),
                'message_required' => __( 'Message is required', 'mt-contact-forms' ),
                'gdpr_required'    => __( 'You must agree to the terms', 'mt-contact-forms' ),
                'sending'          => __( 'Sending...', 'mt-contact-forms' ),
                'send_message'     => __( 'Send Message', 'mt-contact-forms' ),
                'error_generic'    => __( 'An unexpected error occurred. Please try again.', 'mt-contact-forms' ),
            ),
        ) );

	}

    /**
     * Register the shortcode
     */
    public function register_shortcodes() {
        add_shortcode( 'mtcf_form', array( $this, 'render_form' ) );
    }

    /**
     * Render the form
     */
    public function render_form( $atts ) {
        $atts = shortcode_atts( array(
            'skin' => 'default', // default, modern, dark
        ), $atts, 'mtcf_form' );

        // Start output buffering
        ob_start();

        // Include the form partial
        include plugin_dir_path( __FILE__ ) . 'partials/mtcf-public-display.php';

        // Return the buffered content
        return ob_get_clean();
    }

    /**
     * Handle AJAX Form Submission
     */
    public function handle_form_submission() {
        // Verify Nonce
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'mtcf-submit-form' ) ) {
            wp_send_json_error( array( 'message' => __( 'Security check failed.', 'mt-contact-forms' ) ) );
        }

        // Validate Fields (PHP side validation as backup)
        $name = sanitize_text_field( $_POST['mtcf_name'] );
        $email = sanitize_email( $_POST['mtcf_email'] );
        $subject = sanitize_text_field( $_POST['mtcf_subject'] );
        $message = sanitize_textarea_field( $_POST['mtcf_message'] );
        $gdpr = isset( $_POST['mtcf_gdpr'] ) ? 'yes' : 'no';

        if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
            wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'mt-contact-forms' ) ) );
        }

        if ( ! is_email( $email ) ) {
            wp_send_json_error( array( 'message' => __( 'Invalid email address.', 'mt-contact-forms' ) ) );
        }

        if ( $gdpr !== 'yes' ) {
             wp_send_json_error( array( 'message' => __( 'You must accept the GDPR terms.', 'mt-contact-forms' ) ) );
        }

        // Verify Captcha based on settings
        $captcha_provider = get_option('mtcf_captcha_provider', 'none');
        
        if ( $captcha_provider === 'recaptcha' ) {
            $secret = get_option('mtcf_recaptcha_secret_key');
            $response = isset($_POST['g-recaptcha-response']) ? sanitize_text_field($_POST['g-recaptcha-response']) : '';
            
            if ( empty( $response ) ) {
                wp_send_json_error( array( 'message' => __( 'Please complete the reCAPTCHA.', 'mt-contact-forms' ) ) );
            }

            $verify = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
                'body' => array(
                    'secret' => $secret,
                    'response' => $response
                )
            ) );

            $body = wp_remote_retrieve_body( $verify );
            $result = json_decode( $body );

            if ( ! isset( $result->success ) || ! $result->success ) {
                wp_send_json_error( array( 'message' => __( 'reCAPTCHA verification failed.', 'mt-contact-forms' ) ) );
            }

        } elseif ( $captcha_provider === 'turnstile' ) {
            $secret = get_option('mtcf_turnstile_secret_key');
            $response = isset($_POST['cf-turnstile-response']) ? sanitize_text_field($_POST['cf-turnstile-response']) : '';

            if ( empty( $response ) ) {
                wp_send_json_error( array( 'message' => __( 'Please complete the Captcha.', 'mt-contact-forms' ) ) );
            }

            $verify = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', array(
                'body' => array(
                    'secret' => $secret,
                    'response' => $response
                )
            ) );

            $body = wp_remote_retrieve_body( $verify );
            $result = json_decode( $body );

            if ( ! isset( $result->success ) || ! $result->success ) {
                wp_send_json_error( array( 'message' => __( 'Captcha verification failed.', 'mt-contact-forms' ) ) );
            }
        }

        // Send Email (Mockup for now, or actual wp_mail)
        $to = get_option( 'admin_email' );
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $body = "Name: $name <br> Email: $email <br> Subject: $subject <br> Message: <br> $message";
        
        $sent = wp_mail( $to, "New message from $name: $subject", $body, $headers );

        if ( $sent ) {
            wp_send_json_success( array( 'message' => __( 'Message sent successfully!', 'mt-contact-forms' ) ) );
        } else {
            wp_send_json_error( array( 'message' => __( 'Failed to send message. Please try again.', 'mt-contact-forms' ) ) );
        }
    }

}
