@foreach($categories->sortBy('position') as $category)
    @php($hasChilds = sizeof($category->subcategories) > 0)
    <li class="dd-item dd3-item" data-id="{{$category->id}}" data-show-more-url="{{ route('admin.article_categories.show_childs', $category) }}">
        <div class="dd-handle dd3-handle">Drag</div>
        <div class="dd3-content accordion accordion-toggle-arrow" id="accordion_{{ $category->id }}">

            <div class="w-100 d-flex justify-content-between">
            <span style="margin-top: 5px">
                <button data-toggle="collapse" data-target="#collapse_{{ $category->id }}" class="btn btn-sm btn-clean btn-icon"><i class="las la-chevron-down"></i></button>
                <b>{{ $category->sub_title }}</b>
                {{$category->name}}</span>
            <div>
                <form action="{{ route('admin.article_category.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-sm btn-clean btn-icon create_category_inside" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-toggle="modal" data-target="#createArticleCategoryModal"><i class="las la-plus"></i></button>
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateArticleCategory"
                       data-toggle="modal" data-target="#updateArticleCategoryModal"
                       data-id="{{ $category->id }}">
                        <i class="las la-edit"></i>
                    </a>
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                            onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $category->title }}\'?')"
                            title="Delete"><i class="las la-trash"></i>
                    </button>
                </form>
            </div>
            </div>
            <div id="collapse_{{ $category->id }}" class="collapse" data-parent="#accordion_{{ $category->id }}">
                <div class="card">
                    <div class="card-header p-2">
                        <button class="add-article-btn btn btn-sm btn-light-success" data-toggle="modal" data-target="#addCriminalArticleModal" data-id="{{ $category->id }}">Додати статтю</button>
                    </div>
                <div class="card-body p-1 droppable" data-id="{{ $category->id }}" style="min-height: 50px">
                    @include('admin.article_categories.parts.category-articles')
                </div>
                </div>
            </div>
        </div>
        @if($hasChilds)
            <ol class="dd-list">
            </ol>
        @endif
    </li>
@endforeach
