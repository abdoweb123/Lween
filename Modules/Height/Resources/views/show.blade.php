@extends('Admin.layout')
@section('pagetitle', __('trans.height'))
@section('content')

<table class="table">
    <tr>
        <td class="text-center">
            {{ $Model['title'] }}
        </td>
    </tr>
</table>

@endsection

