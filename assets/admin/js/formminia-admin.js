(function ($) {
    'use strict';

    $(document).ready(function () {

        // ──────────────────────────────────────────────────────────────
        // 1. Color Picker initialisation with live preview sync
        // ──────────────────────────────────────────────────────────────
        var colorPickerOptions = {
            change: function (event, ui) {
                syncPreviewFromPickers();
            },
            clear: function () {
                syncPreviewFromPickers();
            }
        };

        $('.formminia-color-picker').wpColorPicker(colorPickerOptions);

        function syncPreviewFromPickers() {
            var accent  = $('#formminia_email_accent_color').val();
            var bg      = $('#formminia_email_bg_color').val();
            var content = $('#formminia_email_content_bg_color').val();
            var text    = $('#formminia_email_text_color').val();

            if (accent)  { $('#emailMockHeader').css('background-color', accent); }
            if (bg)      { $('#emailPreviewCanvas').css('background-color', bg); }
            if (content) { $('#emailMockCard').css('background-color', content); }
            if (text)    { $('#emailMockCard .email-mock-body').css('color', text); }
        }

        // ──────────────────────────────────────────────────────────────
        // 2. Color Preset Palette Buttons
        // ──────────────────────────────────────────────────────────────
        $(document).on('click', '.btn-palette', function () {
            var $btn    = $(this);
            var accent  = $btn.data('accent')  || '';
            var bg      = $btn.data('bg')      || '';
            var content = $btn.data('content') || '';
            var text    = $btn.data('text')    || '';

            // Helper: set a wpColorPicker input value + trigger iris
            function setColor($input, color) {
                if (!$input.length || !color) { return; }
                $input.val(color);
                // Iris (the colour wheel behind wpColorPicker) exposes a setter
                if ($input.wpColorPicker && typeof $input.wpColorPicker === 'function') {
                    try { $input.iris('color', color); } catch (e) {}
                }
                // Also nudge the hidden text so the picker swatch updates
                var $container = $input.closest('.wp-picker-container');
                if ($container.length) {
                    $container.find('.wp-color-result').css('background-color', color);
                }
            }

            setColor($('#formminia_email_accent_color'),       accent);
            setColor($('#formminia_email_bg_color'),           bg);
            setColor($('#formminia_email_content_bg_color'),   content);
            setColor($('#formminia_email_text_color'),         text);

            // Sync the live preview immediately
            if (accent)  { $('#emailMockHeader').css('background-color', accent); }
            if (bg)      { $('#emailPreviewCanvas').css('background-color', bg); }
            if (content) { $('#emailMockCard').css('background-color', content); }
            if (text)    { $('#emailMockCard .email-mock-body').css('color', text); }

            // Visual active state
            $('.btn-palette').removeClass('is-active');
            $btn.addClass('is-active');
        });

        // Subject field → live preview
        $('#formminia_email_subject').on('input', function () {
            $('#emailMockSubjectPreview').text($(this).val());
        });

        // Footer text → live preview
        $('#formminia_email_footer_text').on('input', function () {
            var val = $(this).val().trim();
            $('#emailMockFooterText').text(val || 'Submitted via ' + (window._formminiaSiteName || ''));
        });

        // Logo URL → live preview
        $('#formminia_email_logo_url').on('input', function () {
            var url = $(this).val().trim();
            if (url) {
                $('#emailMockLogo').attr('src', url);
                $('#emailMockLogoWrap').show();
            } else {
                $('#emailMockLogoWrap').hide();
            }
        });

        // ──────────────────────────────────────────────────────────────
        // 3. Media Library Uploader for Logo
        // ──────────────────────────────────────────────────────────────
        $(document).on('click', '.formminia-media-upload-btn', function (e) {
            e.preventDefault();
            var $button  = $(this);
            var $wrapper = $button.closest('.formminia-card, .logo-uploader-group').length
                ? $button.closest('.formminia-card, .logo-uploader-group')
                : $button.closest('section');
            var $urlInp  = $('#formminia_email_logo_url');
            var $remove  = $wrapper.find('.formminia-media-remove-btn');

            var custom_uploader = wp.media({
                title:    'Select Logo',
                button:   { text: 'Use as Logo' },
                multiple: false
            }).on('select', function () {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $urlInp.val(attachment.url).trigger('input');
                if ($remove.length) { $remove.show(); }
            }).open();
        });

        $(document).on('click', '.formminia-media-remove-btn', function (e) {
            e.preventDefault();
            $('#formminia_email_logo_url').val('').trigger('input');
            $(this).hide();
        });

        // ──────────────────────────────────────────────────────────────
        // 4. Password visibility toggle
        // ──────────────────────────────────────────────────────────────
        $(document).on('click', '.btn-toggle-password', function (e) {
            e.preventDefault();
            var $btn   = $(this);
            var $input = $btn.siblings('.password-input');
            var $icon  = $btn.find('.dashicons');
            if ($input.attr('type') === 'password') {
                $input.attr('type', 'text');
                $icon.removeClass('dashicons-visibility').addClass('dashicons-hidden');
            } else {
                $input.attr('type', 'password');
                $icon.removeClass('dashicons-hidden').addClass('dashicons-visibility');
            }
        });

        // ──────────────────────────────────────────────────────────────
        // 5. CAPTCHA Provider card selection
        // ──────────────────────────────────────────────────────────────
        $(document).on('click', '.provider-card', function () {
            var $card     = $(this);
            var provider  = $card.data('provider');

            // Update card UI
            $('.provider-card').removeClass('is-selected');
            $card.addClass('is-selected');

            // Sync hidden select
            $('#formminia_captcha_provider').val(provider);

            // Show/hide credential panels
            $('.formminia-credentials-panel').hide();
            if (provider === 'recaptcha') {
                $('.recaptcha-fields').fadeIn(200);
            } else if (provider === 'turnstile') {
                $('.turnstile-fields').fadeIn(200);
            }
        });

        // Also handle the hidden select (for any native change)
        $('#formminia_captcha_provider').on('change', function () {
            var provider = $(this).val();
            $('.provider-card').removeClass('is-selected');
            $('.provider-card[data-provider="' + provider + '"]').addClass('is-selected');
            $('.formminia-credentials-panel').hide();
            if (provider === 'recaptcha') {
                $('.recaptcha-fields').fadeIn(200);
            } else if (provider === 'turnstile') {
                $('.turnstile-fields').fadeIn(200);
            }
        });

    });

})(jQuery);
