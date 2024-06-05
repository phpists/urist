function makeSelect2AjaxSearch(url, element_id) {
    return {
        url: url,
        data: function (params) {
            var query = {
                search_string: params.term,
                page: params.page || 1
            }
            // Query parameters will be ?search=[term]&type=public
            return query;
        },
        processResults: function (data) {
            data = data.map((el) => {
                return {
                    id: el.id,
                    text: el.full_path ?? el.name
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
async function makeAlertText(alert_text) {
    let alertDiv = document.createElement('div');
    alertDiv.classList.add('alert');
    alertDiv.classList.add('alert-danger');
    alertDiv.innerText = alert_text;
    return alertDiv
}
function checkRequiredInputs(id) {
    document.getElementById(id).addEventListener('submit', function (ev) {
        document.querySelectorAll('.required_inp').forEach(async (inp_element) => {
            let containsAlertMessage = inp_element.parentElement.lastElementChild.classList.contains('alert');
            if (inp_element?.value === null || inp_element?.value === '' || inp_element?.value === '<p></p>') {
                // ev.preventDefault();
                if (!containsAlertMessage) {
                    let alertEl = await makeAlertText('Це поле повинно бути заповнене');
                    inp_element.parentElement.append(alertEl);
                    alertEl.scrollIntoView(false);
                }
            }
            else if (containsAlertMessage) {
                inp_element.parentElement.lastElementChild.remove();
            }
        })
    })
}


$(function () {

    $(document).on('click', '.showCategoryFullPath', function (e) {
        $('#showFullPathModalLabel').text('');
        $('#showFullPathModal').find('.modal-body').text('');

        $('#showFullPathModal').modal('show')

        $.ajax({
            url: $(this).data('url'),
            dataType: 'json',
            success: function (response) {
                $('#showFullPathModalLabel').text(response.name);
                $('#showFullPathModal .modal-body').text(response.full_path);
            }
        })
    })

    $(document).on('click', '.filter-sort', function (e) {
        let $form = $(this.dataset.form);

        $(`input[name="${this.dataset.name}"]`).val(this.dataset.value);
        $form.trigger('change')
    })

})
