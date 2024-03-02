@extends('Client.layouts.layout')
@section('content')

<div class="container container-fluid mt-5 mb-5">
    <div class="d-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Client.home') }}" class="second_link">@lang('trans.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('trans.login')</li>
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
                <form action="{{route('Client.login')}}" method="POST" style="width: 400px;">
                    @csrf
                    <div>
                        <h1>@lang('trans.login')</h1>
                    </div>
                    <div class="my-1">
                        <div class="form-group">
                            <label for="phone" class="form-label">@lang('trans.phone')</label>
                            <input type="tel" name="phone" id="phone" class="form-control w-100" minlength="{{ Country()->length }}" maxlength="{{ Country()->length }}" size="{{ Country()->length }}" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">@lang('trans.password')</label>
                            <input type="password" name="password" class="form-control"  placeholder="@lang('trans.password')" autocomplete="off" />
                        </div>
                        <div class="form-group d-flex justify-content-between my-2">
                            <label class="checkbox-wrap checkbox-primary"><input type="checkbox" class="mx-1" checked>@lang('trans.remember')</label>
                            <a href="{{ route('Client.forget') }}" class="second_link">@lang('trans.forgetPassword')</a>
                        </div>
                        <input class="btn main_btn w-100 mx-auto my-3" type="submit" value="@lang('trans.login')" />
                    </div>
                    <p>@lang('trans.dontHaveAccount') <a href="{{ route('Client.register') }}" class="second_link my-2">@lang('trans.register')</a></p>
                </form>
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
        @json(countries()).forEach(element => element.phone_code.includes(dialCode) ? (length =  element.length) : 0 );
 
        $('#phone').attr("minlength", length);
        $('#phone').attr("maxlength", length);
        $('#phone').attr("size", length);
    })
</script>
@endpush