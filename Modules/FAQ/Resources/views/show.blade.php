@extends('Admin.layout')
@section('pagetitle', __('trans.FAQ'))
@section('content')

<table class="table">
    <tr>
        <td class="text-center">
            {{ $faq['question_en'] }}
        </td>
        <td class="text-center">
            {{ $faq['question_ar'] }}
        </td>
    </tr>
    <tr>
        <td class="text-center">
            {!! $faq['answer_en'] !!}
        </td>
        <td class="text-center">
            {!! $faq['answer_ar'] !!}
        </td>
    </tr>


</table>

@endsection

