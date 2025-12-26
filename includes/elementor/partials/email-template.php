<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Professional HTML Email Template for MTForms
 *
 * @var array $args {
 *     @type string $subject Form subject.
 *     @type array  $fields  Submitted form fields.
 *     @type string $date    Submission date.
 *     @type string $site_name Site name.
 * }
 */

$fields = isset($args['fields']) ? $args['fields'] : [];
$date = isset($args['date']) ? $args['date'] : current_time('mysql');
$site_name = isset($args['site_name']) ? $args['site_name'] : get_bloginfo('name');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
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
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e1e8ed;
        }

        .header {
            background-color: #4a90e2;
            color: #fff;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 40px;
        }

        .field-group {
            margin-bottom: 25px;
            border-bottom: 1px solid #f0f3f5;
            padding-bottom: 15px;
        }

        .field-group:last-child {
            border-bottom: none;
        }

        .label {
            font-size: 13px;
            font-weight: 700;
            color: #8899a6;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: block;
        }

        .value {
            font-size: 16px;
            color: #2c3e50;
            word-break: break-all;
        }

        .footer {
            background-color: #f8f9fa;
            color: #95a5a6;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #e9ecef;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>
                    <?php echo esc_html__('New Form Submission', MTFORMS_TEXT_DOMAIN); ?>
                </h1>
            </div>
            <div class="content">
                <?php foreach ($fields as $label => $value): ?>
                    <div class="field-group">
                        <span class="label">
                            <?php echo esc_html($label); ?>
                        </span>
                        <div class="value">
                            <?php echo nl2br(esc_html($value)); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="footer">
                <p>
                    <?php printf(esc_html__('Submitted on %s via %s', MTFORMS_TEXT_DOMAIN), $date, $site_name); ?>
                </p>
                <p>&copy;
                    <?php echo date('Y'); ?>
                    <?php echo esc_html($site_name); ?>.
                    <?php echo esc_html__('All rights reserved.', MTFORMS_TEXT_DOMAIN); ?>
                </p>
            </div>
        </div>
    </div>
</body>

</html>