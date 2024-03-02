@extends('Admin.layout')
@section('pagetitle', __('trans.Roles'))
@section('content')


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $Role->name }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <strong>@lang('trans.Permissions')</strong>
            @if(!empty($RolePermissions))
            <ul>
                @foreach($RolePermissions as $v)
                <li>
                    {{ $v->name }}
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>

<p class="text-center text-primary"><small></small></p>

@endsection
