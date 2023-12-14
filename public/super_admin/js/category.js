function cookieNameGenerator(el) {
    return 'el_' + el.getAttribute('data-id');
}
$('.dd-item').each(function (idx, el) {
    let cookie_name = cookieNameGenerator(el);
    let val = getCookie(cookie_name);
    if(val === null) {
        writeCookie(cookie_name, '1', 24)
        val = '1';
    }
    if (val === '0') {
        el.classList.add('dd-collapsed')
    }
    else {
        el.classList.remove('dd-collapsed')
    }
})
$('.dd-item button').on('click', function(ev) {
    let el = ev.currentTarget.parentNode;
    let cookie_name = cookieNameGenerator(el);
    let val = getCookie(cookie_name);
    val = val === '1'? '0': '1';
    writeCookie(cookie_name, val, 24)
});
function writeCookie(name,value,hours) {
    if (hours) {
        var date = new Date();
        date.setTime(date.getTime()+(hours*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}
function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
            end = dc.length;
        }
    }
    // because unescape has been deprecated, replaced with decodeURI
    //return unescape(dc.substring(begin + prefix.length, end));
    return decodeURI(dc.substring(begin + prefix.length, end));
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
    $('.dd').nestable({
        callback: function(l,e){
            let el_id = e[0].dataset.id
            let parentEl_id = e[0].parentNode?.parentNode?.dataset.id??null;
            console.log(parentEl_id)
            $.ajax({
                url: '/admin/article_category/update_parent',
                method: 'put',
                data: {
                    id: el_id,
                    parent_id: parentEl_id
                },
                error: function (resp) {
                    console.log(resp)
                }
            })
        }
    });
})
