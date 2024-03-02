<?php

namespace Modules\Branch\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Branch\Entities\Model as Branch;
use Modules\Category\Entities\Model as Category;
use Modules\Country\Entities\Country;
use Modules\Country\Entities\Region;
use Modules\Device\Entities\Device;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Branchs = Branch::get();

        return view('branch::index', compact('Branchs'));
    }

    public function create()
    {
        $Countries = Country::get();

        return view('branch::create', compact('Countries'));
    }

    public function store(Request $request)
    {
        $Branch = Branch::create($request->only('country_id', 'title_ar', 'title_en', 'phone', 'whatsapp', 'email', 'address_ar', 'address_en', 'working_time_ar', 'working_time_en', 'delivery', 'pickup', 'dinein', 'status', 'lat', 'long'));
        $Branch->Regions()->attach($request->regions);
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Branch $Branch)
    {
        $Categories = Category::whereNull('parent_id')->get();

        return view('branch::show', compact('Branch', 'Categories'));
    }

    public function edit($id)
    {
        $Countries = Country::get();
        $Branch = Branch::with('Regions')->find($id);
        $regions = Region::where('country_id', $Branch->country_id)->whereNotIn('id', $Branch->Regions->pluck('id'))->get();

        return view('branch::edit', compact('Branch', 'regions', 'Countries'));
    }

    public function update(Branch $Branch, Category $Category, Request $request)
    {
        $Branch->update($request->only('country_id', 'title_ar', 'title_en', 'phone', 'whatsapp', 'email', 'address_ar', 'address_en', 'working_time_ar', 'working_time_en', 'delivery', 'pickup', 'dinein', 'status', 'lat', 'long'));
        $Branch->Regions()->detach();
        $Branch->Regions()->attach($request->regions);

        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Branch = Branch::where('id', $id)->delete();
    }

    public function editCategories($branch_id, $category_id)
    {
        $Branch = Branch::with('Categories')->where('id', $branch_id)->first();
        $Category = Category::with('children')->find($category_id);

        return view('branch::editCategories', compact('Branch', 'Category'));
    }

    public function updateCategories(Branch $Branch, Category $Category, Request $request)
    {
        $Branch->categories()->detach($Category->children()->pluck('id'));
        $Branch->categories()->attach($request->categories);
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route('admin.branches.show', ['branch' => $Branch]);
    }

    public function editDevices(Branch $Branch, Category $Category, Request $request)
    {
        $Devices = Device::select(['id', 'title_ar', 'title_en'])->whereHas('Categories', function ($query) use ($Category) {
            $query->where('category_id', $Category->id);
        })->without(['Images', 'SizeColor'])->get();

        return view('branch::editDevices', compact('Branch', 'Category', 'Devices'));
    }

    public function updateDevices(Branch $Branch, Category $Category, Request $request)
    {
        $Branch->Devices()->detach($Branch->Devices()->where('category_id', $Category->id)->pluck('device_id'));
        $Branch->Devices()->attach($request->devices, ['category_id' => $Category->id]);
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route('admin.branches.show', ['branch' => $Branch]);
    }
}
