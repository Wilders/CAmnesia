var OpAuthSignIn = function() {
    var initValidationSignIn = function(){
        jQuery('.js-validation-signin').validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: {
                'login': {
                    required: true,
                    minlength: 3
                },
                'password': {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                'login': {
                    required: 'Entrez un identifiant',
                    minlength: 'L\'identifiant doit faire 3 caractères au minimum'
                },
                'password': {
                    required: 'Entrez un mot de passe',
                    minlength: 'Le mot de passe doit faire 5 caractères au minimum'
                }
            }
        });
    };

    return {
        init: function () {
            initValidationSignIn();
        }
    };
}();
jQuery(function(){ OpAuthSignIn.init(); });