<?php

namespace Modules\Product\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends BasicController
{
    public function store(Request $request)
    {
        $data = [];
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:4096',
        ]);

        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file');
        } else {
            if ($request->file('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $filepath = Upload::UploadFile(request()->file, 'Products');
                $data['success'] = 1;
                $data['message'] = 'Uploaded Successfully!';
                $data['filepath'] = $filepath;
                $data['extension'] = $extension;
            } else {
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);
    }

    public function destroy(Request $request)
    {
        Upload::deleteImage(request()->path);

        return response()->json();
    }
}
