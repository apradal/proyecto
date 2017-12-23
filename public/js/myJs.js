Activeko = {};

Activeko.form = {
    
    init : function () {
        this.listeners();
        this.ajaxs();
    },
    listeners : function () {
        /**
         * Shows and Hide the forms to register and log
         */
        $(document).on('click', '.a-btn', function (event) {
            var loginForm = $('#loginForm'),
                registerForm = $('#registerForm');
            
            switch (event.target.id) {
                case 'loginButton':
                    loginForm.fadeIn(2000);
                    $('#modal-bg').fadeIn(1500);
                    registerForm.css({ 'display': "none" });
                    break;
                case 'registerButton':
                    loginForm.css({ 'display': "none" });
                    registerForm.fadeIn(2000);
                    $('#modal-bg').fadeIn(1500);
                    break;
                default:
                    break;
            }
        });
        $(document).on('click', '.icon.cancel', function () {
            var id = ($(this).parent()[0].id);
            var loginForm = $('#loginForm');
            var registerForm = $('#registerForm');
            var leaveActivity = $('#leaveActivity');
            var joinActivity = $('#joinActivity');
            var deleteActivity = $("#delete-activity");
            var error = $('.errors');
            var succes = $('.success');
            switch (id){
                case 'loginForm':
                    loginForm.css({ 'display': "none" });
                    var $inputs = $('#loginForm :input');
                    $inputs.each(function() {
                        if ($(this).attr('type') === 'text' || $(this).attr('type') === 'password'){
                            $(this).val('');
                        }
                    });
                    break;
                case 'registerForm':
                    registerForm.css({ 'display': "none" });
                    var $inputs = $('#registerForm :input');
                    $inputs.each(function() {
                        if ($(this).attr('type') === 'text' || $(this).attr('type') === 'password'){
                            $(this).val('');
                        }
                    });
                    $('select[name=provinces]').val('');
                    break;
                case 'leaveActivity':
                    leaveActivity.css({'display':'none'});
                    break;
                case 'joinActivity':
                    joinActivity.css({'display':'none'});
                    break;
                case 'delete-activity':
                    deleteActivity.css({'display':'none'});
                    break
            }
            $('#modal-bg').css({ 'display': "none" });
            error.html('');
            succes.html('');
        });
        /**
         * Shows the popup joinActivity
         * and put the name and the id of an Activity
         */
        $(document).on('click', '.joinButton', function (event) {
            var joinActivity = $('#joinActivity'),
                activityId = $('#activityId');
            $getActivityTitle = $('#'+ event.target.id).prev().siblings('h2').html();
            $('#joinActivityTitle').html('Está apunto de unirse a la actividad: ' + $getActivityTitle);
            activityId.val(event.target.id);
            joinActivity.fadeIn(2000);
            $('#modal-bg').fadeIn(1500);
        });
        /**
         * Hides the popup joinActivity
         * Simulates cancel.
         */
        $(document).on('click', '#cancelJoinActivity', function (event) {
            var joinActivity = $('#joinActivity');
            joinActivity.css({ 'display': "none" });
            $('#modal-bg').css({'display':'none'});
        });
        /**
         * show the popup leaveActivity
         * and put the name and the id of an Activity
         */
        $(document).on('click', '.leaveButton', function (event) {
            var leaveActivity = $('#leaveActivity'),
                activityId = $('#leaveActivityId');
            $getActivityTitle = $('#'+ event.target.id).prev().children('h2').html();
            $('#joinActivityTitle').html('Está apunto de salirse de la actividad: ' + $getActivityTitle);
            activityId.val(event.target.id);
            leaveActivity.fadeIn(2000);
            $('#modal-bg').fadeIn(1500);
        });
        /**
         * Hides the popup leaveActivity
         * Simulates cancel.
         */
        $(document).on('click', '#cancelLeaveActivity', function (event) {
            var leaveActivity = $('#leaveActivity');
            leaveActivity.css({ 'display': "none" });
            $('#modal-bg').css({ 'display': "none" });
        });
        $(document).on('click', '#delete-activity-button', function (event) {
            event.preventDefault();
            $('#delete-activity').fadeIn(2000);
            $('#modal-bg').fadeIn(1500);
        });
        $('#cancel-delete-activity-b').on('click', function () {
            $('#delete-activity').css({'display':'none'});
            $('#modal-bg').css({'display':'none'});
        });
        $(document).scroll(function(){
            var st = $(this).scrollTop();
            if(st > 180) {
                $(".filter-main").addClass('fixed');
            } else {
                $(".filter-main").removeClass('fixed');
            }
        });
    }, // END Listeners
    ajaxs : function () {
        /**
         * Ajax which let you register an user
         */
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
        /**
         * Ajax which let you login.
         */
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
                    if (response.success === true){
                        if (response.admin === true) {
                            window.location = '/admin';
                        } else {
                            window.location = '/';
                        }
                    }
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
        /**
         * Ajax that let you Join an Activity
         */
        $(document).on('submit', '#joinForm', function (event) {
            event.preventDefault();
            var joinAtivity =  $('#joinActivity');
            $.ajax({
                url: '/joinactivity',
                data: $('#joinForm').serialize(),
                type: 'post',
                dataType: 'json',
                success: function(response){

                    (response.success === true) ? joinAtivity.html('<h3>Registrado en esta actividad</h3>') : '';
                    function redirect(){
                        window.location = '/';
                    }
                    setTimeout(redirect, 2000);
                },
                error: function(response) { // What to do if we fail
                    var errors = response.responseJSON;
                    var html = '';

                    if (errors.success === false){
                        $.each( errors.errors, function( key, value ) {
                            html += '<span><p>' + value + '</p></span>';
                        });
                        joinAtivity.append(html);
                    }
                }
            });
        });
        /**
         * Ajax that let you leave an Activity
         */
        $(document).on('submit', '#leaveForm', function (event) {

            event.preventDefault();

            var leaveActivity =  $('#leaveActivity');

            $.ajax({
                url: '/leaveactivity',
                data: $('#leaveForm').serialize(),
                type: 'post',
                dataType: 'json',
                success: function(response){

                    (response.success === true) ? leaveActivity.html('<h3>Ha salido de la actividad.</h3>') : '';
                    function redirect(){
                        window.location = '/';
                    }
                    setTimeout(redirect, 2000);
                },
                error: function(response) { // What to do if we fail
                    var errors = response.responseJSON;
                    var html = '';

                    if (errors.success === false){
                        $.each( errors.errors, function( key, value ) {
                            html += '<span><p>' + value + '</p></span>';
                        });
                        leaveActivity.append(html);
                    }
                }
            });

        });
        /**
         * Ajax which call the province when filter option is selected and prints them
         */
        $(document).on('change', '.filter', function () {

            var choicesQuery = {
                province : $('#provincesSearch').val(),
                type : $('#typesSearch').val(),
                date : $('#dateSearch').val()
            };
            $.ajax({
                url: '/buildactivity',
                data: choicesQuery,
                type: 'get',
                success: function(response){
                    $('#activities').html(response);
                },
                error: function(response) { // What to do if we fail

                }
            });
        });
        /**
         * Ajax that resets all the filters and prints the activities
         */
        $(document).on('click', '#resetSearch', function () {
            var province = $('#provincesSearch'),
                type = $('#typesSearch'),
                date = $('#dateSearch');
            province.val("");
            type.val("");
            date.val("");
            var choicesQuery = {
                province : province.val(),
                type : type.val(),
                date : date.val()
            };
            $.ajax({
                url: '/buildactivity',
                data: choicesQuery,
                type: 'get',
                success: function(response){
                    $('#activities').html(response);
                },
                error: function(response) { // What to do if we fail
                }
            });
        });
        /**
         * Ajax which deletes activity.
         */
        $('#delete-activity-b').on('click', function () {
            var error = $('.errordelete');
            var succes = $('.successdelete');
            $.ajax({
                url: '/deleteactivity',
                data: $('#edit-form').serialize(),
                type: 'get',
                dataType: 'json',
                success: function(response){
                    $('#delete-activity').css({'display':'none'});
                    $('#modal-bg').css({'display':'none'});
                    error.empty();
                    succes.empty();
                    if (response.success === true){
                        if (response.admin === true) {
                            succes.append('Actividad eliminada.');
                            succes.css({'display':'block'});
                            setTimeout(window.location = '/admin', 4000);
                        } else {
                            succes.append('Actividad eliminada.');
                            succes.css({'display':'block'});
                            setTimeout(window.location = '/', 4000);
                        }
                    }
                },
                error: function(response) { // What to do if we fail
                    $('#delete-activity').css({'display':'none'});
                    $('#modal-bg').css({'display':'none'});
                    var errors = response.responseJSON;
                    error.html("");
                    var html = '';
                    $.each( errors.errors, function( key, value ) {
                        html += value + '<br/>';
                    });
                    error.append(html);
                    error.css({'display':'block'});
                }
            });
        });
    } // END Ajax
};

Activeko.form.init();