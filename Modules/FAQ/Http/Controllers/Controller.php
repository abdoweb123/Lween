<?php

namespace Modules\FAQ\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\FAQ\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::get();

        return view('faq::index', compact('Models'));
    }

    public function create()
    {
        $Models = Model::get();

        return view('faq::create', compact('Models'));
    }

    public function store(Request $request)
    {
        $Model = Model::create($request->all());
        if ($request->hasFile('image')) {
            $Model->image = Upload::UploadFile($request->image, 'Payments');
        }
        $Model->save();
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Parent = Model::where('id', $id)->firstorfail();
        $Models = $Parent->children;

        return view('faq::show', compact('Models', 'Parent'));
    }

    public function edit($id)
    {
        $Models = Model::get();
        $Model = Model::where('id', $id)->firstorfail();

        return view('faq::edit', compact('Model', 'Models'));
    }

    public function update(Request $request, $id)
    {
        $Model = Model::where('id', $id)->firstorfail();
        $Model->update($request->all());
        if ($request->hasFile('image')) {
            $Model->image = Upload::UploadFile($request->image, 'Payments');
        }
        $Model->save();
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }
}
