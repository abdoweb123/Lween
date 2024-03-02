<?php

namespace Modules\Device\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Device\Entities\Device;
use Modules\Device\Entities\Feature;

class FeatureController extends BasicController
{
    public function index(Device $Device, Request $request)
    {
        abort(404);
    }

    public function create(Device $Device)
    {
        return view('device::features.create', compact('Device'));
    }

    public function store(Device $Device, Request $request)
    {
        $Feature = $Device->Features()->create([
            'title_ar' => $request['title_ar'],
            'title_en' => $request['title_en'],
            'image' => $request['image'],
            'desc_ar' => $request['desc_ar'],
            'desc_en' => $request['desc_en'],
        ]);
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route('admin.devices.show', ['device' => $Device]);
    }

    public function show(Device $Device, Feature $Feature)
    {
        return view('device::features.show', compact('Device', 'Feature'));
    }

    public function edit(Device $Device, Feature $Feature)
    {
        return view('device::features.edit', compact('Device', 'Feature'));
    }

    public function update(Request $request, Device $Device, Feature $Feature)
    {
        $Feature->update($request->all());
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route('admin.devices.show', ['device' => $Device]);
    }

    public function destroy(Device $Device, Feature $Feature)
    {
        Feature::where('id', $Feature->id)->delete();
        alert()->success(__('trans.DeletedSuccessfully'));

        return redirect()->route('admin.devices.show', ['device' => $Device]);
    }
}
