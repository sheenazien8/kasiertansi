<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'date',
        'total_qty',
        'total_pric,e',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
