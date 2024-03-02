@extends('Admin.layout')
@section('pagetitle', $Device->title() . ' --> ' .$Feature->title())
@section('content')
<form method="POST" action="{{ route('admin.device.features.update',['device'=>$Device,'feature'=>$Feature]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <label for="title_ar">@lang('trans.title_ar')</label>
            <input type="text" value="{{ $Feature->title_ar }}" name="title_ar" placeholder="@lang('trans.title_ar')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="title_en">@lang('trans.title_en')</label>
            <input type="text" value="{{ $Feature->title_en }}" name="title_en" placeholder="@lang('trans.title_en')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="image" class="form-label">@lang('trans.image')</label>
            <input class="form-control" accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" type="file" data-feature-id="0">
        </div>
        <div class="col-md-6">
            <div class="position-relative" style="width: fit-content;">
                <img class="preview_image" src="{{ $Feature->image }}"/>
                <i data-path="{{ $Feature->image }}" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <label class="my-1">@lang('trans.desc_ar')</label>
            <textarea name="desc_ar" placeholder="@lang('trans.desc_ar')" class="form-control mceNoEditor">{{ $Feature->desc_ar }}</textarea>
        </div>
        <div class="col-md-6 col-sm-12">
            <label class="my-1">@lang('trans.desc_en')</label>
            <textarea name="desc_en" placeholder="@lang('trans.desc_en')" class="form-control mceNoEditor">{{ $Feature->desc_en }}</textarea>
        </div>
        <div class="col-12">
            <div class="button-group my-4">
                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection