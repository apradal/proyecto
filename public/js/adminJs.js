Activeko = {};

Activeko.admin = {
    init: function () {
        this.ajaxs();
        this.listeners();
    },
    listeners: function () {
        var filters = $('.filter');
        var solo = $('.solo');
        solo.on('focusin', function () {
            filters.val('');
            filters.prop('disabled', true);
        });
        solo.on('click', function () {
            solo.prop('disabled', false);
        });
        filters.on('focusin', function () {
            solo.val('');
            solo.prop('disabled', true);
        });
        $('#resetSearch').on('click', function () {
            filters.val('').prop('disabled', false);
            solo.val('').prop('disabled', false);
        });
    },
    ajaxs: function () {
        /**
         * Ajax that let admin search ativities
         */
        $(document).on('click', '#searchButton', function () {
            event.preventDefault();
            var data = {
                id: $('#id').val(),
                id_creator: $('#id_creator').val(),
                tipo: $('#tipo').val(),
                fecha_inicio: $('#fecha_inicio').val(),
                fecha_fin: $('#fecha_fin').val(),
                estado: $('#estado').val()
            };
            $('.solo').val('').prop('disabled', false);
            $('.filter').val('').prop('disabled', false);
            $.ajax({
                url: '/admingetactivities',
                data: data,
                type: 'get',
                success: function(response){
                    $('#activities').html(response);
                    Activeko.admin.bindActivities();
                },
                error: function(response) { // What to do if we fail

                }
            });
        });
    },
    bindActivities: function () {
        $('.activity').each(function () {
            $(this).on('click', function () {
                $(this).children().submit();
            });
        });
    }
};

Activeko.admin.init();