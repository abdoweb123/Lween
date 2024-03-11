@extends('Admin.layout')

@section('pagetitle', __('trans.products'))
@section('content')

<div class="row">
    <div class="my-2 col text-sm-start">
        <a href="{{ route('admin.products.create') }}" class="main-btn">@lang('trans.add_new')</a>
    </div>
    <div class="my-2 col text-sm-start">
        <a href="{{ route('admin.products.new_arrivals') }}" class="btn btn-dark">@lang('trans.new_arrivals')</a>
    </div>
    <div class="my-2 col text-sm-start">
        <a href="{{ route('admin.products.mostselling') }}" class="btn btn-success">@lang('trans.mostselling')</a>
    </div>
    <div class="my-2 col text-sm-start">
        <a href="{{ route('admin.products.featured') }}" class="btn btn-warning">@lang('trans.featured')</a>
    </div>
    <div class="my-2 col text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('products')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
    </div>
</div>
<table class="table table-bordered" >
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
            <th>@lang('trans.price')</th>
            <th>@lang('trans.title')</th>
            <th>@lang('trans.most_popular')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Products as $Model)
        <tr>
            <td>
                <input type="checkbox" class="DTcheckbox" value="{{ $Model->id }}">   {{ $loop->iteration }}
            </td>
            <td>@if ($Model->HasDiscount()) <small class="text-danger" style="text-decoration: line-through">{{ $Model->Price() }}</small> @endif <h5 class="mx-1">{{ $Model->CalcPriceWithCurrancy() }}</h5></td>
            <td><a href="{{ route('admin.products.show', $Model) }}">{{ $Model->title() }}</a></td>
            <td>
                <div class="form-check form-switch">
                    <input
                            type="checkbox"
                            class="form-check-input"
                            id="statusSwitch{{ $Model->id }}"
                            {{ $Model->most_popular == 1 ? 'checked' : '' }}
                            data-product-id="{{ $Model->id }}"
                            style="width:45%; height:25px; display:block; margin:auto"
                    >
                    <label class="form-check-label" for="statusSwitch{{ $Model->id }}"></label>
                </div>
            </td>
            <td>
                <a href="{{ route('admin.products.gallery', ['product_id'=>$Model]) }}"><i class="fa-regular fa-images"></i></a>
                <a href="{{ route('admin.products.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="{{ route('admin.products.destroy', $Model) }}">
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
{{ $Products->links() }}

@endsection


@section('script')
    <script>
        // Function to toggle status via Ajax
        function toggleStatus(productId) {
            $.ajax({
                url: 'products/change-most-popular/' + productId,
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
            var productId = $(this).data('product-id');
            toggleStatus(productId);
            console.log(productId);
        });
    </script>
@stop
