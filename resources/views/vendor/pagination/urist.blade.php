@if ($paginator->hasPages())
    <nav class="pagenav collection-section__pagenav" aria-label="Page navigation">
        <ul class="pagenav__list">
            @if(!$paginator->onFirstPage())
            <li class="pagenav__item">
                <a class="pagenav__arrow" href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}" aria-label="Previous">
                    <svg class="pagenav__icon" width="7" height="14">
                        <use xlink:href="{{ asset('img/sprite.svg#arrow-left') }}"></use>
                    </svg>
                </a>
            </li>
            @endif


                @if($paginator->currentPage() > 2)
                    @if(1 == $paginator->currentPage())
                        <li class="pagenav__item is-active" aria-current="page"><a class="pagenav__link" href="#">1</a></li>
                    @else
                        <li class="pagenav__item"><a class="pagenav__link" href="{{ $paginator->url(1) }}">1</a></li>
                    @endif
                @endif
                @if($paginator->currentPage() > 3)
                    <li class="pagenav__item"><span>...</span></li>
                @endif
                @foreach(range(1, $paginator->lastPage()) as $i)
                    @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
                        @if($i == $paginator->currentPage())
                            <li class="pagenav__item is-active" aria-current="page"><a class="pagenav__link" href="#">{{ $i }}</a></li>
                        @else
                            <li class="pagenav__item"><a class="pagenav__link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endif
                @endforeach
                @if($paginator->currentPage() < $paginator->lastPage() - 2)
                    <li class="pagenav__item"><span>...</span></li>
                @endif
                @if($paginator->currentPage() < $paginator->lastPage() - 1)
                    @if($paginator->lastPage() == $paginator->currentPage())
                        <li class="pagenav__item is-active" aria-current="page"><a class="pagenav__link" href="#">{{ $paginator->lastPage() }}</a></li>
                    @else
                        <li class="pagenav__item"><a class="pagenav__link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
                    @endif
                @endif

                @if(!$paginator->onLastPage())
            <li class="pagenav__item">
                <a class="pagenav__arrow" href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}" aria-label="Next">
                    <svg class="pagenav__icon" width="7" height="14">
                        <use xlink:href="{{ asset('img/sprite.svg#arrow-right') }}"></use>
                    </svg>
                </a>
            </li>
                @endif
        </ul>
    </nav>
@endif
