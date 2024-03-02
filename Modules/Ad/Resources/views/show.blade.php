@extends('Admin.layout')
@section('pagetitle', __('trans.Ads'))
@section('content')

<table class="table">
    <tr>
        <td colspan="2" class="text-center">
            <img src="{{ asset($Model->file ?? setting('logo')) }}" class="rounded mx-auto text-center" id="file" height="200px">
        </td>
    </tr>
</table>

@endsection
