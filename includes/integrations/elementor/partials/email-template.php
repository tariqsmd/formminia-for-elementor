<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * HTML Email Template for MTForms
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
$accent_color = get_option('mtforms_email_accent_color', '#6366f1');
$logo_url = get_option('mtforms_email_logo_url', '');
$footer_text = get_option('mtforms_email_footer_text', '');

// Sanitize.
$accent_color = sanitize_hex_color($accent_color) ?: '#6366f1';
$logo_url = esc_url($logo_url);
$footer_text = esc_html($footer_text);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
        }

        .wrapper {
            width: 100%;
            padding: 40px 0;
            background-color: #f4f7f6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e1e8ed;
        }

        /* ─── Header ─────────────────── */
        .email-header {
            background-color:
                <?php echo $accent_color; ?>
            ;
            padding: 28px 30px;
            text-align: center;
        }

        .email-header-logo {
            display: block;
            margin: 0 auto 14px;
            max-height: 50px;
            width: auto;
        }

        .email-header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.3px;
        }

        /* ─── Content ────────────────── */
        .email-content {
            padding: 36px 40px;
        }

        .email-intro {
            font-size: 15px;
            color: #64748b;
            margin: 0 0 28px;
        }

        .field-group {
            margin-bottom: 22px;
            padding-bottom: 22px;
            border-bottom: 1px solid #f0f3f5;
        }

        .field-group:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .field-label {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
            display: block;
        }

        .field-value {
            font-size: 15px;
            color: #1e293b;
            word-break: break-word;
            line-height: 1.6;
        }

        /* ─── Footer ─────────────────── */
        .email-footer {
            background-color: #f8fafc;
            color: #94a3b8;
            padding: 20px 30px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #e9ecef;
            line-height: 1.7;
        }

        .email-footer a {
            color:
                <?php echo $accent_color; ?>
            ;
            text-decoration: none;
        }

        .email-footer-accent {
            display: inline-block;
            width: 8px;
            height: 8px;
            background:
                <?php echo $accent_color; ?>
            ;
            border-radius: 50%;
            margin: 0 4px 2px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">

            <!-- Header -->
            <div class="email-header">
                <?php if (!empty($logo_url)): ?>
                    <img src="<?php echo $logo_url; ?>" alt="<?php echo esc_attr($site_name); ?>"
                        class="email-header-logo" />
                <?php endif; ?>
                <h1><?php esc_html_e('New Form Submission', MTFORMS_TEXT_DOMAIN); ?></h1>
            </div>

            <!-- Content -->
            <div class="email-content">

                <p class="email-intro">
                    <?php printf(
                        esc_html__('You received a new message from %s.', MTFORMS_TEXT_DOMAIN),
                        '<strong>' . esc_html($site_name) . '</strong>'
                    ); ?>
                </p>

                <?php foreach ($fields as $label => $value): ?>
                    <div class="field-group">
                        <span class="field-label"><?php echo esc_html($label); ?></span>
                        <div class="field-value"><?php echo nl2br(esc_html($value)); ?></div>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p>
                    <span class="email-footer-accent"></span>
                    <?php printf(
                        esc_html__('Submitted on %s via %s', MTFORMS_TEXT_DOMAIN),
                        esc_html($date),
                        esc_html($site_name)
                    ); ?>
                </p>
                <?php if (!empty($footer_text)): ?>
                    <p><?php echo $footer_text; ?></p>
                <?php endif; ?>
                <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html($site_name); ?>.</p>
            </div>

        </div>
    </div>
</body>

</html>