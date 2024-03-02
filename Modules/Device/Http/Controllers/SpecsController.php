<?php

namespace Modules\Device\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Device\Entities\Device;
use Modules\Specs\Entities\Model;

class SpecsController extends BasicController
{
    public function index($device_id, Request $request)
    {
        abort(404);
    }

    public function create($device_id)
    {
        abort(404);
    }

    public function store($device_id, Request $request)
    {
        abort(404);
    }

    public function show($device_id, $spec_id)
    {
        abort(404);
    }

    public function edit($device_id, $spec_id)
    {
        $Device = Device::with('Specs')->find($device_id);
        $Specs = Model::get();

        return view('device::specs.edit', compact('Specs', 'Device'));
    }

    public function update(Device $Device, $specs_id, Request $request)
    {
        if ($request->specs) {
            $Device->Specs()->delete();
            foreach ($request->specs as $spec_id => $Item) {
                if ($Item['desc_ar'] && $Item['desc_en']) {
                    Model::Create([
                        'device_id' => $Device->id,
                        'specs_id' => $spec_id,
                        'desc_ar' => $Item['desc_ar'],
                        'desc_en' => $Item['desc_en'],
                    ]);
                }
            }
        }
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route('admin.devices.show', ['device' => $Device]);
    }

    public function destroy($device_id, $spec_id)
    {
        abort(404);
    }
}
