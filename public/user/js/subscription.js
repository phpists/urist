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


})
