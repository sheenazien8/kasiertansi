<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'date',
        'total_price',
        'total_profit',
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
    public function getDayPriceAttribute()
    {
        $date = $this->date;
        return $this->where('date', $date)->sum('total_price');
    }
}
