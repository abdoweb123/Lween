<div class="row my-4 point">
    <ul  data-bs-toggle="collapse" data-bs-target="#collapse{{ $Order->id }}" aria-expanded="false" aria-controls="collapse{{ $Order->id }}">
        <li class="d-block font-weight-bold"><i class="fa-solid fa-circle-dot"></i> # {{ $Order->id }} - {{ $Order->created_at->format('Y-m-d') }} - @lang('trans.netTotal'): {{ format_number($Order->net_total * Country()->currancy_value) . ' ' . Country()->currancy_code }}</li>
    </ul>
</div>
<div class="collapse" id="collapse{{ $Order->id }}">
    <div class="card card-body">
        @foreach($Order->Devices as $Device)
        <div class="p-2 my-4 shadow">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-5">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-6">
                            <img src="{{ asset($Device->header) }}" class="img-fluid w-75" alt="screen">
                        </div>
                        <div class="col-6">
                            <div class="">
                                <span class="font-weight-bold d-block mb-3">@lang('trans.productName')</span>
                                <span style="font-size: 13px">{{ $Device->title() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row mt-2">
                        <div class="col-4">
                            <span class="font-weight-bold d-block mb-3">@lang('trans.quantity')</span>
                            <span>{{ $Device->pivot->quantity }}</span>
                        </div>
                        <div class="col-4">
                            <span class="font-weight-bold d-block mb-3">@lang('trans.price')</span>
                            <span>{{ format_number($Device->pivot->price * Country()->currancy_value) }}</span>
                        </div>
                        <div class="col-4">
                            <span class="font-weight-bold d-block mb-3">@lang('trans.total')</span>
                            <span>{{ format_number($Device->pivot->total * Country()->currancy_value) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="bg-light">
            <div class="container">
                <div class="sub-total d-flex justify-content-between my-2">
                    <span>@lang('trans.subTotal'):</span>
                    <span>{{ format_number(($Order->sub_total + $Order->discount) * Country()->currancy_value) . ' ' . Country()->currancy_code }}</span>
                </div>
                <div class="sub-total d-flex justify-content-between my-2">
                    <span>@lang('trans.discount'):</span>
                    <span>{{ format_number($Order->discount * Country()->currancy_value) . ' ' . Country()->currancy_code }}</span>
                </div>
                <div class="sub-total d-flex justify-content-between my-2">
                    <span>@lang('trans.vat'):</span>
                    <span>{{ format_number($Order->vat * Country()->currancy_value) . ' ' . Country()->currancy_code }}</span>
                </div>
                <div class="sub-total d-flex justify-content-between my-2">
                    <span>@lang('trans.deliveryCost'):</span>
                    <span>{{ format_number($Order->charge_cost * Country()->currancy_value) . ' ' . Country()->currancy_code }}</span>
                </div>
                <div class="sub-total d-flex justify-content-between my-2">
                    <span>@lang('trans.netTotal'):</span>
                    <span>{{ format_number($Order->net_total * Country()->currancy_value) . ' ' . Country()->currancy_code }}</span>
                </div>
            </div>
        </div>
    </div>
</div>