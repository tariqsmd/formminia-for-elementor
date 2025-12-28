# MTForms

Modern and Easy Contact Form

## Architecture Overview

MTForms uses a modern, layered PHP architecture while remaining fully WordPress‑compatible:

- **Core (`includes/Core`)**
  - `MTForms\Core\Plugin` – main orchestrator that loads dependencies and registers hooks.
  - `MTForms\Core\Loader` – thin namespaced wrapper around the legacy `MTForms_Loader`.
- **Frontend (`includes/Frontend`)**
  - `MTForms\Frontend\FormController` – handles public assets and AJAX form submissions.
- **Domain (`includes/Domain`)**
  - `MTForms\Domain\FormSubmission` – sanitized value object for submission data.
  - `MTForms\Domain\FormValidator` – server‑side validation (required fields, email, GDPR).
  - `MTForms\Domain\Captcha\*Verifier` – reCAPTCHA, Turnstile, or no‑op captcha strategies.
  - `MTForms\Domain\Email\SubmissionMailer` – builds and sends notification emails.
- **Infrastructure (`includes/Infrastructure`)**
  - `MTForms\Infrastructure\WpOptionsConfig` – wrapper for `get_option()` reads.
  - `MTForms\Infrastructure\WpMailMailer` – adapter around `wp_mail()`.
- **Admin (`includes/Admin`)**
  - `MTForms\Admin\SettingsPage` – the main settings screen and Settings API registration.
  - `MTForms\Admin\Options` – central list of option keys.
- **Elementor (`includes/Elementor` + `includes/elementor`)**
  - `MTForms\Elementor\Integration` – registers the Elementor widget.
  - `MTForms\Elementor\Widget` – namespaced wrapper for the legacy `MTForms_Widget`.

Legacy global classes such as `MTForms_Core`, `MTForms_Admin`, `MTForms_Public`, and
`MTForms_Elementor` are kept as thin proxies or shims to preserve backwards compatibility.

## Extension Hooks

Key actions and filters you can hook into:

- **Validation**
  - `mtforms_before_validate_submission( ?WP_Error $pre, MTForms\Domain\FormSubmission $submission )`
  - `mtforms_after_validate_submission( ?WP_Error $post, MTForms\Domain\FormSubmission $submission )`
- **Captcha**
  - `mtforms_captcha_error( WP_Error $error, string $provider )`
- **Email**
  - `mtforms_email_to( string $to, MTForms\Domain\FormSubmission $submission, array $fields )`
  - `mtforms_email_from_name( string $from_name, MTForms\Domain\FormSubmission $submission, array $fields )`
  - `mtforms_email_headers( array $headers, MTForms\Domain\FormSubmission $submission, array $fields )`
  - `mtforms_email_subject( string $subject, MTForms\Domain\FormSubmission $submission, array $fields )`
  - `mtforms_email_body( string $body, MTForms\Domain\FormSubmission $submission, array $fields )`
  - `mtforms_email_template_path( string $path, array $fields )`
  - `mtforms_email_args( array $args )` – final `wp_mail()` arguments.
  - `mtforms_before_send( MTForms\Domain\FormSubmission $submission, string $subject, string $body, array $headers, array $fields )`
  - `mtforms_after_send( bool $sent, MTForms\Domain\FormSubmission $submission, string $subject, string $body, array $headers, array $fields )`
- **Assets**
  - `mtforms_just_validate_src( string $src )` – override JustValidate script URL (e.g. to a self‑hosted file).

These hooks allow you to customise validation, spam protection, email routing, and presentation
without modifying the core plugin code.
