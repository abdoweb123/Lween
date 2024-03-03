@extends('Admin.layout')
@section('pagetitle', __('trans.width'))
@section('content')
<form method="POST" action="{{ route('admin.coupons.update',$Model) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="text-center">
        <img src="{{ asset($Model->file ?? setting('logo')) }}" class="rounded mx-auto text-center" id="file"  height="200px">
    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="mt-1" for="title_en">@lang('trans.value') %</label>
            <input type="number" step="any" name="value" value="{{old('value',$Model->value)}}" required placeholder="@lang('trans.value')" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="mt-1">@lang('trans.max_uses') </label>
            <input type="number" step="1" name="max_uses" value="{{old('max_uses',$Model->max_uses)}}" placeholder="@lang('trans.max_uses')" class="form-control">
        </div>

        <div class="col-md-6 {{ old('from') }}">
            <label class="mt-1">@lang('trans.coupon_from')</label>
            <input type="date" name="start_date" value="{{old('start_date',$Model->start_date)}}" placeholder="@lang('trans.coupon_from')" class="form-control">
        </div>
        <div class="col-md-6 {{ old('to') }}">
            <label class="mt-1">@lang('trans.coupon_to')</label>
            <input type="date" name="end_date" value="{{old('end_date',$Model->end_date)}}" placeholder="@lang('trans.coupon_to')" class="form-control">
        </div>

        <div class="row">
            <div class="col-sm-12 my-4">
                <div class="text-center p-20">
                    <button type="submit" class="main-btn"> {{ __('trans.Submit') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
