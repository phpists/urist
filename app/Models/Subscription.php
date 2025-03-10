<?php

namespace App\Models;

use App\Models\Plan\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{

    const SOURCE_WEB = 'web';
    const SOURCE_MOBILE = 'mobile';
    const SOURCE_MOBILE_IOS = 'mobile.ios';
    const SOURCE_MOBILE_ANDROID = 'mobile.android';

    const PROVIDER_LIQPAY = 'liqpay';
    const PROVIDER_REVENUECAT = 'revenuecat';


    protected $fillable = [
        'user_id',
        'subscription_session_id',
        'plan_id',
        'period',
        'price',
        'expires_at',
        'cancelled_at',
        'provider',
        'source',
    ];

    protected $casts = [
        'expires_at' => 'date',
        'cancelled_at' => 'timestamp'
    ];


    function session(): BelongsTo
    {
        return $this->belongsTo(SubscriptionSession::class, 'subscription_session_id');
    }

    function payments(): HasMany
    {
        return $this->hasMany(SubscriptionPayment::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }


    function isCancelled(): bool
    {
        return $this->cancelled_at !== null;
    }

    public function scopeActive($query)
    {
        $query->where('subscriptions.expires_at', '>', Carbon::now());
    }

}
