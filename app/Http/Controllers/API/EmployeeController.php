<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Owner;
use App\Models\Role;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owner = auth()->user()->userable->id;
        $employees = Employee::where('owner_id', $owner)
                                ->orderBy('created_at','desc')
                                ->paginate(5);

        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        if (!$request->json('password')) {
            request()->json()->add([
                'password' => bcrypt(12345678)
            ]);
        }
        $role = Role::where('name', 'employee')->first();
        $user = new User();
        $owner = auth()->user()->userable;
        $employee = new Employee();
        $employee->fill($request->json()->all());
        $employee->owner()->associate($owner);
        $employee->save();
        $user->fill($request->json()->all());
        $user->userable()->associate($employee);
        $user->save();
        $user->attachRole($role);

        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee$employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee$employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return response()->json($employee->load('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\EmployeeRequest  $request
     * @param  \App\Models\Employee$employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        if (!$request->json('password')) {
            request()->json()->add([
                'password' => bcrypt(12345678)
            ]);
        }
        $user = $employee->user;
        $owner = auth()->user()->userable;
        $employee->fill($request->json()->all());
        $employee->owner()->associate($owner);
        $employee->save();
        $user->fill($request->json()->all());
        $user->userable()->associate($employee);
        $user->save();

        return 'Success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee$employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return 'Success';
    }
}
