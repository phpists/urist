jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#customBulkRecordsDeleteForm', function (e) {
        let ids = JSON.stringify($(".checkbox-item:checkbox:checked").map(function () {
            return $(this).val();
        }).get());

        $(this).append(`<input name="ids" value='${ids}' style="display: none">`)
    })

    $(document).on('click', 'button.edit-btn', function (e) {
        let $btn = $(this),
            showUrl = $btn.data('show-url'),
            updateUrl = $btn.data('update-url');

        $.ajax({
            url: showUrl,
            dataType: 'json',
            success: function (response) {
                if (response.id) {
                    $('#editBlogTagForm')
                        .attr('action', updateUrl)
                        .find('[name="title"]').val(response.title);
                    $('#editBlogTagForm').find('[name="slug"]').val(response.slug)
                }
            }
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
