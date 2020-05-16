<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'payment_method',
        'status',
        'note',
        'invoice_number',
        'rekening_number',
        'purchase_date'
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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchasingDetails()
    {
        return $this->hasMany(PurchasingDetail::class);
    }

    public function spending()
    {
        return $this->hasOne(Spending::class)->orderBy('id', 'desc');
    }
}
