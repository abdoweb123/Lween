@extends('Admin.layout')
@section('pagetitle', __('trans.FAQ'))
@section('content')
<form method="POST" action="{{ route('admin.faq.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="question_ar">@lang('trans.question_ar')</label>
            <input id="question_ar" type="text" name="question_ar" required placeholder="@lang('trans.question_ar')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="question_en">@lang('trans.question_en')</label>
            <input id="question_en" type="text" name="question_en" required placeholder="@lang('trans.question_en')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="answer_ar">@lang('trans.answer_ar')</label>
            <textarea id="answer_ar" name="answer_ar" required placeholder="@lang('trans.answer_ar')" class="mceNoEditor form-control"></textarea>
        </div>
        <div class="col-md-6">
            <label for="answer_en">@lang('trans.answer_en')</label>
            <textarea id="answer_en" name="answer_en" required placeholder="@lang('trans.answer_en')" class="mceNoEditor form-control"></textarea>
        </div>
        <div class="col-md-6">
            <label for="visibility">@lang('trans.visibility')</label>
            <select class="form-control" required id="visibility" name="status">
                <option value="0">@lang('trans.hidden')</option>
                <option selected value="1">@lang('trans.visible')</option>
            </select>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-sm-12 my-4">
                <div class="text-center p-20">
                    <button type="submit" class="main-btn">{{ __('trans.add') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('trans.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
