@extends('Client.Layout.index')

@section('title')
  @lang('trans.otp')
@stop

@section('style')

  <style>
    .resend{
      display: none;
    }
  </style>

  @stop


@section('content')

  <div class="loading-screen position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
  </div>

  <div class="container-fluid section-top " style="min-height: 79vh;">
    <div class="row justify-content-center  py-5">
      <div class="col-lg-4 col-12">
        <h3 class="py-3 fs-5">
           @lang('trans.confirmPhone')
        </h3>
              <div class="accordion-body">
  <P class="fs-6 fw-light">
    @lang('trans.we_send_message_whatsApp_check')
  </P>
  <form action="{{url('verifyOtp/'.encrypt($id))}}" method="post" class="text-center mb-3">
    @csrf
    <input type="text" name="verify_code" class="form-control" required>
    <button type="submit" class="bg-black fw-light text-white border-0 w-100 text-center fw-bold fs-6 py-2 my-4 rounded ">
      @lang('trans.send')
    </button>

    <div class="otp">@lang('trans.we_are_sending_code_through')
      <span class="counter">60</span>
      <span> @lang('trans.second')</span>
    </div>

    <div class="bg-black fw-light text-white border-0 w-100 text-center fw-bold fs-6 py-2 my-4 rounded resend">
      <a href="javascript:;" style="color: white !important;"
         class="text-secondary fw-normal text-decoration-none">@lang('trans.resend_verification_code')
      </a>
    </div>
  </form>

{{--  <button type="button" class="bg-black fw-light text-white border-0 w-100 text-center fw-bold fs-6 py-2 my-4 rounded resend"--}}
{{--  >--}}
{{--  @lang('trans.resend_verification_code')--}}
{{--  </button>--}}





</div>

      </div>


    </div>
  </div>


@stop


@section('script')

{{-- if wrong happend with OTP --}}
  @if (session('wrong'))
    <script>
      Swal.fire({
        title: '@lang('trans.invalidOtp')!',
        text: '@lang('trans.wrongOtp')',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    </script>
  @endif



  <script>
    var counterElement = document.querySelector('.counter');
    var count = 60;
    function updateCounter() {
      counterElement.textContent = count;
      count--;
      if (count < 0) {
        clearInterval(intervalId);
        $(document).ready(() => {
          $(".otp").fadeOut(100, function(){
            $(".resend").fadeIn(1000)
          });
        });

      }
    }

    var intervalId = setInterval(updateCounter, 1000);


    // To resend verify_code
    $('.resend').css('pointer-events', 'all')
    $('.resend').on('click',function(){
      var getUrl = window.location.href.split('/');
      var client_id = getUrl[4];
      //  console.log(client_id)
      var div = $(this);
      var token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url: '{{route('Client.resend_otp')}}',
        type: "POST",
        data: {
          ssh: client_id,
          _token: token
        },
        headers: {
          'X-CSRF-TOKEN': token
        },
        success: function(response) {
          // Handle the response
          // console.log(response);
          div.css('pointer-events', 'none');
        },
        error: function(xhr, status, error) {
          // Handle errors
          // console.log(5)
          console.error(xhr.responseText);
        }
      })
    })
  </script>
@stop



