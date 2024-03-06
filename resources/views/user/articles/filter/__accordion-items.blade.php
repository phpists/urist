@foreach($filterService->getCategories() as $category)
    <div class="accordion__panel">
        <div class="accordion__header" id="accordion-header-{{ $category->id }}">
            <h3 class="accordion__title">{{ $category->name }}</h3>
            @if($category->children->isNotEmpty())
                <button type="button" class="accordion__trigger" aria-expanded="{{ request()->has('categories') ? 'true' : 'false' }}" aria-controls="accordion-content-{{ $category->id }}">
                    <svg class="accordion__icon" width="15" height="8">
                        <use xlink:href="{{ asset('img/sprite.svg#dropdown-arrow') }}"></use>
                    </svg>
                </button>
            @endif
        </div>
        <div class="accordion__content" id="accordion-content-{{ $category->id }}" role="region" aria-labelledby="accordion-header-{{ $category->id }}" aria-hidden="{{ request()->has('categories') ? 'false' : 'true' }}">
            @if($category->children->isNotEmpty())
                <div class="accordion__inner">
                    @foreach($category->children as $child)
                        @include('user.articles.filter.__category', ['category' => $child, 'padding' => 15])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endforeach
