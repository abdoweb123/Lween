<?php

namespace Modules\Width\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use App\Functions\Upload;
use Modules\Width\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::get();

        return view('width::index', compact('Models'));
    }


    public function create()
    {
        return view('width::create');
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

        return view('width::show', compact('Model'));
    }


    public function edit($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('width::edit', compact('Model'));
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
