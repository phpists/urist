<?php

namespace App\Providers;


use App\Events\ArticleCategoryDeleted;
use App\Events\Registered;
use App\Events\UserLoggedInEvent;
use App\Events\UserSubscriptionExpired;
use App\Listeners\ProcessPostCategoryDelete;
use App\Events\UserRegisteredEvent;
use App\Events\UserSendResetPasswordCodeEvent;
use App\Listeners\User\CreateDefaultFoldersListener;
use App\Listeners\User\GrantFreeTrialAccess;
use App\Listeners\User\RemoveRole;
use App\Listeners\User\SendSubscriptionExpirationNotification;
use App\Listeners\UserSendVerifyCodeListener;
use App\Listeners\UserSendVerifyCodeResetPasswordListener;
use App\Models\ArticleCategory;
use App\Observers\ArticleCategoryObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            CreateDefaultFoldersListener::class,
            GrantFreeTrialAccess::class
//            SendEmailVerificationNotification::class,
        ],
        ArticleCategoryDeleted::class => [
            ProcessPostCategoryDelete::class
        ],
        UserRegisteredEvent::class => [
            UserSendVerifyCodeListener::class
        ],
        UserSendResetPasswordCodeEvent::class => [
            UserSendVerifyCodeResetPasswordListener::class
        ],
        UserSubscriptionExpired::class => [
            RemoveRole::class,
            SendSubscriptionExpirationNotification::class
        ],
        UserLoggedInEvent::class => [
            GrantFreeTrialAccess::class,
        ],

        // Socialite
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Apple\AppleExtendSocialite::class.'@handle',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        ArticleCategory::observe(ArticleCategoryObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
