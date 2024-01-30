$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#notificationsButton', function (e) {
        let $container = $('#notificationsContainer'),
            ids = $('#notificationsContainer li.notification-item').map(function () {
                return $(this).data('id');
            }).get()

        $.ajax({
            type: 'POST',
            url: $container.data('read-url'),
            data: {
                ids: ids
            },
            dataType: 'json',
            success: function (response) {
                if (response.result > 0) {
                    $('#notificationsCount').text('0').hide()
                }
            }
        })
    })

})
