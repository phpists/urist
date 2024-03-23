<div class="accordion__inner">
    @foreach($filterService->getCategories() as $mainCategory)
        @if($mainCategory->children->isNotEmpty())
            @foreach($mainCategory->children as $category)
                @include('user.articles.filter.__category', ['padding' => 0, 'iii' => 1])
            @endforeach
        @endif
    @endforeach
</div>
