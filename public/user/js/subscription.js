$(function () {

    $(document).on('click', '.tariffs-list__button', function (e) {
        let $btn = $(this),
            months = $btn.data('months');

        $('.tariffs-list__button').removeClass('is-active');
        $btn.addClass('is-active');

        if (months) {

            $('.tariff-card__total').each(function (i, item) {
                let $selected = $(item).find(`.tariff-card__discount[data-months="${months}"]`),
                    price = $selected.data('price');

                $(item).find('.tariff-card__price span').text(price)
            })

            $('.tariff-card__discount').hide()
            $(`.tariff-card__discount[data-months!="${months}"]`).show()
        }
    })

    $(document).on('click', '.show_payment_modal', function (e) {
        const $form = $('#paymentForm');
        let period = $('#selectedPeriod').val(),
            planTitle = $(this).data('title');

        $.ajax({
            type: 'POST',
            url: this.dataset.url,
            data: {
                period: period
            },
            beforeSend: function () {
                $form.hide();
            },
            success: function (response) {
                $('#paymentPlanTitle').text(planTitle)
                $form.attr('action', response.action);
                $form.find('[name="data"]').val(response.data);
                $form.find('[name="signature"]').val(response.signature);
                $('#paymentPlanPrice').text(response.price_title)
                $form.show();
            }
        })
    })


})
