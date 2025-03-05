<style>
    #spinner {
        position: absolute;
        display: block;
        z-index: 9999;
        margin: auto;
        left: 0;
        right: 0;
        text-align: center;
        top: 0;
        bottom: 0;
    }
</style>

<aside class="filter {{ $is_menu_hidden ? 'is-hide' : '' }}">
    <div class="filter__panel">
        <div class="filter__top">
            <div class="logo filter__logo">
                <a class="logo__link" href="/" aria-label="logo">
                    <img class="logo__img" src="{{ asset('assets/img/user/logo-white.png') }}"
                         srcset="{{ asset('assets/img/user/logo-white@2x.png') }} 2x" width="82" height="61"
                         alt="logo"/>
                </a>
            </div>
            <button class="burger filter__burger" type="button" aria-label="Open sidebar" aria-expanded="false"
                    data-sidebar-toggle="data-sidebar-toggle">
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
                    </svg>
                    <span>Зміст кодексу</span>
                </h3>
                @if(can_user(\App\Enums\PermissionEnum::LEGAL_BASE->value))
                <button class="button button--outline filter__hide-button" type="button" aria-label="Hide Filter"
                        data-tooltip-left="Регулювання масштабу" data-filter-hide="data-filter-hide">
                    <svg class="button__icon" width="10" height="19">
                        <use xlink:href="{{ asset('img/sprite.svg#arrow-left') }}"></use>
                    </svg>
                </button>
                <button class="button button--outline filter__toggle-button" type="button" aria-label="Hide Filter"
                        data-filter-toggle="data-filter-toggle">
                    <svg class="button__icon" width="17" height="17">
                        <use xlink:href="{{ asset('img/sprite.svg#close-modal') }}"></use>
                    </svg>
                </button>
                @endif
            </div>

            <div class="filter__sticky-header">
                <ul class="actions filter__actions">
                    <li class="actions__item">
                        <a class="button button--outline actions__button @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KK->value)) is-active @endif"
                           href="{{ !can_user(\App\Enums\PermissionEnum::MODULE_KK->value) ? '#' : get_setting_value_by_name(\App\Enums\SettingEnum::KK_MODULE_BTN->value) }}" aria-label="KK">КК</a>
                    </li>
                    <li class="actions__item">
                        <a class="button button--outline actions__button @if(url()->current() == route('user.articles.index', \App\Enums\CriminalArticleTypeEnum::KPK->value)) is-active @endif"
                           href="{{ !can_user(\App\Enums\PermissionEnum::MODULE_KPK->value) ? '#' : get_setting_value_by_name(\App\Enums\SettingEnum::KPK_MODULE_BTN->value) }}" aria-label="KПK">КПК</a>
                    </li>
                    <li class="actions__item">
                        <a class="button button--outline actions__button" href="{{ route('user.articles.last-page') }}" aria-label="List">
                            <svg class="button__icon" width="17" height="12">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#list') }}"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="actions__item">
                        @if($lastArticleId = \App\Services\UserLastViewService::getArticle())
                            <a class="button button--outline actions__button" href="{{ route('user.articles.show', $lastArticleId) }}" aria-label="View">
                                <svg class="button__icon" width="17" height="11">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#eye') }}"></use>
                                </svg>
                            </a>
                        @else
                            <button class="button button--outline actions__button" type="button" aria-label="View" disabled="disabled">
                                <svg class="button__icon" width="17" height="11">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#eye') }}"></use>
                                </svg>
                            </button>
                        @endif
                    </li>
                    <li class="actions__item">
                        <a class="button button--outline actions__button @if(url()->current() == route('user.files.index')) is-active @endif" href="{{ route('user.files.index') }}" aria-label="Bookmarks">
                            <svg class="button__icon" width="16" height="20">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#bookmark') }}"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button" type="button" aria-label="Hide Filter" data-filter-toggle="data-filter-toggle">
                            <svg class="button__icon" width="17" height="17">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#close-modal') }}"></use>
                            </svg>
                        </button>
                    </li>
                </ul>
                <form class="search filter__search" id="filter-search-form" autocomplete="off" novalidate="novalidate">
                    <div class="search__group">
                        <input class="input search__input" id="inputFilterSearch" type="text" name="inputFilterSearch"
                               placeholder="Пошук..." autocomplete="off" required="required" data-modal-once="modal-tip-6"/>
                        <button class="search__button">
                            <svg class="search__icon" width="21" height="21">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#search') }}"></use>
                            </svg>
                        </button>
                    </div>
                </form>
                <button class="filter__collapse-button" type="button" aria-label="Filter collapse" data-filter-collapse="data-filter-collapse">
                    <svg width="12" height="8">
                        <use xlink:href="{{ asset('assets/img/user/sprite.svg#dropdown-arrow') }}"></use>
                    </svg>
                </button>
            </div>

            <form id="filterForm" action="{{ route('user.articles.index', $type) }}" style="margin-bottom: 0">
                <input type="hidden" name="sort">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <div id="filterAccordionItemsContainer"
                     data-load-url="{{ route('user.categories.index', ['type' => $type, 'categories' => request('categories', [])]) }}"
                     data-search-url="{{ route('user.categories.search', ['type' => $type, 'categories' => request('categories', [])]) }}"
                     class="accordion filter__accordion"></div>
            </form>
        </div>
        <div class="filter__bottom">
            <button id="clearFilterButton" class="button button--outline filter__button" type="button"
                    data-url="{{ route('user.articles.index', $type) }}" data-modal-once="modal-tip-13">Скинути
            </button>
            <button class="button filter__button" type="submit" form="filterForm"
                    @if(!str_contains(route('user.articles.index', $type), url()->current())) data-redirect="true"
                    @endif disabled>Показати
            </button>
        </div>
    </div>
</aside>

@push('scripts')
    <script>
        let filterTimeout;

        $(function () {

            $(document).on('submit', '#filter-search-form', function (e) {
                e.preventDefault()
            })

            $(document).on('click', '#clearFilterButton', function (e) {
                localStorage.removeItem('filter_search');
                localStorage.removeItem('accordion__panel_expanded_statuses');

                location.href = this.dataset.url;
            })

            const $filterAccordionItemsContainer = $('#filterAccordionItemsContainer');
            let $filterSpinner = $('#spinner').clone();
            $filterAccordionItemsContainer
                .html($filterSpinner.show())
                .css({
                    "text-align": 'center'
                })

            let filter_search = localStorage.getItem('filter_search');
            if (filter_search) {
                $('#inputFilterSearch').val(filter_search);
                filterCategories(filter_search);
            } else {
                $filterAccordionItemsContainer.load($filterAccordionItemsContainer.data('load-url'))
            }

            $(document).on('click', '.accordion__trigger', function (e) {
                const $this = $(this),
                    $container = $('#' + $(this).attr('aria-controls')),
                    $list = $container.find('.accordion__inner');

                if ($container.children().length < 1) {
                    $filterAccordionItemsContainer.prepend($filterSpinner.show())

                    $this.prop('disabled', true)
                    console.log('hide')
                    $this.attr('aria-expanded', 'false');
                    $container.attr('aria-hidden', 'true');

                    $container.load(this.dataset.loadUrl, function () {
                        console.log('show')
                        $this.attr('aria-expanded', 'true');
                        $container.attr('aria-hidden', 'false');
                        $this.prop('disabled', false)
                        $filterSpinner.hide()
                    })
                }
            })

            $(document).on('input', '#inputFilterSearch', function (e) {
                let value = $(this).val().toLowerCase();
                localStorage.setItem('filter_search', value)

                clearTimeout(filterTimeout);
                filterTimeout = setTimeout(function () {
                    filterCategories(value)
                }, 700)
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

                        if (response.url) {
                            history.pushState({}, '', response.url)
                            const responseUrl = new URL(response.url),
                                searchParams = new URLSearchParams(responseUrl.search),
                                categoriesLoadUrl = new URL($('#filterAccordionItemsContainer').data('load-url'));

                            categoriesLoadUrl.search = searchParams.toString();

                            $('#filterAccordionItemsContainer').data('load-url', categoriesLoadUrl.toString())
                        }
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

            $(document).on('click', '.accordion__trigger', function () {
                saveAccordionStatus()
            });

        })

        function saveAccordionStatus() {
            let data = {};
            $('.accordion__panel:has(.accordion__trigger)').each(function (i, item) {
                const $panel = $(item),
                    $content = $panel.find('.accordion__content');

                data[$panel.data('id')] = $content.attr('aria-hidden') !== 'true';
            });

            localStorage.setItem(`accordion__panel_expanded_statuses`, JSON.stringify(data))
        }

        function filterCategories(value) {
            value = value.toLowerCase();

            const $filterAccordionItemsContainer = $('#filterAccordionItemsContainer'),
                searchUrl = new URL($filterAccordionItemsContainer.data('search-url')),
                searchParams = new URLSearchParams(searchUrl.search);

            searchParams.set('q', value);
            searchUrl.search = searchParams.toString();

            const url = value.length > 0
                    ? searchUrl.toString()
                    : $filterAccordionItemsContainer.data('load-url'),
                $filterSpinner = $('#spinner').clone();

            $filterAccordionItemsContainer.prepend($filterSpinner.show())

            $filterAccordionItemsContainer.load(url, () => $filterSpinner.hide())

            // document.getElementById('filterForm').querySelectorAll('span.name-text').forEach(function (item, i) {
            //     item.innerHTML = item.textContent
            // })
            //
            // $('div.accordion__panel.sub-category').each(function (i, el) {
            //     console.log(2, el)
            //     let title = $(el).find('label');
            //     if (title.length > 0) {
            //         if (title.text().toLowerCase().indexOf(value) === -1) {
            //             $(el).hide();
            //         } else {
            //             $(el).show();
            //             el.querySelector('span.name-text').innerHTML = el.querySelector('span.name-text').innerHTML.replace(value, `<span style="background-color: yellow;color: black">${value}</span>`)
            //         }
            //     }
            // })
            //
            // $('.accordion__content[aria-hidden="true"]:has(div.sub-category:visible)')
            //     .each(function (i, item) {
            //         const $parent = $(item).parent('.accordion__panel')
            //
            //         $(item).attr('aria-hidden', false);
            //         $parent.find('.accordion__trigger')
            //             .attr('aria-expanded', true)
            //     })
            //
            // if (value.length < 1) {
            //     $('.accordion__content[aria-hidden="false"]')
            //         .each(function (i, item) {
            //             const $parent = $(item).parent('.accordion__panel')
            //
            //             if (!$parent.find('.accordion__header input')[0].checked) {
            //                 $(item).attr('aria-hidden', true);
            //                 $parent.find('.accordion__trigger')
            //                     .attr('aria-expanded', false)
            //             }
            //         })
            // }
            //
            // saveAccordionStatus();
        }

    </script>
@endpush
