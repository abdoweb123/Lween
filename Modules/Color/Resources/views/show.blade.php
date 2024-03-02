@extends('Admin.layout')
@section('pagetitle', __('trans.colors'))
@section('content')

<table class="table">
    <tr>
        <td class="text-center">
            {{ $Model['title_en'] }}
        </td>
        <td class="text-center">
            {{ $Model['title_ar'] }}
        </td>
        <td class="text-center">
            <div style="background-color: {{ $Model->hexa }}">{{ $Model->hexa }}</div>
        </td>
    </tr>
</table>

@endsection

