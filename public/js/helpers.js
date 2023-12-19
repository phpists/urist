function makeSelect2AjaxSearch(url, element_id) {
    return {
        url: url,
        data: function (params) {
            var query = {
                search_string: params.term
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


// Checkbox selection handle
let checkBoxAll = $('#checkbox-all');

checkBoxAll.on('click', function(ev) {
    if (checkBoxAll.is(':checked')) {
        $('td .checkbox-single .checkbox-item').each((idx, el) => {
            el.checked = true;
        })
    } else {
        $('td .checkbox-single .checkbox-item').each((idx, el) => {
            el.checked = false;
        })
    }
})

document.addEventListener('DOMContentLoaded', function () {
    // Delete multiple records selected by checkbox
    $('#bulkRecordsDeleteForm').on('submit', function(ev) {
        ev.preventDefault();
        let form = ev.currentTarget;
        let el_ids = [];
        $('td .checkbox-single .checkbox-item:checked').each((idx, el) => {
            el_ids.push(el.value)
        });
        $.ajax({
            url: form.action,
            method: 'delete',
            data: {
                item_list: el_ids
            },
            success: function () {
                location.reload();
            }
        })
    })
})

function updateStatus(url, el) {
    let new_value = (+(!parseInt(el.dataset.value)));
    $.ajax({
        url: url,
        data: {
            id: el.dataset.id,
            status: new_value
        },
        method: 'put',
        success: function () {

            if (new_value) {
                el.innerHTML = '<i class="la la-eye"></i>';
            }
            else {
                el.innerHTML = '<i class="la la-eye-slash"></i>';
            }
            el.dataset.value = "" + new_value;
        }
    })
}
