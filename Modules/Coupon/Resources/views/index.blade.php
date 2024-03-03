@extends('Admin.layout')

@section('pagetitle', __('trans.coupons'))
@section('content')

<div class="row">
    <div class="my-2 col-6 text-sm-start">
        <a href="{{ route('admin.coupons.create') }}" class="main-btn">@lang('trans.add_new')</a>
    </div>
    <div class="my-2 col-6 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('coupons')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
    </div>
</div>
<table class="table table-bordered data-table" >
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
            <th>#</th>
            <th>@lang('trans.code')</th>
            <th>@lang('trans.value')</th>
            <th>@lang('trans.max_uses')</th>
            <th>@lang('trans.uses_count')</th>
            <th>@lang('trans.start_date')</th>
            <th>@lang('trans.end_date')</th>
            <th>@lang('trans.status')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Models as $Model)
        <tr>
            <td>
                <input type="checkbox" class="DTcheckbox" value="{{ $Model->id }}">
            </td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $Model->code }}</td>
            <td>{{ $Model->value }}</td>
            <td>{{ $Model->max_uses }}</td>
            <td>{{ $Model->uses_count }}</td>
            <td>{{ $Model->start_date }}</td>
            <td>{{ $Model->end_date }}</td>
            <td>
                <div class="form-check form-switch">
                    <input
                            type="checkbox"
                            class="form-check-input"
                            id="statusSwitch{{ $Model->id }}"
                            {{ $Model->is_active == 1 ? 'checked' : '' }}
                            data-coupon-id="{{ $Model->id }}"
                            style="width:45%; height:25px; display:block; margin:auto"
                    >
                    <label class="form-check-label" for="statusSwitch{{ $Model->id }}"></label>
                </div>
            </td>
            <td>
                <a href="{{ route('admin.coupons.show', $Model) }}"><i class="fa-solid fa-eye"></i></a>
                <a href="{{ route('admin.coupons.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="{{ route('admin.coupons.destroy', $Model) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection


@section('script')
    <script>
        // Function to toggle status via Ajax
        function toggleStatus(couponId) {
            console.log(couponId);
            $.ajax({
                url: 'coupons/change-status/' + couponId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    // Update the UI or handle the response as needed
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Attach event listener to the switch
        $('.form-check-input').on('change', function () {
            var couponId = $(this).data('coupon-id');
            toggleStatus(couponId);
            console.log(couponId);
        });
    </script>
@stop
