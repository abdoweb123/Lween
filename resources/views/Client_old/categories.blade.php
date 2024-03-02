@extends('Client.layouts.layout')
@section('content')

@php($Categories = request('categories') ?? [])
@php($Colors = request('colors')  ?? [])
@php($Sizes = request('sizes')  ?? [])
@php($Storages = request('storages')  ?? [])
@php($Processors = request('processors')  ?? [])
@php($Memories = request('memories')  ?? [])
@php($OperatingSystems = request('os')  ?? [])
@php($min_price = request('min_price')  ?? 0)
@php($max_price = request('max_price')  ?? 100)

<div class="container">
    <div class="row">
        <ul class="breadcrumb d-flex justify-content-center align-items-center">
            <li><h2>@lang('trans.home')</h2></li>
            <li><h4><i class="fa-solid fa-chevron-{{ lang('en') ? 'right' : 'left' }} mx-2"></i></h4></li>
            <li><h2>{{ $Category ? $Category->title() : __('trans.devices') }}</h2></li>
        </ul>
    </div>
    <div class="row">

        <div class="col-12">
        
            <i class="fa-solid fa-sliders h3 mx-1 main_color my-4 point" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilter" aria-controls="offcanvasFilter" aria-label="Toggle navigation"></i>
            <nav class="navbar fixed-top">
                <div class="container-fluid">
                    <div class="offcanvas offcanvas-{{ lang('ar') ? 'end' : 'start' }}" tabindex="-1" id="offcanvasFilter" aria-labelledby="offcanvasFilterLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasFilterLabel">@lang('trans.filter')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body py-5">
                            @include('Client.layouts.filter')
                        </div>
                    </div>
                </div>
            </nav>            
        </div>
        <div class="col-lg-12">
            <div class="row p-0">
                @forelse ($Devices as $Device)
                    <div class="col-12 col-md-6 col-lg-4 p-0">
                        @include('Client.layouts.singledevice',['Device'=>$Device])
                    </div>
                @empty
                    <div class="text-center">
                        <img src="{{ asset('assets/img/empty.png') }}" alt="empty">
                        <h3>@lang('trans.empty_products')</h3>
                    </div>
                @endforelse
            </div>
            {{ $Devices->appends($_GET)->links("pagination::bootstrap-5") }}
        </div>
    </div>
</div>
@endsection


@push('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
<script>

    $(function() {
        $( ".slider-range" ).slider({
            range: true,
            min: {{ 0 }},
            max: {{ 250 }},
            values: [ {{ $min_price }}, {{ $max_price }} ],
            slide: function( event, ui ) {

                $( ".min_price" ).val( ui.values[0] );
                $( ".max_price" ).val( ui.values[1] );
                $( ".amount" ).val( "{{ country()->currancy_code }} " + ui.values[ 0 ] + " - {{ country()->currancy_code }} " + ui.values[ 1 ] );
            }
        });
        $( ".amount" ).val( "{{ country()->currancy_code }} " + $( ".slider-range" ).slider( "values", 0 ) + " - {{ country()->currancy_code }} " + $( ".slider-range" ).slider( "values", 1 ) );
    });
</script>
@endpush
