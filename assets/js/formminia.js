
/**
 * FormMinia for Elementor Elementor Widget Handler
 *
 * This class handles the frontend functionality of the FormMinia for Elementor widget,
 * including validation with JustValidate, AJAX submission, and UI animations.
 *
 * @since 1.0.0
 */
class FORMMINIAWidgetHandler extends elementorModules.frontend.handlers.Base {

    /**
     * Define default settings and selectors
     */
    getDefaultSettings() {
        const widgetId = this.getID();
        return {
            selectors: {
                form: '.formminia-form',
                container: '.formminia-container',
                submitBtn: '.formminia-submit-btn',
                submitBtnText: '.formminia-btn-text',
                responseMsg: '.formminia-response-message',
                formGroup: '.formminia-form-group',
                floatingInput: '.formminia-layout-floating .formminia-input, .formminia-layout-floating .formminia-textarea, .formminia-layout-material .formminia-input, .formminia-layout-material .formminia-textarea',
                checkbox: '.formminia-checkbox-label input[type="checkbox"]'
            }
        };
    }

    /**
     * Define default elements cached for use
     */
    getDefaultElements() {
        const selectors = this.getSettings('selectors');
        return {
            $form: this.$element.find(selectors.form),
            $container: this.$element.find(selectors.container),
            $submitBtn: this.$element.find(selectors.submitBtn),
            $responseMsg: this.$element.find(selectors.responseMsg)
        };
    }

    /**
     * Initialization logic
     */
    onInit() {
        super.onInit(...arguments);

        if (!this.elements.$form.length) {
            return;
        }

        // Initialize Config
        this.initConfig();

        // Initialize UI components
        this.initFloatingLabels();

        // Initialize Validation
        this.initValidation();
    }

    /**
     * Load configuration using Elementor's native handler settings
     */
    initConfig() {
        const settings = this.getElementSettings();
        const globalConfig = typeof formminia_ajax !== 'undefined' ? formminia_ajax : { i18n: {} };
        const globalI18n = globalConfig.i18n || {};

        this.config = {
            ajax_url: globalConfig.ajax_url || (typeof admin_url !== 'undefined' ? admin_url : ''),
            nonce: globalConfig.nonce || '',
            i18n: {
                name_required: settings.name_required_msg || globalI18n.name_required || 'Name is required',
                name_min: globalI18n.name_min || 'Name must be at least 2 characters',
                email_required: settings.email_required_msg || globalI18n.email_required || 'Email is required',
                email_invalid: settings.email_invalid_msg || globalI18n.email_invalid || 'Email is invalid',
                phone_required: settings.phone_required_msg || globalI18n.phone_required || 'Phone number is required',
                phone_invalid: settings.phone_invalid_msg || globalI18n.phone_invalid || 'Please enter a valid phone number',
                website_required: settings.website_required_msg || globalI18n.website_required || 'Website URL is required',
                website_invalid: settings.website_invalid_msg || globalI18n.website_invalid || 'Please enter a valid URL',
                subject_required: settings.subject_required_msg || globalI18n.subject_required || 'Subject is required',
                message_required: settings.message_required_msg || globalI18n.message_required || 'Message is required',
                gdpr_required: settings.gdpr_required_msg || globalI18n.gdpr_required || 'You must agree to the terms',
                sending: settings.sending_msg || globalI18n.sending || 'Sending...',
                send_message: settings.submit_btn_text || globalI18n.send_message || 'Send Message',
                error_generic: globalI18n.error_generic || 'An unexpected error occurred. Please try again.',
                success: settings.success_message || globalI18n.success,
                error: settings.error_message || globalI18n.error
            }
        };
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        const selectors = this.getSettings('selectors');

        // Handle floating label animations (Focus/Blur)
        this.$element.on('focus blur', selectors.floatingInput, (event) => {
            const $input = jQuery(event.currentTarget);
            const $wrapper = $input.closest(selectors.formGroup);

            if (event.type === 'focus' || event.type === 'focusin') {
                $wrapper.addClass('is-focused');
            } else {
                $wrapper.removeClass('is-focused');
                this.updateInputState($input);
            }
        });

        // Handle real-time input status (Has Value)
        this.$element.on('input change', selectors.floatingInput, (event) => {
            this.updateInputState(jQuery(event.currentTarget));
        });
    }

    /**
     * Update the visual state of an input (floating labels)
     */
    updateInputState($input) {
        const selectors = this.getSettings('selectors');
        const $wrapper = $input.closest(selectors.formGroup);
        if ($input.val().trim() !== '') {
            $wrapper.addClass('has-value');
        } else {
            $wrapper.removeClass('has-value');
        }
    }

    /**
     * Pre-check all inputs for existing values (e.g. browser autofill)
     */
    initFloatingLabels() {
        const selectors = this.getSettings('selectors');
        this.$element.find(selectors.floatingInput).each((index, el) => {
            this.updateInputState(jQuery(el));
        });
    }

    /**
     * Setup JustValidate logic
     */
    initValidation() {
        const $form = this.elements.$form;
        const formId = $form.attr('id') || `formminia-form-${this.getID()}`;

        // Ensure unique ID for JustValidate
        if (!$form.attr('id')) {
            $form.attr('id', formId);
        }

        this.validation = new JustValidate(`#${formId}`, {
            errorFieldCssClass: 'just-validate-error-field',
            errorLabelCssClass: 'just-validate-error-label',
            focusInvalidField: true,
            lockForm: true
        });

        this.addValidationRules();

        this.validation.onSuccess((event) => {
            if (event && event.preventDefault) {
                event.preventDefault();
            }
            this.handleSubmission();
        });
    }

    /**
     * Map form fields to validation rules
     */
    addValidationRules() {
        const $form = this.elements.$form;
        const i18n = this.config.i18n;

        const fieldConfigs = {
            formminia_name: {
                required: i18n.name_required,
                rules: [{ rule: 'minLength', value: 2, errorMessage: i18n.name_min }]
            },
            formminia_email: {
                required: i18n.email_required,
                rules: [{ rule: 'email', errorMessage: i18n.email_invalid }]
            },
            formminia_phone: {
                required: i18n.phone_required,
                rules: [{ rule: 'customRegexp', value: /^[\d\s\-\+\(\)]*$/, errorMessage: i18n.phone_invalid }]
            },
            formminia_website: {
                required: i18n.website_required,
                rules: [{ rule: 'customRegexp', value: /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/, errorMessage: i18n.website_invalid }]
            },
            formminia_subject: { required: i18n.subject_required },
            formminia_message: { required: i18n.message_required },
            formminia_gdpr: { required: i18n.gdpr_required }
        };

        Object.keys(fieldConfigs).forEach(fieldName => {
            const $field = $form.find(`[name="${fieldName}"]`);
            if ($field.length) {
                const config = fieldConfigs[fieldName];
                const rules = [];

                if ($field.prop('required') || fieldName === 'formminia_gdpr') {
                    rules.push({ rule: 'required', errorMessage: config.required });
                }

                if (config.rules) {
                    rules.push(...config.rules);
                }

                if (rules.length) {
                    this.validation.addField(`#${$field.attr('id')}`, rules);
                }
            }
        });
    }

    /**
     * AJAX Form Submission
     */
    handleSubmission() {
        const elements = this.elements;

        // 0. Ensure CAPTCHA is completed / available before submitting.
        const captchaState = this.getCaptchaState();
        if (!captchaState.ready) {
            elements.$responseMsg.removeClass('success').addClass('error').html(captchaState.message).fadeIn();
            this.scrollToElement(elements.$responseMsg[0]);
            return;
        }

        const selectors = this.getSettings('selectors');
        const $btnText = elements.$submitBtn.find(selectors.submitBtnText);
        const originalText = $btnText.length ? $btnText.text() : elements.$submitBtn.text();

        // 1. Enter Loading State
        elements.$submitBtn.prop('disabled', true).addClass('loading');
        elements.$form.addClass('submitting');

        const sendingText = this.config.i18n.sending;
        if ($btnText.length) {
            $btnText.text(sendingText);
        } else {
            elements.$submitBtn.text(sendingText);
        }

        // 2. Clear Messages
        elements.$responseMsg.removeClass('success error').empty().hide();

        // 3. Construct Data
        const formData = new FormData(elements.$form[0]);
        formData.append('action', 'formminia_submit_form');
        formData.append('nonce', this.config.nonce);

        // 4. Send Request
        jQuery.ajax({
            url: this.config.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (response) => {
                this.processSubmissionResponse(response, originalText);
            },
            error: (xhr, status, error) => {
                this.handleAjaxError(error, originalText);
            }
        });
    }

    /**
     * Process the server response
     */
    processSubmissionResponse(response, originalText) {
        const { $form, $submitBtn, $responseMsg } = this.elements;
        const selectors = this.getSettings('selectors');
        const $btnText = $submitBtn.find(selectors.submitBtnText);

        // Reset UI state
        $submitBtn.prop('disabled', false).removeClass('loading');
        $form.removeClass('submitting');

        if ($btnText.length) {
            $btnText.text(originalText);
        } else {
            $submitBtn.text(this.config.i18n.send_message);
        }

        if (response.success) {
            // Success Path
            const serverSuccessMsg = (response.data && response.data.message) ? response.data.message : '';
            const msg = this.config.i18n.success || serverSuccessMsg;
            $responseMsg.addClass('success').html(msg).fadeIn();
            $form[0].reset();

            if (this.validation && typeof this.validation.refresh === 'function') {
                this.validation.refresh();
            }

            // Sync UI animations
            this.initFloatingLabels();
            this.resetCaptcha();
            this.scrollToElement($responseMsg[0]);

            // Handle Post-Success Actions
            const redirectUrl = $form.data('redirect');
            if (redirectUrl) {
                setTimeout(() => window.location.href = redirectUrl, 1000);
            } else {
                setTimeout(() => {
                    $responseMsg.fadeOut(() => $responseMsg.removeClass('success'));
                }, 5000);
            }
        } else {
            // Error Path (Validation or Server side) — prefer the server's actual
            // message so real failures are visible instead of the generic default.
            const serverErrorMsg = (response.data && response.data.message) ? response.data.message : '';
            const msg = serverErrorMsg || this.config.i18n.error;
            $responseMsg.addClass('error').html(msg).fadeIn();
            this.resetCaptcha();
            this.scrollToElement($responseMsg[0]);
        }
    }

    /**
     * Handle generic AJAX errors (e.g. 500 Network)
     */
    handleAjaxError(error, originalText) {
        const { $form, $submitBtn, $responseMsg } = this.elements;
        const selectors = this.getSettings('selectors');
        const $btnText = $submitBtn.find(selectors.submitBtnText);

        $submitBtn.prop('disabled', false).removeClass('loading');
        $form.removeClass('submitting');

        if ($btnText.length) {
            $btnText.text(originalText);
        } else {
            $submitBtn.text(this.config.i18n.send_message);
        }

        $responseMsg.addClass('error').html(this.config.i18n.error_generic).fadeIn();
        console.error('FormMinia for Elementor Submission Error:', error);
    }

    /**
     * Check the current CAPTCHA state of the form.
     * Returns { ready, message } — when not ready, the message explains why.
     */
    getCaptchaState() {
        const $form = this.elements.$form;
        const $turnstileWrap = $form.find('.cf-turnstile');
        const $recaptchaWrap = $form.find('.g-recaptcha');

        if (!$turnstileWrap.length && !$recaptchaWrap.length) {
            return { ready: true, message: '' };
        }

        if ($turnstileWrap.length) {
            const token = $form.find('input[name="cf-turnstile-response"]').val();
            if (token) {
                return { ready: true, message: '' };
            }
            if (typeof window.turnstile === 'undefined' || typeof window.turnstile.getResponse !== 'function') {
                return { ready: false, message: 'CAPTCHA could not be loaded. Please wait a moment and try again, or contact the site owner.' };
            }
            return { ready: false, message: 'Please complete the CAPTCHA.' };
        }

        if ($recaptchaWrap.length) {
            const token = $form.find('[name="g-recaptcha-response"]').val();
            if (token) {
                return { ready: true, message: '' };
            }
            if (typeof window.grecaptcha === 'undefined') {
                return { ready: false, message: 'CAPTCHA could not be loaded. Please wait a moment and try again, or contact the site owner.' };
            }
            return { ready: false, message: 'Please complete the CAPTCHA.' };
        }

        return { ready: true, message: '' };
    }

    /**
     * Cleanup Captcha instances
     */
    resetCaptcha() {
        const $form = this.elements.$form;

        // Google ReCaptcha
        if (typeof grecaptcha !== 'undefined' && typeof grecaptcha.reset === 'function') {
            try { grecaptcha.reset(); } catch (e) { }
        }

        // Cloudflare Turnstile
        if (typeof turnstile !== 'undefined' && typeof turnstile.reset === 'function') {
            const turnstileEl = $form.find('.cf-turnstile')[0];
            if (turnstileEl) {
                try { turnstile.reset(turnstileEl); } catch (e) { }
            }
        }
    }

    /**
     * Utility to scroll response messages into view
     */
    scrollToElement(element) {
        if (!element) return;
        const rect = element.getBoundingClientRect();
        const isVisible = (rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight));
        if (!isVisible) {
            element.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const handleFORMMINIAWidget = ($element) => {
        elementorFrontend.elementsHandler.addHandler(FORMMINIAWidgetHandler, { $element });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/formminia.default', handleFORMMINIAWidget);
});