<?php
if (!defined('ABSPATH')) {
    exit;
}

// View template: variables below are injected by SubmissionMailer::build_body.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

/**
 * HTML Email Template for Quick Forms for Elementor
 *
 * Available variables (set by SubmissionMailer::build_body):
 *   $fields    array   Label => value pairs.
 *   $date      string  Submission date (MySQL format).
 *   $site_name string  Site name.
 */

$fields = isset($fields) ? $fields : [];
$date = isset($date) ? $date : current_time('mysql');
$site_name = isset($site_name) ? $site_name : get_bloginfo('name');

// Branding pulled from admin options.
$accent_color = get_option('mtef_email_accent_color', '#6366f1');
$bg_color = get_option('mtef_email_bg_color', '#f4f7f6');
$content_bg = get_option('mtef_email_content_bg_color', '#ffffff');
$text_color = get_option('mtef_email_text_color', '#1e293b');
$logo_url = get_option('mtef_email_logo_url', '');
$footer_text = get_option('mtef_email_footer_text', '');
$show_credit = get_option('mtef_email_show_footer_credit', 'yes') === 'yes';

// Sanitize.
$accent_color = sanitize_hex_color($accent_color) ?: '#6366f1';
$bg_color = sanitize_hex_color($bg_color) ?: '#f4f7f6';
$content_bg = sanitize_hex_color($content_bg) ?: '#ffffff';
$text_color = sanitize_hex_color($text_color) ?: '#1e293b';
$logo_url = esc_url($logo_url);
$footer_text = wp_kses_post($footer_text);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title><?php echo esc_html($site_name); ?></title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:AllowPNG/>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        body { margin: 0; padding: 0; width: 100% !important; height: 100% !important; }

        /* Responsive */
        @media screen and (max-width: 620px) {
            .email-container { width: 100% !important; max-width: 100% !important; }
            .email-content { padding: 24px 20px !important; }
            .email-header { padding: 20px 20px !important; }
            .email-header h1 { font-size: 18px !important; }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:<?php echo esc_attr( $bg_color ); ?>; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <!-- Preview text (hidden) -->
    <div style="display:none; max-height:0; overflow:hidden;">
        <?php echo esc_html($site_name); ?> - <?php esc_html_e('New Form Submission', 'quick-forms-for-elementor'); ?>
    </div>

    <!-- Wrapper -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color:<?php echo esc_attr( $bg_color ); ?>;">
        <tr>
            <td align="center" style="padding:40px 0;">
                <!--[if mso]>
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
                <tr>
                <td>
                <![endif]-->
                <!-- Container -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" class="email-container" style="max-width:600px; width:100%; background-color:<?php echo esc_attr( $content_bg ); ?>; border-radius:10px; overflow:hidden; border:1px solid #e1e8ed;">

                    <!-- Header -->
                    <tr>
                        <td class="email-header" style="background-color:<?php echo esc_attr( $accent_color ); ?>; padding:28px 30px; text-align:center;">
                            <?php if (!empty($logo_url)): ?>
                                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr($site_name); ?>" width="150" height="50" style="display:block; margin:0 auto 14px; max-height:50px; width:auto; height:auto;">
                            <?php endif; ?>
                            <h1 style="margin:0; font-size:22px; font-weight:700; color:#fff; letter-spacing:0.3px;">
                                <?php esc_html_e('New Form Submission', 'quick-forms-for-elementor'); ?>
                            </h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td class="email-content" style="padding:36px 40px;">
                            <p style="margin:0 0 28px; font-size:15px; color:#64748b;">
                                <?php
                                printf(
                                    /* translators: %s: name of the website the submission was sent from. */
                                    esc_html__('You received a new message from %s.', 'quick-forms-for-elementor'),
                                    '<strong>' . esc_html($site_name) . '</strong>'
                                ); ?>
                            </p>

                            <?php foreach ($fields as $label => $value): ?>
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom:22px; padding-bottom:22px; border-bottom:1px solid #f0f3f5;">
                                    <tr>
                                        <td>
                                            <span style="display:block; font-size:11px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:6px;">
                                                <?php echo esc_html($label); ?>
                                            </span>
                                            <div style="font-size:15px; color:#1e293b; word-break:break-word; line-height:1.6;">
                                                <?php echo nl2br(esc_html($value)); ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            <?php endforeach; ?>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="email-footer" style="background-color:#f8fafc; color:#94a3b8; padding:20px 30px; text-align:center; font-size:12px; border-top:1px solid #e9ecef; line-height:1.7;">
                            <?php if ($show_credit): ?>
                                <p style="margin:0 0 8px;">
                                    <span style="display:inline-block; width:8px; height:8px; background-color:<?php echo esc_attr( $accent_color ); ?>; border-radius:50%; margin:0 4px 2px; vertical-align:middle;"></span>
                                    <?php
                                    printf(
                                        /* translators: 1: date the form was submitted, 2: website name. */
                                        esc_html__('Submitted on %1$s via %2$s', 'quick-forms-for-elementor'),
                                        esc_html($date),
                                        esc_html($site_name)
                                    ); ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($footer_text)): ?>
                                <p style="margin:0 0 8px;"><?php echo wp_kses_post( $footer_text ); ?></p>
                            <?php endif; ?>
                            <p style="margin:0;">&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html($site_name); ?>.</p>
                        </td>
                    </tr>

                </table>
                <!--[if mso]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
    </table>
</body>
</html>
