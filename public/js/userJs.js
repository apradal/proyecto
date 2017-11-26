Activeko = {};

Activeko.user = {
    init : function () {
        this.ajaxs();
        this.listeners();
    },
    userData: $('#userInfo').serializeArray(),
    listeners: function () {

    },
    ajaxs : function () {
        /**
         * Ajax to change user data.
         */
        $(document).on('submit', '#userInfo', function (event) {
            event.preventDefault();
            var error = $('.errors'), succes = $('.success');
            if (!Activeko.user.changedData()){
                $.ajax({
                    url: '/personaldata',
                    data: $('#userInfo').serialize(),
                    type: 'post',
                    dataType: 'json',
                    success: function(response){
                        error.empty();
                        succes.empty();
                        (response.success === true) ? succes.append('<span><p>Datos modificados!!!</p></span>') : '';
                        setTimeout(function(){window.location.href = '/userpanel'},2000);
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
            } else {
                error.html('No ha cambiado ningún campo.');
            }
        });
    },
    changedData: function () {
        var oldData = this.userData;
        var newData = $('#userInfo').serializeArray();
        var identical = true;
        $.each(oldData, function (key, object) {
            if (object.value !== newData[key].value){
                identical = false;
            }
        });
        return identical;
    }
};

Activeko.user.init();