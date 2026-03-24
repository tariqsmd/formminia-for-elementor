(function ($) {
    'use strict';

    /**
     * MTForms - Public JavaScript
     * Handles form validation and AJAX submission
     *
     * @version 1.0.0
     */

    $(document).ready(function () {
        initializeForms();
        
        // Handle Elementor Popups and other dynamic content
        $(document).on('elementor/popup/show', function() {
            initializeForms();
        });
    });

    /**
     * Initialize all contact forms on the page
     */
    function initializeForms() {
        const forms = document.querySelectorAll('.mtforms-form:not(.mtforms-initialized)');

        forms.forEach(function (form) {
            form.classList.add('mtforms-initialized');
            initializeForm(form);
        });

        // Initialize floating labels for pre-filled inputs
        setTimeout(() => {
            $('.mtforms-layout-floating .mtforms-input, .mtforms-layout-floating .mtforms-textarea').each(function() {
                if (this.value.trim() !== '') {
                    $(this).closest('.mtforms-form-group').addClass('has-value');
                }
            });
        }, 100);
    }

    /**
     * Initialize a single form with validation and submission handling
     */
    function initializeForm(form) {
        const formId = form.id || 'mtforms-form';
        const container = form.closest('.mtforms-container');
        const submitBtn = form.querySelector('.mtforms-submit-btn');
        const responseMsg = form.querySelector('.mtforms-response-message');

        if (!form || !submitBtn) {
            return;
        }

        // Get form fields to validate
        const hasName = form.querySelector('[name="mtforms_name"]');
        const hasEmail = form.querySelector('[name="mtforms_email"]');
        const hasPhone = form.querySelector('[name="mtforms_phone"]');
        const hasMessage = form.querySelector('[name="mtforms_message"]');
        const hasGdpr = form.querySelector('[name="mtforms_gdpr"]');

        // Initialize JustValidate
        const validation = new JustValidate('#' + formId, {
            errorFieldCssClass: 'just-validate-error-field',
            errorLabelCssClass: 'just-validate-error-label',
            focusInvalidField: true,
            lockForm: true
        });

        // Add validation rules based on available fields
        if (hasName) {
            validation.addField('#' + hasName.id, [
                {
                    rule: 'required',
                    errorMessage: mtforms_ajax.i18n.name_required
                },
                {
                    rule: 'minLength',
                    value: 2,
                    errorMessage: mtforms_ajax.i18n.name_min
                }
            ]);
        }

        if (hasEmail) {
            validation.addField('#' + hasEmail.id, [
                {
                    rule: 'required',
                    errorMessage: mtforms_ajax.i18n.email_required
                },
                {
                    rule: 'email',
                    errorMessage: mtforms_ajax.i18n.email_invalid
                }
            ]);
        }

        if (hasPhone) {
            validation.addField('#' + hasPhone.id, [
                {
                    rule: 'customRegexp',
                    value: /^[\d\s\-\+\(\)]*$/,
                    errorMessage: mtforms_ajax.i18n.phone_invalid || 'Please enter a valid phone number'
                }
            ]);
        }

        if (hasMessage) {
            validation.addField('#' + hasMessage.id, [
                {
                    rule: 'required',
                    errorMessage: mtforms_ajax.i18n.message_required
                }
            ]);
        }

        if (hasGdpr) {
            validation.addField('#' + hasGdpr.id, [
                {
                    rule: 'required',
                    errorMessage: mtforms_ajax.i18n.gdpr_required
                }
            ]);
        }

        // Handle form submission
        validation.onSuccess((event) => {
            if (event && event.preventDefault) {
                event.preventDefault();
            }

            submitForm(form, submitBtn, responseMsg, validation);
        });
    }

    /**
     * Submit the form via AJAX
     */
    function submitForm(form, submitBtn, responseMsg, validation) {
        const btnText = submitBtn.querySelector('.mtforms-btn-text');
        const originalText = btnText ? btnText.textContent : submitBtn.textContent;

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        form.classList.add('submitting');
        if (btnText) {
            btnText.textContent = mtforms_ajax.i18n.sending;
        } else {
            submitBtn.textContent = mtforms_ajax.i18n.sending;
        }

        // Clear previous response
        responseMsg.className = 'mtforms-response-message';
        responseMsg.innerHTML = '';
        responseMsg.style.display = 'none';

        // Prepare form data
        const formData = new FormData(form);
        formData.append('action', 'mtforms_submit_form');
        formData.append('nonce', mtforms_ajax.nonce);

        // Send AJAX request
        $.ajax({
            url: mtforms_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                handleResponse(response, form, submitBtn, responseMsg, validation, originalText, btnText);
            },
            error: function (xhr, status, error) {
                handleError(submitBtn, responseMsg, originalText, btnText, error);
            }
        });
    }

    /**
     * Handle successful AJAX response
     */
    function handleResponse(response, form, submitBtn, responseMsg, validation, originalText, btnText) {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.classList.remove('loading');
        form.classList.remove('submitting');
        if (btnText) {
            btnText.textContent = originalText;
        } else {
            submitBtn.textContent = mtforms_ajax.i18n.send_message;
        }

        if (response.success) {
            // Show success message
            responseMsg.classList.add('success');
            responseMsg.innerHTML = response.data.message;
            responseMsg.style.display = 'block';

            // Reset form
            form.reset();

            // Reset validation state
            if (validation && typeof validation.refresh === 'function') {
                validation.refresh();
            }

            // Clear custom checkbox state
            form.querySelectorAll('.mtforms-checkbox-label input[type="checkbox"]').forEach(function (checkbox) {
                checkbox.checked = false;
            });

            // Scroll to message if not visible
            scrollToElement(responseMsg);

            // Reset Captcha
            resetCaptcha(form);

            // Handle redirect if configured
            const redirectUrl = form.getAttribute('data-redirect');
            if (redirectUrl) {
                setTimeout(function () {
                    window.location.href = redirectUrl;
                }, 1000);
            } else {
                // Auto-hide success message after 5 seconds if no redirect
                setTimeout(function () {
                    responseMsg.style.opacity = '0';
                    setTimeout(function () {
                        responseMsg.style.display = 'none';
                        responseMsg.style.opacity = '1';
                        responseMsg.className = 'mtforms-response-message';
                    }, 300);
                }, 5000);
            }

        } else {
            // Show error message
            responseMsg.classList.add('error');
            responseMsg.innerHTML = response.data.message;
            responseMsg.style.display = 'block';

            // Reset Captcha on failure
            resetCaptcha(form);

            // Scroll to message if not visible
            scrollToElement(responseMsg);
        }
    }

    /**
     * Reset Captcha if it exists
     */
    function resetCaptcha(form) {
        // Reset reCAPTCHA v2
        if (typeof grecaptcha !== 'undefined' && typeof grecaptcha.reset === 'function') {
            try {
                grecaptcha.reset();
            } catch (e) {}
        }

        // Reset Turnstile
        if (typeof turnstile !== 'undefined' && typeof turnstile.reset === 'function') {
            try {
                const turnstileEl = form.querySelector('.cf-turnstile');
                if (turnstileEl) {
                    turnstile.reset(turnstileEl);
                }
            } catch (e) {}
        }
    }

    /**
     * Handle AJAX error
     */
    function handleError(submitBtn, responseMsg, originalText, btnText, error) {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.classList.remove('loading');
        // form.classList.remove('submitting'); // form is not available here, but button is
        const form = submitBtn.closest('form');
        if (form) {
            form.classList.remove('submitting');
        }

        if (btnText) {
            btnText.textContent = originalText;
        } else {
            submitBtn.textContent = mtforms_ajax.i18n.send_message;
        }

        // Show error message
        responseMsg.classList.add('error');
        responseMsg.innerHTML = mtforms_ajax.i18n.error_generic;
        responseMsg.style.display = 'block';

        console.error('Form submission error:', error);
    }

    /**
     * Scroll to element if not in viewport
     */
    function scrollToElement(element) {
        const rect = element.getBoundingClientRect();
        const isVisible = (
            rect.top >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
        );

        if (!isVisible) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    }

    /**
     * Add input animations for floating/material layouts
     * Use event delegation for dynamic forms
     */
    $(document).on('focus blur', '.mtforms-layout-floating .mtforms-input, .mtforms-layout-floating .mtforms-textarea, .mtforms-layout-material .mtforms-input, .mtforms-layout-material .mtforms-textarea', function (e) {
        const wrapper = $(this).closest('.mtforms-form-group');
        if (e.type === 'focus' || e.type === 'focusin') {
            wrapper.addClass('is-focused');
        } else {
            wrapper.removeClass('is-focused');
            if (this.value.trim() !== '') {
                wrapper.addClass('has-value');
            } else {
                wrapper.removeClass('has-value');
            }
        }
    });

    /**
     * Handle input changes for floating labels
     */
    $(document).on('input', '.mtforms-layout-floating .mtforms-input, .mtforms-layout-floating .mtforms-textarea, .mtforms-layout-material .mtforms-input, .mtforms-layout-material .mtforms-textarea', function () {
        const wrapper = $(this).closest('.mtforms-form-group');
        if (this.value.trim() !== '') {
            wrapper.addClass('has-value');
        } else {
            wrapper.removeClass('has-value');
        }
    });

})(jQuery);
