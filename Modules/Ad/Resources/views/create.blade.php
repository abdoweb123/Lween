@extends('Admin.layout')
@section('pagetitle', __('trans.Ads'))
@section('content')
<form method="POST" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="text-center">
        <img src="{{ asset(setting('logo')) }}" class="rounded mx-auto text-center" id="file"  height="200px">
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="link">@lang('trans.link')</label>
            <input id="link" type="text" name="link" placeholder="@lang('trans.link')" class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="file">{{ __('trans.file') }}</label>
            <input class="form-control w-100" id="file" type="file" name="file" onchange="document.getElementById('file').src = window.URL.createObjectURL(this.files[0])">
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
