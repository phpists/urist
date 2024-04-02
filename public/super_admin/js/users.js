jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function request(formId, url) {
        formId = '#' + formId;
        if (typeof url === 'undefined') {
            url = $(formId).attr('action') + '?' + $(formId).serialize();
        }

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function (response) {
                $('#table_container').html(response.html);

                window.history.pushState(null, null, url);
            }
        });

    }

    $('#search').on('input', function () {
        request('filterDataForm')
    })

    $(document).on('click', 'button[data-target="#subscribeUser"]', function (e) {
        $("#subscribeUser form").attr('action', this.dataset.url);
    })

});
