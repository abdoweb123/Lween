@extends('Client.Layout.index')

@section('style')
  <style>
    #disabled_send{
      background-color: var(--mainColor1);
      opacity: 20%;
      cursor: pointer;
    }
  </style>
@stop

@section('title')
  @lang('trans.address_and_delivery')
@stop

@section('content')
  <div class="container py-5">
    <div class="row ">
      <ol class="list-inline text-center step-indicator d-flex justify-content-around">
        <li class="active ">
          <div class="step border border-2 border-dark bg-black text-white"><span>1</span></div>
          <div class="caption hidden-xs hidden-sm">@lang('trans.address_and_delivery')</div>
        </li>
        <li class="incomplete hover-step">
          <a href="javascript:void(0);" onclick="document.getElementById('paymentConfirmation').submit();">
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
    <form action="{{route('Client.paymentConfirmation')}}" id="paymentConfirmation" method="post">
      @csrf
      <div class="row gap-3 address py-2">
        <div id="address_{{$address->id}}" class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
          <div class=" position-absolute d-icon">
            @if(count($address->Orders) == 0)
            <span class="p-2">
                <a href="#delete" onclick="confirmDelete({{$address->id}})">
                  <i class="fa-solid fa-trash"></i>
                </a>
            </span>
            @endif

            <span class="p-2">
              <a href="{{route('Client.editAddress',$address->id)}}">
                 <i class="fa-solid fa-pen"></i>
              </a>
            </span>
          </div>
          <p class="mt-3"><span class="text-secondary px-2">@lang('trans.country'): </span><span>{{$address->Region->Country['title_'.lang()]}}</span></p>
          <p><span class="text-secondary px-2">@lang('trans.theRegion'): </span><span>{{$address->Region['title_'.lang()]}}</span></p>
          <p><span class="text-secondary px-2">@lang('trans.theBlock'): </span><span>{{$address->block}}</span></p>
          <p><span class="text-secondary px-2">@lang('trans.road'):</span><span>{{$address->road}}</span></p>
        </div>
        <div class="col-lg-3 col-8 py-3" onclick="document.location='{{route('Client.addNewAddress')}}'" style="min-height: 200px;">
          <span><i class="fa-solid fa-plus"></i></span>
          @lang('trans.add_new_address')
        </div>
    </div>
      <div class="row py-2 ">
        <p>
          @lang('trans.select_delivery_companies')
        </p>
        @foreach(Deliveries() as $delivery)
          <div class="col-12 ">
            <div class="row border-1 border border-secondary p-1 rounded-1 my-2">
              <div class="col-6">
                <div class="form-check">
                  <div class="">
                    <input class="form-check-input px-2" type="radio" value="{{$delivery->id}}" name="delivery_id" {{$delivery->id == 1 ? 'checked' : ''}}>
                    <label class="form-check-label">
                      @if($delivery->id == 1)
                        <span class="px-2"><i class="fa-solid fa-truck-fast"></i></span>
                      @else
                        <span class="px-2"><i class="fa-solid fa-shop"></i></span>
                      @endif
                      <span>{{$delivery['title_'.lang()]}}</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <span>@lang('trans.shipping_price'):</span>
                  <span class="px-2">
                    @if($delivery->id == 1)
                      {{ number_format($address->Region->delivery_cost * Country()->currancy_value, 2, '.', '') }}
                    @else
                      00
                    @endif
                  </span>
                  {{Country()->currancy_code}}
              </div>
            </div>
          </div>
        @endforeach

      </div>
      <div class="row my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-dark w-auto px-5" type="button" onclick="document.location='{{route('Client.continuePurchasingCart')}}'">@lang('trans.theBack')</button>
          @isset($address)
            <button class="btn btn-dark w-auto px-5" type="submit">@lang('trans.next')</button>
          @else
            <button class="btn btn-dark w-auto px-5" id="disabled_send" type="button" onclick="chooseAddress()">
              @lang('trans.next')
            </button>
          @endisset

        </div>
      </div>
    </form>

  </div>
@stop


@section('script')
{{--  confirm delete address --}}
<script>
    function confirmDelete(addressId) {
      Swal.fire({
        title: '{{__('trans.confirmDelete')}}',
        // text: 'Are you sure you want to delete this address?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{__('trans.yes')}}',
        cancelButtonText: '{{__('trans.no')}}',
      }).then((result) => {
        if (result.isConfirmed) {
          // Send AJAX request to delete the address
          $.ajax({
            type: 'POST',
            url: '{{ route("Client.deleteAddress") }}',
            data: {
              address_id: addressId,
              _token: '{{ csrf_token() }}'
            },
            success: function (response) {
              // If deletion is successful, remove the HTML element
              $('#address_' + addressId).remove();
              Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success'
              });
            },
            error: function (xhr, status, error) {
              console.error('Error:', error);
              Swal.fire({
                title: 'Error',
                text: '{{__('trans.somethingWrong')}}',
                icon: 'error'
              });
            }
          });
        }
      });
    }
  </script>

{{--  --}}
<script>
    function chooseAddress(){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{__('trans.choose_address_plz')}}',
      });
  }
</script>


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
      $('input[name="delivery_type"]').change(function () {
        $('.row').removeClass('shadow');
        if ($(this).is(':checked')) {
          $(this).closest('.row').addClass('shadow');
        }
      });
    });
    $(document).ready(function () {
      $('input[name="delivery_type"]').change(function () {
        $('.row').removeClass('shadow');
        if ($(this).is(':checked')) {
          $(this).closest('.row').addClass('shadow');
        }
      });

      // Trigger the change event on page load
      $('input[name="delivery_type"]:checked').trigger('change');
    });
  </script>
@stop

