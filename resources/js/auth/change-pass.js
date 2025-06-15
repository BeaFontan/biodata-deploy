$(document).ready(function() {
    $("#form-change-pass").validate({
        rules: {
            current_password: {
                required: true,
                minlength: 6,
            },
            new_password: {
                required: true,
                minlength: 6,
            },
            new_password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#new_password"
            }
        },
        messages: {
            current_password: {
                required: "Por favor, introduce o teu contrasinal actual",
                minlength: "O contrasinal debe ter polo menos 6 caracteres"
            },
            new_password: {
                required: "Por favor, introduce o teu novo contrasinal",
                minlength: "O contrasinal debe ter polo menos 6 caracteres"
            },
            new_password_confirmation: {
                required: "Por favor, repite o teu novo contrasinal",
                minlength: "O contrasinal debe ter polo menos 6 caracteres",
                equalTo: "Os contrasinais non coinciden"
            }
        },
        errorClass: "is-invalid",
        validClass: "is-valid",
        highlight: function(element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
        }
    });
});
