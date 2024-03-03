@extends('Client.Layout.index')


@section('title')
  @lang('trans.shopping_cart')
@stop

@section('content')
  <div class="container py-5">
    <div class="row ">
      <ol class="list-inline text-center step-indicator d-flex justify-content-around">
        <li class="active ">
          <div class="step border border-2 border-dark bg-black  text-white "><span>1</span></div>
          <div class="caption hidden-xs hidden-sm">@lang('trans.address_and_delivery')</div>
        </li>
        <li class="incomplete hover-step">
          <a href="payment.html">
            <div class="step border border-2 border-secondary text-secondary"><span>2</span></div>
          </a>
          <div class="caption hidden-xs hidden-sm">@lang('trans.payment_confirmation')</div>
        </li>
      </ol>
    </div>
    <div class="row py-2 ">
      <h6 class="fw-semibold py-2 ">
        @lang('trans.address_and_delivery')
      </h6>
      <p>
        @lang('trans.choose_your_address')

      </p>
    </div>

    <div class="row gap-3 address py-2">
        @foreach($addresses as $address)
            <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
              <div class=" position-absolute d-icon">

                <span class="p-2">
                   <a href="#delete">
                      <i class="fa-solid fa-trash"></i>
                  </a>
                </span>

                <span class="p-2">
                  <a href="editAdress.html">
                     <i class="fa-solid fa-pen"></i>
                  </a>
                </span>

              </div>
              <p><span class="text-secondary px-2">@lang('trans.country'): </span><span>{{$address->Region->Country['title_'.lang()]}}</span></p>
              <p><span class="text-secondary px-2">@lang('trans.theRegion'): </span><span>{{$address->Region['title_'.lang()]}}</span></p>
              <p><span class="text-secondary px-2">@lang('trans.block'): </span><span>{{$address->block}}</span></p>
              <p><span class="text-secondary px-2">@lang('trans.road'):</span><span>{{$address->road}}</span></p>
            </div>
        @endforeach
        <div class="col-lg-3 col-8 py-3" onclick="document.location='{{route('Client.addNewAddress')}}'" style="min-height: 200px;">
          <span><i class="fa-solid fa-plus"></i></span>
          @lang('trans.add_new_address')
        </div>
    </div>
  {{--<div class="row py-2">
        <p>
          المنتجات
        </p>
        <div class="col-12">
          <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center " data-aos="fade-up"
               data-aos-duration="1000">
            <div class="col-lg-7 col-6">
              <div class="d-flex">
                <div class="flex-shrink-0 rounded-0">
                  <img class="w-100 h-100" src="assets/imgs/b4.jpeg" alt="...">
                </div>
                <div class="flex-grow-1 p-3  fw-bold">
                  2369 - 46.0 - XS ( ١٩ انش )
                </div>
              </div>
            </div>

            <div class="col-lg-5 col-6 text-price">
              3,300.00 AED
            </div>
          </div>
        </div>
      </div>
    --}}
    <div class="row py-2 ">
      <p>
        اختر احد شركات التوصيل:
      </p>
      <div class="col-12 ">
        <div class="row border-1 border border-secondary p-1 rounded-1 my-2">
          <div class="col-6">
            <div class="form-check">
              <div class="">
                <input class="form-check-input px-2" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                       checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  <span class="px-2"><i class="fa-solid fa-truck-fast"></i></span>
                  <span>توصيل الي المنزل</span>
                </label>
              </div>
            </div>
          </div>
          <div class="col-6">
            <span>سعر الشحن:</span><span class="px-2">00</span>
          </div>
        </div>
      </div>
      <div class="col-12 ">
        <div class="row border-1 border border-secondary p-1 rounded-1 my-2">
          <div class="col-6">
            <div class="form-check">
              <div class="">
                <input class="form-check-input px-2" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                <label class="form-check-label" for="flexRadioDefault3">
                  <span class="px-2"><i class="fa-solid fa-shop"></i></span>
                  <span>استلام من المحل</span>
                </label>
              </div>
            </div>
          </div>
          <div class="col-6">
            <span>سعر الشحن:</span><span class="px-2">00</span>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-5">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-dark w-auto px-5" type="button" onclick="document.location='cart.html'">رجوع</button>
        <button class="btn btn-dark w-auto px-5" type="button"
                onclick="document.location='payment.html'">التالي</button>
      </div>
    </div>
  </div>
@stop


@section('script')
  <script>
    const selectedAddress = document.querySelectorAll('.address div');

    selectedAddress.forEach(selectedDiv => {
      selectedDiv.addEventListener('click', function () {
        selectedAddress.forEach(btn => {
          if (btn !== selectedDiv) {
            btn.classList.remove('active');
          }
        });
        this.classList.toggle('active');
      });
    });


    $(document).ready(function () {
      $('input[name="flexRadioDefault"]').change(function () {
        $('.row').removeClass('shadow');
        if ($(this).is(':checked')) {
          $(this).closest('.row').addClass('shadow');
        }
      });
    });
    $(document).ready(function () {
      $('input[name="flexRadioDefault"]').change(function () {
        $('.row').removeClass('shadow');
        if ($(this).is(':checked')) {
          $(this).closest('.row').addClass('shadow');
        }
      });

      // Trigger the change event on page load
      $('input[name="flexRadioDefault"]:checked').trigger('change');
    });
  </script>
@stop

