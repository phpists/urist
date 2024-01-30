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

    public function getPrettyCreatedAtAttribute()
    {
        return $this->created_at->format('H:i d.m.Y');
    }

}
