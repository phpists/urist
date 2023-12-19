function makeAjaxCategorySearch() {
    return {
        url: '/admin/article_category/search',
        data: function (params) {
            var query = {
                search_string: params.term,
                article_category_id: document.getElementById('updateCategoryId').value
            }
            // Query parameters will be ?search=[term]&type=public
            return query;
        },
        processResults: function (data) {
            data = data.map((el) => {
                return {
                    id: el.id,
                    text: el.name
                }
            })
            return {
                results: data
            };
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.updateTag').on('click', function (ev) {
        let categoryId = ev.currentTarget.dataset.id;
        $.ajax({
            url: '/admin/tag',
            data: {
                id: categoryId
            },
            success: function (resp) {
                document.getElementById('updateTagId').value = categoryId;
                $("#updateTagName").val(resp.name)
            }
        })
    })
    // Sorting table
    let tbody = document.getElementById('tags-table')
    new Sortable(tbody, {
        animation: 150,
        handle: '.handle',
        dragClass: 'table-sortable-drag',
        onEnd: function (/**Event*/ evt) {
            let article_id = evt.item.dataset.value
            let newIndex = evt.newIndex;
            $.ajax({
                method: 'put',
                url: '/admin/tag/update_position',
                data: {
                    id: article_id,
                    position: newIndex
                },
                error: function (resp) {
                    console.log(resp)
                }
            });

        }
    });
})
