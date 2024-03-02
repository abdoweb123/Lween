@extends('Client.layouts.layout')
@section('content')
<form action="{{ route('Client.submit',request('delivery_id')) }}" method="POST" id="form-submit">
    @csrf

    <div class="bg-ccc py-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mx-2 mt-5 text-start">
                        <a href="{{ route('Client.cart') }}" style="width: max-content;" class="btn third_btn px-3 my-3"><i class="fa-solid fa-angle-left me-1"></i>@lang('trans.back') </a>
                    </div>
                </div>
                <div class="col-xl-8">
                    
                    @if (!auth('client')->check())   
                        <div class="card border shadow-none">
                            <div class="card-body">
                                <h5 class="capital my-2 fw-normal">@lang('trans.Customer Details')</h5>
                                <div class="row">
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="name">@lang('trans.Name')</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name',auth('client')->user()?->name) }}" id="name" required >
                                        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <div class="row position-relative">
                                            <label for="phone">@lang('trans.mobile')</label>
                                            <input type="hidden" name="country_id" value="1">
                                            <input class="form-control" name="phone" value="{{ old('phone',auth('client')->user()?->phone) }}" id="phone" required type="tel" minlength="{{ Country()->length }}" maxlength="{{ Country()->length }}" size="{{ Country()->length }}">
                                            <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="email">@lang('trans.email')</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email',auth('client')->user()?->email) }}" id="email" placeholder="xyz@gmail.com">
                                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @foreach ($Cart as $CartItem)
                    
                    @php($SelectedItem = $CartItem->Device->Items->when($CartItem->item_id, function ($query) use($CartItem) {
                        return $query->where('id', $CartItem->item_id);
                    })->first() ?? $CartItem->Device)
                    @php($CalcPrice = $SelectedItem->CalcPrice())
                    @php($Price = $SelectedItem->Price())
                    @php($CalcPriceWithCurrancy = $SelectedItem->CalcPriceWithCurrancy())
                    
                    <div class="card border shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-start border-bottom pb-3">
                                <div class="me-4">
                                    <img src="{{ asset($CartItem->Device->header) }}" alt="" class="avatar-lg rounded">
                                </div>
                                <div class="flex-grow-1 align-self-center overflow-hidden">
                                    <div>
                                        <h5 class="text-truncate font-size-18 d-flex justify-content-between"><a class="text-dark">{{ $CartItem->Device->title() }}</a> </h5>
                                        @if ($CartItem->Color)
                                        <p class="mb-0 mt-1">@lang('trans.color') : <span class="fw-medium">{{ $CartItem->Color->title() }}</span></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <ul class="list-inline mb-0 font-size-16">
                                        <li class="list-inline-item">
                                            <a href="#" class="text-muted px-1">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-muted px-1">
                                                <i class="mdi mdi-heart-outline"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div>
                                <div class="row">
                                    <div class="col-5 col-md-5">
                                        <div class="mt-3">
                                            <p class="text-muted mb-2">@lang('trans.Price')</p>
                                            <div class="d-flex">@if ($CartItem->Device->HasDiscount()) <small class="text-danger" style="text-decoration: line-through">{{ $Price }}</small> @endif <h5 class="mx-1">{{ $CalcPriceWithCurrancy }}</h5></div>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-3">
                                        <div class="mt-3">
                                            <p class="text-muted mb-2">@lang('trans.Quantity')</p>
                                            <div class="d-inline-flex">
                                                <div class="number">
                                                    <input data-id="{{ $CartItem->id }}" data-price="{{ $CalcPrice }}" data-discount="{{ $Price -  $CalcPrice }}" type="text" class="form-control border-0" value="{{ $CartItem->quantity }}" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-4">
                                        <div class="mt-3">
                                            <p class="text-muted mb-2">@lang('trans.Total')</p>
                                            <h5><span id="total-{{ $CartItem->id }}">{{ format_number($CalcPrice * $CartItem->quantity) }}</span> {{ Country()->currancy_code }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach

                    <div class="mt-5 mt-lg-0">
                        <div class="card border shadow-none" style="text-align: inherit">
                            <div class="card-header bg-transparent border-bottom py-3 px-4">
                                <h5 class="font-size-16 mb-0">
                                    {{ Deliveries()->where('id',request('delivery_id'))->first()->title() }}
                                    @if (request('delivery_id') == 1)
                                        <img src="{{ asset('assets/img/delivery.png') }}" alt="delivery" style="max-width: 50px;margin: 0px 5px">
                                    @elseif (request('delivery_id') == 2)
                                        <img src="{{ asset('assets/img/pickup.png') }}" alt="delivery" style="max-width: 50px;margin: 0px 5px">
                                    @else
                                        <img src="{{ asset('assets/img/instore.png') }}" alt="delivery" style="max-width: 50px;margin: 0px 5px">
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body p-4 pt-2">
                                @if (request('delivery_id') == 1)
                                    @if (auth('client')->check() && auth('client')->user()->Addresses()->count())              
                                        <h5 class="capital my-2 fw-normal">@lang('trans.Select Address')</h5>
                                        <div class="row">
                                            @foreach (auth('client')->user()->Addresses()->get() as $Address)
                                                <div class="col-md-6">
                                                    <input class="form-check-input"  data-price="{{ $Address->Region->delivery_cost *  Country()->currancy_value }}"  step="border: 1px solid;" type="checkbox" name="address_id" id="del-{{ $Address->id }}" value="{{ $Address->id }}">
                                                    <label class="form-check-label" for="del-{{ $Address->id }}">
                                                        <p class="m-0">@lang('trans.region') : {{ $Address->Region->title() }}</p>
                                                        <p class="m-0">@if(Country()->id == 1) @lang('trans.block') @else @lang('trans.district') @endif : {{ $Address->block }}</p>
                                                        <p class="m-0">@if(Country()->id == 1) @lang('trans.road') @else @lang('trans.street') @endif : {{ $Address->road }}</p>
                                                        @if ($Address->building_no)
                                                            <p class="m-0">@lang('trans.building') : {{ $Address->building_no }}</p>
                                                        @endif
                                                        @if ($Address->floor_no)
                                                            <p class="m-0">@lang('trans.floor') : {{ $Address->floor_no }}</p>
                                                        @endif
                                                        @if ($Address->apartment)
                                                            <p class="m-0">@lang('trans.apartment') : {{ $Address->apartment }}</p>
                                                        @endif
                                                        @if ($Address->type)
                                                            <p class="m-0">@lang('trans.type') : {{ $Address->type }}</p>
                                                        @endif
                                                        @if ($Address->additional_directions)
                                                            <p class="m-0">@lang('trans.additional_directions') : {{ $Address->additional_directions }}</p>
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <h5 class="capital my-5 fw-normal">@lang('trans.Or') @lang('trans.add_new')</h5>
                                    @endif

                                    <div class="p-3 pb-5 my-1">
                                        <div class="row mt-1">
                                            <div class="col-12 col-md-6">
                                                <label for="email">@if(Country()->id == 1) @lang('trans.region') @else @lang('trans.region') @endif</label>
                                                <select class="form-control w-100" name="region_id" id="region_id">
                                                    <option selected disable hidden data-price="0" value="">@lang('trans.region')</option>
                                                    @foreach (Country()->Regions()->orderBy('title_'.lang())->get() as $Region)
                                                        <option data-price="{{ $Region->delivery_cost *  Country()->currancy_value }}" value="{{ $Region->id }}">{{ $Region->title() }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">@error('region_id'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="block">@if(Country()->id == 1) @lang('trans.block') @else @lang('trans.district') @endif</label>
                                                <input type="text" class="form-control" name="block" id="block" value="{{ old('block') }}">
                                                <span class="text-danger">@error('block'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="road">@if(Country()->id == 1) @lang('trans.road') @else @lang('trans.street') @endif</label>
                                                <input type="text" class="form-control" name="road" id="road" value="{{ old('road') }}">
                                                <span class="text-danger">@error('road'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="building_no">@lang('trans.Building')</label>
                                                <input type="text" class="form-control" name="building_no" id="building_no" value="{{ old('building_no') }}">
                                                <span class="text-danger">@error('building_no'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="floor_no">@lang('trans.floor_no')</label>
                                                <input type="text" class="form-control" name="floor_no" id="floor_no" value="{{ old('floor_no') }}">
                                                <span class="text-danger">@error('floor_no'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="apartment">@lang('trans.apartment')</label>
                                                <input type="text" class="form-control" name="apartment" id="apartment" value="{{ old('apartment') }}">
                                                <span class="text-danger">@error('apartment'){{ $message }}@enderror</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="type">@lang('trans.flat') @lang('trans.Or') @lang('trans.office')</label>
                                                <input type="text" class="form-control" name="type" id="type" value="{{ old('type') }}">
                                                <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                                            </div>
                
                                            <div class="col-12">
                                                <label for="additional_directions">@lang('trans.additional_directions')</label>
                                                <input type="text" class="form-control" name="additional_directions" id="additional_directions" value="{{ old('additional_directions') }}">
                                                <span class="text-danger">@error('additional_directions'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            @foreach (Branches() as $Branch)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="branch_id" id="del-{{ $Branch->id }}" value="{{ $Branch->id }}" @checked($loop->first)>
                                                    <label class="form-check-label" for="del-{{ $Branch->id }}">{{ $Branch->title() }}</label>
                                                </div>
                                            @endforeach
                                            <span class="text-danger">@error('branch_id'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="mt-5 mt-lg-0">
                        <div class="card border shadow-none" style="text-align: inherit">
                            <div class="card-header bg-transparent border-bottom py-3 px-4">
                                <h5 class="font-size-16 mb-0">@lang('trans.paymentMethod')</h5>
                            </div>
                            <div class="card-body p-4 pt-2">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            @foreach (Payments() as $Payment)
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <img src="{{ asset($Payment->image) }}" alt="payment" style="max-width: 50px;margin: 0px 5px">
                                                        <input class="form-check-input" style="margin-top: 15px;" type="radio" name="payment_id" id="del-{{ $Payment->id }}" value="{{ $Payment->id }}" @checked($loop->first)>
                                                        <label class="form-check-label" for="del-{{ $Payment->id }}">{{ $Payment->title() }}</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 mt-lg-0">
                        <div class="card border shadow-none" style="text-align: inherit">
                            <div class="card-header bg-transparent border-bottom py-3 px-4">
                                <h5 class="font-size-16 mb-0">@lang('trans.order') @lang('trans.Summary')</h5>
                            </div>
                            <div class="card-body p-4 pt-2">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>@lang('trans.sub_total') :</td>
                                                <td class="text-end">{{ Country()->currancy_code }} <span id="sub_total">1</span> </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('trans.Discount') : </td>
                                                <td class="text-end">- {{ Country()->currancy_code }} <span id="discount">1</span> </td>
                                            </tr>
                                            @if (request('delivery_id') == 1)          
                                                <tr>
                                                    <td>@lang('trans.delivery_charge') :</td>
                                                    <td class="text-end">{{ Country()->currancy_code }} <span id="delivery_charge">1</span> </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>@lang('trans.vat') ( {{ setting('vat') }}% ) : </td>
                                                <td class="text-end">{{ Country()->currancy_code }} <span id="vat">1</span> </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <th>@lang('trans.netTotal') :</th>
                                                <td class="text-end">
                                                    <span class="fw-bold">
                                                        {{ Country()->currancy_code }} <span id="netTotal">1</span>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 mt-lg-0">
                        <div class="card border shadow-none" style="text-align: inherit">
                            <button type="submit" id="confirmOrder" class="btn main_btn  w-100 py-3"><i class="fa-regular fa-circle-check me-1"></i> @lang('trans.confirmOrder') </button>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>

</form>
@endsection

@push('css')
    <style>
        .bg-ccc {
            background-color: #f1f3f7;
        }

        .avatar-lg {
            height: auto;
            width: 5rem;
            max-height: 5rem
        }

        .font-size-18 {
            font-size: 18px !important;
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        a {
            text-decoration: none !important;
        }

        .w-xl {
            min-width: 160px;
        }

        .card {
            margin-bottom: 24px;
            -webkit-box-shadow: 0 2px 3px #e4e8f0;
            box-shadow: 0 2px 3px #e4e8f0;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #eff0f2;
            border-radius: 1rem;
        }

        .minus,
        .plus {
            width: 20px;
            background: #f2f2f2;
            border-radius: 4px;
            border: 1px solid #ddd;
            display: inline-block;
            vertical-align: middle;
            text-align: center;
            cursor: pointer;
        }

        .number input {
            height: 34px;
            width: 100px;
            text-align: center;
            font-size: 26px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
            max-width: 51px;
        }
    </style>
@endpush

@if (!auth('client')->check())   
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
            })
        </script>
    @endpush
@endif

@push('js')
    <script>
        $(document).on("change", "#region_id", function () {
            $("input[name='address_id']").prop('checked', false);
            calc();
        });
        function calc(){
            delivery_charge = 0;
            if ($('input[name=address_id]:checked').length) {
                delivery_charge = parseFloat($('input[name=address_id]:checked').attr('data-price'));
            }else{
                delivery_charge = parseFloat($( "#region_id option:selected" ).attr('data-price'));
            }
            if(delivery_charge > 0){
                delivery_charge = delivery_charge;
            }else{
                delivery_charge = 0;
            }

            decimals = {{ Country()->decimals }};
            sub_total = 0;
            discount = 0;
            vat_percentage = {{ setting('vat') }};
            $('.number').each(function(i, obj) {
                total = 0;
                id = parseFloat($(obj).find('input').attr('data-id'));
                quantity = parseFloat($(obj).find('input').val());
                price = parseFloat($(obj).find('input').attr('data-price'));
                discount += parseFloat($(obj).find('input').attr('data-discount')) * parseFloat(quantity);
                total = (parseFloat(price) * parseFloat(quantity));
                $('#total-'+id).html(total.toFixed(decimals));
                sub_total += total;
            });
            vat = sub_total/100*vat_percentage;
            netTotal = sub_total + vat + delivery_charge;
            sub_total += discount;
            $('#sub_total').html(sub_total.toFixed(decimals));
            $('#discount').html(discount.toFixed(decimals));
            $('#vat').html(vat.toFixed(decimals));
            @if (request('delivery_id') == 1)    
                $('#delivery_charge').html(delivery_charge.toFixed(decimals));
            @endif
            $('#netTotal').html(netTotal.toFixed(decimals));
        }
        calc();

        $(document).on("click", "input[name='address_id']", function () {
            value = $(this).prop("checked");
            $("input[name='address_id']").prop('checked', false);
            $(this).prop('checked', value);
            calc();
        });

        if ({{ request('delivery_id') }} == 1) {            
            $(document).on("click", "#confirmOrder", function (event) {
                event.preventDefault();
                if ($('input[name=address_id]:checked').length) {
                    $("#confirmOrder").attr("disabled", true);
                    $('#form-submit').submit();
                }else if( $( "#region_id option:selected" ).val() && $('#block').val().length > 0 && $('#road').val().length > 0){
                    $("#confirmOrder").attr("disabled", true);
                    $('#form-submit').submit();
                }else{
                    toast('error',"{{ __('validation.required',['attribute'=>__('trans.address')]) }}")
                }
            });
        }
    </script>
@endpush