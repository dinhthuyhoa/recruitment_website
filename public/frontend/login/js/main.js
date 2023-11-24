(function ($) {
    "use strict";

    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit', function () {
        var check = true;

        for (var i = 0; i < input.length; i++) {
            if (validate(input[i]) == false) {
                showValidate(input[i]);
                check = false;
            }
        }

        return check;
    });

    $('.validate-form .input100').each(function () {
        $(this).focus(function () {
            hideValidate(this);
        });
    });

    function validate(input) {
        var inputValue = $(input).val().trim();

        if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if (inputValue.match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                showError(input, 'Invalid email address');
                return false;
            }
        } else if ($(input).attr('name') == 'phone') {
            // Add phone number validation (e.g., digits only)
            if (!inputValue.match(/^\d+$/)) {
                showError(input, 'Invalid phone number');
                return false;
            }
        } else if ($(input).attr('name') == 'password') {
            // Add password length validation
            if (inputValue.length < 6) {
                showError(input, 'Password must be at least 6 characters');
                return false;
            }
        } else if ($(input).attr('name') == 'password_verify') {
            // Add password confirmation validation
            var passwordInput = $('input[name="password"]').val().trim();
            if (inputValue !== passwordInput) {
                showError(input, 'Password confirmation does not match');
                return false;
            }
        } else {
            if (inputValue == '') {
                showError(input, 'This field is required');
                return false;
            }
        }

        return true;
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    function showError(input, message) {
        var thisAlert = $(input).parent();
        $(thisAlert).addClass('alert-validate');
        $(thisAlert).attr('data-validate', message);
    }

})(jQuery);
