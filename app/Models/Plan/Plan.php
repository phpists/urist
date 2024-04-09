<?php

namespace App\Models\Plan;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'pos',
        'title',
        'price_monthly',
        'price_semiannual',
        'price_annual',
    ];


    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function features()
    {
        return $this->hasManyThrough(
            Feature::class,
            PlanFeature::class,
            'plan_id',
            'id',
            'id',
            'feature_id'
        )
            ->orderBy('pos');
    }

    public function activeFeatures()
    {
        return $this->features()->active();
    }

    public function planFeatures()
    {
        return $this->hasMany(PlanFeature::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getSemiannualDiscountPercent(): int
    {
        return round((($this->price_monthly * 6) - $this->price_semiannual) / ($this->price_monthly * 6) * 100);
    }

    public function getAnnualDiscountPercent(): int
    {
        return round((($this->price_monthly * 12) - $this->price_annual) / ($this->price_monthly * 12) * 100);
    }

    public function getAnnualDiscountSum(): int
    {
        return round((($this->price_monthly * 12) - $this->price_annual));
    }

    public function getPriceByPeriod(string $period): string
    {
        return match ($period) {
            'month' => $this->price_monthly,
            'year' => $this->price_annual
        };
    }

    public function getPriceWithPeriodByPeriod(string $period): string
    {
        $periodTitle = match ($period) {
            'month' => 'місяць',
            'year' => 'рік'
        };

        return '$' . $this->getPriceByPeriod($period) . '/' . $periodTitle;
    }

}
