@extends('Admin.layout')
@section('pagetitle', __('trans.Ads'))
@section('content')
<form method="POST" action="{{ route('admin.ads.update',$Model) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="text-center">
        <img src="{{ asset($Model->file ?? setting('logo')) }}" class="rounded mx-auto text-center" id="file"  height="200px">
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="link">@lang('trans.link')</label>
            <input id="link" type="text" name="link" placeholder="@lang('trans.link')" class="form-control" value="{{ $Model['link'] }}">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="file">{{ __('trans.file') }}</label>
            <input class="form-control w-100" id="file" type="file" name="file" onchange="document.getElementById('file').src = window.URL.createObjectURL(this.files[0])">
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
