@extends('Admin.layout')
@section('pagetitle', __('trans.addSetting'))
@section('content')
    <form method="POST" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data" 
        >
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="key">@lang('trans.keywords')</label>
                <input type="text" name="key" id="key" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="type">@lang('trans.type')</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>


            <div class="col-md-6">
                <label for="valuetype">@lang('trans.valuetype')</label>
                <select class="form-control" required id="valuetype" name="valuetype">
                    <option disabled selected hidden>@lang('trans.Select')</option>
                    <option value="description">@lang('trans.description')</option>
                    <option value="image">@lang('trans.image')</option>
                </select>
            </div>
            <div class="col-md-6" id="ValueFild">

            </div>
        </div>


       
        <div class="text-right m-b-0 text-center">
            <button class="main-btn btn-hover text-center waves-effect waves-light" type="submit">@lang('trans.add')</button>
            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">@lang('trans.cancel')</button>
        </div>
    </form>
@endsection

@section('js')



    <script>
        $("#itemSetting").addClass('active');


        $(document).on('change', '#valuetype', function() {
            $('#ValueFild').empty();
            if ($(this).val() == 'description') {
                $('#ValueFild').html('<label for="description">@lang("trans.description")</label><input type="text" name="value"  class="form-control" required>');
            }
            if ($(this).val() == 'image') {
                $('#ValueFild').html('<label for="image">@lang("trans.image")</label><input accept="image/*" type="file" name="Imagevalue" class="form-control"section>');
            }
        });
    </script>
@endsection
