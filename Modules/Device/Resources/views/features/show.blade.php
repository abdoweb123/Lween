@extends('Admin.layout')
@section('pagetitle', $Device->title() . ' --> ' .$Feature->title())
@section('content')

<table class="my-5 table dataTable">
    <tbody class="">
        <tr>
            <td>@lang('trans.image')</td>
            <td><img src="{{ asset($Feature->image ?? setting('logo')) }}" style="max-width: 300px;"></td>
        </tr>
        <tr>
            <td>@lang('trans.title_ar')</td>
            <td>{{ $Feature->title_ar }}</td>
        </tr>
        <tr>
            <td>@lang('trans.title_en')</td>
            <td>{{ $Feature->title_en }}</td>
        </tr>
        <tr>
            <td>@lang('trans.desc_ar')</td>
            <td>{{ $Feature->desc_ar }}</td>
        </tr>
        <tr>
            <td>@lang('trans.desc_en')</td>
            <td>{{ $Feature->desc_en }}</td>
        </tr>
    </tbody>
</table>


@endsection
