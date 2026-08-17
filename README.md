# MTForms

A modern, feature-rich contact form plugin for WordPress and Elementor. Multiple skins and layouts, GDPR support, spam protection, and professional HTML email notifications.

## Requirements

- WordPress 5.8 or higher
- Elementor (free) 3.5 or higher
- PHP 7.0 or higher

## Installation

1. Upload the `mtforms` folder to `/wp-content/plugins/`, or install through the WordPress admin Plugins screen.
2. Activate the plugin, then open **MTForms** in the admin menu to configure global settings (CAPTCHA provider, email template, recipients).
3. Edit any page with Elementor, search for the **MTForms** widget, and drag it to the content area.

## Architecture

All PHP lives under `includes/` and is loaded by the composer-free autoloader in `includes/Core/bootstrap.php`, which maps fully-qualified class names to file paths (case-sensitive, Windows-safe).

- **Core (`includes/Core`)** — `MTForms\Core\Plugin` (main orchestrator), `Loader`, `i18n`, `activator`, `deactivator`.
- **Admin (`includes/Admin`)** — `SettingsPage` (Settings API + submissions screen), `Options` (canonical option keys), `SubmissionsTable` (WP_List_Table with search, CSV export, bulk/single delete), `settings-view` template.
- **Frontend (`includes/Frontend`)** — `MTForms\Frontend\FormController`: registers assets and handles the AJAX submission endpoint (nonce, honeypot, IP rate limiting).
- **Services (`includes/Services`)** — `FormSubmission` (sanitized value object), `FormValidator`, `SubmissionRepository`, `WpOptionsConfig`, `WpMailMailer`; `Captcha\*` (reCAPTCHA v2 / Turnstile / no-op verifiers); `Email\SubmissionMailer` (notification + auto-responder emails).
- **Integrations (`includes/Integrations/Elementor`)** — `Integration` (registers the widget), `Widget`, `WidgetRenderer`, `WidgetControls\ContentControls` and `WidgetControls\StyleControls`.

## Extension Hooks

Key actions and filters:

- **Validation**
    - `mtforms_before_validate_submission( $pre, $submission )` — filter
    - `mtforms_after_validate_submission( $post, $submission )` — filter
- **Captcha**
    - `mtforms_captcha_error( $response, $provider )` — action
    - `mtforms_just_validate_src( $src )` — filter, override the JustValidate script URL (e.g. self-hosted)
- **Email**
    - `mtforms_email_to( $to, $submission, $fields )` — filter
    - `mtforms_email_from_name( $from_name, $submission, $fields )` — filter
    - `mtforms_email_headers( $headers, $submission, $fields )` — filter
    - `mtforms_email_subject( $subject, $submission, $fields )` — filter
    - `mtforms_email_body( $body, $submission, $fields )` — filter
    - `mtforms_email_template_path( $path, $fields )` — filter
    - `mtforms_before_send( $submission, $subject, $body, $headers, $fields )` — action
    - `mtforms_after_send( $sent, $submission, $subject, $body, $headers, $fields )` — action

## Privacy

Submissions (including the visitor's IP address and user agent) are stored in the site database so you can review contact messages. Entries can be permanently deleted from the Submissions screen, and all data is removed when the plugin is uninstalled.

## License

GPLv2 or later (see `readme.txt`). Includes JustValidate by Horprogs (MIT) — https://github.com/horprogs/Just-validate.