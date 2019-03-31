<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasingDetail extends Model
{
    protected $fillable = [
        'purchase_id',
        'item_id',
        'qty',
        'total_price'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth()->id();
        });
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
