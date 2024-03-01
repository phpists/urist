<div class="modal modal--bg-none" id="modal-notifications">
    <div class="modal__inner">
        <div class="modal__window">
            <button class="modal__close" aria-label="Close modal" data-modal-close="data-modal-close" type="button">
                <svg class="modal__close-icon" width="23" height="22">
                    <use xlink:href="{{asset('assets/img/user/sprite.svg#close-modal')}}"></use>
                </svg>
            </button>
            <ul class="modal__notifications" id="mobileNotificationsContainer" data-read-url="{{ route('user.notifications.bulk-mark-as-read') }}">
                @foreach($notificationService->getLatest() as $userNotification)
                    <li class="modal__notifications-item" data-id="{{ $userNotification->id }}">
                        <div class="notification-card">
                            <time class="notification-card__date">{{ $userNotification->pretty_created_at }}</time>
                            <div class="notification-card__info">
                                <h3 class="notification-card__title">{{ $userNotification->title }}</h3>
                                @if($userNotification->url)
                                <a class="button button--outline notification-card__more" href="{{ $userNotification->url }}" target="_blank">
                                    <svg class="button__icon" width="17" height="12">
                                        <use xlink:href="{{asset('assets/img/user/sprite.svg#long-arrow-right')}}"></use>
                                    </svg></a>
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
