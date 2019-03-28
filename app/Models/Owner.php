<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name',
        'join_date',
        'end_date',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
