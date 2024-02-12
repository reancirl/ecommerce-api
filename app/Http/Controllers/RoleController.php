<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => request('name'),
            'guard_name' => 'web',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $role,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name' => request('name'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $role,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
        ]);
    }

    /**
     * Assign permissions to a role.
     */
    public function assignPermissions(Request $request, Role $role)
    {
        $permissions = $request->permissions ?? [];

        $role->syncPermissions($permissions);

        return response()->json([
            'status' => 'success',
            'message' => 'Permissions assigned successfully.',
            'data' => $role->permissions,
        ]);
    }

    /**
     * Get all permissions.
     */
    public function getAllPermissions()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'permissions' => Permission::all('name'),
        ]);
    }
}
