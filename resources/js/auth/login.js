$(document).ready(function() {
    $("#form-login").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            email: {
                required: "Por favor, introduce o teu correo electrónico",
                email: "Introduce una dirección de correo válida"},
            password: {
                required: "Por favor, introduce o teu contrasinal",
                minlength: "O contrasinal debe ter polo menos 6 caracteres"
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
