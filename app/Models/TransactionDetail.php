<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'qty',
        'price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getTotalPriceAttribut()
    {
        return $this->sum('price');
    }
}
