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
                Тег
            </th>
            <th class="pr-0 text-center">
                Дії
            </th>
        </tr>
        </thead>
        <tbody id="tags-table">
        @foreach($tags as $tag)
            <tr class="handle table-sortable-drag" data-value="{{$tag->id}}">
                <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $tag->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
                </td>
                <td class="handle text-center pl-0" style="cursor: pointer">
                    {{ $tag->id }}
                </td>
                <td class="text-center pl-0">
                    {{ $tag?->name }}
                </td>
                <td class="text-center pr-0">
                    <form action="{{ route('admin.tag.delete') }}" method="POST">
                        <a class="btn btn-icon btn-clean btn-sm">
                            <i class="flaticon2-resize"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon updateTag"
                           data-toggle="modal" data-target="#updateArticleCategoryModal"
                           data-id="{{ $tag->id }}">
                            <i class="las la-edit"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $tag->id }}">
                        <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                onclick="return confirm('Ви впевнені, що хочете видалити хештег \'{{ $tag->title }}\'?')"
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
{{ $tags->links('vendor.pagination.super_admin_pagination') }}
