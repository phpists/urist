<div class="accordion__panel sub-category">
    <div class="accordion__header" id="accordion-header-{{ $category->id }}">
        <div class="checkbox accordion__checkbox">
            <input class="checkbox__input" id="accordion-checkbox-{{ $category->id }}" type="checkbox" name="categories[]" value="{{ $category->id }}" @checked($filterService->isCategoryActive($category->id))>
            <label class="checkbox__label" for="accordion-checkbox-{{ $category->id }}">
                @if($category->sub_title)
                    <span class="blue-color"><b>{{ $category->sub_title }}</b></span>
                @endif
                {{ $category->name }}
            </label>
        </div>
        @if($category->children->isNotEmpty())
        <button type="button" class="accordion__trigger" aria-expanded="{{ $filterService->isMustBeExpanded($category) ? 'true' : 'false' }}" aria-controls="accordion-content-{{ $category->id }}">
            <svg class="accordion__icon" width="15" height="8">
                <use xlink:href="{{ asset('img/sprite.svg#dropdown-arrow') }}"></use>
            </svg>
        </button>
        @endif
    </div>
    <div class="accordion__content" id="accordion-content-{{ $category->id }}" role="region" aria-labelledby="accordion-header-{{ $category->id }}" aria-hidden="{{ $filterService->isMustBeExpanded($category) ? 'false' : 'true' }}">
        @if($category->children->isNotEmpty())
        <div class="accordion__inner">
            @foreach($category->children as $child)
                @include('user.articles.filter.__category', ['category' => $child])
            @endforeach
        </div>
        @endif
    </div>
</div>
