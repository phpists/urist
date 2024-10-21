function cookieNameGenerator(el) {
    return 'el_' + el.getAttribute('data-id');
}
// openNestableItems();
$(document).on('click', '.dd-item button', function(ev) {
    let el = ev.currentTarget.parentNode;
    let cookie_name = cookieNameGenerator(el);
    let val = getFromLocalStorage(cookie_name);
    val = val === '1'? '0': '1';
    writeToLocalStorage(cookie_name, val)
});
function writeToLocalStorage(name,value) {
    localStorage.setItem(name, value);
}
function getFromLocalStorage(name) {
    return localStorage.getItem(name);
}

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
                    text: el.full_path
                }
            })
            return {
                results: data
            };
        }
    }
}
function changeParent(category_id, parent_id) {
    $.ajax({
        url: '/admin/article_category/update_parent',
        method: 'put',
        data: {
            id: category_id,
            parent_id: parent_id
        },
        error: function (resp) {
            console.log(resp)
        }
    })
}
document.addEventListener('DOMContentLoaded', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Sorting table
    let tbody = document.getElementById('articleCategoriesTable')
    if (tbody) {
        new Sortable(tbody, {
            animation: 150,
            handle: '.handle',
            dragClass: 'table-sortable-drag',
            onEnd: function (/**Event*/ evt) {
                let article_id = evt.item.dataset.value
                let newIndex = evt.newIndex;
                $.ajax({
                    method: 'put',
                    url: '/admin/article_category/update_position',
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
    }

    const createCategorySelect = $("#createCategoryParent").select2({
        width: '100%',
        placeholder: "Виберіть батьківську категорію",
        ajax: makeAjaxCategorySearch()
    });
    $("#updateCategoryParent").select2({
        width: '100%',
        placeholder: "Виберіть батьківську категорію",
        ajax: makeAjaxCategorySearch()
    })
    $('.updateArticleCategory').on('click', function (ev) {
        let categoryId = ev.currentTarget.dataset.id;
        $.ajax({
            url: '/admin/article_category',
            data: {
                id: categoryId
            },
            success: function (resp) {
                document.getElementById('updateCategoryId').value = categoryId;
                $("#updateCategoryName").val(resp.name)
                $('#updateCategorySubTitle').val(resp.sub_title)
                if (resp.parent_category !== null) {
                    let categorySelect = $("#updateCategoryParent");
                    let option = document.createElement('option');
                    option.value = resp.parent_category.id;
                    option.innerText = resp.parent_category.name;
                    categorySelect.append(option);
                    option.selected = 'selected';
                }
            }
        })
    })


    $(document).on('click', 'button.create_category_inside', function (e) {
        let option = new Option(this.dataset.name, this.dataset.id, true, true);
        createCategorySelect.append(option).trigger('change');
    })

    $(document).on('click', '.updateStatusBtn', () => {
        updateStatus('/admin/article_category/update_status', el)
    })

    initNestable();
    // openNestableItems()

    $(document).on('click', 'li.dd-item .dd-expand', function (e) {
        const $item = $(this).parents('li.dd-item:first');
        loadChilds($item)
    })


    $('#nameSearch').on('input', function () {
        request('filterDataForm')
    })
    $('#filterDataForm').on('change', function () {
        request('filterDataForm')
    })
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
            $('#table_data').html(response.table);

            window.history.pushState(null, null, url);
        }
    });

}

function loadChilds($item) {
    $item.find('ol.dd-list').load($item.data('show-more-url'), () => {
        reinitNestable()
        openNestableItems($item)
    });
}

function initNestable() {
    const $block = $('.dd');

    $block.nestable({
        depth: 100,
        beforeDragStop: function (container, $target, place, event) {
            if (event.target.classList.contains('parent-category-droppable')) {
                $.ajax({
                    async: true,
                    url: $('#nestable3').data('move-parent-url'),
                    method: 'post',
                    data: {
                        category_id: $target.data('id'),
                        parent_id: $(event.target).data('id')
                    },
                    success: function (response) {
                        $target.remove()
                    },
                    error: function (resp) {
                        console.log(resp)
                    }
                })
            }
        },
        callback: function (l, e) {
            let url = document.getElementById('nestable3').dataset.updateUrl;

            $.ajax({
                url: url,
                method: 'put',
                data: {
                    positions: l.nestable('serialize')
                },
                error: function (resp) {
                    console.log(resp)
                }
            })
        }
    });
}

function reinitNestable() {
    const $block = $('.dd');
    $block.nestable('init');
}

function openNestableItems(parent = null) {
    const $parent = parent || $(document);

    $parent.find('.dd-item').each(function (idx, el) {
        let cookie_name = cookieNameGenerator(el);
        let val = getFromLocalStorage(cookie_name);
        if(val === null) {
            writeToLocalStorage(cookie_name, '0')
            val = '0';
        }
        if (val == '1') {
            if (el.classList.contains('dd-collapsed')) {
                el.classList.remove('dd-collapsed')
                loadChilds($(el))
            }
        } else {
            if (!el.classList.contains('dd-collapsed')) {
                el.classList.add('dd-collapsed')
            }
        }
    })
}
