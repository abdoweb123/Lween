@extends('Admin.layout')

@section('pagetitle', __('trans.devices'))
@section('content')

<form action="{{ route('admin.devices.featured') }}" method="post">
    @csrf
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
                <th>@lang('trans.title')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Devices as $Model)
                <tr>
                    <td>
                        <input type="checkbox" @checked($Model->featured > 0) name="devices[]" class="DTcheckbox" value="{{ $Model->id }}">
                    </td>
                    <td>{{ $Model->title() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12">
        <div class="button-group my-4">
            <button type="submit" class="main-btn btn-hover w-100 text-center">
                {{ __('trans.Submit') }}
            </button>
        </div>
    </div>
</form>
@endsection
