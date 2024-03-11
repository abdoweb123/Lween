@extends('Admin.layout')

@section('pagetitle', __('trans.orders'))
@section('content')

    <div class="row">
        <div class="my-2 col-6 text-sm-start">
            <a href="{{ route('admin.orders.create') }}" class="main-btn">@lang('trans.add_new')</a>
        </div>
        <div class="my-2 col-6 text-sm-end">
            <button type="button" id="DeleteSelected" onclick="DeleteSelected('f_a_q_s')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
        </div>
    </div>
    <table class="table table-bordered data-table" >
        <thead>
            <tr>
                <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
                <th>@lang('trans.name')</th>
                <th>@lang('trans.phone')</th>
                <th>#</th>
                <th>@lang('trans.status')</th>
                <th>@lang('trans.netTotal')</th>
                <th>@lang('trans.Payment')</th>
                <th>@lang('trans.type')</th>
                <th>@lang('trans.time')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Models as $Order)
            <tr>
                <td>
                    <input type="checkbox" class="DTcheckbox" value="{{ $Order->id }}"> - {{ $Order->id }}
                </td>
                <td>{{ $Order->Client->name }}</td>
                <td>{{$Order->Client->phone }}</td>
                <td><a data-bs-toggle="modal" data-bs-target="#order-{{ $Order['id'] }}" href="#">@lang('trans.details')</a></td>
              {{-- <td style="text-align:center;">
                    @if ($Order['status'] == 0 && $Order['follow'] == 0)
                        <select class="select form-control">
                            <option selected hidden disabled>{{  __('trans.Refuse/ Accept')  }}</option>
                            <option data-status="1" data-follow="1"  data-id="{{ $Order['id'] }}">{{  __('trans.accept_order')  }}</option>
                            <option data-status="2" data-follow="0"  data-id="{{ $Order['id'] }}">{{  __('trans.decline')  }}</option>
                        </select>
                    @elseif ($Order['status'] == 1)
                        @if($Order['follow'] == 1)
                            @if($Order->delivery_id == 1)
                                <select class="select form-control">
                                    <option selected hidden disabled>{{  __('trans.accepted')  }}</option>
                                    <option data-status="1" data-follow="2"  data-id="{{ $Order['id'] }}">{{  __('trans.order_onway')  }}</option>
                                    <option data-status="1" data-follow="3"  data-id="{{ $Order['id'] }}">{{  __('trans.order_delivered')  }}</option>
                                </select>
                            @elseif($Order->delivery_id > 1)
                                <select class="select form-control">
                                    <option selected hidden disabled>{{  __('trans.accepted')  }}</option>
                                    <option data-status="1" data-follow="2"  data-id="{{ $Order['id'] }}">{{  __('trans.order_ready')  }}</option>
                                    <option data-status="1" data-follow="3"  data-id="{{ $Order['id'] }}">{{  __('trans.order_delivered')  }}</option>
                                </select>
                            @endif
                        @elseif($Order['follow'] == 2)
                            <select class="select form-control">
                                @if($Order->delivery_id == 1)
                                    <option disabled hidden selected>{{  __('trans.order_onway')  }}</option>
                                @elseif($Order->delivery_id > 1)
                                    <option disabled hidden selected>{{  __('trans.order_ready')  }}</option>
                                @endif
                                <option data-status="1" data-follow="3"  data-id="{{ $Order['id'] }}">{{  __('trans.order_delivered')  }}</option>
                            </select>
                        @elseif($Order['follow'] == 3)
                            {{ __('trans.order_delivered') }}
                        @endif
                    @elseif ($Order['status'] == 2)
                        <select class="select form-control">
                            <option selected hidden disabled>{{  __('trans.decline')  }}</option>
                            <option data-status="0" data-follow="0"  data-id="{{ $Order['id'] }}">{{  __('website.back')  }}</option>
                        </select>
                    @elseif ($Order['status'] > 2)
                        <p>
                            {{  __('trans.not_complete')  }}
                        </p>
                    @endif
                </td>--}}
                <td>
                    @if($Order->delivery_id > 1)
                        <p>
                            {{  __('trans.Receipt_shop')  }}
                        </p>
                    @else
                        @if($Order['status'] == '3')
                            <p>
                                {{  __('trans.delivered')  }}
                            </p>
                        @else
                            <select class="select form-control">
                                <option data-status="4" data-id="{{ $Order['id'] }}" {{$Order['status'] == '4' ? 'selected' : ''}}>{{  __('trans.refused')  }}</option>
                                <option data-status="0" data-id="{{ $Order['id'] }}" {{$Order['status'] == '0' ? 'selected' : ''}}>{{  __('trans.pending')  }}</option>
                                <option data-status="1" data-id="{{ $Order['id'] }}" {{$Order['status'] == '1' ? 'selected' : ''}}>{{  __('trans.preparing')  }}</option>
                                <option data-status="2" data-id="{{ $Order['id'] }}" {{$Order['status'] == '2' ? 'selected' : ''}}>{{  __('trans.ready')  }}</option>
                                <option data-status="3" data-id="{{ $Order['id'] }}" {{$Order['status'] == '3' ? 'selected' : ''}}>{{  __('trans.delivered')  }}</option>
                            </select>
                        @endif
                    @endif

                </td>
                <td>{{ $Order['net_total'] . ' '. Country()->currancy_code }}</td>
                <td>{{ $Order->Payment ? $Order->Payment->title() : '' }}</td>
                <td>{{ $Order->Delivery ? $Order->Delivery->title() : '' }}</td>
                <td>{{ $Order['created_at'] }}</td>
                <td>
                    <form class="formDelete" method="POST" action="{{ route('admin.orders.destroy', $Order) }}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                            <i class="fa-solid fa-eraser"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    
    @foreach($Models as  $Order)
    <div class="modal fade" id="order-{{ $Order['id'] }}" tabindex="-1" aria-labelledby="order-{{ $Order['id'] }}Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="order-{{ $Order['id'] }}Label">@lang('trans.orderDetails')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="display:contents">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover text-center">
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <h4>{{ __("trans.client") }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.name") }}</th>
                                <td colspan="3">{{ $Order->Client ? $Order->Client->name : '' }}</td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.email") }}</th>
                                <td colspan="3">{{ $Order->Client ? $Order->Client->email : '' }}</td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.phone") }}</th>
                                <td colspan="3">{{ $Order->Client ? $Order->Client->phone_code . $Order->Client->phone : '' }}</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <h4>{{ __("trans.Payment") }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3">{{ __("trans.sub_total") }}</th>
                                <td colspan="3">{{ $Order->sub_total . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @if($Order->charge_cost > 0)
                            <tr>
                                <th colspan="3">{{ __("trans.charge_cost") }}</th>
                                <td colspan="3">{{ $Order->charge_cost . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @endif
                            @if($Order->discount > 0)
                            <tr>
                                <th colspan="3">{{ __("trans.discount") }}</th>
                                <td colspan="3">{{ $Order->discount . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th colspan="3">{{ __("trans.vat") }}</th>
                                <td colspan="3">{{ $Order->vat . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @if($Order->coupon > 0)
                            <tr>
                                <th colspan="3">{{ __("trans.coupon") }} ({{ $Order->coupon_text }})</th>
                                <td colspan="3">{{ $Order->coupon . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th colspan="3">{{ __("trans.net_total") }}</th>
                                <td colspan="3">{{ $Order->net_total . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @if ($Order->address)
                                <tr>
                                    <td colspan="6">
                                        <h4>{{ __("trans.address") }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("trans.country") }}</th>
                                    <td colspan="3">{{ $Order->address->region?->Country?->title() }}</td>
                                </tr>
                                <tr>
                                    @if($Order->address->region?->country_id == 2)
                                        <th colspan="3">{{ __("trans.region") }}</th>
                                    @else
                                        <th colspan="3">{{ __("trans.city") }}</th>
                                    @endif
                                    <td colspan="3">{{ $Order->address->region?->title() }}</td>
                                </tr>
                                <tr>
                                    @if($Order->address->region?->country_id == 2)
                                        <th colspan="3">{{ __("trans.block") }}</th>
                                    @else
                                        <th colspan="3">{{ __("trans.district") }}</th>
                                    @endif
                                    <td colspan="3">{{ $Order->address->block }}</td>
                                </tr>
                                <tr>
                                    @if($Order->address->region?->country_id == 2)
                                    <th colspan="3">{{ __("trans.street") }}</th>
                                    @else
                                        <th colspan="3">{{ __("trans.road") }}</th>
                                    @endif
                                    <td colspan="3">{{ $Order->address->road }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("trans.floor_no") }}</th>
                                    <td colspan="3">{{ $Order->address->floor_no }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("trans.apartment") }}</th>
                                    <td colspan="3">{{ $Order->address->apartment }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("trans.type") }}</th>
                                    <td colspan="3">{{ $Order->address->type }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">{{ __("trans.additional_directions") }}</th>
                                    <td colspan="3">{{ $Order->address->additional_directions }}</td>
                                </tr>
                            @else
                                <tr>
                                    <th colspan="3">{{ __("trans.branch") }}</th>
                                    <td colspan="3">{{ $Order->Branch->title() }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
    
                    <h4 class="text-center">{{ __("trans.products") }}</h4>
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>{{ __("trans.title") }}</th>
                                @if($Order->Products->sum('color_id') > 0)
                                <th>{{ __("trans.color") }}</th>
                                @endif
                                <th>{{ __("trans.quantity") }}</th>
                                <th>{{ __("trans.price") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Order->Products as $item )
                            <tr>
                                <td>{{ $item->title() }}</td>
                                @if($Order->Products->sum('color_id') > 0)
                                <td>{{ Color($item->pivot->color_id)?->title() }}</td>
                                @endif
                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ $item->pivot->price . ' '. Country()->currancy_code }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('trans.close')</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    


@endsection


@section('js')
    <script type="text/javascript">
        $(document).on('change', '.select', function() {
            $.ajax({
                url: "{{ route('admin.orders.status') }}"
                , type: "GET"
                , data: {
                    _token: "{{ csrf_token() }}"
                    , id: $(this).find(':selected').attr('data-id')
                    , status: $(this).find(':selected').attr('data-status')
                , }
                , success: function(response) {
                    location.reload(true);
                }
            });
        });
    </script>
@endsection