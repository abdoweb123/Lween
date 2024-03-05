@extends('Client.Layout.index')


@section('title')
  @lang('trans.shopping_cart')
@stop

@section('content')

  <div class="container my-5" style="min-height: 60vh;">
    <div class="row  border-bottom">
      <p>
        @lang('trans.Edit Address')
      </p>
    </div>
    <form action="{{route('Client.updateAddress',['id'=>$address->id,'type'=>$type??''])}}" method="post">
{{--    <form action="{{route('Client.updateAddress',$address->id)}}" method="post">--}}
      @csrf
      <div class="row gap-2 my-5 p-2 bg-light">
        <div class="col-5">
          <h6>@lang('trans.country')</h6>
          <select class="option-selected btn-sm w-100 gray-bage border-0 px-2" name="country_id" aria-label="Default select example">
            <option selected value="{{$address->Region->country_id}}">{{$address->Region->Country['title_'.lang()]}}</option>
          </select>
        </div>
        <div class="col-5">
          <h6>@lang('trans.theRegion')</h6>
          <select class="option-selected btn-sm w-100 gray-bage border-0 px-2" name="region_id" aria-label="Default select example">
            <option selected value="{{$address->region_id}}">{{$address->Region['title_'.lang()]}}</option>
          </select>
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.theBlock')
          </h6>
          <input type="text" name="block" class="form-control" value="{{$address->block}}">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.road')
          </h6>
          <input type="text" name="road" class="form-control" value="{{$address->road}}">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.building_no')
          </h6>
          <input type="text" name="building_no" class="form-control" value="{{$address->building_no}}">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.floor_no')
          </h6>
          <input type="text" name="floor_no" class="form-control" value="{{$address->floor_no}}">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.apartmentNo')
          </h6>
          <input type="text" name="apartmentNo" class="form-control" value="{{$address->apartment}}">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.apartmentType')
          </h6>
          <input type="text" name="apartmentType" class="form-control" value="{{$address->type}}">
        </div>
        <div class="col-10">
          <h6>
            @lang('trans.additional_directions')
          </h6>
          <textarea name="additional_directions" rows="4" class="form-control">{{$address->additional_directions}}</textarea>
        </div>
      </div>
      <div class="row my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-dark w-auto px-5" type="submit" href="Purchase.html">@lang('trans.next')</button>
          <button class="btn btn-outline-dark w-auto px-5" type="button"
                  onclick="document.location='{{ route('Client.chooseAddressShipping') }}'">@lang('trans.cancel')</button>
        </div>
      </div>
    </form>
  </div>

@stop


@section('script')
  <script>
    $("#example-basic").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      autoFocus: true
    });
  </script>

  <script>
    // Disable select elements after page has loaded
    document.addEventListener('DOMContentLoaded', function() {
      var selects = document.querySelectorAll('.option-selected');
      selects.forEach(function(select) {
        select.addEventListener('mousedown', function(event) {
          event.preventDefault(); // Prevent default dropdown behavior
        });
      });
    });
  </script>
@stop
