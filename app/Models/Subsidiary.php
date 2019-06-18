<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    protected $fillable = [
        'name',
        'address',
        'built_at',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth_cache()->id;
        });
    }
}
