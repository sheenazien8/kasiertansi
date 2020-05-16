<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name',
        'package',
        'photo',
        'address',
        'join_date',
        'end_date',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
