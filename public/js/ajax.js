(function ($) {

	'use strict';

    $('.delete-social').on('click', function() {
        handleAjax({that: $(this), button: 'delete-social-button', spinner: 'delete-social-spinner'});    
    });

    $('.user-cancel-subscription').on('click', function() {
        handleAjax({that: $(this), button: 'cancel-subscription-button', spinner: 'cancel-subscription-spinner'});    
    });

    $('.user-activate-subscription').on('click', function() {
        handleAjax({that: $(this), button: 'activate-subscription-button', spinner: 'activate-subscription-spinner'});    
    });

    $('.resend-otp').on('click', function() {
        handleAjax({that: $(this), button: 'resend-otp-button', spinner: 'resend-otp-spinner'});    
    });

    $('.delete-profile-image').on('click', function() {
        handleAjax({that: $(this), button: 'delete-profile-image-button', spinner: 'delete-profile-image-spinner'});    
    });

    $('.delete-unit').on('click', function() {
        handleAjax({that: $(this), button: 'delete-unit-button', spinner: 'delete-unit-spinner'});    
    });

})(jQuery);
