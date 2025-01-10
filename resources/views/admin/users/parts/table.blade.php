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
            Період підписки
        </th>
        <th class="pr-0 text-center">
            Ціна підписки
        </th>
        <th class="pr-0 text-center">
            Стан підписки
        </th>
        <th class="pr-0 text-center">
            Джерело підписки
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
                {{ $user->activeSubscription
                    ? __('subscription.'.$user->activeSubscription->period)
                     . ' (' . ($user->activeSubscription->period == 'trial'
                                ? 'пробний період до '
                                : (is_null($user->activeSubscription->subscription_session_id) ? 'видана адміном до ' : ''))
                            . $user->activeSubscription->expires_at->format('d.m.y') . ($user->pendingSubscription && !is_null($user->pendingSubscription->subscription_session_id) ? ' | далі йде оплачена підписка' : '') . ')'
                    : '-' }}
            </td>
            <td class="pr-0 text-center">
                {{ $user->getSubscriptionPrice() }}
            </td>
            <td class="pr-0 text-center">
                @if($user->activeSubscription && $user->activeSubscription->cancelled_at)
                    <span class="label label-warning label-inline">Скасована</span>
                @elseif($user->activeSubscription)
                    <span class="label label-success label-inline">Активна</span>
                @else
                    <span class="label label-danger label-inline">Неактивна</span>
                @endif
            </td>
            <td class="pr-0 text-center">
                {{ $user->getSubscriptionSource() }}
            </td>
            <td class="justify-content-center pr-0 d-flex">
                @if(!$user->activeSubscription)
                    <button type="button" title="Підписка" data-url="{{ route('admin.users.subscribe', $user) }}"
                            data-toggle="modal" data-target="#subscribeUser"
                            class="btn btn-sm btn-clean btn-icon edit-btn">
                        <i class="las la-star"></i>
                    </button>
                @endif
                @if($user->activeSubscription && !str_contains($user->activeSubscription->source, 'mobile'))
                    <form method="POST" action="{{ route('admin.users.unsubscribe', $user) }}"
                          style="display: inline">
                        @csrf
                        <button type="submit" title="Анулювати підписку"
                                data-url="{{ route('admin.users.subscribe', $user) }}"
                                class="btn btn-sm btn-clean btn-icon edit-btn"
                                onclick="return confirm('Ви впевнені, що хочете анулювати підписку користувача?')">
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@if(method_exists($users, 'links'))
    {{ $users->links('vendor.pagination.product_pagination') }}
@endif
