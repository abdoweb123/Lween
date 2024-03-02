<?php

namespace Modules\Address\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Address\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::latest();

        return view('address::index', compact('Models'));
    }

    public function show($id)
    {
        $Model = Model::latest()->find($id);

        return view('address::show', compact('Model'));
    }
}
