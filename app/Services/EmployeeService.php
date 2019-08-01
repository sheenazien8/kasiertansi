<?php
namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;

class EmployeeService
{
    public function getTotalEmployee()
    {
        $carbon = Carbon::now();
        $employees = Employee::select('id')->where('owner_id', auth_cache()->userable->id)
                                ->get()->count();

        return $employees;
    }
}
