@extends('Admin.layout')
@section('pagetitle', __('trans.products'))
@section('content')
    <form action="{{ route('admin.branch.category.products.update',['branch' => $Branch ,'category' => $Category ]) }}" method="POST">
        @csrf
        <table class="table dataTable data-table" id="DataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
                    <th>@lang('trans.title_ar')</th>
                    <th>@lang('trans.title_en')</th>
                </tr>
            </thead>
            <tbody class="text-center" data-table="products">
                @foreach($Products as $Product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><input type="checkbox" @checked($Branch->products->pluck('id')->contains($Product->id)) class="DTcheckbox" value="{{ $Product->id }}" name="products[]"></td>
                        <td><a>{{ $Product->title_ar }}</a></td>
                        <td><a>{{ $Product->title_en }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
        <div class="col-12 my-4">
            <div class="button-group">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </form>
@endsection
