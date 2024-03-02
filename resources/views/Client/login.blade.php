@extends('Client.Layout.index')

@section('title')

  @lang('trans.login')

@stop

@section('content')
  <div class="loading-screen position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
  </div>

  <div class="container-fluid section-top " style="min-height: 79vh;">
    <div class="row justify-content-center  py-5">
      <div class="col-lg-4 col-12">
        <div class="w-100 py-3 d-flex align-items-center justify-content-between fs-5">
          <h3 class="" >
            @lang('trans.login')
          </h3>
          <h3 class="fs-6 text-decoration-underline mb-0 mt-2" style="color: #0909e3; font-size: 17px !important;">
            <a href="{{route('Client.register')}}" class="text-secondary">
              @lang('trans.registerNewUser')
            </a>
          </h3>
        </div>
        <div class="accordion border-0 accordion-flush" id="accordionFlushExample">
          <div class="accordion-item border-0">
            <h2 class="accordion-header">
              <a class="accordion-button collapsed bg-black text-white my-2 w-100 p-3 rounded d-flex align-items-center phoneButton"
                 type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                 aria-controls="flush-collapseOne">
                <span class="px-2">
                  <i class="fa-solid fa-mobile-screen"></i>
                </span>
                <span class="fw-bold fs-6 ">
                  @lang('trans.withPhone')
                </span>
              </a>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <P class="fs-6 fw-light">
                 @lang('trans.to_sign_in_add_your_mobile_text_message')
                </P>
                <form action="{{route('Client.login')}}" method="post" class="text-center">
                  @csrf
                  <div class="row mb-3">
                    <div class="col col-8 col-md-9">
                      <input type="tel" name="phone" placeholder="5xxxxxxxx" class="form-control" required>
                    </div>
                    <div class="col col-4 col-md-3">
                      <select data-v-0c38eff6="" required="required" class="form-control" name="country_code">
                        @foreach(Countries() as $key => $country)
                           <option value="{{$country->country_code}}">{{$country->phone_code}} ({{$country['title_'.lang()]}})</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-12">
                      <input type="password" placeholder="@lang('trans.password')" name="password" class="form-control" required min="6">
                    </div>
                  </div>
                  <button type="submit" class="bg-black fw-light text-white border-0 w-100  fw-bold fs-6 py-2 my-4 rounded">
                    @lang('trans.log_in')
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="accordion-item border-0">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed bg-black text-white  my-2 w-100 p-3 rounded d-flex align-items-center emailButton"
                      type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                      aria-controls="flush-collapseTwo">
                <span class="px-2">
                  <i class="fa-solid fa-envelope-open-text"></i>
                </span>
                <span class="fw-bold fs-6 ">
                    @lang('trans.withEmail')
                </span>
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <P class="fs-6 fw-light">
                  @lang('trans.to_sign_in_add_your_email_text_message')
                </P>
                <form action="{{route('Client.login')}}" method="post" class="text-center">
                  @csrf
                  <input type="email" name="email" class="form-control direction mb-2" placeholder="email@example.com" required>
                  <input type="password" name="password" class="form-control direction" min="6" placeholder="password" required>
                  <button type="submit" class="bg-black fw-light text-white border-0 w-100  fw-bold fs-6 py-2 my-4 rounded">
                    @lang('trans.log_in')
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop


@section('script')

@stop