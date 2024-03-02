@extends('Admin.layout')

@section('pagetitle', __('trans.Delivery'))
@section('content')

<div class="row">
    <div class="my-2 col-6 text-sm-start">
    </div>
    <div class="my-2 col-6 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('f_a_q_s')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
    </div>
</div>
<table class="table table-bordered data-table" >
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
            <th>#</th>
            <th>@lang('trans.title_ar')</th>
            <th>@lang('trans.title_en')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Models as $Model)
        <tr>
            <td>
                <input type="checkbox" class="DTcheckbox" value="{{ $Model->id }}">
            </td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Model->title_ar }}</td>
            <td>{{ $Model->title_en }}</td>
            <td>
                <a href="{{ route('admin.deliveries.show', $Model) }}"><i class="fa-solid fa-eye"></i></a>
                <a href="{{ route('admin.deliveries.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
