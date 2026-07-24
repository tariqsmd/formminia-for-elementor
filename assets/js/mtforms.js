/**
 * MTForms Elementor Widget Handler
 *
 * This class handles the frontend functionality of the MTForms widget,
 * including validation with JustValidate, AJAX submission, and UI animations.
 *
 * @since 1.0.0
 */
class MTFormsWidgetHandler extends elementorModules.frontend.handlers.Base {

    /**
     * Define default settings and selectors
     */
    getDefaultSettings() {
        const widgetId = this.getID();
        return {
            selectors: {
                form: '.mtforms-form',
                container: '.mtforms-container',
                submitBtn: '.mtforms-submit-btn',
                submitBtnText: '.mtforms-btn-text',
                responseMsg: '.mtforms-response-message',
                formGroup: '.mtforms-form-group',
                floatingInput: '.mtforms-layout-floating .mtforms-input, .mtforms-layout-floating .mtforms-textarea, .mtforms-layout-material .mtforms-input, .mtforms-layout-material .mtforms-textarea',
                checkbox: '.mtforms-checkbox-label input[type="checkbox"]'
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
    async onInit() {
        super.onInit(...arguments);

        if (!this.elements.$form.length) {
            return;
        }

        // Initialize UI components
        this.initFloatingLabels();
        
        // Initialize Validation
        this.initValidation();
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
        const formId = $form.attr('id') || `mtforms-form-${this.getID()}`;
        
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
        const i18n = mtforms_ajax.i18n;

        const fieldConfigs = {
            mtforms_name: {
                required: i18n.name_required,
                rules: [{ rule: 'minLength', value: 2, errorMessage: i18n.name_min }]
            },
            mtforms_email: {
                required: i18n.email_required,
                rules: [{ rule: 'email', errorMessage: i18n.email_invalid }]
            },
            mtforms_phone: {
                required: i18n.phone_required,
                rules: [{ rule: 'customRegexp', value: /^[\d\s\-\+\(\)]*$/, errorMessage: i18n.phone_invalid }]
            },
            mtforms_website: {
                required: i18n.website_required,
                rules: [{ rule: 'customRegexp', value: /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/, errorMessage: i18n.website_invalid }]
            },
            mtforms_subject: { required: i18n.subject_required },
            mtforms_message: { required: i18n.message_required },
            mtforms_gdpr: { required: i18n.gdpr_required }
        };

        Object.keys(fieldConfigs).forEach(fieldName => {
            const $field = $form.find(`[name="${fieldName}"]`);
            if ($field.length) {
                const config = fieldConfigs[fieldName];
                const rules = [];

                if ($field.prop('required') || fieldName === 'mtforms_gdpr') {
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
        const selectors = this.getSettings('selectors');
        const $btnText = elements.$submitBtn.find(selectors.submitBtnText);
        const originalText = $btnText.length ? $btnText.text() : elements.$submitBtn.text();

        // 1. Enter Loading State
        elements.$submitBtn.prop('disabled', true).addClass('loading');
        elements.$form.addClass('submitting');
        
        const sendingText = mtforms_ajax.i18n.sending;
        if ($btnText.length) {
            $btnText.text(sendingText);
        } else {
            elements.$submitBtn.text(sendingText);
        }

        // 2. Clear Messages
        elements.$responseMsg.removeClass('success error').empty().hide();

        // 3. Construct Data
        const formData = new FormData(elements.$form[0]);
        formData.append('action', 'mtforms_submit_form');
        formData.append('nonce', mtforms_ajax.nonce);

        // 4. Send Request
        jQuery.ajax({
            url: mtforms_ajax.ajax_url,
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
            $submitBtn.text(mtforms_ajax.i18n.send_message);
        }

        if (response.success) {
            // Success Path
            $responseMsg.addClass('success').html(response.data.message).fadeIn();
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
            // Error Path (Validation or Server side)
            $responseMsg.addClass('error').html(response.data.message).fadeIn();
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
            $submitBtn.text(mtforms_ajax.i18n.send_message);
        }

        $responseMsg.addClass('error').html(mtforms_ajax.i18n.error_generic).fadeIn();
        console.error('MTForms Submission Error:', error);
    }

    /**
     * Cleanup Captcha instances
     */
    resetCaptcha() {
        const $form = this.elements.$form;
        
        // Google ReCaptcha
        if (typeof grecaptcha !== 'undefined' && typeof grecaptcha.reset === 'function') {
            try { grecaptcha.reset(); } catch (e) {}
        }
        
        // Cloudflare Turnstile
        if (typeof turnstile !== 'undefined' && typeof turnstile.reset === 'function') {
            const turnstileEl = $form.find('.cf-turnstile')[0];
            if (turnstileEl) {
                try { turnstile.reset(turnstileEl); } catch (e) {}
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

/**
 * Register the Widget Handler with Elementor
 */
jQuery(window).on('elementor/frontend/init', () => {
    const handleMTFormsWidget = ($element) => {
        elementorFrontend.elementsHandler.addHandler(MTFormsWidgetHandler, { $element });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/mtforms.default', handleMTFormsWidget);
});
