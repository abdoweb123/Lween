@extends('Admin.layout')
@section('pagetitle', $Parent->title())
@section('content')


<div class="row">
    <div class="my-2 col-6">
        <a href="{{ route('admin.categories.create') }}" class="main-btn px-5">@lang('trans.add_new')</a>
    </div>
</div>
<table class="table text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.title_ar')</th>
            <th>@lang('trans.title_en')</th>
            <th>@lang('trans.visibility')</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="@auth('admin') row_position @endauth" data-table="categories">
        @foreach ($Models as $Model)
        <tr data-id="{{ $Model->id }}" data-position="{{ $Model->arrangement }}">
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-center">{{ $Model->title_ar }}</td>
            <td class="text-center">{{ $Model->title_en }}</td>
            <td class="text-center">
                <input class="toggle" type="checkbox" onclick="toggleswitch({{ $Model->id }},'categories')" @if ($Model->status) checked @endif>
            </td>
            <td class="text-center">
                <a href="{{ route('admin.categories.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="{{ route('admin.categories.destroy', $Model) }}">
                    @csrf
                    @method('delete')
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
