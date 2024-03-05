@extends('Client.Layout.index')

@section('title')
    @lang('trans.MainPage')
@stop


@section('style')

@stop

@section('content')

{{--{{'gsffs'.App::setLocale(session()->get('locale'))}}--}}

    <div class="container-fluid mb-5 section-top">
        <div class="row ">
            <img class="w-100 p-0" src="{{asset('assets_client/imgs/header.png')}}">
        </div>
    </div>
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
                    <a href="{{route('Client.category.devices',$Category->id)}}">
                        <img class="w-100" src="{{$Category->image}}">
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <div class="container-fluid my-5">
        <div class="row">
            <img class="p-0" src="{{asset('assets_client/imgs/bag4.jpg')}}" style="height:600px"/>
        </div>
    </div>

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
                    @foreach($Category->devices as $key=>$product)
                        <div class="card border-0 news-card position-relative">
                            <a href="{{ route('Client.devices.details', $product->id) }}">
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

                    @endforeach

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
                            onclick="document.location='{{route('Client.category.devices',$Category->id)}}'">
                        @lang('trans.more')
                    </button>
                @endif
            </div>
        </div>
    @empty
    @endforelse

@stop