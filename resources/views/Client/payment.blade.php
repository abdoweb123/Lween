@extends('Client.Layout.index')

@section('style')
  <style>
    .icon-delete-circle {
      display: inline-block;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background-color: #ccc;
      text-align: center;
      line-height: 25px;
    }
  </style>
@stop

@section('title')
  @lang('trans.paymentConfirmation')
@stop

@section('content')

  <form action="{{route('Client.storeOrder')}}" method="post">
    @csrf
    <div class="container py-5">
      <div class="row ">
        <ol class="list-inline text-center step-indicator d-flex justify-content-around">
          <li class="active ">
            <a href="{{route('Client.chooseAddressShipping')}}">
              <div class="step border border-2 border-dark  text-black ">
                <span> 1</span>
              </div>
            </a>
            <div class="caption hidden-xs hidden-sm">@lang('trans.address_and_delivery')</div>
          </li>

          <li class="incomplete">
            <div class="step border border-2 border-dark text-white bg-black"><span>2</span></div>
            <div class="caption hidden-xs hidden-sm">@lang('trans.payment_confirmation')</div>
          </li>
        </ol>
      </div>
      <div class="row py-2 ">
        <h6 class="fw-semibold py-2 ">
          @lang('trans.payment_confirmation')
        </h6>
      </div>

      <div class="row gap-5">
        <div class="col-lg-5 col-12">

          <div class="row py-2">
            <p class="mb-0">
              @lang('trans.devices')
            </p>
            @foreach($data['carts'] as $cart)
              <div class="col-12">
                <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center"
                     data-aos="fade-up" data-aos-duration="1000" style="font-size:13px">
                  <div class="col-lg-8 col-8 p-0">
                    <div class="d-flex">
                      <span class="icon-delete-circle">
                            <span class="icon-delete">{{$cart->quantity}}</span>
                        </span>
                      <div class="flex-shrink-0 rounded-0">
                        <img class="w-100 h-100" src="{{asset($cart->Device->header)}}" alt="...">
                      </div>
                      <div class="flex-grow-1 p-3  fw-bold">
                        #{{$cart->device_id}} - {{$cart->Height->title}} - {{$cart->Width['title_'.lang()]}}
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-4 text-price">
                    @if($cart->Device->HasDiscount())
                      <span id="cart-item_{{$cart->id}}" data-has-discount="true" data-cart-id="{{$cart->id}}">
                          <span class="hasDiscount">
                              <span id="price_after_discount_{{$cart->id}}" class="hasDiscount_price cart_final_price">
                                  {{$cart->Device->RealPrice() * $cart->quantity}}
                              </span>
                              {{Country()->currancy_code}}
                          </span>
                      </span>
                    @else
                      <span id="cart-item_{{$cart->id}}" data-has-discount="false" data-cart-id="{{$cart->id}}">
                          <span class="no_discount" id="no_discount_{{$cart->id}}">
                              <span id="no_discount_price_{{$cart->id}}" class="hasDiscount_price cart_final_price">
                                  {{$cart->Device->Price() * $cart->quantity}}
                              </span>
                              {{Country()->currancy_code}}
                          </span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach

          </div>
          <div class="row py-2 ">
            <p class="mb-0">
              @lang('trans.paymentMethod'):
            </p>
            @foreach(payments() as $payment)
              @if($payment->id == 1)
                <div class="col-12 ">
              <div class="row border-1 border border-secondary p-1 rounded-1 my-3">
                <div class="col-12">
                  <div class="form-check">
                    <div class="">
                      <input class="form-check-input px-2" type="radio" name="payment_id" value="{{$payment->id}}" id="flexRadioDefault1" checked>
                      <label class="form-check-label" for="flexRadioDefault1">
                        <img src="{{asset($payment->image)}}" alt=".." style="width: 30px; height: 25px;">
                        <span>{{$payment['title_'.lang()]}}</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              @endif
            @endforeach
          </div>

          <div class="row py-2 ">
            <p class="mb-0">
              @lang('trans.notes')
            </p>

          </div>
          <div class="row">
            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3" style="resize: none;"></textarea>
          </div>
          <div class="row py-2 ">
            <p class="mb-0">
              @lang('trans.exchange_return_policy'):
            </p>

          </div>
          <div class="row border-1 border border-secondary fw-light p-1 rounded-1 my-2 align-items-center">
            <p class="mb-0">
            @lang('trans.exchange_return_policy_desc')
            </p>
          </div>
        </div>
        <div class="col-lg-5 col-12">
          <div class="row py-2 ">
            <p class="mb-0">
              @lang('trans.Order Details'):
            </p>

          </div>
          <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center">
            <div class="col-7">
              @lang('trans.sub_total')
            </div>
            <div class="col-5">
              {{ number_format($data['sub_total'], 2) }} {{Country()->currancy_code}}
            </div>

          </div>
          <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center">
            <div class="col-7">
              @lang('trans.total')
            </div>
            <div class="col-5 fw-bold">
              {{ number_format(($data['total'] + ($data['address']->Region->delivery_cost ?? 0) * Country()->currancy_value), 2) }} {{Country()->currancy_code}}
            </div>

          </div>
          <div class="row py-2 ">
            <p class="mb-0">
              @lang('trans.delivery_to'):
            </p>
          </div>
          <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center">
            <div class="col-12">
              {{$data['address']->Region->Country['title_'.lang()]}},
              {{$data['address']->Region['title_'.lang()]}},
              {{$data['address']->block}},
              {{$data['address']->road}}
            </div>
          </div>
          <div class="row py-2 ">
            <p class="mb-0">
              @lang('trans.delivery_by'):
            </p>

          </div>
          <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center">
            <div class="col-12">
              <span>{{$data['delivery']['title_'.lang()]}}</span>
              <span class="px-2"><i class="fa-solid fa-truck-fast"></i></span>
            </div>
          </div>
        </div>
      </div>
      <div class="row my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-dark w-auto px-5" type="button"
            onclick="document.location='{{route('Client.chooseAddressShipping')}}'">@lang('trans.back')</button>
          <button class="btn btn-dark w-auto px-5" type="submit">@lang('trans.confirm')</button>
        </div>
      </div>
    </div>
  </form>


@stop

@section('script')
  <script>
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

