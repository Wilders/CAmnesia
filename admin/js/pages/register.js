var OpAuthSignUp = function() {
    var initValidationSignUp = function(){
        jQuery('.js-validation-signup').validate({
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
                'username': {
                    required: true,
                    minlength: 3
                },
                'email': {
                    required: true,
                    email: true
                },
                'password': {
                    required: true,
                    minlength: 5
                },
                'password-confirm': {
                    required: true,
                    equalTo: '#password'
                },
                'terms': {
                    required: true
                }
            },
            messages: {
                'username': {
                    required: 'Entrez un nom d\'utilisateur.',
                    minlength: 'Votre nom d\'utilisateur doit faire 3 caractères au minimum.'
                },
                'email': 'Entrez une adresse email valide.',
                'password': {
                    required: 'Entrez un mot de passe.',
                    minlength: 'Votre mot de passe doit faire 5 caractères au minimum.'
                },
                'password-confirm': {
                    required: 'Entrez un mot de passe.',
                    minlength: 'Votre mot de passe doit faire 5 caractères au minimum.',
                    equalTo: 'Les mots de passe ne correspondent pas.'
                },
                'terms': 'Vous devez accepter les C.G.U!'
            }
        });
    };

    return {
        init: function () {
            initValidationSignUp();
        }
    };
}();
jQuery(function(){ OpAuthSignUp.init(); });