$(function() {

    setTimeout(() => {
        $('#resendVerificationBlock').show();
    }, 60 * 1000)

    $(document).on('click', '#resendVerificationBlock', function (e) {
        $.ajax({
            type: 'POST',
            url: $(this).data('url'),
            data: {
                phone: $('#code-form').find('input[name="phone"]').val(),
            },
            dataType: 'json',
            success: function(response) {
                toastr.success('Код успішно відправлено повторно')

                $('#resendVerificationBlock').hide()
                setTimeout(() => {
                    $('#resendVerificationBlock').show()
                }, 60 * 1000)
            }
        })
    })

})
