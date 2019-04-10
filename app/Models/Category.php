<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth()->id();
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
