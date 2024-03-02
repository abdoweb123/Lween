@extends('Admin.layout')
@section('pagetitle', __('trans.clients'))

@section('content')

<form action="{{ route('admin.clients.update',$Model) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="text-center">
        <img src="{{ asset(setting('logo')) }}" class="rounded mx-auto text-center"  id="image"  height="200px">
    </div>
    <div class="row">
        <div class="col-12"></div>
        <div class="col-md-6 ">
            <label for="name">{{ __('trans.name') }}</label>
            <input value="{{ $Model->name }}" type="text" name="name" id="name" parsley-trigger="change" required value="" class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="email">{{ __('trans.email') }}</label>
            <input value="{{ $Model->email }}" type="email" name="email" parsley-trigger="change" value="" required class="form-control">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="phone">{{ __('trans.phone') }}</label>
            <input  class="form-control @error('phone')is-invalid @enderror" required type="phone" name="phone" id="phone_number" placeholder="{{ __('trans.Phone') }}" value="{{ old('phone',$Model->phone) }}">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="password">{{ __('trans.password') }}</label>
            <input type="password" name="password" id="password" parsley-trigger="change" class="form-control" data-parsley-id="10">
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="password_confirmation">{{ __('trans.confirmPassword') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" parsley-trigger="change" class="form-control" data-parsley-id="10">
        </div>

        <div class="form-group col-md-6">
            <label for="file">@lang('trans.image')</label>
            <label for="file" class="file-input btn btn-block btn-primary btn-file w-100">
                @lang("trans.Browse")
                <input accept="image/*" type="file" type="file" name="image" id="file" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
            </label>
        </div>
        <div class="clearfix"></div>
        <div class="col-12 my-4">
            <div class="button-group my-4">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>

@endsection
