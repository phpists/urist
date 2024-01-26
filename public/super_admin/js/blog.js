jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Form filter
    // Category filter
    $("#tag_select").select2({
        placeholder: 'Виберіть хештеги'
    })

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
    $('#tag_select').on('change', function () {
        request('filterDataForm')
    })
    $('#nameSearch').on('input', function () {
        request('filterDataForm')
    })


    $(document).on('change', '.bool-updatable', function (e) {
        let url = $(this).data('url'),
            name = this.name,
            value = this.checked ? 1 : 0;

        let data = {};
        data[name] = value;

        $.ajax({
            type: 'PUT',
            url: url,
            data: data,
            dataType: 'json',
        })
    })

    $(document).on('submit', '#customBulkRecordsDeleteForm', function (e) {
        let ids = JSON.stringify($(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get());

        $(this).append(`<input name="ids" value='${ids}'>`)
    })

});
