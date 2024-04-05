<table class="table table-head-custom table-vertical-center">
    <thead>
    <tr>
        <th class="pr-0 text-center">
            ID
        </th>
        <th class="pr-0 text-center">
            Ім'я
        </th>
        <th class="pr-0 text-center">
            Email
        </th>
        <th class="pr-0 text-center">
            Телефон
        </th>
        <th class="pr-0 text-center">
            Дата народження
        </th>
        <th class="pr-0 text-center">
            Місто
        </th>
        <th class="pr-0 text-center">
            К-сть файлів
        </th>
        <th class="pr-0 text-center">
            Підписка
        </th>
        <th class="pr-0 text-center">
            Дії
        </th>
    </tr>
    </thead>
    <tbody id="blog_table" class="blog_table">
        @foreach($users as $user)
        <tr>
            <td class="pr-0 text-center">
                {{ $user->id }}
            </td>
            <td class="pr-0 text-center">
                {{ $user->full_name }}
            </td>
            <td class="pr-0 text-center">
                {{ $user->email }}
            </td>
            <td class="pr-0 text-center">
                {{ $user->phone }}
            </td>
            <td class="pr-0 text-center">
                {{ $user->birth_date }}
            </td>
            <td class="pr-0 text-center">
                {{ $user->city }}
            </td>
            <td class="pr-0 text-center">
                {{ $user->files()->count() }}
            </td>
            <td class="pr-0 text-center">
                {{ $user->activeSubscription ? __('subscription.'.$user->activeSubscription->period) . ' (' . $user->activeSubscription->expires_at->format('d.m.y') . ')' : '-' }}
            </td>
            <td class="justify-content-center pr-0 d-flex">
                <button type="button" title="Підписка" data-url="{{ route('admin.users.subscribe', $user) }}"
                        data-toggle="modal" data-target="#subscribeUser" class="btn btn-sm btn-clean btn-icon edit-btn">
                    <i class="las la-star"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $users->links('vendor.pagination.product_pagination') }}
