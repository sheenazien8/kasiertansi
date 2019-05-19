<?php

namespace App\Models;

use App\UserIdValueDefault;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['unit'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth_cache()->id;
        });
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
