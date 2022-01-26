<?php

namespace App\Http\Controllers;

use App\Actions\Role\CreateRole;
use App\Actions\Role\UpdateRole;
use App\Http\Requests\RoleFormRequest;
use App\Models\SuperAdmin;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RolesController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userCan('role.view')) {
            return abort(403);
        }
        $roles = Role::SimplePaginate(10);
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('role.create')) {
            return abort(403);
        }
        $permissions = Permission::all();
        $permission_groups = SuperAdmin::getPermissionGroup();
        return view('backend.roles.create', compact('permissions', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        if (!userCan('role.create')) {
            return abort(403);
        }

        try {
            CreateRole::create($request);

            flashSuccess('Role Created Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if (!userCan('role.update')) {
            return abort(403);
        }

        $permissions = Permission::all();
        $permission_groups = SuperAdmin::getPermissionGroup();

        return view('backend.roles.edit', compact('permissions', 'permission_groups', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleFormRequest  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleFormRequest $request, Role $role)
    {
        if (!userCan('role.update')) {
            return abort(403);
        }

        try {
            UpdateRole::update($request, $role);

            flashSuccess('Role Updated Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (!userCan('role.delete')) {
            return abort(403);
        }

        if ($role->id == Role::first()->id) {
            flashError("You can't delete default role");
            return back();
        }

        try {
            if (!is_null($role)) {
                $role->delete();
            }

            flashSuccess('Role Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }
}
