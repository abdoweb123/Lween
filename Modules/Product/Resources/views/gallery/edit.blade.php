@extends('Admin.layout')
@section('pagetitle', $Product->title() . ' --> ' . __('trans.Gallery'))
@section('content')
<form method="POST" action="{{ route('admin.product.gallery.update',['product'=>$Product,'gallery'=>$Gallery]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <label for="image" class="form-label">@lang('trans.image')</label>
            <input class="form-control gallery_image" accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" type="file" data-gallery-id="0">
        </div>
        <div class="col-md-6">
            <div class="position-relative" style="width: fit-content;">
                <img class="preview_image" src="{{ $Gallery->image }}"/>
                <i data-path="{{ $Gallery->image }}" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i>
            </div>
        </div>
       
        <div class="col-12">
            <div class="button-group my-4">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
