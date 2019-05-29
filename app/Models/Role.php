<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            // $query->user_id = auth_cache()->id;
        });
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'role_employee');
    }
}
