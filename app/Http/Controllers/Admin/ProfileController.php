<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\Model;

class ProfileController extends BasicController
{
    public function show()
    {
        return view('Admin.profile');
    }

    public function update(ProfileRequest $request)
    {
        Model::where('id', auth()->id())->update($request->except('password', '_token', '_method', 'password_confirmation'));

        if ($request->password) {
            Model::where('id', auth()->id())->update([
                'password' => Hash::make($request->password),
            ]);
        }

        toast(__('trans.updatedSuccessfully'), 'success');

        return redirect()->back();
    }
}
