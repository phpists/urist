@if($articles->isNotEmpty())
    <table class="collection-table">
        <thead class="collection-table__thead">
        <tr>
            <th>
                <span>Дата</span>
                <div class="sort">
                    <button class="sort__button filter-sort" data-value="date:asc" type="button" aria-label="Sort up">
                        <svg class="sort__icon" width="16" height="12">
                            <use xlink:href="{{ asset('img/sprite.svg#sort-up-arrow') }}"></use>
                        </svg>
                    </button>
                    <button class="sort__button filter-sort" data-value="date:desc" type="button" aria-label="Sort up">
                        <svg class="sort__icon" width="16" height="12">
                            <use xlink:href="{{ asset('img/sprite.svg#sort-down-arrow') }}"></use>
                        </svg>
                    </button>
                </div>
            </th>
            <th>Назва ПП</th>
            <th>ПП</th>
        </tr>
        </thead>
        <tbody class="collection-table__tbody">
        @foreach($articles as $article)
            @php($url = can_user(\App\Enums\PermissionEnum::LEGAL_BASE->value) ? route('user.articles.show', $article) : '#')
            <tr>
                <td>
                    <time class="collection-table__date">
                        <a class="black-link" href="{{ $url }}">{{ $article->pretty_date }}</a>
                    </time>
                    <span class="collection-table__info">
                        <a class="black-link" href="{{ $url }}">{{ $article->getTagsString() }}</a>
                    </span>
                    <ul class="actions actions--center collection-table__actions">
                        <li class="actions__item">
                            <button class="button button--xs button--outline modal-self-completing" type="button"
                                    aria-label="В закладки" data-tooltip="В закладки" data-modal="modal-bookmark"
                                    data-json='@json(['criminal_article_id' => $article->id])'>
                                <svg class="button__icon" width="14" height="14">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#bookmark') }}"></use>
                                </svg>
                            </button>
                        </li>
                        <li class="actions__item">
                            <button class="button button--xs button--outline" type="button" aria-label="Експорт файлу"
                                    onclick="window.location.href = '{{ route('user.articles.export-doc', $article) }}'"
                                    data-tooltip="Екпорт файлу">
                                <svg class="button__icon" width="14" height="14">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#download') }}"></use>
                                </svg>
                            </button>
                        </li>
                        <li class="actions__item">
                            <button class="button button--xs button--outline modal-self-completing" type="button" aria-label="Поділитися" data-modal="modal-social"
                                    data-tooltip="Поділитися" data-json='@json(['share_url' => $url, 'share_text' => htmlentities($article->name)])'>
                                <svg class="button__icon" width="14" height="14">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#share') }}"></use>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </td>
                <td>
                    <h4 class="collection-table__title">
                        <a class="black-link" href="{{ $url }}">{!! $article->getSearchHighlightedName() !!}</a></h4>
                    <div class="collection-table__link-group">
                    @if($article->court_decision_link)
                        <a class="blue-link collection-table__link" href="{{ $article->court_decision_link }}"
                           target="_blank">Посилання на рішення</a>
                    @endif
                        <button class="button button--outline button--xs" type="button" aria-label="Copy" data-tooltip="Копіювати"
                                onclick="copyText('{{ $article->court_decision_link }}')">
                            <svg class="button__icon" width="14" height="14">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#copy') }}"></use>
                            </svg>
                        </button>
                    </div>
                </td>
                <td>
                    <div class="collection-descr default">
                        <a class="black-link collection-descr__text" href="{{ $url }}" style="display:block;">
                            <p style="display: inline;">{!! $short = str_replace("\r\n", '<br>', truncate_by_words($article->getSearchHighlightedDescription(), 370)) !!}</p>
                            <div class="collection-descr__hidden">
                                {!! str_replace("\r\n", '<br>', Str::substr($article->getSearchHighlightedDescription(), mb_strlen($short) - 3)) !!}
                            </div>
                        </a>
                        @if(strlen($short) < strlen($article->description))
                            <button class="collection-descr__more" type="button"><span>Читати детальніше</span>
                                <svg class="collection-descr__more-icon" width="8" height="4">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#dropdown-arrow') }}"></use>
                                </svg>
                            </button>
                        @endif
                    </div>
                    <div class="collection-descr more-width">
                        <a class="black-link collection-descr__text" href="{{ $url }}" style="display:block;">
                            <p style="display: inline;">{!! $short = str_replace("\r\n", '<br>', truncate_by_words($article->getSearchHighlightedDescription(), 700)) !!}</p>
                            <div class="collection-descr__hidden">
                                {!! str_replace("\r\n", '<br>', Str::substr($article->getSearchHighlightedDescription(), mb_strlen($short) - 3)) !!}
                            </div>
                        </a>
                        @if(strlen($short) < strlen($article->description))
                            <button class="collection-descr__more" type="button"><span>Читати детальніше</span>
                                <svg class="collection-descr__more-icon" width="8" height="4">
                                    <use xlink:href="{{ asset('assets/img/user/sprite.svg#dropdown-arrow') }}"></use>
                                </svg>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $articles->onEachSide(6)->links('vendor.pagination.urist') !!}
@else
    <h3>Немає результатів</h3>
@endif
