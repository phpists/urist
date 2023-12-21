<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                                    <span style="width: 20px;">
                                        <label class="checkbox checkbox-single checkbox-all">
                                            <input id="checkbox-all" type="checkbox"
                                                   name="checkbox[]">&nbsp;<span></span>
                                        </label>
                                    </span>
            </th>
            <th class="pl-0 text-center">
                ID
            </th>
            <th class="pr-0 text-center">
                Категорія
            </th>
            <th class="pr-0 text-center">
                Дії
            </th>
        </tr>
        </thead>
        <tbody id="articleCategoriesTable">
        @foreach($article_categories as $article_category)
            <tr class="handle table-sortable-drag" data-value="{{$article_category->id}}">
                <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $article_category->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                </td>
                <td class="text-center pl-0" style="cursor: pointer">
                    {{ $article_category->id }}
                </td>
                <td class="text-center pl-0">
                    {{ $article_category?->name }}
                </td>
                <td class="justify-content-center pr-0 d-flex" id="row_{{ $article_category->id }}">
                    <a class="btn btn-icon btn-clean btn-sm">
                        <i class="flaticon2-resize"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateArticleCategory"
                       data-toggle="modal" data-target="#updateArticleCategoryModal"
                       data-id="{{ $article_category->id }}">
                        <i class="las la-edit"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateStatusBtn"
                       data-id="{{ $article_category->id }}" data-value="{{$article_category->is_active}}">
                        @if($article_category->is_active)
                            <i class="la la-eye"></i>
                        @else
                            <i class="la la-eye-slash"></i>
                        @endif
                    </a>
                    <form action="{{ route('admin.article_category.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $article_category->id }}">
                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $article_category->title }}\'?')"
                                title="Delete"><i class="las la-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->
{{--{{ $article_categories->links('vendor.pagination.super_admin_pagination') }}--}}
