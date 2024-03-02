@extends('Client.layouts.layout')
@section('content')

@if ($Cart->count())
    <form action="{{ route('Client.confirm') }}" method="POST">
        @csrf

        <div class="bg-ccc py-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">

                        @foreach ($Cart as $CartItem)       
                            @php($SelectedItem = $CartItem->Device->Items->when($CartItem->item_id, function ($query) use($CartItem) {
                                return $query->where('id', $CartItem->item_id);
                            })->first() ?? $CartItem->Device)
                            @php($CalcPrice = $SelectedItem->CalcPrice())
                            @php($Price = $SelectedItem->Price())
                            @php($CalcPriceWithCurrancy = $SelectedItem->CalcPriceWithCurrancy())
                            
                            <div class="card border shadow-none" id="cart-{{ $CartItem->id }}">
                                <div class="card-body">
                                    <i class="fa-solid fa-circle-xmark text-danger position-absolute h4 point" style="right: 10px;top: 10px;" data-id="{{ $CartItem->id }}"></i>
                                    <div class="d-flex align-items-start border-bottom pb-3">
                                        <div class="me-4">
                                            <img src="{{ asset($CartItem->Device->header) }}" alt="" class="avatar-lg rounded">
                                        </div>
                                        <div class="flex-grow-1 align-self-center overflow-hidden">
                                            <div>
                                                <h5 class="text-truncate font-size-18 d-flex justify-content-between"><a href="{{ route('Client.device',$CartItem->Device) }}" class="text-dark">{{ $CartItem->Device->title() }}</a> </h5>
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
                                            <div class="col-4 col-md-4">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2">@lang('trans.Price')</p>
                                                    <div class="">@if ($CartItem->Device->HasDiscount()) <small class="text-danger" style="text-decoration: line-through">{{ $Price }}</small> @endif {{  $CalcPriceWithCurrancy  }}</div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-5">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2">@lang('trans.Quantity')</p>
                                                    <div class="d-inline-flex">
                                                        <div class="number d-flex align-items-center">
                                                            <span data-id="{{ $CartItem->id }}" class="minus">-</span>
                                                            <input data-price="{{ $CalcPrice }}" data-id="{{ $CartItem->id }}" data-discount="{{ $Price -  $CalcPrice }}" type="text" class="form-control border-0" value="{{ $CartItem->quantity }}" readonly />
                                                            <span data-id="{{ $CartItem->id }}" class="plus">+</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-3">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2">@lang('trans.Total')</p>
                                                    <h5><span id="total-{{ $CartItem->id }}">{{ $CalcPrice * $CartItem->quantity }}</span> {{ Country()->currancy_code }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="col-xl-4">
                        <div class="mt-5 mt-lg-0">
                            <div class="card border shadow-none" style="text-align: inherit">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="font-size-16 mb-0">@lang('trans.Delivery Information')</h5>
                                </div>
                                <div class="card-body p-4 pt-2">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                @foreach (Deliveries() as $Delivery)        
                                                    <tr>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                @if ($Delivery->id == 1)
                                                                    <img src="{{ asset('assets/img/delivery.png') }}" alt="delivery" style="max-width: 50px;margin: 0px 5px">
                                                                @elseif ($Delivery->id == 2)
                                                                    <img src="{{ asset('assets/img/pickup.png') }}" alt="delivery" style="max-width: 50px;margin: 0px 5px">
                                                                @else
                                                                    <img src="{{ asset('assets/img/instore.png') }}" alt="delivery" style="max-width: 50px;margin: 0px 5px">
                                                                @endif
                                                                <input class="form-check-input" style="margin-top: 15px;" type="radio" name="delivery_id" id="del-{{ $Delivery->id }}" value="{{ $Delivery->id }}" @checked($loop->first)>
                                                                <label class="form-check-label" for="del-{{ $Delivery->id }}">{{ $Delivery->title() }}</label>
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
                    </div>
                    <div class="col-12">
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
                    </div>
                </div>
                <div class="row mt-1     mt-lg-0">
                    <div class="row my-1">
                        <div class="col-6 text-start">
                            <a style="width: max-content;padding: 8px;" href="{{ route('Client.categories') }}" class="btn third_btn"><i class="fa-solid fa-angle-left me-1"></i> @lang('trans.Continue Shopping') </a>
                        </div>
                        <div class="col-6 text-end">
                            <button type="submit" style="width: max-content;padding: 8px;" class="btn main_btn"><i class="fa-regular fa-circle-check me-1"></i> @lang('trans.check_out') </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@else
    <div class="row">
        <div class=" text-center">
            <img src="{{ asset('assets/img/empty-cart.png') }}" alt="empty-cart" style="max-width: 500px">
            <h2>@lang('trans.Empty Shopping Cart.')</h2>
        </div>
    </div>
@endif
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
@push('js')
<script>

    $(document).on("click", ".fa-circle-xmark", function () {
        id = $(this).attr('data-id');
        $('#cart-'+id).remove();
        if($('.number').length == 0){
            location.reload(true);
        }
        $.ajax({
            url: "{{ route('Client.deleteitem') }}",
            dataType: "json",
            type: "POST",
            async: true,
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                toast(data.type,data.message);
                calc();
            }
        });
    });
    $(document).on("click", ".minus", function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        calc();


        id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('Client.minus') }}",
            dataType: "json",
            type: "POST",
            async: true,
            data: {
                id: id,
                count: count,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                toast(data.type,data.message);
            }
        });
    });
    $(document).on("click", ".plus", function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) + 1;
        id = $(this).attr('data-id');

        $.ajax({
            url: "{{ route('Client.plus') }}",
            dataType: "json",
            type: "POST",
            async: true,
            data: {
                id: id,
                count: count,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                toast(data.type,data.message);
                $input.val(count);
                $input.change();
                calc();
            }
        });
    });

    function calc(){
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
        netTotal = sub_total + vat;
        sub_total += discount;
        $('#sub_total').html(sub_total.toFixed(decimals));
        $('#discount').html(discount.toFixed(decimals));
        $('#vat').html(vat.toFixed(decimals));
        $('#netTotal').html(netTotal.toFixed(decimals));
    }
    calc();
</script>
@endpush