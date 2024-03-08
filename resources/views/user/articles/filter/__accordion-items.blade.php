@foreach($filterService->getCategories() as $category)
    @if($category->children->isNotEmpty())
        <div class="accordion__inner">
            @foreach($category->children as $child)
                @include('user.articles.filter.__category', ['category' => $child, 'padding' => 0, 'iii' => 1])
            @endforeach
        </div>
    @endif
@endforeach
