@extends('Client.Layout.index')


@section('title')
  @lang('trans.shopping_cart')
@stop

@section('content')


  <div class="container my-5" style="min-height: 60vh;">


  
    <div class="row  border-bottom">
      <p>
        @lang('trans.add_new_address')
      </p>
    </div>



    <form action="{{route('Client.storeAddress')}}" method="post">
      @csrf
      <div class="row gap-2 my-5 p-2 bg-light">
        <div class="col-5">
          <h6>@lang('trans.country')</h6>
          <select class="btn-sm w-100 gray-bage border-0 px-2" name="country_id" disabled aria-label="Default select example">
            <option selected value="{{session()->get('addressCountry')['id'] ?? Country()['id']}}">{{session()->get('addressCountry')['title_'.lang()] ?? Country()['title_'.lang()]}}</option>
          </select>
        </div>
        <div class="col-5">
          <h6>@lang('trans.theRegion')</h6>

          <select class="btn-sm w-100 gray-bage border-0 px-2" name="region_id" disabled aria-label="Default select example">
            <option selected value="{{session()->get('addressRegion')['id'] ?? Region()['id']}}">{{session()->get('addressRegion')['title_'.lang()] ?? Region()['title_'.lang()]}}</option>
          </select>
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.TheBlock')
          </h6>
          <input type="text" name="block" class="form-control">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.road')
          </h6>
          <input type="text" name="road" class="form-control">
        </div>
        <div class="col-5">
          <h6>
          @lang('trans.building_no')
          </h6>
          <input type="text" name="building_no" class="form-control">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.floor_no')
          </h6>
          <input type="text" name="floor_no" class="form-control">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.apartmentNo')
          </h6>
          <input type="text" name="apartmentNo" class="form-control">
        </div>
        <div class="col-5">
          <h6>
            @lang('trans.apartmentNo')
          </h6>
          <input type="text" name="apartmentType" class="form-control">
        </div>
      </div>
      <div class="row my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <a class="btn btn-dark w-auto px-5" type="button" href="Purchase.html">التالي</a>
          <button class="btn btn-outline-dark w-auto px-5" type="button"
            onclick="document.location='Purchase.html'">الغاء</button>
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
@stop