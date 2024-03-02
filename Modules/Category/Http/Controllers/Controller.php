<?php

namespace Modules\Category\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Category\Entities\Model;
use Modules\Category\Entities\Model as Category;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::OrderByArrangement()->whereNull('parent_id')->with('children')->withCount('children')->get();

        return view('category::index', compact('Models'));
    }

    public function create()
    {
        $Models = Model::whereNull('parent_id')->get();

        return view('category::create', compact('Models'));
    }

    public function store(Request $request)
    {
        $Model = Model::create($request->only(['parent_id', 'title_ar', 'title_en', 'status']));
        if ($request->hasFile('image')) {
            $Model->image = Upload::UploadFile($request->image, 'Categories');
        }
        $Model->save();
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Parent = Model::where('id', $id)->with('children')->firstorfail();
        $Models = $Parent->children;

        return view('category::show', compact('Models', 'Parent'));
    }

    public function edit($id)
    {
        $Models = Model::whereNull('parent_id')->get();
        $Model = Model::where('id', $id)->firstorfail();

        return view('category::edit', compact('Model', 'Models'));
    }

    public function update(Request $request, $id)
    {
        $Model = Model::where('id', $id)->firstorfail();
        $Model->update($request->only(['parent_id', 'title_ar', 'title_en', 'status']));
        if ($request->hasFile('image')) {
            $Model->image = Upload::UploadFile($request->image, 'Categories');
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
