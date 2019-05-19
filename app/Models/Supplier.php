<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'address',
        'contact',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth_cache()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pucrhases()
    {
        return $this->hasMany(Purchase::class);
    }
}
