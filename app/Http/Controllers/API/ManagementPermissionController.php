<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ManagementPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('user_id', auth_cache()->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);

        return response()->json($roles);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->json()->add([
            'display_name' => ucwords($request->json('name'))
        ]);
        $role = new Role();
        $role->fill($request->json()->all());
        $role->save();

        return $role;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->json()->add([
            'display_name' => ucwords($request->name)
        ]);
        $role->fill($request->json()->all());
        $role->permissions()->sync(Arr::pluck($request->json('permissions'), 'id'));
        $role->employees()->sync(Arr::pluck($request->json('employees'), 'id'));
        $role->save();

        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return 'Success';
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function getUserWhereRole(Role $role)
    {
        return response()->json($role->employees->load('user'));
    }
    /**
     * Get the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public static function getRoleName(Role $role)
    {
        return response()->json([
            'name' => $role->name,
            'permissions' => $role->permissions,
            'employees' => $role->employees
        ]);
    }
    /**
     * Get the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getEmployee()
    {
        $employees = Employee::select('id', 'name')
                            ->where('owner_id', auth_cache()->userable->id)
                            ->whereDoesntHave('roles')
                            ->get();

        return response()->json($employees);
    }
    /**
     * Get the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getPermission()
    {
        $permissions = Permission::select('id', 'display_name')->get();

        return response()->json($permissions);
    }
}
