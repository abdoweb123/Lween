@extends('Admin.layout')
@section('pagetitle', __('trans.address'))
@section('content')
    <div class="row">
        <div class="col-2">
            @lang('trans.name')
        </div>
        <div class="col-10">
            {{ $Address['name'] }}
        </div>

        <div class="col-2">
            @lang('trans.phone')
        </div>
        <div class="col-10">
            {{ $Address['phone'] }}
        </div>

        <div class="col-2">
            @lang('trans.email')
        </div>
        <div class="col-10">
            {{ $Address['email'] }}
        </div>

        <div class="col-2">
            @lang('trans.subject')
        </div>
        <div class="col-10">
            {{ $Address['subject'] }}
        </div>

        <div class="col-2">
            @lang('trans.message')
        </div>
        <div class="col-10">
            <p> {{ $Address['message'] }}</p>
        </div>
    </div>

@endsection
