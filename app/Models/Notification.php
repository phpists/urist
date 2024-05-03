<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
    ];


    protected static function booted () {

        static::deleted(function(self $model) {
            \DB::table('user_notifications')->where('notification_id', $model->id)->delete();
        });

    }

    public function getPrettyCreatedAtAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }

}
