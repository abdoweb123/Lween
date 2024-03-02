@extends('Admin.layout')
@section('pagetitle', $Device->title() . ' --> ' .  __('trans.add') . ' ' . __('trans.feature'))
@section('content')


<form method="POST" action="{{ route('admin.device.features.store',['device'=>$Device]) }}">
    @csrf

    <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
        <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
            <h2>@lang('trans.features')</h2>
        </span>
    </div>
    <div class="row mx-2 px-2 position-relative">
        <div class="col-md-6">
            <label for="title_ar">@lang('trans.title_ar')</label>
            <input type="text" name="title_ar" placeholder="@lang('trans.title_ar')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="title_en">@lang('trans.title_en')</label>
            <input type="text" name="title_en" placeholder="@lang('trans.title_en')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="image" class="form-label">@lang('trans.image')</label>
            <input class="form-control" accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" type="file" data-feature-id="0">
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-6 col-sm-12">
            <label class="my-1">@lang('trans.desc_ar')</label>
            <textarea name="desc_ar" placeholder="@lang('trans.desc_ar')" class="form-control mceNoEditor"></textarea>
        </div>
        <div class="col-md-6 col-sm-12">
            <label class="my-1">@lang('trans.desc_en')</label>
            <textarea name="desc_en" placeholder="@lang('trans.desc_en')" class="form-control mceNoEditor"></textarea>
        </div>
    </div>
    

    <div class="row">
        <div class="col-sm-12 my-4">
            <div class="text-center p-20">
                <button type="submit" class="btn btn-primary">{{ __('trans.add') }}</button>
                <button type="reset" class="btn btn-secondary">{{ __('trans.cancel') }}</button>
            </div>
        </div>
    </div>
    </div>
</form>
@endsection
