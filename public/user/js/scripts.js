$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#notificationsButton', function (e) {
        let $container = $('#notificationsContainer'),
            ids = $('#notificationsContainer li.notification-item').map(function () {
                return $(this).data('id');
            }).get()

        $.ajax({
            type: 'POST',
            url: $container.data('read-url'),
            data: {
                ids: ids
            },
            dataType: 'json',
            success: function (response) {
                if (response.result > 0) {
                    $('#notificationsCount').text('0').hide()
                }
            }
        })
    })

    $(document).on('click', '#mobileNotificationsButton', function (e) {
        let $container = $('#mobileNotificationsContainer'),
            ids = $('#mobileNotificationsContainer li.modal__notifications-item').map(function () {
                return $(this).data('id');
            }).get()

        $.ajax({
            type: 'POST',
            url: $container.data('read-url'),
            data: {
                ids: ids
            },
            dataType: 'json',
            success: function (response) {
                if (response.result > 0) {
                    $('#mobileNotificationsCount').text('0').hide()
                }
            }
        })
    })

    $(document).on('input', '.just-validate-error-field', function (e) {
        $(this).removeClass('just-validate-error-field');
        let $next = $(this).next();

        if ($next.hasClass('error-label')) {
            $next.hide()
        }
    })

    $(document).on('click', '.modal-self-completing', function (e) {
        let action = this.dataset.action ?? null,
            json = this.dataset.json,
            form = document.getElementById(this.dataset.modal).querySelector('form');

        if (form) {
            if (action)
                form.action = action;

            try {
                let values = JSON.parse(json);

                for (let field in values) {
                    let formField = form.querySelector(`[name="${field}"]`)
                    if (formField)
                        formField.value = values[field]
                }
            } catch (e) {
            }
        }
    })

    $(document).on('submit', '#modal-delete form', function (e) {
        e.preventDefault();

        let form = this;

        $.ajax({
            type: form.method,
            url: form.action,
            data: $(form).serialize(),
            dataType: 'json',
            success: function (response) {
                throwSuccessToaster(response.message);
            },
            error: function (jqXHR) {
                throwErrorToaster(jqXHR?.responseJSON?.message ?? 'Не вдалось обробити запит')
            },
            complete: function () {
                $('#modal-delete button.modal__close').click()
                updateContainer('#itemsContainer', location.href)
            }
        })
    })

    $(document).on('submit', '#modal-edit form', function (e) {
        e.preventDefault();

        let form = this;

        $.ajax({
            type: form.method,
            url: form.action,
            data: $(form).serialize(),
            dataType: 'json',
            success: function (response) {
                throwSuccessToaster(response.message);
            },
            error: function (jqXHR) {
                throwErrorToaster(jqXHR?.responseJSON?.message ?? 'Не вдалось обробити запит')
            },
            complete: function () {
                $('#modal-edit button.modal__close').click()
                updateContainer('#itemsContainer', location.href)
            }
        })
    })

    $(document).on('submit', 'form.ajax-form', function (e) {
        e.preventDefault();
        updateContainer($(this).data('target-container'), this.action + '?' + $(this).serialize())
    })

    $(document).on('keyup', `form.ajax-form input[name*="search"]`, function (e) {
        $(this).parents('form').submit()
    })

    $(document).on('keyup', '.search__input', delay(function () {
        let url = $(this).data('url');

        if (url)
            $.ajax({
                url: url,
                data: {
                    search: $(this).val(),
                },
                success: function (response) {
                    $('.searchItemsContainer').html(response)
                }
            })
    }, 600))


    $(document).on('submit', 'form.articles-search', function (e) {
        $('.searchItemsContainer').html('').hide()
        const $form = $('#filterForm');
        $form.find('input[name="search"]').val($(this).find('input[name="search"]').val());
        $form.submit()
    })

    if ((Math.min(window.screen.width, window.screen.height) < 768 || navigator.userAgent.indexOf("Mobi") > -1)
        && window.location.href.includes('/articles/'))
        $('.filter-toggle__button').click() // open filter on articles page if mobile device


    $('#alertsContainer span.success').each(function (i, item) {
        throwSuccessToaster(item.textContent)
    })

    $('#alertsContainer span.error').each(function (i, item) {
        throwErrorToaster(item.textContent)
    })

})


function updateContainer(targetSelector, url) {
    $(targetSelector).load(url)
}



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

const copyText = async (text) => {
    try {
        // Navigator clipboard api needs a secure context (https)
        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(text);
            throwSuccessToaster('Посилання успішно скопійоване в буфер обміну');
        } else {
            // Use the 'out of viewport hidden text area' trick
            const textArea = document.createElement("textarea");
            textArea.value = text;

            // Move textarea out of the viewport so it's not visible
            textArea.style.position = "absolute";
            textArea.style.left = "-999999px";

            document.body.prepend(textArea);
            textArea.select();

            try {
                document.execCommand('copy');
                throwSuccessToaster('Посилання успішно скопійоване в буфер обміну');
            } catch (error) {
                console.error(error);
            } finally {
                textArea.remove();
            }
        }
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}


function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}
