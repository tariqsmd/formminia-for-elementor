<?php

namespace FORMMINIA\Integrations\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait WidgetRenderer {

	/**
	 * Render widget output on the frontend.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();

		// Enqueue Captcha scripts on-demand if enabled in widget settings
		if ($settings['show_captcha'] === 'yes') {
			$captcha_provider = get_option('formminia_captcha_provider', 'none');
			if ($captcha_provider === 'recaptcha') {
				wp_enqueue_script('google-recaptcha');
			} elseif ($captcha_provider === 'turnstile') {
				wp_enqueue_script('cloudflare-turnstile');
			}
		}

		// Calculate required fields
		$required_fields = [];
		$fields = ['name', 'email', 'phone', 'website', 'subject', 'message'];
		foreach ($fields as $field) {
			if ($settings['show_' . $field] === 'yes' && $settings['required_' . $field] === 'yes') {
				$required_fields[] = 'formminia_' . $field;
			}
		}

		if ($settings['show_gdpr'] === 'yes') {
			$required_fields[] = 'formminia_gdpr';
		}

		$this->get_partial(
			'form-header',
			[
				'settings' => $settings,
				'widget_id' => $widget_id,
				'required_fields' => $required_fields,
			]
		);

		if ($settings['form_title']) {
			printf('<h2 class="formminia-form-title">%s</h2>', esc_html($settings['form_title']));
		}

		$this->render_form_content($settings, $widget_id);

		$this->get_partial(
			'form-footer',
			[
				'settings' => $settings,
				'widget_id' => $widget_id,
			]
		);
	}

	/**
	 * Render the form contents.
	 */
	public function render_form_content($settings, $widget_id)
	{
		echo '<div class="formminia-fields-wrapper">';

		if ($settings['show_name'] === 'yes') {
			$this->render_field('name', $settings, $widget_id);
		}

		if ($settings['show_email'] === 'yes') {
			$this->render_field('email', $settings, $widget_id);
		}

		if ($settings['show_phone'] === 'yes') {
			$this->render_field('phone', $settings, $widget_id);
		}

		if ($settings['show_website'] === 'yes') {
			$this->render_field('website', $settings, $widget_id);
		}

		if ($settings['show_subject'] === 'yes') {
			$this->render_field('subject', $settings, $widget_id);
		}

		echo '</div>'; // .formminia-fields-wrapper

		if ($settings['show_message'] === 'yes') {
			$this->render_field('message', $settings, $widget_id);
		}

		$this->get_partial(
			'gdpr',
			[
				'settings' => $settings,
				'widget_id' => $widget_id,
			]
		);

		$this->get_partial(
			'captcha',
			[
				'settings' => $settings,
			]
		);

		$this->render_button($settings);

		$this->get_partial('response', []);
	}

	/**
	 * Render a form field.
	 */
	public function render_field($type, $settings, $widget_id)
	{
		$field_args = [
			'settings' => $settings,
			'widget_id' => $widget_id,
			'type' => $type,
			'required' => false,
			'field_id' => 'field-' . $type . '-' . $widget_id,
		];

		// Get dynamic icon if available
		$field_args['icon'] = isset($settings['icon_' . $type]) ? $settings['icon_' . $type] : null;
		$field_args['required'] = (isset($settings['required_' . $type]) && $settings['required_' . $type] === 'yes');

		switch ($type) {
			case 'name':
				$field_args['name'] = 'formminia_name';
				$field_args['label'] = $settings['label_name'];
				$field_args['placeholder'] = $settings['placeholder_name'];
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>';
				break;
			case 'email':
				$field_args['name'] = 'formminia_email';
				$field_args['label'] = $settings['label_email'];
				$field_args['placeholder'] = $settings['placeholder_email'];
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>';
				break;
			case 'phone':
				$field_args['name'] = 'formminia_phone';
				$field_args['label'] = $settings['label_phone'];
				$field_args['placeholder'] = $settings['placeholder_phone'];
				$field_args['type'] = 'tel';
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>';
				break;
			case 'website':
				$field_args['name'] = 'formminia_website';
				$field_args['label'] = $settings['label_website'];
				$field_args['placeholder'] = $settings['placeholder_website'];
				$field_args['type'] = 'url';
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2z"/></svg>';
				break;
			case 'subject':
				$field_args['name'] = 'formminia_subject';
				$field_args['label'] = $settings['label_subject'];
				$field_args['placeholder'] = $settings['placeholder_subject'];
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6z"/></svg>';
				break;
			case 'message':
				$field_args['name'] = 'formminia_message';
				$field_args['label'] = $settings['label_message'];
				$field_args['placeholder'] = $settings['placeholder_message'];
				$field_args['type'] = 'textarea';
				$field_args['icon_svg'] = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>';
				break;
		}

		$this->get_partial('field-item', $field_args);
	}

	/**
	 * Render the submit button.
	 */
	public function render_button($settings)
	{
		$this->get_partial(
			'button',
			[
				'settings' => $settings,
			]
		);
	}

	/**
	 * Get partial template file.
	 *
	 * @param string $template Template name.
	 * @param array  $args     Arguments to pass to the template.
	 */
	public function get_partial($template, $args = [])
	{
		$path = FORMMINIA_PLUGIN_DIR . 'includes/Integrations/Elementor/Partials/' . $template . '.php';
		if (file_exists($path)) {
			include $path;
		}
	}
}