(function ($) {
    'use strict';

    $(document).ready(function () {

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
