=== MTForms ===
Contributors: mtariqsmd
Tags: contact form, elementor form builder, elementor, gdpr, captcha
Requires at least: 5.8
Tested up to: 7.1
Requires PHP: 7.0
Requires Plugins: elementor
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

A modern, feature-rich contact form plugin for Elementor with multiple skins, layouts, GDPR support and spam protection.

== Description ==

MTForms is a modern contact form plugin for WordPress that integrates natively with Elementor. Build beautiful forms with 50+ preset skins, multiple layouts (floating labels, material, inline and more), inline SVG field icons and a professional HTML email template.

= Key features =

* Native Elementor widget with 50+ preset skins and 7 layout styles.
* Server-side validation for all required fields.
* Spam protection: Google reCAPTCHA v2, Cloudflare Turnstile and a honeypot field.
* IP-based rate limiting to prevent submission flooding.
* GDPR consent checkbox.
* Submissions stored securely in the database with an admin list table, search, CSV export and bulk/single delete.
* Professional HTML email notifications with customizable branding (colors, logo, footer), CC/BCC support and optional per-form recipients.
* Optional auto-responder emails to the visitor.
* Success redirect support.
* Fully translatable. All strings are properly internationalized.

= Privacy =

Submissions (including the visitor's IP address and user agent) are stored in your site's database so you can review contact messages. You can permanently delete entries from the Submissions screen, and all data is removed when the plugin is uninstalled.

= Requirements =

* WordPress 5.8 or higher.
* Elementor (free) 3.5 or higher.
* PHP 7.0 or higher.

== Installation ==

1. Upload the `mtforms` folder to the `/wp-content/plugins/` directory, or install it through the WordPress admin "Plugins" screen.
2. Activate the plugin. Go to Plugins → Installed Plugins and click "Activate" under MTForms.
3. Open MTForms in the admin menu to configure global settings (CAPTCHA, email template, recipients). The email settings are optional — by default notifications are sent to your WordPress admin email.
4. Edit any page/post with Elementor, search for the "MTForms" widget, and drag it to the content area.

== Frequently Asked Questions ==

= Do I need Elementor to use MTForms? =

Yes. MTForms is designed as an Elementor widget, so Elementor (free) must be installed and activated.

= Will the handler answer spam? =

MTForms includes Google reCAPTCHA v2, Cloudflare Turnstile, a honeypot field and IP-based rate limiting. Enable the provider you prefer in MTForms → General settings and turn on the CAPTCHA option in the widget.

= Are submitted messages stored? =

Yes. All submissions are saved in the database so you never lose an inquiry, even if the email fails. Manage them under MTForms → Submissions.

= How do I change the recipient email? =

By default notifications go to your site's admin email. To override it globally, go to MTForms → Email Settings → Recipient Email. You can also set a per-form recipient, CC and BCC in the widget's "Advanced Settings".

== Screenshots ==

1. The MTForms Elementor widget in the editor.
2. Form settings — fields, GDPR, CAPTCHA and honeypot.
3. Email settings — recipients and HTML template customization.
4. The submissions screen with search, CSV export and delete.

== Changelog ==

= 1.0.0 =
* Initial release.

== Credits ==

* JustValidate by Horprogs — https://github.com/horprogs/Just-validate — MIT License.