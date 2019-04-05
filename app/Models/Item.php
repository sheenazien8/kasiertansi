<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'code',
        'current_stock'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth()->id();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function purchasingDetails()
    {
        return $this->hasMany(PurchasingDetail::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class)->orderBy('id', 'desc');
    }

    public function price()
    {
        return $this->hasOne(Price::class)->orderBy('id', 'desc');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
