@extends('Client.layouts.layout')
@section('content')

<div class="container container-fluid mt-5 mb-5">
    <div class="d-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Client.home') }}" class="second_link" >@lang('trans.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('trans.register')</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center">
                <div class="mt-4">
                    <img src="{{ asset(setting('logo')) }}" class="img-fluid footer-logoimg" alt="image">
                </div>
            </div>
           <div class="col-12 col-md-6 d-flex justify-content-center">
                <form action="{{route('Client.register')}}" method="POST" id="register-form" style="width: 400px;">
                    @csrf
                    <div class="header">
                        <h1>@lang('trans.register')</h1>
                    </div>
                    <div class="my-1">
                        <div class="form-group">
                            <label for="name" class="form-label">@lang('trans.name')</label>
                            <input class="form-control" required type="text" id="name" name="name" class="w-100" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">@lang('trans.phone')</label>
                            <input class="form-control" required type="tel" id="phone" name="phone" class="w-100" autocomplete="off" minlength="{{ Country()->length }}" maxlength="{{ Country()->length }}" size="{{ Country()->length }}" />
                            <input type="hidden" id="phone_code" name="phone_code"/>
                            <input type="hidden" id="country_id" name="country_id"/>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">@lang('trans.email')</label>
                            <input class="form-control" required type="email" id="email" name="email" class="w-100" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">@lang('trans.password')</label>
                            <input class="form-control" required type="password" id="password" name="password" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">@lang('trans.confirmPassword')</label>
                            <input class="form-control" required type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" />
                        </div>
                        <input class="btn main_btn w-100 mx-auto my-3" type="button" id="register" value="@lang('trans.register')" />
                    </div>
                    <p>@lang('trans.haveAccount') <a href="{{ route('Client.login') }}" class="second_link">@lang('trans.login')</a></p>
                </form>
           </div>
        </div>
    </div>

</div>


<div class="modal fade" id="Verify" tabindex="-1" aria-labelledby="VerifyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
       <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title">@lang('trans.Verify_phone_number') (WhatsApp)</h5>
          </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="code" class="form-label">@lang('trans.code')</label>
                    <input class="form-control" type="text" id="code" minlength="6" maxlength="6">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('trans.close')</button>
                <button type="button" class="btn px-2 py-1 main_btn" id="verifPhNum">@lang('trans.Submit')</button>
            </div>
       </div>
    </div>
 </div>

@endsection

@push('css')
<link rel="stylesheet" href="https://unpkg.com/intl-tel-input@17.0.3/build/css/intlTelInput.css">
@endpush

@push('js')
<script src="https://unpkg.com/intl-tel-input@17.0.3/build/js/intlTelInput.js"></script>
<script>
    var iti = window.intlTelInput(document.querySelector("#phone"), {
        separateDialCode: true
        , onlyCountries: @json(countries()->pluck('country_code')->toarray())
        , utilsScript: "https://unpkg.com/intl-tel-input@17.0.3/build/js/utils.js"
        , preferredCountries: ["{{ Country()->country_code }}"]
    , });
    window.iti = iti;
    document.querySelector("#phone").addEventListener("countrychange", function() {
        $('#phone').val('');
        dialCode = iti.getSelectedCountryData().dialCode;
        length = 0;
        $.each(@json(countries()), function (key, element) {
            if (element.phone_code.includes(dialCode)) {
                length =  element.length;
                country_id =  element.id;
            }
        });
 
        $('#phone').attr("minlength", length);
        $('#phone').attr("maxlength", length);
        $('#phone').attr("size", length);

        $('#phone_code').val(dialCode);
    })
</script>
<script>
    verified = false;
    code = null;
    $(document).on("click", "#verifPhNum", function (event) {
        if(code == $('#code').val()){
            verified = true;
            $('#register-form').submit();
        }
    });
    $(document).on("click", "#register", function (event) {
        event.preventDefault();
        phone_number = $('#phone_code').val() + $('#phone').val();
        if(verified == false){
            if ($('#name').val().length == 0) {
                toast('error',"{{ __('validation.required',['attribute'=>__('trans.name')]) }}")
            }else if($('#phone').val().length == 0){
                toast('error',"{{ __('validation.required',['attribute'=>__('trans.phone')]) }}")
            }else if($('#email').val().length == 0){
                toast('error',"{{ __('validation.required',['attribute'=>__('trans.email')]) }}")
            }else if($('#password').val().length == 0){
                toast('error',"{{ __('validation.required',['attribute'=>__('trans.password')]) }}")
            }else{
                $('.modal').modal('show');
                if (code) {
                    toast('success',"{{ __('trans.Verify_phone_number') }}");
                }else{
                    $.ajax({
                        url: "/sendotp/"+phone_number,
                        dataType: "json",
                        type: "POST",
                        async: true,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            toast('success',"{{ __('trans.Verify_phone_number') }}");
                            code = data.code;
                        }
                    });
                }
            }
        }else if(verified == true){
            $('#register-form').submit();
        }
    });
</script>
@endpush


