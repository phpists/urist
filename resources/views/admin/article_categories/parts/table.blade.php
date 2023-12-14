@foreach($categories as $category)
    <li class="dd-item dd3-item" data-id="{{$category->id}}">
        <div class="dd-handle dd3-handle">Drag</div>
        <div class="dd3-content">
            <span>{{$category->name}}</span>
            <div>
                <form action="{{ route('admin.article_category.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
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
        @if(sizeof($category->subcategories) > 0)
            <ol class="dd-list">
                @foreach($category->subcategories->sortBy('position') as $subcategory)
                    <li class="dd-item dd3-item" data-id="{{$subcategory->id}}">
                        <div class="dd-handle dd3-handle">Drag</div>
                        <div class="dd3-content">
                            <span>{{$subcategory->name}}</span>
                            <div>
                                <form action="{{ route('admin.article_category.delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateArticleCategory"
                                       data-toggle="modal" data-target="#updateArticleCategoryModal"
                                       data-id="{{ $subcategory->id }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                    <input type="hidden" name="id" value="{{ $subcategory->id }}">
                                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                            onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $subcategory->title }}\'?')"
                                            title="Delete"><i class="las la-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if(sizeof($subcategory->children) > 0)
                            <ol class="dd-list">
                                @foreach($subcategory->children->sortBy('position') as $sub_2_category)
                                    @include('admin.article_categories.parts.subcategory', ['category' => $sub_2_category])
                                @endforeach
                            </ol>
                        @endif
                    </li>
                @endforeach
            </ol>
        @endif
    </li>
@endforeach
