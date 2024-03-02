@extends('Admin.layout')

@section('pagetitle', __('trans.blocks'))
@section('content')

<div class="row">
    <div class="my-2 col-6">
        <a href="{{ route('admin.blocks.create') }}" class="main-btn btn-hover text-center px-5">@lang('trans.add_new') <i class="fa-solid fa-plus mx-1"></i></a>
    </div>
</div>
<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.block')</th>
            <th>@lang('trans.status')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Models as $Model)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-center">
                {{ $Model->title }}
            </td>
            <td>
                <input class="toggle" type="checkbox" onclick="toggleswitch({{ $Model->id }},'blocks')" @if ($Model->status) checked @endif>
            </td>
            <td>
                <a href="{{ route('admin.blocks.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
