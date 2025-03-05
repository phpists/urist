<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position', 'primary_color', 'secondary_color'];

    public $timestamps = false;

    public function styleColor(): Attribute
    {
        return Attribute::get(function() {
            if ($this->primary_color !== '#ffffff' && $this->secondary_color !== '#ffffff')
                return "background: linear-gradient(90deg, {$this->primary_color} 0%, {$this->secondary_color} 100%);";
            elseif ($this->primary_color !== '#ffffff')
                return "background: {$this->primary_color}";
            else
                return '';
        });
    }
}
