<table class="collection-table">
    <thead class="collection-table__thead">
    <tr>
        <th>Дата
            <div class="sort">
                <button class="sort__button filter-sort" data-value="created_at:asc" type="button" aria-label="Sort up">
                    <svg class="sort__icon" width="11" height="6">
                        <use xlink:href="{{ asset('img/sprite.svg#sort-up-arrow') }}"></use>
                    </svg>
                </button>
                <button class="sort__button filter-sort" data-value="created_at:desc" type="button" aria-label="Sort up">
                    <svg class="sort__icon" width="11" height="6">
                        <use xlink:href="{{ asset('img/sprite.svg#sort-down-arrow') }}"></use>
                    </svg>
                </button>
            </div>
        </th>
        <th>Назва статті</th>
        <th>Опис</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="collection-table__tbody">
    @foreach($articles as $article)
        <tr>
            <td>
                <time class="collection-table__date">
                    <a class="black-link" href="{{ route('user.articles.show', $article) }}">{{ $article->created_at }}</a>
                </time>
                <span class="collection-table__info">
                    <a class="black-link" href="{{ route('user.articles.show', $article) }}">ккс вс</a>
                </span>
            </td>
            <td>
                <h4 class="collection-table__title"><a class="black-link" href="{{ route('user.articles.show', $article) }}">{{ $article->name }}</a></h4>
                <a class="blue-link collection-table__link" href="{{ $article->court_decision_link }}" target="_blank">Посилання на рішення</a>
            </td>
            <td>
                <div class="collection-descr">
                    <a class="black-link collection-descr__text" href="{{ route('user.articles.show', $article) }}">
                        {!! $short = Str::words($article->content, 50, '') !!}
                        <div class="collection-descr__hidden">
                            {!! Str::substr($article->content, strlen($short)) !!}
                        </div>
                    </a>
                    <button class="collection-descr__more" type="button"><span>Читати детальніше</span>
                        <svg class="collection-descr__more-icon" width="8" height="4">
                            <use xlink:href="{{ asset('assets/img/user/sprite.svg#dropdown-arrow') }}"></use>
                        </svg>
                    </button>
                </div>
            </td>
            <td>
                <ul class="actions collection-table__actions">
                    <li class="actions__item">
                        <button class="button button--outline actions__button" type="button" aria-label="Copy" data-tooltip="Копіювати" onclick="copyText('{{ route('user.articles.show', $article) }}')">
                            <svg class="button__icon" width="22" height="22">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#copy') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button modal-self-completing" type="button" aria-label="Add to bookmarks" data-tooltip="В закладки" data-modal="modal-bookmark" data-json='@json(['criminal_article_id' => $article->id])' data-id="{{$article->id}}">
                            <svg class="button__icon" width="19" height="24">
                                <use xlink:href="{{ asset('img/sprite.svg#bookmark') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button modal-self-completing" type="button" aria-label="Add page" data-tooltip="Створити" data-modal="modal-file" data-json='@json(['criminal_article_id' => $article->id, 'name' => $article->name])'>
                            <svg class="button__icon" width="22" height="24">
                                <use xlink:href="{{ asset('assets/img/user/sprite.svg#create') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button" type="button" aria-label="Word" data-tooltip="Word">
                            <svg class="button__icon" width="18" height="21">
                                <use xlink:href="{{ asset('img/sprite.svg#word-simple') }}"></use>
                            </svg>
                        </button>
                    </li>
                    <li class="actions__item">
                        <button class="button button--outline actions__button" type="button" aria-label="Read more" data-tooltip="Перейти" onclick="location.href = '{{ route('user.articles.show', $article) }}'">
                            <svg class="button__icon" width="17" height="12">
                                <use xlink:href="{{ asset('img/sprite.svg#long-arrow-right') }}"></use>
                            </svg>
                        </button>
                    </li>
                </ul>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $articles->links('vendor.pagination.urist') !!}