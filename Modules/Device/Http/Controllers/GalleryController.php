<?php

namespace Modules\Device\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Device\Entities\Device;
use Modules\Device\Entities\Gallery;

class GalleryController extends BasicController
{
    public function index($device_id, Request $request)
    {
        abort(404);
    }

    public function create(Device $Device)
    {
        return view('device::gallery.create', compact('Device'));
    }

    public function store(Device $Device, Request $request)
    {
        $Gallery = Gallery::create(['device_id' => $Device->id] + $request->all());
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route('admin.devices.show', ['device' => $Device]);
    }

    public function show($device_id, $gallery_id)
    {
        abort(404);
    }

    public function edit(Device $Device, Gallery $Gallery)
    {
        return view('device::gallery.edit', compact('Gallery', 'Device'));
    }

    public function update(Request $request, Device $Device, Gallery $Gallery)
    {
        $Gallery->update($request->all());
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route('admin.devices.show', ['device' => $Device]);
    }

    public function destroy(Device $Device, Gallery $Gallery)
    {
        $Gallery->delete();
        alert()->success(__('trans.DeletedSuccessfully'));

        return redirect()->route('admin.devices.show', ['device' => $Device]);
    }
}
