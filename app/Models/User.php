<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\FolderType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'birth_date',
        'city',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'google_id',
        'apple_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_BASE = 'base';
    const ROLE_LITE = 'lite';


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @return HasMany
     */
    public function userPhoneVerifyCodes(): HasMany
    {
        return $this->hasMany(UserPhoneVerifyCode::class);
    }

     /**
     * @return HasMany
     */
    public function userResetPasswordVerifyCodes(): HasMany
    {
        return $this->hasMany(UserResetPasswordCode::class);
    }

    public function allFolders()
    {
        return $this->hasMany(Folder::class);
    }

    public function bookmarkFolders()
    {
        return $this->allFolders()
            ->whereFolderType(FolderType::FAVOURITES_FOLDER->value);
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Favourite::class);
    }

    public function fileFolders()
    {
        return $this->allFolders()
            ->whereFolderType(FolderType::FILE_FOLDER->value);
    }


    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }


    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    public function notifications()
    {
        return $this->hasManyThrough(
            Notification::class,
            UserNotification::class,
            'user_id',
            'id',
            'id',
            'notification_id'
        )->select(['notifications.*', 'user_notifications.is_read']);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    public function activeSubscription(): HasOne
    {
        return $this->subscription()->where(function ($query) {
            return $query->whereNull('subscriptions.cancelled_at')
                ->orWhere(function ($query) {
                    return $query->whereNotNull('subscriptions.cancelled_at')
                        ->where('expires_at', '>', Carbon::now());
                });
        });
    }

    public function pendingSubscription(): HasOne
    {
        return $this->activeSubscription()->latest();
    }

    public function hadSubscription(): bool
    {
        return $this->subscription()->exists();
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('user_notifications.is_read', 0);
    }

    public function latestNotifications()
    {
        return $this->notifications()->latest()->limit(5);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isSuperAdmin(): bool
    {
        return $this->id == 1 || $this->id == 2;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ($this->last_name ? ' ' . $this->last_name : '');
    }

}
