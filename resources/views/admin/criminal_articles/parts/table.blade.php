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
            ID
        </th>
        <th class="pr-0 text-center">
            Назва
        </th>
        <th class="pr-0 text-center">
            Категорія
        </th>
        <th class="pr-0 text-center">
            Дії
        </th>
    </tr>
    </thead>
    <tbody id="criminal_articles_table" class="criminal_articles_table">
        @foreach($criminal_articles as $item)
        <tr class="handle table-sortable-drag" data-value="{{$item->id}}">
            <td class="text-center pl-0">
                                            <span style="width: 20px;">
                                                <label class="checkbox checkbox-single">
                                                    <input class="checkbox-item" type="checkbox" name="checkbox[]"
                                                           value="{{ $item->id }}">&nbsp;<span></span>
                                                </label>
                                            </span>
            </td>
            <td class="text-center pl-0">
                {{ $item->id }}
            </td>
            <td class="pr-0 text-center">
                <a href="{{ route('admin.criminal_article.edit', $item->id) }}">{{ $item->name }}</a>
            </td>
            <td class="pr-0 text-center">
                {{ $item->category?->name }}
            </td>
            <td class="justify-content-center pr-0 d-flex" id="row_{{ $item->id }}">
                <a class="btn btn-icon btn-clean btn-sm">
                    <i class="flaticon2-resize"></i>
                </a>
                <a data-value="{{$item->is_active}}" data-id="{{$item->id}}" class="btn btn-icon btn-clean btn-sm updateStatusBtn">
                    @if($item->is_active)
                        <i class="la la-eye"></i>
                    @else
                        <i class="la la-eye-slash"></i>
                    @endif
                </a>
                <a href="{{ route('admin.criminal_article.edit', $item->id) }}"
                   class="btn btn-sm btn-clean btn-icon">
                    <i class="las la-edit"></i>
                </a>
                <a data-value="{{ $item->id }}" href="javascript:;" class="btn btn-sm btn-clean btn-icon favouriteBtn"
                   data-toggle="modal"
                   data-target="#createFavouriteModal"
                   data-id="{{ $item->id }}">
                    <i class="far fa-star"></i>
                </a>
                <a data-value="{{ $item->id }}" href="javascript:;" class="btn btn-sm btn-clean btn-icon fileBtn"
                   data-toggle="modal"
                   data-target="#createFileModal"
                   data-id="{{ $item->id }}">
                    <i class="las la-file-export"></i>
                </a>
                <form action="{{ route('admin.criminal_article.delete', $item->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button
                       class="btn btn-sm btn-clean btn-icon"
                       onclick="return confirm('Вы уверенны, что хотите удалить данную запись?')">
                        <i class="las la-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
