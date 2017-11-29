Activeko = {};

Activeko.user = {
    init : function () {
        this.ajaxs();
        this.listeners();
    },
    userData: $('#userInfo').serializeArray(),
    listeners: function () {
        $(document).on('click', '.leaveButton', function (event) {
            var leaveActivity = $('#leaveActivity'),
                activityId = $('#leaveActivityId');
            $getActivityTitle = $('#'+ event.target.id).prev().children('h2').html();
            $('#joinActivityTitle').html('Está apunto de salirse de la actividad: ' + $getActivityTitle);
            activityId.val(event.target.id);
            leaveActivity.css({ 'display' : 'block'});
        });
        /**
         * Hides the popup leaveActivity
         * Simulates cancel.
         */
        $(document).on('click', '#cancelLeaveActivity', function (event) {
            var leaveActivity = $('#leaveActivity');
            leaveActivity.css({ 'display': "none" });
        });
        /**
         * Shows and hides the content of personal data user or activities.
         */
        $(document).on('click', '.userpaneloptions', function (event) {
            var dataOption = $('#personaldata'),
                activityOption = $('#activities-user');
            switch (event.target.id) {
                case 'dataOption':
                    dataOption.css({ 'display': "block" });
                    activityOption.css({ 'display': "none" });
                    break;
                case 'activitiesOption':
                    dataOption.css({ 'display': "none" });
                    activityOption.css({ 'display': "block" });
                    break;
                default:
                    break;
            }
        });
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
                        window.location = '/userpanel';
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