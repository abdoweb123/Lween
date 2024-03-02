@extends('Admin.layout')
@section('pagetitle', __('trans.permissions'))
@section('content')


<table class="table table-bordered data-table text-center" >
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.title_ar')</th>
            <th>@lang('trans.title_en')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Permissions as $Permission)
        <tr data-id="{{ $Permission->id }}" data-position="{{ $Permission->arrangement }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Permission->title_ar }}</td>
            <td>{{ $Permission->title_en }}</td>
            <td>
                <a href="{{ route('admin.permissions.edit', $Permission) }}"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
