<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'date',
        'total_price',
        'total_qty',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth()->id();
        });
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
