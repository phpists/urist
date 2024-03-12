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
        <tr>
            <td>
                <time class="collection-table__date">
                    <a class="black-link" href="{{ route('user.articles.show', $article) }}">{{ $article->pretty_date }}</a>
                </time>
                <span class="collection-table__info">
                    <a class="black-link" href="{{ route('user.articles.show', $article) }}">{{ $article->getTagsString() }}</a>
                </span>
            </td>
            <td>
                <h4 class="collection-table__title"><a class="black-link" href="{{ route('user.articles.show', $article) }}">{{ $article->name }}</a></h4>
                @if($article->court_decision_link)
                <a class="blue-link collection-table__link" href="{{ $article->court_decision_link }}" target="_blank">Посилання на рішення</a>
                @endif
            </td>
            <td>
                <div class="collection-descr default">
                    <a class="black-link collection-descr__text" href="{{ route('user.articles.show', $article) }}" style="display:block;">
                        <p style="display: inline;">{!! $short = str_replace("\r\n", '<br>', truncate_by_words($article->getDescriptionWithHighlightedWord(request('search')), 370)) !!}</p>
                        <div class="collection-descr__hidden">
                            {!! str_replace("\r\n", '<br>', Str::substr($article->getDescriptionWithHighlightedWord(request('search')), mb_strlen($short) - 3)) !!}
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
                    <a class="black-link collection-descr__text" href="{{ route('user.articles.show', $article) }}" style="display:block;">
                        <p style="display: inline;">{!! $short = str_replace("\r\n", '<br>', truncate_by_words($article->getDescriptionWithHighlightedWord(request('search')), 700)) !!}</p>
                        <div class="collection-descr__hidden">
                            {!! str_replace("\r\n", '<br>', Str::substr($article->getDescriptionWithHighlightedWord(request('search')), mb_strlen($short) - 3)) !!}
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

{!! $articles->onEachSide(1)->links('vendor.pagination.urist') !!}
@else
    <h3>Немає результатів</h3>
@endif
