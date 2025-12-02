(function ($) {
    'use strict';

    $(document).ready(function () {
        const form = document.querySelector('#mtcf-form');
        const submitBtn = document.querySelector('.mtcf-submit-btn');
        const responseMsg = document.querySelector('.mtcf-response-message');

        if (!form) return;

        const validation = new JustValidate('#mtcf-form', {
            errorFieldCssClass: 'just-validate-error-field',
            errorLabelCssClass: 'just-validate-error-label',
            focusInvalidField: true,
            lockForm: true,
        });

        validation
            .addField('#mtcf_name', [
                {
                    rule: 'required',
                    errorMessage: mtcf_ajax.i18n.name_required,
                },
                {
                    rule: 'minLength',
                    value: 3,
                    errorMessage: mtcf_ajax.i18n.name_min,
                },
            ])
            .addField('#mtcf_email', [
                {
                    rule: 'required',
                    errorMessage: mtcf_ajax.i18n.email_required,
                },
                {
                    rule: 'email',
                    errorMessage: mtcf_ajax.i18n.email_invalid,
                },
            ])
            .addField('#mtcf_message', [
                {
                    rule: 'required',
                    errorMessage: mtcf_ajax.i18n.message_required,
                },
            ])
            .addField('#mtcf_gdpr', [
                {
                    rule: 'required',
                    errorMessage: mtcf_ajax.i18n.gdpr_required,
                },
            ])
            .onSuccess((event) => {
                // Prevent default submission
                if (event && event.preventDefault) {
                    event.preventDefault();
                }

                // Show spinner/loading state
                submitBtn.disabled = true;
                submitBtn.textContent = mtcf_ajax.i18n.sending;
                responseMsg.className = 'mtcf-response-message';
                responseMsg.innerHTML = '';

                const formData = new FormData(form);
                formData.append('action', 'mtcf_submit_form');
                formData.append('nonce', mtcf_ajax.nonce);

                $.ajax({
                    url: mtcf_ajax.ajax_url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = mtcf_ajax.i18n.send_message;

                        if (response.success) {
                            responseMsg.classList.add('success');
                            responseMsg.innerHTML = response.data.message;
                            form.reset();
                            // Reset validation state
                            validation.refresh();
                        } else {
                            responseMsg.classList.add('error');
                            responseMsg.innerHTML = response.data.message;
                        }
                    },
                    error: function (xhr, status, error) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = mtcf_ajax.i18n.send_message;
                        responseMsg.classList.add('error');
                        responseMsg.innerHTML = mtcf_ajax.i18n.error_generic;
                        console.error(error);
                    }
                });
            });

    });

})(jQuery);
