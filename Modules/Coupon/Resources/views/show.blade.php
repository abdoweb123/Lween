@extends('Admin.layout')
@section('pagetitle', __('trans.width'))
@section('content')

<table class="table">
    <tr class="text-center">
        <th>@lang('trans.code')</th>
        <th>@lang('trans.value')</th>
        <th>@lang('trans.max_uses')</th>
        <th>@lang('trans.uses_count')</th>
        <th>@lang('trans.start_date')</th>
        <th>@lang('trans.end_date')</th>
        <th>@lang('trans.status')</th>
    </tr>
    <tr class="text-center">
        <td>{{ $Model->code }}</td>
        <td>{{ $Model->value }}</td>
        <td>{{ $Model->max_uses }}</td>
        <td>{{ $Model->uses_count }}</td>
        <td>{{ $Model->start_date }}</td>
        <td>{{ $Model->end_date }}</td>
        <td>{{ $Model->is_active == '1' ? __('trans.active') : __('trans.inactive') }}</td>
    </tr>
</table>

@endsection

