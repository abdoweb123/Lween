@extends('Client.Layout.index')

@section('title')
    @lang('trans.MainPage')
@stop


@section('link')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

@stop

@section('style')
    <style>
        .carousel-inner .carousel-item-right.active,
        .carousel-inner .carousel-item-next {
            transform: translateX(33.33%);
        }

        .carousel-inner .carousel-item-left.active,
        .carousel-inner .carousel-item-prev {
            transform: translateX(-33.33%)
        }

        .carousel-inner .carousel-item-right,
        .carousel-inner .carousel-item-left{
            transform: translateX(0);
        }

        .a_product_details:hover{
            text-decoration: none;
        }
    </style>
@stop

@section('content')

{{--{{'gsffs'.App::setLocale(session()->get('locale'))}}--}}



<!-- Full Page Image Background Carousel Header -->
<div class="container-fluid mb-5 section-top p-0">
    <div class="">
        <div class="main_header position-relative ltr">
            <div id="sliders" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="">
                    @foreach ($Sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="disc position-relative" style="rgba(0, 0, 0, .05);">
                                <img style="width:100%;" src="{{asset($slider->file)}}" class="img-fluid" alt="image">
                                @if( $slider->title() )
                                    <div style="background: rgba(0,0,0,0.6);" class="carousel-caption d-none d-md-block" style="text-align: center; z-index: 99;">
                                        <h1 class="more_bold" style="color:white;">{{ $slider->title() }}</h1>
                                        <p class="teny_font" style="color:white; font-size:20px;">{!! $slider->desc() !!}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($Sliders && count($Sliders) > 1)
                    <div class="container">
                        <button class="carousel-control-prev" type="button" data-bs-target="#sliders" data-bs-slide="prev">
                            <i class="icon-chevron-left1 main_color h1"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#sliders" data-bs-slide="next">
                            <i class="icon-chevron-right1 main_color h1"></i>
                        </button>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>


{{--    <div class="container-fluid mb-5 section-top">--}}
{{--        <div class="row ">--}}
{{--            <img class="w-100 p-0" src="{{asset('assets_client/imgs/header.png')}}">--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="container my-5">
        <div class="row">
            <div class="col-12 ">
                <h3 class="py-4  fw-bold">
                    @lang('trans.categories')
                </h3>
            </div>
        </div>

        @php
            $Categories_regular = Categories()->take(4);
        @endphp

        <div class="row regular">
            @forelse($Categories_regular as $Category)
                <div class="col" data-aos="zoom-in-up" data-aos-duration="700">
                    <a href="{{route('Client.category.products',$Category->id)}}">
                        <img class="w-100" src="{{$Category->image}}">
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    </div>

<div class="container-fluid mb-5 section-top p-0">
    <div class="">
        <div class="main_header position-relative ltr">
            <div id="sliders" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="">
                    @foreach ($Ads as $key => $Ad)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="disc position-relative" style="rgba(0, 0, 0, .05);">
                                <img style="width:100%;" src="{{asset($Ad->file)}}" class="img-fluid" alt="image">
                                @if( $Ad->title() )
                                    <div style="background: rgba(0,0,0,0.6);" class="carousel-caption d-none d-md-block" style="text-align: center; z-index: 99;">
                                        <h1 class="more_bold" style="color:white;">{{ $Ad->title() }}</h1>
                                        <p class="teny_font" style="color:white; font-size:20px;">{!! $Ad->desc() !!}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($Ads && count($Ads) > 1)
                    <div class="container">
                        <button class="carousel-control-prev" type="button" data-bs-target="#sliders" data-bs-slide="prev">
                            <i class="icon-chevron-left1 main_color h1"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#sliders" data-bs-slide="next">
                            <i class="icon-chevron-right1 main_color h1"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{--    <div class="container my-5">--}}
{{--        <div class="row">--}}
{{--            <a href="{{$Ad->link?? '#'}}">--}}
{{--                <img class="p-0" src="{{asset($Ad->file)}}" style="height:600px; width:100%"/>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

    @php
        $Categories_mid = Categories()->take(2);
    @endphp
    @forelse($Categories_mid as $Category)
        <div class="container my-5" data-aos="fade-up">
            <div class="row  ">
                <div class="col-12 ">
                    <h3 class="py-4 fw-bold text-center">
                        {{$Category['title_'.lang()]}}
                    </h3>
                </div>
            </div>
            <div class="row ">
                <div class="slider2 regular direction">
                    @forelse($Category->Products as $key=>$product)
                        <div class="card border-0 news-card position-relative">
                            <a href="{{ route('Client.products.details', $product->id) }}" class="a_product_details">
                                <div class="img-card d-flex align-items-center">
                                    <img class="w-100 h-auto" src="{{ asset($product->header) }}" />
                                </div>
                                <div class="card-body text-center">
                                    <h6 class="text-dark fw-semibold">
                                        {{$product->id}}
                                    </h6>
                                    <p class="card-text fs-6 mb-0 fw-bold">
                                        @if($product->HasDiscount())
                                            <span style="text-decoration: line-through; display:block;">{{$product->Price()}} {{Country()->currancy_code}}</span>
                                            <span>{{$product->PriceWithCurrancy()}}</span>
                                        @else
                                            <span style="display:block; visibility: hidden;">...</span>
                                            <span>{{$product->price}}</span> {{Country()->currancy_code}}
                                        @endif
                                    </p>
                                    <p class="card-text fs-6 text-secondary fw-semibold">
                                        @lang('trans.available_in_multiple_options')
                                    </p>
                                    <button class="bg-black rounded-1 text-white fs-6 p-2 w-75">
                                        @lang('trans.addToCart')
                                    </button>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
            <div class="row justify-content-center">
                @if($key == 0)
                    <button type="button" class="btn btn-outline-dark w-auto seeall-product"
                            onclick="document.location='{{route('Client.allProducts')}}'">
                        @lang('trans.allProducts')
                    </button>
                @else
                    <button type="button" class="btn btn-outline-dark w-auto seeall-product"
                            onclick="document.location='{{route('Client.category.products',$Category->id)}}'">
                        @lang('trans.more')
                    </button>
                @endif
            </div>
        </div>
    @empty
    @endforelse

@stop


