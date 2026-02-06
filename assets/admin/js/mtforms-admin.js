(function ($) {
    'use strict';

    $(document).ready(function () {

        /**
         * Color Picker.
         */
        $('.mtforms-color-picker').wpColorPicker();

        /**
         * Media Library Uploader for Logo.
         */
        $('.mtforms-media-upload-btn').on('click', function (e) {
            e.preventDefault();

            var $button = $(this);
            var $wrapper = $button.closest('.mtforms-card');
            var $urlInp = $wrapper.find('.mtforms-media-url');
            var $preview = $wrapper.find('.mtforms-logo-preview');
            var $remove = $wrapper.find('.mtforms-media-remove-btn');

            var custom_uploader = wp.media({
                title: 'Select Logo',
                button: { text: 'Use as Logo' },
                multiple: false
            }).on('select', function () {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $urlInp.val(attachment.url);
                $preview.show().find('img').attr('src', attachment.url);
                $remove.show();
            }).open();
        });

        $('.mtforms-media-remove-btn').on('click', function (e) {
            e.preventDefault();
            var $button = $(this);
            var $wrapper = $button.closest('.mtforms-card');
            $wrapper.find('.mtforms-media-url').val('');
            $wrapper.find('.mtforms-logo-preview').hide();
            $button.hide();
        });

        /**
         * Right info sidebar — sub-tab switching.
         */
        $('.mtforms-info-tab').on('click', function () {
            var $btn = $(this);
            var target = $btn.data('target');

            // Update tab buttons
            $('.mtforms-info-tab').removeClass('is-active');
            $btn.addClass('is-active');

            // Show the matching panel
            $('.mtforms-info-panel').removeClass('is-active');
            $('#' + target).addClass('is-active');
        });

    });

})(jQuery);
