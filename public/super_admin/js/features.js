jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', 'button.edit-btn', function (e) {
        let $btn = $(this),
            showUrl = $btn.data('show-url'),
            updateUrl = $btn.data('update-url');

        $.ajax({
            url: showUrl,
            dataType: 'json',
            success: function (response) {
                if (response.id) {
                    $('#editFeatureForm')
                        .attr('action', updateUrl)
                        .find('[name="title"]').val(response.title);
                    $('#editFeatureForm').find('[name="is_active"]').prop('checked', response.is_active == 1);
                }
            }
        })
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

    let tbody = document.querySelector('tbody')
    new Sortable(tbody, {
        animation: 150,
        handle: '.handle',
        dragClass: 'table-sortable-drag',
        onEnd: function (/**Event*/ evt) {
            var list = [];
            $.each($(tbody).find('tr'), function (idx, el) {
                list.push({
                    id: $(el).data('id'),
                    pos: idx + 1
                })
            });

            $.ajax({
                method: 'post',
                url: $(tbody).data('update-positions-url'),
                data: {
                    positions: list,
                },
                dataType: 'json',
                success: function (response) {
                    $.each(response, function(i, item) {
                        let id = item['id'];
                        let position = item['position'];
                        $(`tr[data-id="${id}"]`).find('.position').text(position)
                    })
                }
            });

        }
    });

});
