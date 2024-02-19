jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    document.querySelectorAll('.favouriteBtn').forEach((el) => {
        el.addEventListener('click', function () {
            document.getElementById('storeFavArticleId').value = el.dataset.id;
        })
    });
    document.querySelectorAll('.fileBtn').forEach((el) => {
        el.addEventListener('click', function () {
            document.getElementById('storeFileArticleId').value = el.dataset.id;
        })
    });
    // document.getElementById('add_favourites_form').addEventListener('submit', (ev) => {
    //     ev.preventDefault();
    //     let criminal_article_id = document.getElementById('storeFavArticleId').value;
    //     $.ajax({
    //         url: ev.currentTarget.action,
    //         method: 'POST',
    //         data: {
    //             criminal_article_id: criminal_article_id,
    //             name: document.getElementById('storeFavName').value,
    //             folder_id: document.getElementById('storeFavFolder')?.value??null
    //         },
    //         success: () => {
    //             let callBtn = document.getElementById('row_' + criminal_article_id);
    //             if (callBtn.classList.contains('active')) {
    //                 callBtn.innerHTML = '<i class="far fa-star"></i>';
    //             }
    //             else {
    //                 callBtn.innerHTML = '<i class="fas fa-star"></i>';
    //             }
    //             callBtn.classList.toggle('active');
    //             const myModal = new bootstrap.Modal('#createFavouriteModal', {
    //                 keyboard: false
    //             });
    //             myModal.hide();
    //         }
    //     })
    // })
    $("#storeFavFolder").select2({
        placeholder: "Назва папки",
        ajax: makeSelect2AjaxSearch('/folders/search_favourites', 'storeFavFolder')
    })
    $("#storeFileFolder").select2({
        placeholder: "Назва папки",
        ajax: makeSelect2AjaxSearch('/folders/search_file_folders', 'storeFileFolder')
    })

    // Form filter
    // Category filter
    $("#category_select").select2({
        placeholder: 'Виберіть категорію',
        ajax: makeSelect2AjaxSearch('/admin/article_category/search', 'category_select')
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
                $('#table_container').html(response.table);
                $('#pagination_container').html(response.pagination);

                window.history.pushState(null, null, url);
            }
        });

    }
    $('#category_select').on('change', function () {
        request('filterDataForm')
    })
    $('#filterDataForm').on('change', function () {
        request('filterDataForm')
    })
    $('#nameSearch').on('input', function () {
        request('filterDataForm')
    })

    $('#date_range_picker').datepicker({
        todayHighlight: true,
        format: "yyyy-mm-dd",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    });

    // Sorting table
    let tbody = document.getElementById('criminal_articles_table')
    new Sortable(tbody, {
        animation: 150,
        handle: '.handle',
        dragClass: 'table-sortable-drag',
        onEnd: function (/**Event*/ evt) {
            let article_id = evt.item.dataset.value
            let newIndex = evt.newIndex;
            $.ajax({
                method: 'put',
                url: '/admin/criminal_article/update_position',
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

    // Update status of article
    $('.updateStatusBtn').each((id, el) => {
        el.addEventListener('click', () => {
            updateStatus('/admin/criminal_article/update_status', el)

        })
    })
});
