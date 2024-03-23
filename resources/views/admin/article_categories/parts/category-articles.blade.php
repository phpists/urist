@foreach($category->articles as $article)
    <div class="btn-group btn-group-sm mx-2 my-1 drag-element" data-category-id="{{ $category->id }}"
         data-url="{{ route('admin.criminal-article.update-category', $article) }}" data-id="{{ $article->id }}">
        <span class="btn bg-light-primary handle"><i class="fas fa-arrows-alt"></i></span>
        <button type="button" class="btn btn-light-primary showCategoryFullPath" data-url="{{ route('admin.criminal-article.show-full-name', $article) }}">{{ Str::limit($article->name, 30) }}</button>
        <button type="button" class="btn btn-light-primary delete-article-category" data-url="{{ route('admin.criminal-article.delete-category', $article) }}" data-category-id="{{ $category->id }}"><i class="fas fa-trash-alt"></i></button>
    </div>
@endforeach
