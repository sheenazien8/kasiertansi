<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice_number',
        'user_id',
        'purchase_date',
        'paying',
        'change',
        'total_price',
        'total_profit',
        'total_qty',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->user_id = auth_cache()->id;
            $query->purchase_date = date('Y-m-d');
        });
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function income()
    {
        return $this->hasOne(Income::class);
    }
}
