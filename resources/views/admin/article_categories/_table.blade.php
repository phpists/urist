<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                ID
            </th>
            <th class="pr-0 text-center">
                Категорія
            </th>
        </tr>
        </thead>
        <tbody class="faq-table">
        @foreach($article_categories as $article_category)
            <tr>
                <td class="handle text-center pl-0" style="cursor: pointer">
                    {{ $article_category->id }}
                </td>
                <td class="text-center pl-0">
                    {{ $article_category->name }}
                </td>
                <td class="text-center pr-0">
                    <form action="{{ route('admin.article_category.delete') }}" method="POST">
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateArticleCategory"
                           data-toggle="modal" data-target="#updateArticleCategoryModal"
                           data-id="{{ $article_category->id }}">
                            <i class="las la-edit"></i>
                        </a>
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
