<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'join_date',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiary_id');
    }
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_employee');
    }
}
