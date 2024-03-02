@extends('Admin.layout')
@section('content')


{!! Form::model($Role, ['method' => 'PATCH','route' => ['admin.roles.update', $Role->id]]) !!}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>@lang('trans.title_ar')</strong>
            {!! Form::text('title_ar', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>@lang('trans.title_en')</strong>
            {!! Form::text('title_en', null, array('class' => 'form-control')) !!}
        </div>
    </div>



    <div class="col-xs-12 col-sm-12 col-md-6">
        <label for="permissions">@lang('trans.permissions')</label>(<a type='button' class="text-decoration-none mx-2" id='selectAll'>@lang('trans.select_all')</a>)
        <select class="form-control selectpicker border" id="permissions" required multiple name="permissions[]">
            @foreach ($Permissions as $Permission)
                <option @selected(in_array($Permission->id, $RolePermissions)) value="{{ $Permission->id }}">{{ $Permission->title() }}</option>
            @endforeach
        </select>
    </div>


    <div class="col-12">
        <div class="button-group">
            <button type="submit" class="main-btn btn-hover w-100 text-center">
                {{ __('trans.Submit') }}
            </button>
        </div>
    </div>
</div>

{!! Form::close() !!}

<p class="text-center text-primary"><small></small></p>

@endsection


@section('css')
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection



@section('js')
    <script src="https://unpkg.com/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".selectpicker").selectpicker();
        });
        $('#selectAll').click(function() {
            $('#permissions option').attr("selected","selected");
            $(".selectpicker").selectpicker('refresh');
        });
    </script>
@endsection