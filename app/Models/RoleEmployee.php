<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleEmployee extends Pivot
{
    protected $table = 'role_employee';
    protected $fillable = [
        'role_id',
        'employee_id'
    ];
}
