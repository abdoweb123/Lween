<?php

namespace Modules\Height\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use App\Functions\Upload;
use Modules\Brand\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::get();

        return view('height::index', compact('Models'));
    }


    public function create()
    {
        return view('height::create');
    }


    public function store(Request $request)
    {
        $Model = Model::create($request->all());
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }


    public function show($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('height::show', compact('Model'));
    }


    public function edit($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('height::edit', compact('Model'));
    }


    public function update(Request $request, $id)
    {
        $Model = Model::where('id', $id)->firstorfail();
        $Model->update($request->all());
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }


} //end of class
