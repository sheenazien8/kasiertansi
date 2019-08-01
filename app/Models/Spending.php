<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    protected $fillable = [
        'date',
        'total_qty',
        'total_price',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth_cache()->id;
        });
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
