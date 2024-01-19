@if ($paginator->hasPages())
    <nav class="pagenav collection-section__pagenav" aria-label="Page navigation">
        <ul class="pagenav__list">
            <li class="pagenav__item">
                <a class="pagenav__arrow" href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}" aria-label="Previous">
                    <svg class="pagenav__icon" width="7" height="14">
                        <use xlink:href="{{ asset('img/sprite.svg#arrow-left') }}"></use>
                    </svg>
                </a>
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagenav__item"><span>...</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if($page == $paginator->currentPage())
                            <li class="pagenav__item is-active" aria-current="page"><a class="pagenav__link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="pagenav__item"><a class="pagenav__link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            <li class="pagenav__item">
                <a class="pagenav__arrow" href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}" aria-label="Next">
                    <svg class="pagenav__icon" width="7" height="14">
                        <use xlink:href="{{ asset('img/sprite.svg#arrow-right') }}"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
@endif
