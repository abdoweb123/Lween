@extends('Client.Layout.index')

@section('title')
  @lang('trans.allProducts')
@stop

@section('content')
  <div class="container  section-top">
    <div class="row align-items-center">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-5">
          <li class="breadcrumb-item"><a href="{{route('Client.home')}}">@lang('trans.MainPage')
            </a></li>
          <li class="breadcrumb-item" aria-current="page">@lang('trans.allProducts')</li>
        </ol>
      </nav>
    </div>
  </div>

{{--  <div class="gray-bage">--}}
{{--    <div class="container py-5">--}}
{{--      <div class="row ">--}}
{{--        <h3>{{$categoryProducts['title_'.lang()]}}</h3>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
  <div class="container my-5">
    <div class="row justify-content-between align-items-center">
      <div class="col-md-7  col-12 ">
        <div class="row ">
          <div class="col-lg-5 col-6 mb-4">
            <h6>
             @lang('trans.filter_results')
            </h6>

            <button type="button" class="btn btn-outline-dark px-4 " data-bs-toggle="modal" data-bs-target="#filter"
                    role="group" aria-label="Basic outlined example">
              <span>
                @lang('trans.filter_results')
              </span>
              <span>
                <i class="fa-solid fa-filter"></i>
              </span>
            </button>

          </div>
          <div class="col-lg-5 col-6 mb-4">
            <h6>@lang('trans.sort_by')
            </h6>
            <select class="form-select w-auto border border-dark px-4" aria-label="Default select example" id="selectOptionSortBy">
              <option value="{{route('Client.allProducts',['searchBy'=>'newest'])}}" {{ $searchBy == 'newest'? 'selected' : '' }}>@lang('trans.newest')</option>
              <option value="{{route('Client.allProducts',['searchBy'=>'most_popular'])}}" {{ $searchBy == 'most_popular'? 'selected' : '' }}>@lang('trans.most_popular')</option>
              <option value="{{route('Client.allProducts',['searchBy'=>'lowest_price'])}}" {{ $searchBy == 'lowest_price'? 'selected' : '' }}>@lang('trans.lowest_price')</option>
              <option value="{{route('Client.allProducts',['searchBy'=>'highest_price'])}}" {{ $searchBy == 'highest_price'? 'selected' : '' }}>@lang('trans.highest_price') </option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-12 d-flex justify-content-md-end">
        <p>
          @if(lang() == 'en')
            <span class="fw-bold"> {{ ' '.count($products).' ' }} </span>
            <span>@lang('trans.product_n') </span>
            <span>  @lang('trans.was_found')</span>

          @else
            @lang('trans.was_found')
            <span class="fw-bold"> {{ count($products)  }} </span>
            @lang('trans.product_n')
          @endif
        </p>
      </div>
    </div>


    <div class="row regular ">
      @foreach($products as $product)
        <div class=" p-3 col-lg-3 col-md-4 col-6">
          <a href="{{ route('Client.devices.details', $product->id) }}">
          <div class="card border-0 news-card position-relative">
            <div class="img-card d-flex align-items-center">
              <img class="w-100 h-auto" src="{{asset($product->header)}}" />
            </div>
            <div class="card-body text-center">
              <h6 class="text-dark fw-semibold">
                <a>{{$product->id}}</a>
              </h6>
              <p class="card-text fs-6 mb-0 fw-bold">
                @if($product->HasDiscount())
                  <span style="text-decoration: line-through; display:block;">{{$product->Price()}} {{Country()->currancy_code}}</span>
                  <span>{{$product->PriceWithCurrancy()}}</span>
                @else
                  <span style="display:block; visibility: hidden;">...</span>
                  <span>{{$product->price}}</span> {{Country()->currancy_code}}
                @endif
              </p>
              <p class="card-text fs-6 text-secondary fw-semibold">
                @lang('trans.available_in_multiple_options')
              </p>
              <button class="bg-black rounded-1 text-white fs-6  p-2 w-75 ">
                @lang('trans.Add to cart')
              </button>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>

  <div class="modal fade " id="filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="container">

              <div class="row gap-2 fs-6">

                <div class="col-5">
                  <h6>
                    من
                  </h6>
                  <input type="number" class="form-control" id="from" aria-describedby="emailHelp">

                </div>
                <div class="col-5">
                  <h6>الي </h6>
                  <input type="number" class="form-control" id="to" aria-describedby="emailHelp">
                </div>
                <div class="col-5">
                  <div class="py-2 my-2">
                    <input type="checkbox" id="check2" name="check2">
                    <label for="check2"> عرض التخفضيات كلها
                    </label>

                  </div>


                </div>
              </div>
            </div>
            <div class="modal-footer ">
              <button type="reset" class="btn gray-bage border-0">مسح</button>
              <button type="submit" class="btn gray-bage border-0 px-5">بحث</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
@stop


@section('script')
  <script>
    document.getElementById('selectOptionSortBy').addEventListener('change', function() {
      var selectedOption = this.value;
      if (selectedOption) {
        window.location.href = selectedOption;
      }
    });
  </script>
@stop
