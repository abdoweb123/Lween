@extends('Admin.layout')
@section('pagetitle', __('trans.categories'))

@section('content')
<form method="POST" action="{{ route('admin.categories.update',$Model) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row">

        <div class="text-center">
            <img src="{{ asset($Model->image ?? setting('logo')) }}" class="rounded mx-auto text-center"  id="image"  height="200px">
        </div>
        <div class="form-group col-md-6">
            <label for="title_ar">@lang('trans.title_ar')</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" required value="{{ $Model['title_ar'] }}">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">@lang('trans.title_en')</label>
            <input type="text" name="title_en" id="title_en" class="form-control" required value="{{ $Model['title_en'] }}">
        </div>
        @if($Model->children->count() == 0) 
            <div class="form-group col-md-6">
                <label >@lang('trans.parent')</label>
                <select name="parent_id" class="form-control" data-live-search="true">
                    <option value="">{{ __('trans.Choose') }}</option>
                    @foreach($Models->whereNotIn('id',$Model->id) as $Single)
                    <option {{ $Model->parent_id == $Single->id ? 'selected' : '' }} value="{{ $Single['id'] }}">{{ $Single->title() }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group col-md-6">
            <label for="visibility">@lang('trans.visibility')</label>
            <select class="form-control" required id="visibility" name="status">
                <option {{ $Model['status'] == 1 ? 'selected' : '' }} value="1">@lang('trans.visible')</option>
                <option {{ $Model['status'] == 0 ? 'selected' : '' }} value="0">@lang('trans.hidden')</option>
            </select>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="image">{{ __('trans.image') }}</label>
            <input class="form-control w-100" id="image" type="file" name="image" onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
        </div>
       
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