<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Role\Entities\Permission;
use Modules\Role\Entities\Role;

class RoleController extends BasicController
{
    public function index(Request $request)
    {
        $Roles = Role::get();

        return view('role::roles.index', compact('Roles'));
    }

    public function create()
    {
        $Permissions = Permission::get();

        return view('role::roles.create', compact('Permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->title_en,
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
        ]);
        if ($request->permissions && count($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Role = Role::where('id', $id)->firstorfail();

        return view('role::roles.show', compact('Role'));
    }

    public function edit($id)
    {
        $Permissions = Permission::get();
        $RolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();
        $Role = Role::where('id', $id)->firstorfail();

        return view('role::roles.edit', compact('Role', 'Permissions', 'RolePermissions'));
    }

    public function update(Request $request, $id)
    {
        Role::find($id)->update([
            'name' => $request->title_en,
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
        ]);
        $role = Role::find($id);
        $role->syncPermissions($request->permissions);
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Role = Role::where('id', $id)->delete();
    }
}
