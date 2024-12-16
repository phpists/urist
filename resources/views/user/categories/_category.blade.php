<div class="accordion__panel sub-category" data-id="{{ $category['id'] }}">
    <div class="accordion__header" id="accordion-header-{{ $category['id'] }}">
        <div class="checkbox accordion__checkbox">
            <input class="checkbox__input" id="accordion-checkbox-{{ $category['id'] }}" type="checkbox"
                   name="categories[]" data-modal-once="modal-tip-5"
                   value="{{ $category['id'] }}" @checked($category['checked'] ?? false)>
            <label class="checkbox__label" for="accordion-checkbox-{{ $category['id'] }}">
                @isset($category['sub_title'])
                    <strong class="red-color"><b>{{ $category['sub_title'] }}</b></strong>
                @endisset
                <span class="name-text">{!! get_highlighted_text($category['name'], $search ?? null) !!}</span>
            </label>
        </div>
        @if((isset($category['children_count']) && $category['children_count'] > 0) || (!empty($category['children']) && is_array($category['children'])))
            <button type="button" class="accordion__trigger"
                    aria-expanded="{{ isset($category['children']) ? 'true' : (isset($category['expanded']) && $category['expanded'] === true ? 'true' : 'false') }}" data-modal-once="modal-tip-4"
                    aria-controls="accordion-content-{{ $category['id'] }}"
                    @if(isset($category['children_count'])) data-load-url="{{ route('user.categories.index', ['type' => $type, 'articleCategory' => $category['id'], 'categories' => request('categories', [])]) }}" @endif>
                <svg class="accordion__icon" width="15" height="8">
                    <use xlink:href="{{ asset('img/sprite.svg#dropdown-arrow') }}"></use>
                </svg>
            </button>
        @endif
    </div>
    <div class="accordion__content" id="accordion-content-{{ $category['id'] }}" role="region"
         aria-labelledby="accordion-header-{{ $category['id'] }}"
         aria-hidden="{{ isset($category['children']) ? 'false' : (isset($category['expanded']) && $category['expanded'] === true ? 'false' : 'true') }}">
        @if(!empty($category['children']) && is_array($category['children']))
            @include('user.categories.index', ['categories' => $category['children']])
        @endif
    </div>
</div>
