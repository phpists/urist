@php($filterService = $filterService ?? new \App\Services\ArticleFilterService(request('type')))

<aside class="filter {{ $is_menu_hidden ? 'is-hide' : '' }}">
    <div class="filter__panel">
        <div class="filter__top">
            <div class="logo filter__logo">
                <a class="logo__link" href="/" aria-label="logo">
                    <img class="logo__img" src="{{ asset('assets/img/user/logo-white.png') }}" srcset="{{ asset('assets/img/user/logo-white@2x.png') }} 2x" width="82" height="61" alt="logo"/>
                </a>
            </div>
            <button class="burger filter__burger" type="button" aria-label="Open sidebar" aria-expanded="false" data-sidebar-toggle="data-sidebar-toggle">
                <div class="burger__line"></div>
                <div class="burger__line"></div>
                <div class="burger__line"></div>
            </button>
        </div>
        <div class="filter__inner">
            <div class="filter__header">
                <h3 class="filter__title">
                    <svg class="filter__title-icon" width="38" height="38">
                        <use xlink:href="{{ asset('img/sprite.svg#filter') }}"></use>
                    </svg><span>Зміст кодексу</span>
                </h3>
                <button class="button button--outline filter__hide-button" type="button" aria-label="Hide Filter" data-tooltip-left="Регулювання масштабу" data-filter-hide="data-filter-hide">
                    <svg class="button__icon" width="10" height="19">
                        <use xlink:href="{{ asset('img/sprite.svg#arrow-left') }}"></use>
                    </svg>
                </button>
                <button class="button button--outline filter__toggle-button" type="button" aria-label="Hide Filter" data-filter-toggle="data-filter-toggle">
                    <svg class="button__icon" width="17" height="17">
                        <use xlink:href="{{ asset('img/sprite.svg#close-modal') }}"></use>
                    </svg>
                </button>
            </div>
            <form class="search filter__search" id="filter-search-form" autocomplete="off" novalidate="novalidate">
                <div class="search__group">
                    <input class="input search__input" id="inputFilterSearch" type="text" name="inputFilterSearch" placeholder="Пошук..." autocomplete="off" required="required">
                    <button type="button" class="search__button">
                        <svg class="search__icon" width="21" height="21">
                            <use xlink:href="{{ asset('img/sprite.svg#search') }}"></use>
                        </svg>
                    </button>
                </div>
            </form>

            <form id="filterForm" action="{{ route('user.articles.index', $filterService->getType()) }}" data-count-url="{{ route('user.articles.total-count', $filterService->getType()) }}" style="margin-bottom: 0">
                <input type="hidden" name="sort">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <div id="filterAccordionItemsContainer"
                     data-load-url="{{ route('user.filter', ['type' => $filterService->getType(), ...request()->query()]) }}"
                     class="accordion filter__accordion"></div>
            </form>
        </div>
        <div class="filter__bottom">
            <button class="button button--outline filter__button" type="button" onclick="location.href = '{{ route('user.articles.index', $filterService->getType()) }}'">Скинути</button>
            <button class="button filter__button" type="submit" form="filterForm" @if(!str_contains(route('user.articles.index', $filterService->getType()), url()->current())) data-redirect="true" @endif disabled>Показати</button>
        </div>
    </div>
</aside>

@push('scripts')
    <script>
        $(function () {

            $(document).on('submit', '#filter-search-form', function (e) {
                e.preventDefault()
            })

            const $filterAccordionItemsContainer = $('#filterAccordionItemsContainer');
            let $filterSpinner = $('#spinner').clone();
            $filterAccordionItemsContainer
                .html($filterSpinner.show())
                .css({
                    "text-align": 'center'
                })
            $filterAccordionItemsContainer.load($filterAccordionItemsContainer.data('load-url'), function () {
                $filterSpinner.hide()
            })

            $(document).on('keyup', '#inputFilterSearch', function (e) {
                let value = $(this).val().toLowerCase();

                filterCategories(value)
            })

            $(document).on('click', '.filter-sort', function (e) {
                let $input = $(`input[name="sort"]`)

                if ($input.length > 0) {
                    $input.val($(this).data('value'))
                    $('#filterForm').submit()
                }
            })

            $(document).on('change', '#selectSortBy', function (e) {
                let $input = $(`input[name="sort"]`)

                if ($input.length > 0) {
                    $input.val($(this).val())
                    $('#filterForm').submit()
                }
            })

            $(document).on('submit', '#filterForm', function (e) {
                let isRedirectNeeds = $('button[form="filterForm"]').data('redirect')

                if (isRedirectNeeds !== undefined)
                    return true;

                e.preventDefault();
                let $form = $(this);

                $.ajax({
                    type: $form.attr('method') ?? 'GET',
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    dataType: 'json',
                    beforeSend: function () {
                        let $spinner = $('#spinner').clone();

                        $('button[form="filterForm"]').prop('disabled', true)

                        $('#itemsContainer')
                            .html($spinner.show())
                            .css({
                                display: "flex",
                                justifyContent: "center"
                            })
                    },
                    success: function (response) {
                        if (response.html)
                            $('#itemsContainer')
                                .html(response.html)
                                .css({
                                    display: "block",
                                })

                        if (response.url)
                            history.pushState({}, '', response.url)
                    },
                    complete: function () {
                        if ($('aside.filter').hasClass('is-visible'))
                            $('.filter-toggle__button').click();
                    }
                })
            })

            $(document).on('change', 'input[name="categories[]"]', function (e) {
                let $form = $('#filterForm'),
                    $button = $('button[form="filterForm"]');

                $button.prop('disabled', false)

                $.ajax({
                    url: $form.data('count-url'),
                    data: $form.serialize(),
                    dataType: 'json',
                    beforeSend: function () {
                        // $button.text('');
                    },
                    success: function (response) {
                        // $button.text(`Показати (${response.count})`)
                    },
                    complete: function () {
                    }
                })
            })
        })

        function filterCategories(value) {
            value = value.toLowerCase();

            document.getElementById('filterForm').querySelectorAll('span.name-text').forEach(function (item, i) {
                item.innerHTML = item.textContent
            })

            if (value.length > 0 && $('#filterForm input[name="categories[]"]:checked').length > 0) {
                $('#filterForm div.accordion__panel.sub-category .accordion__header input[name="categories[]"]:not(:checked)').each(function (i, el) {
                    $(el).parents('div.accordion__panel.sub-category:first').hide()
                })

                $('div.accordion__panel.sub-category .accordion__header input[name="categories[]"]:checked')
                    .each(function (i, el) {
                        $(el).parents('div.accordion__panel.sub-category:first')
                            .find('div.accordion__content div.accordion__panel.sub-category')
                            .each(function (i, el) {
                                let title = $(el).find('label');
                                if (title.length > 0) {
                                    if (title.text().toLowerCase().indexOf(value) === -1) {
                                        $(el).hide();
                                    } else {
                                        $(el).show();
                                        el.querySelector('span.name-text').innerHTML = el.querySelector('span.name-text').innerHTML.replace(value, `<span style="background-color: yellow;color: black">${value}</span>`)
                                    }
                                }
                            })
                    })


                $('.accordion__content[aria-hidden="true"]:has(div.sub-category:visible)')
                    .each(function (i, item) {
                        const $parent = $(item).parent('.accordion__panel')

                        $(item).attr('aria-hidden', false);
                        $parent.find('.accordion__trigger')
                            .attr('aria-expanded', true)
                    })
            } else {
                $('div.accordion__panel.sub-category').each(function (i, el) {
                    let title = $(el).find('label');
                    if (title.length > 0) {
                        if (title.text().toLowerCase().indexOf(value) === -1) {
                            $(el).hide();
                        } else {
                            $(el).show();
                            el.querySelector('span.name-text').innerHTML = el.querySelector('span.name-text').innerHTML.replace(value, `<span style="background-color: yellow;color: black">${value}</span>`)
                        }
                    }
                })

                $('.accordion__content[aria-hidden="true"]:has(div.sub-category:visible)')
                    .each(function (i, item) {
                        const $parent = $(item).parent('.accordion__panel')

                        $(item).attr('aria-hidden', false);
                        $parent.find('.accordion__trigger')
                            .attr('aria-expanded', true)
                    })

                if (value.length < 1) {
                    $('.accordion__content[aria-hidden="false"]')
                        .each(function (i, item) {
                            const $parent = $(item).parent('.accordion__panel')

                            if (!$parent.find('.accordion__header input')[0].checked) {
                                $(item).attr('aria-hidden', true);
                                $parent.find('.accordion__trigger')
                                    .attr('aria-expanded', false)
                            }
                        })
                }
            }
        }

    </script>
@endpush
