<?php

namespace Modules\Block\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Block\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::get();

        return view('block::index', compact('Models'));
    }

    public function create()
    {
        return view('block::create');
    }

    public function store(Request $request)
    {
        $Model = Model::create($request->only(['title', 'status']));
        $Model->save();
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route('admin.blocks.index');
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('block::edit', compact('Model'));
    }

    public function update(Request $request, $id)
    {
        $Model = Model::where('id', $id)->firstorfail();
        $Model->update($request->only(['title',  'status']));
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route('admin.blocks.index');
    }

    public function destroy($id)
    {
        Model::where('id', $id)->delete();
    }
}
