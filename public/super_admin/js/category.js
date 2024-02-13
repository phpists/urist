function cookieNameGenerator(el) {
    return 'el_' + el.getAttribute('data-id');
}
$('.dd-item').each(function (idx, el) {
    let cookie_name = cookieNameGenerator(el);
    let val = getFromLocalStorage(cookie_name);
    if(val === null) {
        writeToLocalStorage(cookie_name, '1')
        val = '1';
    }
    if (val === '0') {
        el.classList.add('dd-collapsed')
    }
    else {
        el.classList.remove('dd-collapsed')
    }
})
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
                    text: el.name
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

    $("#createCategoryParent").select2({
        placeholder: "Виберіть батьківську категорію",
        ajax: makeAjaxCategorySearch()
    });
    $("#updateCategoryParent").select2({
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

    $('#jstree_container').jstree({
        core: {
            'check_callback': true
        },
        "plugins" : [ "dnd" ]
    });
    let jstreeEl = $('#jstree_container');
    jstreeEl.on('open_node.jstree', function (ev, node) {
        if(node.node.children.length === 0 || (node.node.children.length < node.node.children_d.length)) {
            return;
        }
        let el_ids = node.node.children.map((el) => {
            return el.split('_')[1];
        })
        $.ajax({
            url: "/admin/article_category/get_children",
            data: {
                id_list: el_ids
            },
            success: function (resp) {
                resp.forEach((el) => {
                    jstreeEl.jstree('create_node', $('#node_' + el.parent_id), {
                        "id": "node_" + el.id,
                        "text": el.name
                    }, 'last', false, false)
                })
            }
        })
    });
    jstreeEl.on('activate_node.jstree', function (ev, node) {
        if (!node.node.state.opened) {
            jstreeEl.jstree('open_node', $('#' + node.node.id));
        }
        else {
            jstreeEl.jstree('close_node', $('#' + node.node.id));
        }
    });
    jstreeEl.on('move_node.jstree', function (ev, node) {
        let parent_id = node.parent.split('_');
        if(parent_id.length > 1) {
            parent_id = parent_id[1]
        }
        else {
            parent_id = null;
        }
        changeParent(node.node.id.split('_')[1], parent_id)
    })
    $('.updateStatusBtn').each((id, el) => {
        el.addEventListener('click', () => {
            updateStatus('/admin/article_category/update_status', el)

        })
    })
    $('.dd').nestable()
        .on('change', function (e) {
            let list = e.length ? e : $(e.target);
            $.ajax({
                url: '/admin/article_category/update_position',
                method: 'put',
                data: {
                    positions: list.nestable('serialize')
                },
                error: function (resp) {
                    console.log(resp)
                }
            })
        });
})
