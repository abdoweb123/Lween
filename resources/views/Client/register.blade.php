@extends('Client.Layout.index')

@section('title')
  @lang('trans.register')
@stop

@section('content')
<div class="loading-screen position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
  <i class="fa fa-spinner fa-spin fa-5x"></i>
</div>
<div id="icons">
</div>

<div class="container-fluid section-top " style="min-height: 79vh;">
  <div class="row justify-content-center  py-5">
    <div class="col-lg-4 col-12">
      <h3 class="py-3 fs-5">
        @lang('trans.registerNewAccount')
      </h3>
      <div class="accordion-body">
        <P class="fs-6 fw-light">
         @lang('trans.enterDataCorrectly_sendWhatsAppMessage')
        </P>
        <form action="{{route('Client.register')}}" method="post" class="text-center">
          @csrf
          <input type="text" name="name" class="form-control mb-3" value="{{old('name')}}" placeholder="@lang('trans.name')" required>
          <input type="email" name="email" class="form-control mb-3" value="{{old('email')}}" placeholder="@lang('trans.email')">
          <input type="password" name="password" class="form-control mb-3" placeholder="@lang('trans.password')" required>
          <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="@lang('trans.confirmPassword')" required>
          <div class="row mb-3">
            <div class="col col-8 col-md-9">
              <input type="tel" name="phone" placeholder="5xxxxxxxx" value="{{old('phone')}}" class="form-control" required>
            </div>
            <div class="col col-4 col-md-3">
              <select data-v-0c38eff6="" required="required" class="form-control" name="country_code">
                @foreach(Countries() as $key => $country)
                  <option value="{{$country->country_code}}">{{$country->phone_code}} ({{$country['title_'.lang()]}})</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="bg-black fw-light text-white border-0 w-100  fw-bold fs-6 py-2 my-4 rounded">
            @lang('trans.log_in')
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop

