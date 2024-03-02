@extends('Admin.layout')

@section('pagetitle', __('trans.Roles'))
@section('content')

<table class="table table-bordered data-table text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.title_ar')</th>
            <th>@lang('trans.title_en')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Roles as $Role)
        <tr data-id="{{ $Role->id }}" data-position="{{ $Role->arrangement }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Role->title_ar }}</td>
            <td>{{ $Role->title_en }}</td>
            <td>
                <a href="{{ route('admin.roles.edit', $Role) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                @if($Role->id > 1)   
                    <form class="formDelete" method="POST" action="{{ route('admin.roles.destroy', $Role) }}">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                            <i class="fa-solid fa-eraser"></i>
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection

