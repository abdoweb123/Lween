@extends('Admin.layout')
@section('pagetitle', __('trans.blocks'))
@section('content')
    <form method="POST" action="{{ route('admin.blocks.update',$Model) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class=" col-md-6">
                <label for="title">@lang('trans.title')</label>
                <input id="title" type="text" name="title" required placeholder="@lang('trans.title')" class="form-control" value="{{ $Model['title'] }}">
            </div>

            <div class=" col-md-6">
                <label for="visibility">@lang('trans.visibility')</label>
                <select class="form-control" required id="visibility" name="status">
                    <option {{ $Model['status'] == 0 ? 'selected' : '' }} value="0">@lang('trans.hidden')</option>
                    <option {{ $Model['status'] == 1 ? 'selected' : '' }} value="1">@lang('trans.visible')</option>
                </select>
            </div>
           
            <div class="col-12 my-3">
                <div class="button-group my-4 text-center">
                    <button type="submit" class="main-btn btn-hover w-100 text-center">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
