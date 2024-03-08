@php($isMustBeExpanded = $filterService->isMustBeExpanded($category))

<div class="accordion__panel sub-category">
    <div class="accordion__header" id="accordion-header-{{ $category->id }}"
         style="padding-left: {{ $padding + 10 }}px">
        <div class="checkbox accordion__checkbox">
            <input class="checkbox__input" id="accordion-checkbox-{{ $category->id }}" type="checkbox"
                   name="categories[]"
                   value="{{ $category->id }}" @checked($filterService->isCategoryActive($category->id))>
            <label class="checkbox__label" for="accordion-checkbox-{{ $category->id }}">
                @if($category->sub_title)
                    <strong class="red-color"><b>{{ $category->sub_title }}</b></strong>
                @endif
                @if($iii == 1 || $iii == 2)
                    <b>{{ $category->name }}</b>
                @else
                    {{ $category->name }}
                @endif
            </label>
        </div>
        @if($category->children->isNotEmpty())
            <button type="button" class="accordion__trigger" aria-expanded="{{ $isMustBeExpanded ? 'true' : 'false' }}"
                    aria-controls="accordion-content-{{ $category->id }}">
                <svg class="accordion__icon" width="15" height="8">
                    <use xlink:href="{{ asset('img/sprite.svg#dropdown-arrow') }}"></use>
                </svg>
            </button>
        @endif
    </div>
    <div class="accordion__content" id="accordion-content-{{ $category->id }}" role="region"
         aria-labelledby="accordion-header-{{ $category->id }}"
         aria-hidden="{{ $isMustBeExpanded ? 'false' : 'true' }}">
        @if($category->children->isNotEmpty())
            <div class="accordion__inner">
                @foreach($category->children as $child)
                    @include('user.articles.filter.__category', ['category' => $child, 'padding' => $padding + 10, 'iii' => $iii + 1])
                @endforeach
            </div>
        @endif
    </div>
</div>
