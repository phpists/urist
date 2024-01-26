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
        <th class="pr-0 text-center">
            Назва
        </th>
        <th class="pr-0 text-center">
            Хештеги
        </th>
        <th class="pr-0 text-center">
            Основна
        </th>
        <th class="pr-0 text-center">
            Дії
        </th>
    </tr>
    </thead>
    <tbody id="blog_table" class="blog_table">
        @foreach($blog as $item)
        <tr class="handle table-sortable-drag" data-value="{{$item->id}}">
            <td class="text-center pl-0">
                <span style="width: 20px;">
                    <label class="checkbox checkbox-single">
                        <input class="checkbox-item" type="checkbox" name="ids[]"
                               value="{{ $item->id }}">&nbsp;<span></span>
                    </label>
                </span>
            </td>
            <td class="pr-0 text-center">
                <a href="{{ route('admin.blog.edit', $item) }}">{{ $item->title }}</a>
            </td>
            <td class="pr-0 text-center">
                {{ implode(', ', $item->tags()->pluck('title')->toArray()) }}
            </td>
            <td class="pr-0 text-center">
                <span class="switch justify-content-center">
								<label>
									<input class="bool-updatable" type="checkbox" @checked($item->is_main) name="is_main" data-url="{{ route('admin.blog.update', $item) }}">
									<span></span>
								</label>
							</span>
            </td>
            <td class="justify-content-center pr-0 d-flex" id="row_{{ $item->id }}">
                <a href="{{ route('admin.blog.edit', $item) }}"
                   class="btn btn-sm btn-clean btn-icon">
                    <i class="las la-edit"></i>
                </a>
                <form action="{{ route('admin.blog.destroy', $item) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button
                       class="btn btn-sm btn-clean btn-icon"
                       onclick="return confirm('Ви впевнені, що хочете видалити запис?')">
                        <i class="las la-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $blog->links('vendor.pagination.product_pagination') }}
