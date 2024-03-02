@extends('Admin.layout')
@section('pagetitle', __('trans.blocks'))
@section('content')
<form method="POST" action="{{ route('admin.blocks.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <label for="title">@lang('trans.title')</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>


        <div class="col-md-6">
            <label for="visibility">@lang('trans.visibility')</label>
            <select class="form-control" required id="visibility" name="status">
                <option selected value="1">@lang('trans.visible')</option>
                <option value="0">@lang('trans.hidden')</option>
            </select>
        </div>

     
        <div class="col-12 my-4">
            <div class="button-group my-4 text-center">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>

@endsection
