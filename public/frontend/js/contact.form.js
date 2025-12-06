/**
*
* -----------------------------------------------------------------------------
*
* Template : Edulearn | Responsive Education HTML5 Template 
* Author : rs-theme
* Author URI : http://www.rstheme.com/
*
* -----------------------------------------------------------------------------
*
**/

jQuery(document).ready(function($) {
    'use strict';

    // Get the form.
    var form = $('#contact-form');

    // Get the messages div.
    var formMessages = $('#form-messages');

    // Set up an event listener for the contact form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Serialize the form data.
        var formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        })
        .done(function(response) {
            // Make sure that the formMessages div has the 'success' class.
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');

            // Set the message text (handle both string and JSON responses)
            var message = typeof response === 'string' ? response : (response.message || 'Thank you! Your message has been sent successfully.');
            $(formMessages).html('<i class="fa fa-check-circle"></i> ' + message);

            // Clear the form.
            $('#fname, #lname, #email, #subject, #message').val('');
        })
        .fail(function(data) {
            // Make sure that the formMessages div has the 'error' class.
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');

            // Handle validation errors or other errors
            var errorMessage = 'Oops! An error occurred and your message could not be sent.';
            
            if (data.responseJSON) {
                // Handle JSON response (validation errors)
                if (data.responseJSON.message) {
                    errorMessage = data.responseJSON.message;
                } else if (data.responseJSON.errors) {
                    var errors = [];
                    $.each(data.responseJSON.errors, function(key, value) {
                        errors.push(value[0]);
                    });
                    errorMessage = errors.join('<br>');
                }
            } else if (data.responseText) {
                errorMessage = data.responseText;
            }
            
            $(formMessages).html('<i class="fa fa-exclamation-circle"></i> ' + errorMessage);
        });
    });

});