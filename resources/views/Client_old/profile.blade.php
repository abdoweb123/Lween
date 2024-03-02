@extends('Client.layouts.layout')
@section('content')

<div class="container container-fluid mt-5 mb-5">
    <div class="d-flex justify-content-between">
        <nav aria-label="breadcrumb" class="d-flex align-items-center justify-content-between w-100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Client.home') }}" class="second_link">@lang('trans.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('trans.profile')</li>
            </ol>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa-solid fa-sliders h3 mx-1 main_color point" data-bs-toggle="offcanvas" data-bs-target="#toggle" aria-controls="toggle" aria-label="Toggle navigation"></i></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        @if ((request('type') == 'info') || request('type') == null )
            <form action="{{route('Client.profile')}}" method="POST" id="profile-form">
                @csrf
                <div class="header">
                    <h4>@lang('trans.Account Info')</h4>
                </div>
                <div class="row my-1">
                    <div class="col-md-6 form-group">
                        <label for="name" class="form-label">@lang('trans.name')</label>
                        <input class="form-control" required type="text" id="name" value="{{ auth('client')->user()->name }}" name="name" class="w-100" autocomplete="off" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="phone" class="form-label">@lang('trans.phone')</label>
                        <input class="form-control" required type="tel" id="phone" value="{{ auth('client')->user()->phone }}" name="phone" class="w-100" autocomplete="off" readonly />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="password" class="form-label">@lang('trans.password')</label>
                        <input class="form-control" required type="password" id="password" name="password" autocomplete="off" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="password_confirmation" class="form-label">@lang('trans.confirmPassword')</label>
                        <input class="form-control" required type="password" id="password_confirmation" name="password_confirmation" autocomplete="off" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email" class="form-label">@lang('trans.email')</label>
                        <input class="form-control" required type="email" id="email" value="{{ auth('client')->user()->email }}" name="email" class="w-100" autocomplete="off" />
                    </div>
                    <div class="col-md-12 form-group text-center">
                        <button class="btn main_btn w-50 mx-auto my-3" type="submit" id="profile">@lang('trans.update')</button>
                    </div>
                   
                </div>
            </form>
        @elseif (request('type') == 'addresses')
            <div class="header">
                <h4>@lang('trans.myAddresses')</h4>
            </div>
            <div class="row my-4">
                @if(count(auth('client')->user()->addresses) > 0)
                <div class="col-12">
                    @foreach(auth('client')->user()->Addresses as $Address)
                    <div class="bg-light p-3 rounded mb-4 {{ lang() == 'ar' ? 'text-right' : '' }}">
                        <ul class="my-3 list-unstyled">
                            <li class="row my-3">
                                
                                @php($country_id = $Address->Region['country_id'])
                                <p class="col-12 col-md-6">
                                    @if($country_id != 2)
                                        @lang('trans.city')
                                    @else
                                        @lang('trans.region')
                                    @endif
                                    :
                                    {{ $Address->Region->title() }}
                                </p>
                                <p class="col-12 col-md-6">
                                    @if($country_id != 2)
                                        @lang('trans.district')
                                    @else
                                        @lang('trans.block')
                                    @endif
                                    :
                                    {{ $Address['block'] }}
                                </p>
                                <p class="col-12 col-md-6">
                                    @if($country_id != 2)
                                        @lang('trans.street')
                                    @else
                                        @lang('trans.road')
                                    @endif
                                    :
                                    {{ $Address['road'] }}
                                </p>
                                <p class="col-12 col-md-6">
                                    @lang('trans.building_floor')
                                    :
                                    {{ $Address['building_no'] }}
                                </p>
                                <p class="col-12 col-md-6">
                                    @lang('trans.floor_no')
                                    :
                                    {{ $Address['floor_no'] }}
                                </p>
                                <p class="col-12 col-md-6">
                                    @lang('trans.apartment')
                                    :
                                    {{ $Address['apartment'] }}
                                </p>
                                <p class="col-12 col-md-6">
                                    @lang('trans.type')
                                    :
                                    {{ $Address['type'] }}
                                </p>
                                <p class="col-12 col-md-6">
                                    @lang('trans.additional_directions')
                                    :
                                    {{ $Address['additional_directions'] }}
                                </p>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('Client.address.edit', $Address['id']) }}" class="h5 text-decoration-none last_link transition-me mx-4"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form method="POST" action="{{ route('Client.address.destroy', $Address['id']) }}">
                                @csrf
                                @method('DELETE')
                                <button style="display: contents;color: red;" type="submit" class="show_confirm h5 text-decoration-none last_link transition-me mx-4 deleteAddress"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    <div class="my-4">
                        <button onclick="location.href='{{ route('Client.address.create') }}'"  class="main_btn w-50 py-3 border-0 rounded"><i class="fa-solid fa-plus mx-2"></i>@lang('trans.addAddress')</button>
                    </div>
                </div>
                @else
                <div class="col-12 text-center">
                    <h4 class="p-4 m-0">@lang('trans.noSavedAddress')</h4>
                    <div>
                        <button onclick="location.href='{{ route('Client.address.create') }}'"  class="main_btn w-50 py-3 border-0 rounded">@lang('trans.addAddress')</button>
                    </div>
                </div>
                @endif
            </div>

        @elseif (request('type') == 'orders')
            
                
            <div class="header">
                <h4>@lang('trans.currentOrders')</h4>
            </div>
            @if(CurrentOrders()->count())
            <div id="accordion" class="{{ lang() == 'ar' ? 'text-right' : '' }}">
                @foreach(CurrentOrders() as $key => $Order)

                   @include('Client.layouts.order-tab',['Order'=>$Order])

                @endforeach
            </div>
            @else
                <div class="col-12 text-center">
                    <h4 class="p-4 m-0">@lang('trans.noOrders')</h4>
                </div>
            @endif
                
            <div class="header">
                <h4>@lang('trans.previousOrders')</h4>
            </div>
            @if(PreviousOrders()->count())
            <div id="accordion" class="{{ lang() == 'ar' ? 'text-right' : '' }}">
                @foreach(PreviousOrders() as $key => $Order)

                   @include('Client.layouts.order-tab',['Order'=>$Order])

                @endforeach
            </div>
            @else
                <div class="col-12 text-center">
                    <h4 class="p-4 m-0">@lang('trans.noOrders')</h4>
                </div>
            @endif

        @elseif (request('type') == 'wishlist')
            <div class="header">
                <h4>@lang('trans.WISHLIST')</h4>
            </div>
            @forelse (Wishlist() as $Device)
                <div class="col-12 col-md-6 col-lg-4 p-0">
                    @include('Client.layouts.singledevice',['Device'=>$Device])
                </div>
            @empty
                <div class="text-center">
                    <img src="{{ asset('assets/img/empty.png') }}" alt="empty">
                    <h3>@lang('trans.empty_products')</h3>
                </div>
            @endforelse
        @endif
    </div>
</div>



<nav class="navbar fixed-top">
    <div class="container-fluid">
        <div class="offcanvas offcanvas-{{ lang('ar') ? 'end' : 'start' }}" tabindex="-1" id="toggle" aria-labelledby="toggleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="toggleLabel">{{ setting('title_'.lang()) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="sidebar-nav">
                    <li class="@if ((request('type') == 'info') || request('type') == null ) active @endif">
                        <a href="{{ route('Client.profile') }}/info">@lang('trans.Account Info')</a>
                    </li>
                    <li class="@if (request('type') == 'addresses') active @endif">
                        <a href="{{ route('Client.profile') }}/addresses">@lang('trans.My Addresses')</a>
                    </li>
                    <li class="@if (request('type') == 'orders') active @endif">
                        <a href="{{ route('Client.profile') }}/orders">@lang('trans.My Orders')</a>
                    </li>
                    <li class="@if (request('type') == 'wishlist') active @endif">
                        <a href="{{ route('Client.profile') }}/wishlist">@lang('trans.WISHLIST')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

@endsection

@push('js')
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("d-none");
        $("#wrapper").toggleClass("toggled");
    });
</script>
@endpush

@push('css')
<style>
    .sidebar-nav {
        position: absolute;
        width: 95%;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sidebar-nav li {
        text-indent: 20px;
        line-height: 40px;
    }

    .sidebar-nav li a {
        display: block;
        text-decoration: none;
        color: #999999;
    }

    .sidebar-nav li a:hover {
        text-decoration: none;
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
    }

    .sidebar-nav li.active a,
    .sidebar-nav li a.active,
    .sidebar-nav li a:hover {
        color: #fff;
        background: #000;
        text-decoration: none;
    }
    
</style>
@endpush
