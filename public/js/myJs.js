Activeko = {};

Activeko.form = {
    
    init : function () {
        this.listeners();
        this.ajaxRegisterUser();
        this.ajaxLoginUser();
    },
    listeners : function () {
        $(document).on('click', '.btn-form', function (event) {

            var loginForm = $('#loginForm'),
                registerForm = $('#registerForm');
            
            switch (event.target.id) {
                case 'loginButton':
                    loginForm.css({ 'display': "block" });
                    registerForm.css({ 'display': "none" });
                    break;
                case 'registerButton':
                    loginForm.css({ 'display': "none" });
                    registerForm.css({ 'display': "block" });
                    break;
                default:
                    break;
            }
        });
    }, // END Listeners
    ajaxRegisterUser : function () {
        $(document).on('submit', '#registerUserForm', function (event) {

            event.preventDefault();

            var error = $('.errors'),
                succes = $('.success');

            $.ajax({
                url: '/registeruser',
                data: $('#registerUserForm').serialize(),
                type: 'post',
                dataType: 'json',
                success: function(response){

                    error.empty();
                    succes.empty();

                    (response.success === true) ? succes.append('<span><p>Usuario registrado!!!</p></span>') : '';
                },
                error: function(response) { // What to do if we fail
                    var errors = response.responseJSON;
                    var html = '';

                    error.empty();
                    succes.empty();

                    if (errors.success === false){
                        $.each( errors.errors, function( key, value ) {
                            html += '<span><p>' + value + '</p></span>';
                        });
                        error.append(html);
                    }
                }
            });

        });
    }, // END Ajax
    ajaxLoginUser : function () {
        $(document).on('submit', '#loginUserForm', function (event) {

            event.preventDefault();

            var error = $('.errors'),
                succes = $('.success');

            $.ajax({
                url: '/loginuser',
                data: $('#loginUserForm').serialize(),
                type: 'post',
                dataType: 'json',
                success: function(response){

                    error.empty();
                    succes.empty();

                    //if exists

                    if (response.success === true){
                        window.location = '/';
                    }

                },
                error: function(response) { // What to do if we fail
                    var errors = response.responseJSON;
                    var html = '';

                    error.empty();
                    succes.empty();

                    if (errors.success === false){
                        $.each( errors, function( key, value ) {
                            (key == 'errors') ? html += '<span><p>' + value + '</p></span>' : '';
                        });
                        error.append(html);
                    }

                }
            });

        });
    }
};

Activeko.form.init();