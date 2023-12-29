@foreach($categories as $category)
    <div class="accordion__panel">
        <h3 class="accordion__header" id="accordion-header-1">
            <button class="accordion__trigger" @if(sizeof($category->children) > 0) aria-expanded="{{(isset($category->parent_id) || (sizeof($category->articles) > 0))? 'true': 'false'}}" aria-controls="accordion-content-{{$category->id}}" @endif>{{$category->name}}
                @if(sizeof($category->children) > 0)
                    <svg class="accordion__icon" width="19" height="10">
                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                    </svg>
                @endif
            </button>
        </h3>
        @if((sizeof($category->children) > 0) || (sizeof($category->articles) > 0))
            <div class="accordion__content" id="accordion-content-{{$category->id}}" role="region" aria-labelledby="accordion-header-{{$category->id}}" aria-hidden="{{(isset($category->parent_id) || (sizeof($category->articles) > 0))? 'false': 'true'}}">
                <div class="accordion__inner">
                    @if(sizeof($category->articles) > 0)
                        <table class="collection-table">
                            <thead class="collection-table__thead">
                            <tr>
                                <th>Дата</th>
                                <th>Назва статті</th>
                                <th>Опис</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="collection-table__tbody">
                                @foreach($category->articles as $article)
                                    <tr>
                                        <td>
                                            <time class="collection-table__date">{{$article->created_at}}</time><span class="collection-table__info">ккс вс</span>
                                        </td>
                                        <td>
                                            <h4 class="collection-table__title">{{$article->name}}</h4><a class="blue-link collection-table__link" href="#">Посилання на рішення</a>
                                        </td>
                                        <td>
                                            <div class="collection-descr">
                                                <div class="collection-descr__text">
                                                    <p>Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки... Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки...</p>
                                                    <div class="collection-descr__hidden">
                                                        <p>Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки... Онлайн-сервисы помогают пользователям решать самые разные задачи в интернете: проводить финансовые транзакции, совершать покупки...</p>
                                                    </div>
                                                </div>
                                                <button class="collection-descr__more" type="button"><span>Читати детальніше</span>
                                                    <svg class="collection-descr__more-icon" width="8" height="4">
                                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#dropdown-arrow')}}"></use>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="actions collection-table__actions">
                                                <li class="actions__item">
                                                    <button class="button button--outline actions__button" type="button" aria-label="Copy" data-tooltip="Копіювати">
                                                        <svg class="button__icon" width="22" height="22">
                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#copy')}}"></use>
                                                        </svg>
                                                    </button>
                                                </li>
                                                <li class="actions__item">
                                                    <button class="favouriteBtn button button--outline actions__button" type="button" aria-label="Add to bookmarks" data-id="{{$article->id}}" data-tooltip="В закладки" data-modal="modal-bookmark">
                                                        <svg class="button__icon" width="19" height="24">
                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#bookmark')}}"></use>
                                                        </svg>
                                                    </button>
                                                </li>
                                                <li class="actions__item">
                                                    <button class="button button--outline actions__button" type="button" aria-label="Add page" data-tooltip="Створити">
                                                        <svg class="button__icon" width="22" height="24">
                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#create')}}"></use>
                                                        </svg>
                                                    </button>
                                                </li>
                                                <li class="actions__item">
                                                    <button class="button button--outline actions__button" type="button" aria-label="Read more" data-tooltip="Перейти">
                                                        <svg class="button__icon" width="17" height="12">
                                                            <use xlink:href="{{asset('assets/img/user/sprite.svg#long-arrow-right')}}"></use>
                                                        </svg>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @include('layouts.partials.categories', ['categories' => $category->children])
                </div>
            </div>
            <div class="modal-wrap">
                @include('layouts.user_partials.modal-bookmark')
            </div>
        @endif
    </div>
@endforeach
