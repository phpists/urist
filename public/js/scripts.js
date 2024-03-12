$(function () {

    $(document).on('input', '.just-validate-error-field', function (e) {
        $(this).removeClass('just-validate-error-field');
        let $next = $(this).next();

        if ($next.hasClass('error-label')) {
            $next.hide()
        }
    })

})


function throwSuccessToaster(text) {
    let $elem = $(`<div class="alert"><svg class="alert__icon" width="15" height="11"><use xlink:href="/img/sprite.svg#check"></use></svg><span>${text}</span></div>`);
    $('body').append($elem);
    $elem.addClass('is-visible')

    setTimeout(() => {
        $(document).one('click', function () {
            $elem.removeClass('is-visible')
        })
    }, 300);

    setTimeout(() => {
        $elem.removeClass('is-visible')
    }, 3000)
}

function throwErrorToaster(text) {
    let $elem = $(`<div class="alert alert--red"><svg class="alert__icon" width="15" height="15"><use xlink:href="/img/sprite.svg#cross"></use></svg><span>${text}</span></div>`);
    $('body').append($elem);
    $elem.addClass('is-visible')

    setTimeout(() => {
        $(document).one('click', function () {
            $elem.removeClass('is-visible')
        })
    }, 300);

    setTimeout(() => {
        $elem.removeClass('is-visible')
    }, 3000)
}
