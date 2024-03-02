@extends('Admin.layout')
@section('pagetitle', $Device->title() . ' --> ' . __('trans.specs'))
@section('content')
<form method="POST" action="{{ route('admin.device.specs.update',['device'=>$Device,'spec'=>1]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-5">@lang('trans.desc_ar')</div>
                <div class="col-md-5">@lang('trans.desc_en')</div>
            </div>
        </div>
        <div class="col-12">
            @foreach ($Specs as $Spec)
            @php($item = $Device->Specs->where('specs_id',$Spec->id)->first())
            <div class="row my-2">
                <div class="col-md-2"> <h5>{{ $Spec->title() }}</h5></div>
                <div class="col-md-5"><textarea placeholder="@lang('trans.desc_ar')" name="specs[{{ $Spec->id }}][desc_ar]" cols="15" rows="5" class="form-control mceNoEditor py-2">{!! $item?->desc_ar !!}</textarea></div>
                <div class="col-md-5"><textarea placeholder="@lang('trans.desc_en')" name="specs[{{ $Spec->id }}][desc_en]" cols="15" rows="5" class="form-control mceNoEditor py-2">{!! $item?->desc_en !!}</textarea></div>
            </div>
            @endforeach
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