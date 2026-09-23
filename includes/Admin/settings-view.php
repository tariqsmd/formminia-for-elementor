<?php
/**
 * Provide an admin area view for the plugin
 *
 * @package    Quick Forms for Elementor
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// This file is a partial view template included by the controller, so its variables are shared with the calling scope.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Active tab is read from the URL to decide which panel renders (display only).
// phpcs:ignore WordPress.Security.NonceVerification.Recommended
$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'general';

$tabs = array(
	'general' => array(
		'label'    => __( 'General', 'quick-forms-for-elementor' ),
		'subtitle' => __( 'Security & Anti-Spam', 'quick-forms-for-elementor' ),
		'icon'     => 'dashicons-shield',
	),
	'email'   => array(
		'label'    => __( 'Email Settings', 'quick-forms-for-elementor' ),
		'subtitle' => __( 'Templates & Branding', 'quick-forms-for-elementor' ),
		'icon'     => 'dashicons-email-alt',
	),
	'support' => array(
		'label'    => __( 'Support & Guide', 'quick-forms-for-elementor' ),
		'subtitle' => __( 'Features & Payments', 'quick-forms-for-elementor' ),
		'icon'     => 'dashicons-heart',
	),
);

// Pre-fetch option values.
$captcha_provider = get_option( 'mtef_captcha_provider', 'none' );
$admin_email      = get_option( 'mtef_admin_email', get_option( 'admin_email' ) );
$email_subject    = get_option( 'mtef_email_subject', 'New Contact Form Submission' );
$email_from_name  = get_option( 'mtef_email_from_name', get_bloginfo( 'name' ) );
$enable_html      = get_option( 'mtef_enable_html_email', 'yes' );
$accent_color     = get_option( 'mtef_email_accent_color', '#4f46e5' );
$bg_color         = get_option( 'mtef_email_bg_color', '#f8fafc' );
$content_bg       = get_option( 'mtef_email_content_bg_color', '#ffffff' );
$text_color       = get_option( 'mtef_email_text_color', '#1e293b' );
$logo_url         = get_option( 'mtef_email_logo_url', '' );
$footer_text      = get_option( 'mtef_email_footer_text', '' );
$show_credit      = get_option( 'mtef_email_show_footer_credit', 'yes' );

$has_elementor = defined( 'ELEMENTOR_VERSION' ) || did_action( 'elementor/loaded' );

// Documentation link to the Cloudflare Turnstile dashboard (not an offloaded asset).
// phpcs:ignore PluginCheck.CodeAnalysis.Offloading.OffloadedContent
$turnstile_docs_url = 'https://dash.cloudflare.com/?to=/:account/turnstile';
?>

<!-- ══════════════════════════════════════════════════════ -->
<!-- WORDPRESS NOTICES WRAPPER                              -->
<!-- WP's common.js relocates .notice divs after the first  -->
<!-- .wp-header-end found, so notices render here (on top)  -->
<!-- instead of inside the branded header below.            -->
<!-- ══════════════════════════════════════════════════════ -->
<div class="wrap">
	<div class="wp-header-end"></div>
</div>

<!-- ══════════════════════════════════════════════════════ -->
<!-- PLUGIN CONTENT                                         -->
<!-- ══════════════════════════════════════════════════════ -->
<div class="mtef-admin-wrap">

	<!-- ══════════════════════════════════════════════════════ -->
	<!-- MODERN TOP HEADER                                      -->
	<!-- ══════════════════════════════════════════════════════ -->
	<header class="mtef-page-header">
		<div class="mtef-page-header-brand">
			<div class="mtef-logo-badge">
				<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M22 6L12 13L2 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>
			<div class="mtef-title-area">
				<div class="mtef-title-row">
					<h1><?php esc_html_e( 'Quick Forms for Elementor', 'quick-forms-for-elementor' ); ?></h1>
					<span class="mtef-version-pill">v<?php echo esc_html( MTEF_VERSION ); ?></span>
					<span class="mtef-status-pill <?php echo $has_elementor ? 'is-active' : 'is-warning'; ?>">
						<span class="status-dot"></span>
						<?php echo $has_elementor ? esc_html__( 'Elementor Ready', 'quick-forms-for-elementor' ) : esc_html__( 'Elementor Required', 'quick-forms-for-elementor' ); ?>
					</span>
				</div>
				<p class="mtef-subtitle"><?php esc_html_e( 'Modern contact forms with 50+ skins, anti-spam, and styled notifications', 'quick-forms-for-elementor' ); ?></p>
			</div>
		</div>

		<div class="mtef-page-header-actions">
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=mtef-submissions' ) ); ?>" class="mtef-btn-secondary">
				<span class="dashicons dashicons-list-view"></span>
				<?php esc_html_e( 'View Submissions', 'quick-forms-for-elementor' ); ?>
			</a>
			<a href="https://wordpress.org/support/plugin/quick-forms-for-elementor/" target="_blank" rel="noopener noreferrer" class="mtef-btn-secondary">
				<span class="dashicons dashicons-editor-help"></span>
				<?php esc_html_e( 'Documentation', 'quick-forms-for-elementor' ); ?>
			</a>
		</div>
	</header>

	<!-- ══════════════════════════════════════════════════════ -->
	<!-- ADMIN LAYOUT                                           -->
	<!-- ══════════════════════════════════════════════════════ -->
	<div class="mtef-admin-layout">

		<!-- ═══ LEFT SIDEBAR ═══ -->
		<aside class="mtef-admin-sidebar">
			<nav class="mtef-sidebar-nav" aria-label="<?php esc_attr_e( 'Plugin Settings Navigation', 'quick-forms-for-elementor' ); ?>">
				<?php foreach ( $tabs as $tab_key => $tab ) : ?>
					<a href="?page=mtef&tab=<?php echo esc_attr( $tab_key ); ?>"
						class="mtef-sidebar-nav-item <?php echo $active_tab === $tab_key ? 'is-active' : ''; ?>">
						<span class="nav-item-icon dashicons <?php echo esc_attr( $tab['icon'] ); ?>"></span>
						<span class="nav-item-text">
							<span class="nav-item-title"><?php echo esc_html( $tab['label'] ); ?></span>
							<span class="nav-item-subtitle"><?php echo esc_html( $tab['subtitle'] ); ?></span>
						</span>
						<span class="nav-item-arrow dashicons dashicons-arrow-right-alt2"></span>
					</a>
				<?php endforeach; ?>
			</nav>

			<!-- Quick Link / Shortcut Card -->
			<div class="mtef-sidebar-card">
				<div class="sidebar-card-header">
					<span class="dashicons dashicons-admin-appearance"></span>
					<strong><?php esc_html_e( '50+ Preset Skins', 'quick-forms-for-elementor' ); ?></strong>
				</div>
				<p><?php esc_html_e( 'Edit any page with Elementor, search for the "Quick Forms" widget, and choose from 50 built-in skins.', 'quick-forms-for-elementor' ); ?></p>
				<a href="https://github.com/tariqsmd/mtforms/issues" target="_blank" rel="noopener noreferrer" class="sidebar-link">
					<span class="dashicons dashicons-external"></span>
					<?php esc_html_e( 'Request a Skin / Feature', 'quick-forms-for-elementor' ); ?>
				</a>
			</div>
		</aside>
		<!-- ═══ /LEFT SIDEBAR ═══ -->

		<!-- ═══ MAIN CONTENT ═══ -->
		<main class="mtef-admin-main">

			<?php if ( 'general' === $active_tab ) : ?>

				<form method="post" action="options.php" class="mtef-form-layout">
					<?php settings_fields( \MTEF\Admin\Options::GROUP_GENERAL ); ?>

					<!-- SECTION 1: SPAM PROTECTION -->
					<section class="mtef-card">
						<div class="mtef-card-header">
							<div class="header-icon-wrap shield-icon">
								<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
								</svg>
							</div>
							<div>
								<h2><?php esc_html_e( 'Anti-Spam & CAPTCHA Provider', 'quick-forms-for-elementor' ); ?></h2>
								<p class="section-desc"><?php esc_html_e( 'Choose which validation challenge to use across your forms to stop automated bot submissions.', 'quick-forms-for-elementor' ); ?></p>
							</div>
						</div>

						<div class="mtef-card-body">
							<!-- Hidden Select for native form submission -->
							<select name="mtef_captcha_provider" id="mtef_captcha_provider" class="mtef-provider-select" style="display:none;">
								<option value="none" <?php selected( $captcha_provider, 'none' ); ?>><?php esc_html_e( 'None', 'quick-forms-for-elementor' ); ?></option>
								<option value="recaptcha" <?php selected( $captcha_provider, 'recaptcha' ); ?>><?php esc_html_e( 'Google reCAPTCHA v2', 'quick-forms-for-elementor' ); ?></option>
								<option value="turnstile" <?php selected( $captcha_provider, 'turnstile' ); ?>><?php esc_html_e( 'Cloudflare Turnstile', 'quick-forms-for-elementor' ); ?></option>
							</select>

							<!-- Visual Provider Selector Cards -->
							<div class="mtef-provider-grid">
								<!-- Card 1: None -->
								<div class="provider-card <?php echo 'none' === $captcha_provider ? 'is-selected' : ''; ?>" data-provider="none">
									<div class="provider-radio-check"></div>
									<div class="provider-icon-badge">
										<span class="dashicons dashicons-dismiss"></span>
									</div>
									<div class="provider-info">
										<h3><?php esc_html_e( 'Disabled', 'quick-forms-for-elementor' ); ?></h3>
										<p><?php esc_html_e( 'No CAPTCHA challenge. Forms will still use the honeypot and IP rate limiting.', 'quick-forms-for-elementor' ); ?></p>
									</div>
									<span class="provider-tag default-tag"><?php esc_html_e( 'Basic Spam Filter', 'quick-forms-for-elementor' ); ?></span>
								</div>

								<!-- Card 2: reCAPTCHA v2 -->
								<div class="provider-card <?php echo 'recaptcha' === $captcha_provider ? 'is-selected' : ''; ?>" data-provider="recaptcha">
									<div class="provider-radio-check"></div>
									<div class="provider-icon-badge recaptcha-badge">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12" stroke="#4285F4" stroke-width="2" stroke-linecap="round"/>
											<path d="M22 12C22 6.48 17.52 2 12 2" stroke="#34A853" stroke-width="2" stroke-linecap="round"/>
											<path d="M9 12L11 14L15 10" stroke="#4285F4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</div>
									<div class="provider-info">
										<h3><?php esc_html_e( 'Google reCAPTCHA v2', 'quick-forms-for-elementor' ); ?></h3>
										<p><?php esc_html_e( 'The familiar "I\'m not a robot" checkbox challenge. Requires Google API keys.', 'quick-forms-for-elementor' ); ?></p>
									</div>
									<span class="provider-tag google-tag"><?php esc_html_e( 'Checkbox Challenge', 'quick-forms-for-elementor' ); ?></span>
								</div>

								<!-- Card 3: Cloudflare Turnstile -->
								<div class="provider-card <?php echo 'turnstile' === $captcha_provider ? 'is-selected' : ''; ?>" data-provider="turnstile">
									<div class="provider-radio-check"></div>
									<div class="provider-icon-badge turnstile-badge">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M17.5 19H9C5.13 19 2 15.87 2 12C2 8.48 4.61 5.57 8.01 5.07C9.36 3.19 11.54 2 14 2C17.87 2 21 5.13 21 9C21 9.34 20.98 9.67 20.93 10C21.58 10.45 22 11.18 22 12C22 13.66 20.66 15 19 15C18.66 15 18.34 14.94 18.05 14.83" stroke="#F6821F" stroke-width="2" stroke-linecap="round"/>
										</svg>
									</div>
									<div class="provider-info">
										<h3><?php esc_html_e( 'Cloudflare Turnstile', 'quick-forms-for-elementor' ); ?></h3>
										<p><?php esc_html_e( 'Modern, privacy-first alternative. Seamless non-interactive verification.', 'quick-forms-for-elementor' ); ?></p>
									</div>
									<span class="provider-tag recommended-tag"><?php esc_html_e( 'Recommended', 'quick-forms-for-elementor' ); ?></span>
								</div>
							</div>

							<!-- Provider Credentials Box: reCAPTCHA -->
							<div class="mtef-credentials-panel recaptcha-fields" <?php echo 'recaptcha' !== $captcha_provider ? 'style="display:none;"' : ''; ?>>
								<div class="credentials-banner">
									<span class="dashicons dashicons-info"></span>
									<div>
										<strong><?php esc_html_e( 'Need reCAPTCHA v2 credentials?', 'quick-forms-for-elementor' ); ?></strong>
										<p><?php esc_html_e( 'Register your site in the Google reCAPTCHA Console and select "Challenge (v2)" -> "I\'m not a robot" Checkbox.', 'quick-forms-for-elementor' ); ?></p>
										<a href="https://www.google.com/recaptcha/admin" target="_blank" rel="noopener noreferrer" class="external-link">
											<?php esc_html_e( 'Open Google reCAPTCHA Console', 'quick-forms-for-elementor' ); ?>
											<span class="dashicons dashicons-external"></span>
										</a>
									</div>
								</div>

								<div class="mtef-field-group">
									<label for="mtef_recaptcha_site_key">
										<?php esc_html_e( 'reCAPTCHA Site Key', 'quick-forms-for-elementor' ); ?>
										<span class="required-asterisk">*</span>
									</label>
									<div class="input-wrap">
										<input type="text" id="mtef_recaptcha_site_key" name="mtef_recaptcha_site_key"
											value="<?php echo esc_attr( get_option( 'mtef_recaptcha_site_key', '' ) ); ?>"
											class="regular-text" placeholder="e.g. 6Ld...AAAAA..." autocomplete="off" />
									</div>
									<p class="field-hint"><?php esc_html_e( 'Public site key displayed in your form HTML.', 'quick-forms-for-elementor' ); ?></p>
								</div>

								<div class="mtef-field-group">
									<label for="mtef_recaptcha_secret_key">
										<?php esc_html_e( 'reCAPTCHA Secret Key', 'quick-forms-for-elementor' ); ?>
										<span class="required-asterisk">*</span>
									</label>
									<div class="input-wrap password-wrap">
										<input type="password" id="mtef_recaptcha_secret_key" name="mtef_recaptcha_secret_key"
											value="<?php echo esc_attr( get_option( 'mtef_recaptcha_secret_key', '' ) ); ?>"
											class="regular-text password-input" placeholder="e.g. 6Ld...AAAAA..." autocomplete="off" />
										<button type="button" class="btn-toggle-password" title="<?php esc_attr_e( 'Toggle password visibility', 'quick-forms-for-elementor' ); ?>">
											<span class="dashicons dashicons-visibility"></span>
										</button>
									</div>
									<p class="field-hint"><?php esc_html_e( 'Secret key used for secure server-side verification. Never share this key.', 'quick-forms-for-elementor' ); ?></p>
								</div>
							</div>

							<!-- Provider Credentials Box: Turnstile -->
							<div class="mtef-credentials-panel turnstile-fields" <?php echo 'turnstile' !== $captcha_provider ? 'style="display:none;"' : ''; ?>>
								<div class="credentials-banner">
									<span class="dashicons dashicons-info"></span>
									<div>
										<strong><?php esc_html_e( 'Need Cloudflare Turnstile credentials?', 'quick-forms-for-elementor' ); ?></strong>
										<p><?php esc_html_e( 'Create a new widget in your Cloudflare dashboard under Turnstile -> Add Site (Managed or Non-interactive mode).', 'quick-forms-for-elementor' ); ?></p>
										<a href="<?php echo esc_url( $turnstile_docs_url ); ?>" target="_blank" rel="noopener noreferrer" class="external-link">
											<?php esc_html_e( 'Open Cloudflare Turnstile Dashboard', 'quick-forms-for-elementor' ); ?>
											<span class="dashicons dashicons-external"></span>
										</a>
									</div>
								</div>

								<div class="mtef-field-group">
									<label for="mtef_turnstile_site_key">
										<?php esc_html_e( 'Turnstile Site Key', 'quick-forms-for-elementor' ); ?>
										<span class="required-asterisk">*</span>
									</label>
									<div class="input-wrap">
										<input type="text" id="mtef_turnstile_site_key" name="mtef_turnstile_site_key"
											value="<?php echo esc_attr( get_option( 'mtef_turnstile_site_key', '' ) ); ?>"
											class="regular-text" placeholder="e.g. 0x4AAAAAA..." autocomplete="off" />
									</div>
									<p class="field-hint"><?php esc_html_e( 'Public site key provided by Cloudflare.', 'quick-forms-for-elementor' ); ?></p>
								</div>

								<div class="mtef-field-group">
									<label for="mtef_turnstile_secret_key">
										<?php esc_html_e( 'Turnstile Secret Key', 'quick-forms-for-elementor' ); ?>
										<span class="required-asterisk">*</span>
									</label>
									<div class="input-wrap password-wrap">
										<input type="password" id="mtef_turnstile_secret_key" name="mtef_turnstile_secret_key"
											value="<?php echo esc_attr( get_option( 'mtef_turnstile_secret_key', '' ) ); ?>"
											class="regular-text password-input" placeholder="e.g. 0x4AAAAAA..." autocomplete="off" />
										<button type="button" class="btn-toggle-password" title="<?php esc_attr_e( 'Toggle password visibility', 'quick-forms-for-elementor' ); ?>">
											<span class="dashicons dashicons-visibility"></span>
										</button>
									</div>
									<p class="field-hint"><?php esc_html_e( 'Secret key for server-side siteverify endpoint.', 'quick-forms-for-elementor' ); ?></p>
								</div>
							</div>
						</div>
					</section>

					<!-- STICKY ACTION BAR -->
					<div class="mtef-sticky-save">
						<div class="save-status-text">
							<span class="dashicons dashicons-saved"></span>
							<span><?php esc_html_e( 'Configure settings and click save to apply changes.', 'quick-forms-for-elementor' ); ?></span>
						</div>
						<button type="submit" class="mtef-btn-primary">
							<span class="dashicons dashicons-yes-alt"></span>
							<?php esc_html_e( 'Save Settings', 'quick-forms-for-elementor' ); ?>
						</button>
					</div>
				</form>

			<?php elseif ( 'email' === $active_tab ) : ?>

				<form method="post" action="options.php" class="mtef-form-layout">
					<?php settings_fields( \MTEF\Admin\Options::GROUP_EMAIL ); ?>

					<div class="mtef-two-col-grid">
						<!-- LEFT COLUMN: SETTINGS -->
						<div class="settings-col">

							<!-- SECTION 1: RECIPIENTS & ROUTING -->
							<section class="mtef-card">
								<div class="mtef-card-header">
									<div class="header-icon-wrap mail-icon">
										<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
											<polyline points="22,6 12,13 2,6"/>
										</svg>
									</div>
									<div>
										<h2><?php esc_html_e( 'Notification Routing', 'quick-forms-for-elementor' ); ?></h2>
										<p class="section-desc"><?php esc_html_e( 'Configure who receives notifications when a contact form is submitted.', 'quick-forms-for-elementor' ); ?></p>
									</div>
								</div>

								<div class="mtef-card-body">
									<div class="mtef-field-group">
										<label for="mtef_admin_email">
											<?php esc_html_e( 'Recipient Email', 'quick-forms-for-elementor' ); ?>
											<span class="required-asterisk">*</span>
										</label>
										<div class="input-wrap">
											<input type="email" id="mtef_admin_email" name="mtef_admin_email"
												value="<?php echo esc_attr( $admin_email ); ?>"
												class="regular-text" required />
										</div>
										<p class="field-hint"><?php esc_html_e( 'Primary email address where submission notifications are delivered.', 'quick-forms-for-elementor' ); ?></p>
									</div>

									<div class="form-row-2col">
										<div class="mtef-field-group">
											<label for="mtef_email_cc"><?php esc_html_e( 'CC Addresses', 'quick-forms-for-elementor' ); ?></label>
											<input type="text" id="mtef_email_cc" name="mtef_email_cc"
												value="<?php echo esc_attr( get_option( 'mtef_email_cc', '' ) ); ?>"
												class="regular-text" placeholder="team@domain.com, lead@domain.com" />
											<p class="field-hint"><?php esc_html_e( 'Comma-separated email list.', 'quick-forms-for-elementor' ); ?></p>
										</div>

										<div class="mtef-field-group">
											<label for="mtef_email_bcc"><?php esc_html_e( 'BCC Addresses', 'quick-forms-for-elementor' ); ?></label>
											<input type="text" id="mtef_email_bcc" name="mtef_email_bcc"
												value="<?php echo esc_attr( get_option( 'mtef_email_bcc', '' ) ); ?>"
												class="regular-text" placeholder="archive@domain.com" />
											<p class="field-hint"><?php esc_html_e( 'Blind carbon copy addresses.', 'quick-forms-for-elementor' ); ?></p>
										</div>
									</div>

									<div class="form-row-2col">
										<div class="mtef-field-group">
											<label for="mtef_email_from_name"><?php esc_html_e( 'Sender Name ("From")', 'quick-forms-for-elementor' ); ?></label>
											<input type="text" id="mtef_email_from_name" name="mtef_email_from_name"
												value="<?php echo esc_attr( $email_from_name ); ?>"
												class="regular-text" />
										</div>

										<div class="mtef-field-group">
											<label for="mtef_email_subject"><?php esc_html_e( 'Default Subject', 'quick-forms-for-elementor' ); ?></label>
											<input type="text" id="mtef_email_subject" name="mtef_email_subject"
												value="<?php echo esc_attr( $email_subject ); ?>"
												class="regular-text" />
										</div>
									</div>
								</div>
							</section>

							<!-- SECTION 2: HTML TEMPLATE & BRANDING -->
							<section class="mtef-card">
								<div class="mtef-card-header">
									<div class="header-icon-wrap palette-icon">
										<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/>
											<circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/>
											<circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/>
											<circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/>
											<path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/>
										</svg>
									</div>
									<div>
										<h2><?php esc_html_e( 'Template Branding & Colors', 'quick-forms-for-elementor' ); ?></h2>
										<p class="section-desc"><?php esc_html_e( 'Customize your HTML email notification layout, colors, logo and footer.', 'quick-forms-for-elementor' ); ?></p>
									</div>
								</div>

								<div class="mtef-card-body">
									<div class="mtef-toggle-row">
										<div class="toggle-meta">
											<strong><?php esc_html_e( 'Enable HTML Email Template', 'quick-forms-for-elementor' ); ?></strong>
											<p><?php esc_html_e( 'Renders a responsive, branded email template instead of plain text.', 'quick-forms-for-elementor' ); ?></p>
										</div>
										<label class="mtef-switch">
											<input type="checkbox" name="mtef_enable_html_email" value="yes" <?php checked( $enable_html, 'yes' ); ?> id="toggle_enable_html">
											<span class="mtef-slider round"></span>
										</label>
									</div>

									<!-- Quick Palette Presets -->
									<div class="mtef-preset-palettes">
										<span class="palette-label"><?php esc_html_e( 'Color Presets:', 'quick-forms-for-elementor' ); ?></span>
										<div class="palette-buttons">
											<button type="button" class="btn-palette" data-accent="#4f46e5" data-bg="#f8fafc" data-content="#ffffff" data-text="#1e293b">
												<span class="swatch" style="background:#4f46e5;"></span>
												<?php esc_html_e( 'Indigo Modern', 'quick-forms-for-elementor' ); ?>
											</button>
											<button type="button" class="btn-palette" data-accent="#059669" data-bg="#f0fdf4" data-content="#ffffff" data-text="#0f172a">
												<span class="swatch" style="background:#059669;"></span>
												<?php esc_html_e( 'Emerald Clean', 'quick-forms-for-elementor' ); ?>
											</button>
											<button type="button" class="btn-palette" data-accent="#0284c7" data-bg="#f0f9ff" data-content="#ffffff" data-text="#0f172a">
												<span class="swatch" style="background:#0284c7;"></span>
												<?php esc_html_e( 'Ocean Sky', 'quick-forms-for-elementor' ); ?>
											</button>
											<button type="button" class="btn-palette" data-accent="#0f172a" data-bg="#f1f5f9" data-content="#ffffff" data-text="#0f172a">
												<span class="swatch" style="background:#0f172a;"></span>
												<?php esc_html_e( 'Slate Luxury', 'quick-forms-for-elementor' ); ?>
											</button>
											<button type="button" class="btn-palette" data-accent="#e11d48" data-bg="#fff1f2" data-content="#ffffff" data-text="#1e293b">
												<span class="swatch" style="background:#e11d48;"></span>
												<?php esc_html_e( 'Rose Crimson', 'quick-forms-for-elementor' ); ?>
											</button>
										</div>
									</div>

									<div class="colors-grid">
										<div class="color-item">
											<label for="mtef_email_accent_color"><?php esc_html_e( 'Header Bar Accent', 'quick-forms-for-elementor' ); ?></label>
											<input type="text" id="mtef_email_accent_color" name="mtef_email_accent_color"
												value="<?php echo esc_attr( $accent_color ); ?>"
												class="mtef-color-picker" data-preview-target="header" />
										</div>

										<div class="color-item">
											<label for="mtef_email_bg_color"><?php esc_html_e( 'Email Canvas BG', 'quick-forms-for-elementor' ); ?></label>
											<input type="text" id="mtef_email_bg_color" name="mtef_email_bg_color"
												value="<?php echo esc_attr( $bg_color ); ?>"
												class="mtef-color-picker" data-preview-target="canvas" />
										</div>

										<div class="color-item">
											<label for="mtef_email_content_bg_color"><?php esc_html_e( 'Card Container BG', 'quick-forms-for-elementor' ); ?></label>
											<input type="text" id="mtef_email_content_bg_color" name="mtef_email_content_bg_color"
												value="<?php echo esc_attr( $content_bg ); ?>"
												class="mtef-color-picker" data-preview-target="content" />
										</div>

										<div class="color-item">
											<label for="mtef_email_text_color"><?php esc_html_e( 'Primary Text Color', 'quick-forms-for-elementor' ); ?></label>
											<input type="text" id="mtef_email_text_color" name="mtef_email_text_color"
												value="<?php echo esc_attr( $text_color ); ?>"
												class="mtef-color-picker" data-preview-target="text" />
										</div>
									</div>

									<!-- Logo Uploader -->
									<div class="mtef-field-group logo-uploader-group">
										<label><?php esc_html_e( 'Email Header Logo', 'quick-forms-for-elementor' ); ?></label>
										<div class="mtef-media-field">
											<input type="text" id="mtef_email_logo_url" name="mtef_email_logo_url"
												value="<?php echo esc_attr( $logo_url ); ?>"
												class="regular-text mtef-media-url" placeholder="https://domain.com/wp-content/uploads/logo.png" />
											<button type="button" class="mtef-btn-secondary mtef-media-upload-btn">
												<span class="dashicons dashicons-upload"></span>
												<?php esc_html_e( 'Choose Logo', 'quick-forms-for-elementor' ); ?>
											</button>
											<button type="button" class="mtef-btn-danger mtef-media-remove-btn" <?php echo empty( $logo_url ) ? 'style="display:none;"' : ''; ?>>
												<span class="dashicons dashicons-trash"></span>
												<?php esc_html_e( 'Remove', 'quick-forms-for-elementor' ); ?>
											</button>
										</div>
										<p class="field-hint"><?php esc_html_e( 'Recommended height: 40px–50px with transparent background.', 'quick-forms-for-elementor' ); ?></p>
									</div>

									<!-- Footer Settings -->
									<div class="mtef-field-group">
										<label for="mtef_email_footer_text"><?php esc_html_e( 'Custom Footer Note', 'quick-forms-for-elementor' ); ?></label>
										<textarea id="mtef_email_footer_text" name="mtef_email_footer_text" rows="2"
											class="regular-text" placeholder="<?php esc_attr_e( 'e.g. Acme Corp • 123 Innovation Way • contact@acme.com', 'quick-forms-for-elementor' ); ?>"><?php echo esc_textarea( $footer_text ); ?></textarea>
									</div>

									<div class="mtef-toggle-row">
										<div class="toggle-meta">
											<strong><?php esc_html_e( 'Show "Submitted via Site" Credit', 'quick-forms-for-elementor' ); ?></strong>
											<p><?php esc_html_e( 'Displays the timestamp and site link in the email footer.', 'quick-forms-for-elementor' ); ?></p>
										</div>
										<label class="mtef-switch">
											<input type="checkbox" name="mtef_email_show_footer_credit" value="yes" <?php checked( $show_credit, 'yes' ); ?>>
											<span class="mtef-slider round"></span>
										</label>
									</div>
								</div>
							</section>

						</div>

						<!-- RIGHT COLUMN: LIVE INTERACTIVE EMAIL PREVIEW -->
						<div class="preview-col">
							<div class="mtef-sticky-preview">
								<div class="preview-frame-header">
									<div class="window-dots">
										<span></span><span></span><span></span>
									</div>
									<span class="preview-title"><?php esc_html_e( 'Live Notification Preview', 'quick-forms-for-elementor' ); ?></span>
									<span class="live-badge"><?php esc_html_e( 'Real-time', 'quick-forms-for-elementor' ); ?></span>
								</div>

								<!-- Live Render Box -->
								<div class="mtef-email-preview-canvas" id="emailPreviewCanvas" style="background-color: <?php echo esc_attr( $bg_color ); ?>;">
									<div class="email-mock-card" id="emailMockCard" style="background-color: <?php echo esc_attr( $content_bg ); ?>;">
										<!-- Header -->
										<div class="email-mock-header" id="emailMockHeader" style="background-color: <?php echo esc_attr( $accent_color ); ?>;">
											<div class="mock-logo-wrap" id="emailMockLogoWrap" <?php echo empty( $logo_url ) ? 'style="display:none;"' : ''; ?>>
												<img src="<?php echo esc_url( $logo_url ); ?>" alt="Logo" id="emailMockLogo" />
											</div>
											<h4 id="emailMockHeading"><?php esc_html_e( 'New Form Submission', 'quick-forms-for-elementor' ); ?></h4>
										</div>

										<!-- Body -->
										<div class="email-mock-body" style="color: <?php echo esc_attr( $text_color ); ?>;">
											<p class="mock-intro"><?php printf( /* translators: %s: website name. */ esc_html__( 'You received a new inquiry from %s:', 'quick-forms-for-elementor' ), '<strong>' . esc_html( get_bloginfo( 'name' ) ) . '</strong>' ); ?></p>

											<div class="mock-field-row">
												<span class="mock-label"><?php esc_html_e( 'NAME', 'quick-forms-for-elementor' ); ?></span>
												<span class="mock-value">Sarah Jenkins</span>
											</div>
											<div class="mock-field-row">
												<span class="mock-label"><?php esc_html_e( 'EMAIL', 'quick-forms-for-elementor' ); ?></span>
												<span class="mock-value">sarah.jenkins@example.com</span>
											</div>
											<div class="mock-field-row">
												<span class="mock-label"><?php esc_html_e( 'SUBJECT', 'quick-forms-for-elementor' ); ?></span>
												<span class="mock-value" id="emailMockSubjectPreview"><?php echo esc_html( $email_subject ); ?></span>
											</div>
											<div class="mock-field-row no-border">
												<span class="mock-label"><?php esc_html_e( 'MESSAGE', 'quick-forms-for-elementor' ); ?></span>
												<span class="mock-value"><?php esc_html_e( 'Hi, I would like to inquire about your services and schedule a consultation next week.', 'quick-forms-for-elementor' ); ?></span>
											</div>
										</div>

										<!-- Footer -->
										<div class="email-mock-footer">
											<p id="emailMockFooterText"><?php echo ! empty( $footer_text ) ? esc_html( $footer_text ) : sprintf( /* translators: %s: website name. */ esc_html__( 'Submitted via %s', 'quick-forms-for-elementor' ), esc_html( get_bloginfo( 'name' ) ) ); ?></p>
											<span>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- STICKY ACTION BAR -->
					<div class="mtef-sticky-save">
						<div class="save-status-text">
							<span class="dashicons dashicons-saved"></span>
							<span><?php esc_html_e( 'All changes are ready to save.', 'quick-forms-for-elementor' ); ?></span>
						</div>
						<button type="submit" class="mtef-btn-primary">
							<span class="dashicons dashicons-yes-alt"></span>
							<?php esc_html_e( 'Save Email Settings', 'quick-forms-for-elementor' ); ?>
						</button>
					</div>
				</form>

			<?php elseif ( 'support' === $active_tab ) : ?>

				<div class="mtef-support-layout">
					<!-- Welcome Hero -->
					<div class="mtef-card support-hero">
						<div class="hero-text">
							<span class="hero-badge"><?php esc_html_e( 'Getting Started & Support', 'quick-forms-for-elementor' ); ?></span>
							<h2><?php esc_html_e( 'Build High-Converting Forms with Elementor', 'quick-forms-for-elementor' ); ?></h2>
							<p><?php esc_html_e( 'Quick Forms for Elementor gives you 50+ preset styles, spam protection, and styled email templates. Follow the quick guide below or support development.', 'quick-forms-for-elementor' ); ?></p>
						</div>
					</div>

					<!-- 3-Step Quick Start Cards -->
					<div class="mtef-steps-grid">
						<div class="mtef-step-card">
							<span class="step-num">01</span>
							<h3><?php esc_html_e( 'Open Elementor', 'quick-forms-for-elementor' ); ?></h3>
							<p><?php esc_html_e( 'Edit any page, post, or template with the Elementor page builder.', 'quick-forms-for-elementor' ); ?></p>
						</div>
						<div class="mtef-step-card">
							<span class="step-num">02</span>
							<h3><?php esc_html_e( 'Drag "Quick Forms for Elementor"', 'quick-forms-for-elementor' ); ?></h3>
							<p><?php esc_html_e( 'Search for "Quick Forms" in the Elementor widget panel and drag it into your page section.', 'quick-forms-for-elementor' ); ?></p>
						</div>
						<div class="mtef-step-card">
							<span class="step-num">03</span>
							<h3><?php esc_html_e( 'Pick a Preset Skin', 'quick-forms-for-elementor' ); ?></h3>
							<p><?php esc_html_e( 'Select from 50 built-in skins or 7 layouts (Floating, Material, Inline, Boxed).', 'quick-forms-for-elementor' ); ?></p>
						</div>
					</div>

					<!-- 2-Column Info & Community -->
					<div class="mtef-two-col-grid" style="margin-top: 24px;">
						<!-- Features Included -->
						<div class="mtef-card">
							<div class="mtef-card-header">
								<div class="header-icon-wrap" style="background:#f0fdf4; color:#16a34a;">
									<span class="dashicons dashicons-awards"></span>
								</div>
								<div>
									<h2><?php esc_html_e( 'Included Features', 'quick-forms-for-elementor' ); ?></h2>
									<p class="section-desc"><?php esc_html_e( 'Everything available out of the box in Quick Forms for Elementor', 'quick-forms-for-elementor' ); ?></p>
								</div>
							</div>
							<div class="mtef-card-body">
								<ul class="features-checklist">
									<li>
										<span class="check-icon">✓</span>
										<div>
											<strong><?php esc_html_e( '50 Preset Design Skins', 'quick-forms-for-elementor' ); ?></strong>
											<span><?php esc_html_e( 'Neumorphic, Glassmorphism, Material, Retro & Minimalist styles.', 'quick-forms-for-elementor' ); ?></span>
										</div>
									</li>
									<li>
										<span class="check-icon">✓</span>
										<div>
											<strong><?php esc_html_e( '7 Layout Structures', 'quick-forms-for-elementor' ); ?></strong>
											<span><?php esc_html_e( 'Floating Labels, Material Minimal, Inset Shadow, Inline layout, etc.', 'quick-forms-for-elementor' ); ?></span>
										</div>
									</li>
									<li>
										<span class="check-icon">✓</span>
										<div>
											<strong><?php esc_html_e( 'Submissions Database Storage', 'quick-forms-for-elementor' ); ?></strong>
											<span><?php esc_html_e( 'Never miss an inquiry. Search, export to CSV and manage from admin.', 'quick-forms-for-elementor' ); ?></span>
										</div>
									</li>
									<li>
										<span class="check-icon">✓</span>
										<div>
											<strong><?php esc_html_e( 'Spam Protection Suite', 'quick-forms-for-elementor' ); ?></strong>
											<span><?php esc_html_e( 'Google reCAPTCHA v2, Cloudflare Turnstile, honeypot and IP rate limiting.', 'quick-forms-for-elementor' ); ?></span>
										</div>
									</li>
									<li>
										<span class="check-icon">✓</span>
										<div>
											<strong><?php esc_html_e( 'GDPR Consent Checkbox', 'quick-forms-for-elementor' ); ?></strong>
											<span><?php esc_html_e( 'Custom consent text with privacy policy links.', 'quick-forms-for-elementor' ); ?></span>
										</div>
									</li>
								</ul>
							</div>
						</div>

						<!-- Support & Contributions -->
						<div class="mtef-card">
							<div class="mtef-card-header">
								<div class="header-icon-wrap" style="background:#eef2ff; color:#4f46e5;">
									<span class="dashicons dashicons-heart"></span>
								</div>
								<div>
									<h2><?php esc_html_e( 'Support & Feedback', 'quick-forms-for-elementor' ); ?></h2>
									<p class="section-desc"><?php esc_html_e( 'Support development or report bugs directly to the team.', 'quick-forms-for-elementor' ); ?></p>
								</div>
							</div>
							<div class="mtef-card-body">
								<div class="support-action-list">
									<a href="https://github.com/tariqsmd/mtforms/issues" target="_blank" rel="noopener noreferrer" class="support-action-card">
										<span class="dashicons dashicons-warning"></span>
										<div>
											<strong><?php esc_html_e( 'Report an Issue / Bug', 'quick-forms-for-elementor' ); ?></strong>
											<span><?php esc_html_e( 'File an issue on the official GitHub repository.', 'quick-forms-for-elementor' ); ?></span>
										</div>
										<span class="dashicons dashicons-arrow-right-alt2 arrow-icon"></span>
									</a>

									<a href="https://wordpress.org/support/plugin/quick-forms-for-elementor/reviews/#new-post" target="_blank" rel="noopener noreferrer" class="support-action-card">
										<span class="dashicons dashicons-star-filled star-icon"></span>
										<div>
											<strong><?php esc_html_e( 'Leave a 5-Star Review', 'quick-forms-for-elementor' ); ?></strong>
											<span><?php esc_html_e( 'Help support future development by reviewing on WordPress.org.', 'quick-forms-for-elementor' ); ?></span>
										</div>
										<span class="dashicons dashicons-arrow-right-alt2 arrow-icon"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

			<?php endif; ?>

		</main>
		<!-- ═══ /MAIN CONTENT ═══ -->

	</div><!-- .mtef-admin-layout -->

</div><!-- .mtef-admin-wrap -->