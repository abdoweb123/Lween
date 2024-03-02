@extends('Admin.layout')
@section('pagetitle', $Branch->title())
@section('content')
    <table class="table dataTable data-table" id="DataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('trans.title_ar')</th>
                <th>@lang('trans.title_en')</th>
                <th>@lang('trans.image')</th>
            </tr>
        </thead>
        <tbody class="text-center" data-table="categories">
            @foreach($Categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('admin.branch.categories',['branch' => $Branch ,'category' => $category ]) }}">{{ $category->title_ar }}</a></td>
                <td><a href="{{ route('admin.branch.categories',['branch' => $Branch ,'category' => $category ]) }}">{{ $category->title_en }}</a></td>
                <td><a href="{{ route('admin.branch.categories',['branch' => $Branch ,'category' => $category ]) }}"><img src="{{ asset($category->image ?? setting('logo')) }}" style="height:100px;border:0"></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
