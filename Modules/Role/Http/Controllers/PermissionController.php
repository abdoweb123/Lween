<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Role\Entities\Permission;

class PermissionController extends BasicController
{
    public function index(Request $request)
    {
        $Permissions = Permission::get();

        return view('role::permissions.index', compact('Permissions'));
    }

    public function create()
    {
        return view('role::permissions.create');
    }

    public function store(Request $request)
    {
        Permission::create(['name' => $request->input('name').'-list', 'title_ar' => $request->input('name').' list', 'title_en' => $request->input('name').' list']);
        Permission::create(['name' => $request->input('name').'-create', 'title_ar' => $request->input('name').' create', 'title_en' => $request->input('name').' create']);
        Permission::create(['name' => $request->input('name').'-edit', 'title_ar' => $request->input('name').' edit', 'title_en' => $request->input('name').' edit']);
        Permission::create(['name' => $request->input('name').'-delete', 'title_ar' => $request->input('name').' delete', 'title_en' => $request->input('name').' delete']);
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Permission = Permission::where('id', $id)->firstorfail();

        return view('role::permissions.show', compact('Permission'));
    }

    public function edit($id)
    {
        $Permission = Permission::where('id', $id)->firstorfail();

        return view('role::permissions.edit', compact('Permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->title_ar = $request->input('title_ar');
        $permission->title_en = $request->input('title_en');
        $permission->save();
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Permission = Permission::where('id', $id)->delete();
    }
}
