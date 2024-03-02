@extends('Admin.layout')

@section('pagetitle', __('trans.branches'))
@section('content')

<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.branches.create') }}" class="main-btn">@lang('trans.add_new')</a>
    </div>
    <div class="my-2 col-6 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('branches')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
    </div>
</div>
<table class="table dataTable data-table" >
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
        @foreach ($Branchs as $Branch)
        <tr>
            <td>
                <input type="checkbox" class="DTcheckbox" value="{{ $Branch->id }}">
            </td>
            <td>{{ $loop->iteration }}</td>
            <td><a href="{{ route('admin.branches.show', $Branch) }}">{{ $Branch->title_ar }}</a></td>
            <td><a href="{{ route('admin.branches.show', $Branch) }}">{{ $Branch->title_en }}</a></td>
            <td>
                <a href="{{ route('admin.branches.edit', $Branch) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="{{ route('admin.branches.destroy', $Branch) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
