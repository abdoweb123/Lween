@extends('Admin.layout')
@section('pagetitle', $Device->title() . ' --> ' .  __('trans.add') . ' ' . __('trans.gallery'))
@section('content')


<form method="POST" action="{{ route('admin.device.gallery.store',['device'=>$Device]) }}">
    @csrf

    <div class="row mx-2 px-2 position-relative">
        <div class="col-md-6">
            <label for="image" class="form-label">@lang('trans.image')</label>
            <input class="form-control gallery_image" accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" type="file" data-gallery-id="0">
        </div>
        <div class="col-md-6">
        </div>
    </div>
    

    <div class="row">
        <div class="col-sm-12 my-4">
            <div class="text-center p-20">
                <button type="submit" class="main-btn">{{ __('trans.add') }}</button>
                <button type="reset" class="btn btn-secondary">{{ __('trans.cancel') }}</button>
            </div>
        </div>
    </div>
    </div>
</form>
@endsection
