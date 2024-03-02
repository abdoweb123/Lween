@extends('Client.layouts.layout')
@section('content')
    <div class="container">
        <div class="row">
            <ul class="breadcrumb d-flex justify-content-center align-items-center">
                <li><h2>@lang('trans.home')</h2></li>
                <li><h4><i class="fa-solid fa-chevron-{{ lang('en') ? 'right' : 'left' }} mx-2"></i></h4></li>
                <li><h2>{{ $Device->title() }}</h2></li>
            </ul>
        </div>
    
        <div class="card border-0">
            <div class="card-body">
                <div class="row my-5">
                    <div class="col-md-7 col-sm-12">
                        <div class="white-box text-center">
                            <div class="img__wrapper">
                                @if(request('color_id'))
                                    @if(IsVideo($Device->Headers()->where('color_id',request('color_id'))->first()->header))
                                        <video class="preview_image" controls allowfullscreen muted autoplay loop controlsList="nodownload"  src="{{ asset($Device->Headers()->where('color_id',request('color_id'))->first()->header) }}" style="max-height: 400px;" /></video>  
                                    @else
                                        <img style="max-width:100%" class="img-responsive" src="{{ asset($Device->Headers()->where('color_id',request('color_id'))->first()->header) }}" /> 
                                    @endif
                                @else
                                    @if(IsVideo($Device->header))
                                        <video class="preview_image" controls allowfullscreen muted autoplay loop controlsList="nodownload"  src="{{ asset($Device->header) }}" style="max-height: 400px;" /></video>  
                                    @else
                                        <img style="max-width:100%" class="img-responsive" src="{{ asset($Device->header) }}" /> 
                                    @endif
                                @endif
                                @if ($Device->HasDiscount())
                                    <div class="ribbon">
                                        {{ $Device->discount_value }}%
                                    </div>
                                @endif
                                @if ($Device->quantity < 1)
                                    <a class="sold_out">@lang('trans.Sold Out')</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-5 col-sm-12 px-md-4 text-start">
                        
                         
                            
                        <h4 class="box-title mt-5">{{ $Device->title() }}</h4>
                        <p>{!! $Device['short_desc_' . lang()] !!}</p>

                        
                        <div class="my-3">
                            @if(request('color_id'))
                                @php($FirstItem = $Device->Items->sortBy('price')->first())
                                <span class="h4">@lang('trans.start_from'):</span>
                                @if ($Device->HasDiscount())
                                    <small class="text-danger" style="text-decoration: line-through">{{ $FirstItem->Price() }}</small>
                                @endif
                                <span class="h4">{{ $FirstItem->CalcPriceWithCurrancy() }}</h4>
                            @else
                                <span class="h4">@lang('trans.price'):</span>
                                @if ($Device->HasDiscount())
                                    <small class="text-danger" style="text-decoration: line-through">{{ $Device->Price() }}</small>
                                @endif
                                <span class="h4">{{ $Device->CalcPriceWithCurrancy() }}</h4>
                            @endif
                        </div>
                        <div class="">
                   
                            <div class="">
                                @if ($Device->quantity >= 1)
                                    @if($Device->Items->Count())
                                        <div class="my-2 d-flex">
                                            @foreach($Device->Items->unique('color_id') as $Item)
                                                <a href="{{ route('Client.device',['device_id'=>$Device,'color_id'=>$Item->color_id]) }}">
                                                    @if(request('color_id') ==  $Item->color_id)
                                                        <i class="fa-solid fa-circle mx-1 h2 border border-3 p-1 rounded-circle" style="border-style: dashed !important;border-color: {{ $Item->Color->hexa }} !important;color: {{ $Item->Color->hexa }}"></i>
                                                    @else
                                                        <i class="fa-solid fa-circle mx-1 h2 p-1 rounded-circle" style="border-color: {{ $Item->Color->hexa }} !important;color: {{ $Item->Color->hexa }}"></i>
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
                                        <a class="btn main_btn px-5" style="border-radius: 0px;" href="{{ route('Client.BuildYourDevice',['device_id'=>$Device,'color_id'=>request('color_id')]) }}">@lang('trans.build_your_device')</a>
                                    @else
                                        <button class="add-to-cart-button">
                                            <svg class="add-to-cart-box box-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="24" height="24" rx="2" fill="#ffffff" />
                                            </svg>
                                            <svg class="add-to-cart-box box-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="24" height="24" rx="2" fill="#ffffff" />
                                            </svg>
                                            <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                            </svg>
                                            <svg class="tick" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="none" d="M0 0h24v24H0V0z" />
                                                <path fill="#ffffff"
                                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM9.29 16.29L5.7 12.7c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L10 14.17l6.88-6.88c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41l-7.59 7.59c-.38.39-1.02.39-1.41 0z" />
                                            </svg>
                                            <span class="add-to-cart">@lang('trans.addToCart')</span>
                                            <span class="added-to-cart">@lang('trans.addedSuccessfully')</span>
                                        </button>
                                    @endif
                                @endif
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-3 text-center">
                <div data-bs-toggle="modal" data-bs-target="#Gallery">
                    <img style="max-width: 200px;" class="img-responsive" src="{{ asset($Device->Gallery->when(request('color_id'), fn($query) =>  $query->where('color_id', request('color_id')) )->first()?->image) }}" />
                    <p class="point"><i class="fa-regular fa-images"></i> @lang('trans.open') @lang('trans.gallery')</p>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <h4 class="box-title d-none d-md-block">{{ $Device->title() }}</h4>
                <div class="h4 main_color">
                    <span id="wishlist">
                        <i class="{{ $wishlist ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                        @lang('trans.WISHLIST')
                    </span>
                    <span>
                        |
                    </span>
                    <i class="fa-solid fa-share-nodes point" id="share"></i>
                    <div class="social twitter"><a href="https://twitter.com/share?url={{ url()->current() }}" target="_blank"><i class="fa-brands fa-twitter"></i></a></div>
                    <div class="social facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"><i class="fa-brands fa-facebook"></i></a></div>
                    <div class="social whatsapp"><a href="https://wa.me/?text={{ url()->current() }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></div>
                </div>
                <p>{{ mb_strimwidth(strip_tags($Device['long_desc_' . lang()]), 0, 200, '...') }}</p>
                <p>
                    <img src="{{ asset('assets/img/payment.png') }}" alt="payment" style="max-width: 200px">
                </p>
            </div>
           
        </div>
    </div>
  

    <style>
        #tabs .nav-link {
            color: #999999;
            padding: 10px 30px;
            border-radius: 0px;
            transition: unset;
            border: 0px;
        }
        #tabs .nav-item {
            color: #999999;
            border: 0px;
        }
        #tabs .nav-link.active{
            font-weight: bold;
            background-color: #FFF !important;
            color: #000 !important;
            border-top: 1px solid #000 !important;
            border-left: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
        }
    
        #tabs .nav-item{
            margin: 10px 0px;
            border: 0px;
            border-radius: 50px;
        }
    </style>

    <div class="container" id="tabs" >
        <ul class="nav nav-tabs d-flex justify-content-center" style="border-bottom: 1px solid #000 !important;max-height: 54px">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" data-slick="over_view" href="#over_view">@lang('trans.over_view')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-slick="specs" href="#specs">@lang('trans.specs')</a>
            </li>
            @if ($Device->Accessories->count())       
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-slick="accessories" href="#accessories">@lang('trans.accessories')</a>
            </li>
            @endif
        </ul>
    
        <div class="tab-content">
            <div class="tab-pane container active" id="over_view">
                <div class="over_view">
                    @foreach ($Device->Features as $Feature)
                        <div class="px-1 mx-1">
                            <img class="mt-1" src="{{ $Feature->image ?? setting('logo') }}" alt="{{ $Feature->title() }}" style="max-width: 100%">
                            <h5 class="my-2">{{ $Feature->title() }}</h5>
                            {!! $Feature->desc() !!}
                        </div>
                    @endforeach
                </div>
                
                {{--
                
                <div class="mx-5">
                    <div
                        id="360-slide"
                        data-folder="https://scaleflex.cloudimg.io/v7/demo/vivo-mobile/"
                        data-filename-x="product-{index}.jpg"
                        data-amount-x="60"
                    ></div>
                </div>
                @push('js')
                    <script src="https://cdn.scaleflex.it/plugins/js-cloudimage-360-view/latest/js-cloudimage-360-view.min.js"></script>
                    <script>
                        const new360View = document.getElementById('360-slide');
                        new360View.classList.add("cloudimage-360");
                        window.CI360.add('360-slide');
                    </script>
                @endpush
                
                --}}
                
                <p>{!! $Device['long_desc_' . lang()] !!}</p>
                @foreach ($Device->Gallery->when(request('color_id'), fn($query) =>  $query->where('color_id', request('color_id')) ) as $Slider)
                    <img loading="lazy" src="{{ $Slider->image }}" class="w-100" alt="SliderImage">
                @endforeach
            </div>

            <div class="tab-pane container fade" id="specs">
                <div class="specs">
                    <table class="table">
                        <tbody>
                            @foreach ($Device->Specs as $Spec)          
                                <tr>
                                    <th style="min-width: 200px;background: #e8e8e8">{{ $Spec->title() }}</th>
                                    <td style="min-width: 200px;">{{ $Spec->pivot['desc_'.lang()] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                     </table>
                </div>
            </div>
            @if ($Device->Accessories->count())       
                <div class="tab-pane container fade" id="accessories">
                    <div class="accessories">
                        @foreach ($Device->Accessories as $AccessoryDevice)
                            @include('Client.layouts.singledevice',['Device'=>$AccessoryDevice])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="Gallery" tabindex="-1" aria-labelledby="GalleryLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="GallerySLider" class="carousel slide" data-bs-ride="carousel">
                        @if ($Device->Gallery->when(request('color_id'), fn($query) =>  $query->where('color_id', request('color_id')) )->count() > 1)
                            <div class="carousel-indicators">
                                @foreach ($Device->Gallery->when(request('color_id'), fn($query) =>  $query->where('color_id', request('color_id')) ) as $Slider)
                                    <button type="button" data-bs-target="#GallerySLider" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $loop->index }}"></button>
                                @endforeach
                            </div>
                        @endif

                        <div class="carousel-inner">
                            @foreach ($Device->Gallery->when(request('color_id'), fn($query) =>  $query->where('color_id', request('color_id')) ) as $Slider)
                                <div class="carousel-item py-3 text-center {{ $loop->first ? ' active' : '' }}">
                                    <img loading="lazy" src="{{ $Slider->image }}" alt="SliderImage" style="max-height: 500px;">
                                </div>
                            @endforeach
                        </div>
                        @if ($Device->Gallery->when(request('color_id'), fn($query) =>  $query->where('color_id', request('color_id')) )->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#GallerySLider" data-bs-slide="prev">
                                <i style="color: black;font-size: 25px;" class="fa-regular fa-circle-left"></i>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#GallerySLider" data-bs-slide="next">
                                <i style="color: black;font-size: 25px;" class="fa-regular fa-circle-right"></i>
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
    <style>
        .fa-circle.active{
            border: 3px solid;
            border-radius: 50%;
            padding: 3px;
        }
        .add-to-cart-button {
            background: var(--main--color);
            border: none;
            border-radius: 4px;
            -webkit-box-shadow: 0 3px 13px -2px rgba(0, 0, 0, .15);
            box-shadow: 0 3px 13px -2px rgba(0, 0, 0, .15);
            color: #fff;
            display: flex;
            font-family: 'Ubuntu', sans-serif;
            justify-content: space-around;
            min-width: 195px;
            overflow: hidden;
            outline: none;
            padding: 0.7rem;
            position: relative;
            text-transform: uppercase;
            transition: 0.4s ease;
            width: auto;
        }

        .add-to-cart-button:active {
            -webkit-box-shadow: 0 0 0 0.2rem rgba(252, 186, 3, .45);
            box-shadow: 0 0 0 0.2rem rgba(252, 186, 3, .45);
            -webkit-transform: translateY(4px);
            transform: translateY(4px);
        }

        .add-to-cart-button:hover {
            cursor: pointer;
        }

        .add-to-cart-button:hover,
        .add-to-cart-button:focus {
            -webkit-box-shadow: 0 0 0 0.2rem rgba(252, 186, 3, .45);
            box-shadow: 0 0 0 0.2rem rgba(252, 186, 3, .45);
            -webkit-transform: translateY(-1px);
            transform: translateY(-1px);
        }

        .add-to-cart-button.added {
            background: #2fbf30;
            -webkit-box-shadow: 0 0 0 0.2rem rgba(11, 252, 3, 0.45);
            box-shadow: 0 0 0 0.2rem rgba(11, 252, 3, 0.45);
        }

        .add-to-cart-button.added .add-to-cart {
            display: none;
        }

        .add-to-cart-button.added .added-to-cart {
            display: block;
        }

        .add-to-cart-button.added .cart-icon {
            animation: drop 0.3s forwards;
            -webkit-animation: drop 0.3s forwards;
            animation-delay: 0.18s;
        }

        .add-to-cart-button.added .box-1,
        .add-to-cart-button.added .box-2 {
            top: 18px;
        }

        .add-to-cart-button.added .tick {
            animation: grow 0.6s forwards;
            -webkit-animation: grow 0.6s forwards;
            animation-delay: 0.7s;
        }

        .add-to-cart,
        .added-to-cart {
            margin-left: 36px;
        }

        .added-to-cart {
            display: none;
            position: relative;
        }

        .add-to-cart-box {
            height: 5px;
            position: absolute;
            top: 0;
            width: 5px;
        }

        .box-1,
        .box-2 {
            transition: 0.4s ease;
            top: -8px;
        }

        .box-1 {
            left: 23px;
            transform: rotate(45deg);
        }

        .box-2 {
            left: 32px;
            transform: rotate(63deg);
        }

        .cart-icon {
            left: 15px;
            position: absolute;
            top: 8px;
        }

        .tick {
            background: #146230;
            border-radius: 50%;
            position: absolute;
            left: 28px;
            transform: scale(0);
            top: 5px;
            z-index: 2;
        }

        @-webkit-keyframes grow {
            0% {
                -webkit-transform: scale(0);
            }

            50% {
                -webkit-transform: scale(1.2);
            }

            100% {
                -webkit-transform: scale(1);
            }
        }

        @keyframes grow {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        @-webkit-keyframes drop {
            0% {
                -webkit-transform: translateY(0px);
            }

            100% {
                -webkit-transform: translateY(1px);
            }
        }

        @keyframes drop {
            0% {
                transform: translateY(0px);
            }

            100% {
                transform: translateY(1px);
            }
        }

                

        .social {
            opacity: 0;
            position: relative;
            margin: 0px 8px;
            width: 40px;
            height: 40px;
            border-radius: 100%;
            display: inline-block;
            font-size: 20px;
            text-align: center;
            cursor: pointer;
            color: #fff;
            text-align: center;
            transform: translateY(-10px);
        }
        .social i{
            margin-top: 9px;
            color: #fff;
        }
        

        .twitter {
            background: #00aced;
        }

        .facebook {
            background: #3b5998;
        }

        .whatsapp {
            background: #1dde1a;
        }

        .social.clicked {
            opacity: 1;
            transition: 1.2s all ease;
            transform: translateY(-2px);
        }

    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
    <script>
        $('.over_view').slick(slider_format);
        $('.accessories').slick(slider_format);
        $('.nav-link').on('shown.bs.tab', function() {
            if ($(this).attr('data-slick') == 'accessories' || $(this).attr('data-slick') == 'over_view') {
                $('.'+$(this).attr('data-slick')).slick('refresh');
            }
        });
        
        $(document).on("click", "#share", function () {
            $(".social.twitter").toggleClass("clicked");
            $(".social.facebook").toggleClass("clicked");
            $(".social.whatsapp").toggleClass("clicked");
        });
        device_id = {{ $Device->id }};
        color_id = {{ 0 }};
        $(document).on("click", ".fa-circle", function () {
            color_id = $(this).attr('data-id');
            $('.fa-circle').removeClass('active');
            $(this).addClass('active');
        });

        $(document).on("click", "#wishlist", function () {
            $.ajax({
                url: "{{ route('Client.ToggleWishlist') }}",
                dataType: "json",
                type: "POST",
                async: true,
                data: {
                    device_id: device_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    toast(data.type,data.message);
                    if (data.exists == 1) {
                        $('#wishlist i').removeClass().addClass('fa-solid fa-heart');
                    }
                    if (data.exists == 0) {
                        $('#wishlist i').removeClass().addClass('fa-regular fa-heart');
                    }
                }
            });
        });


        addToCartButton = document.querySelectorAll(".add-to-cart-button");
        document.querySelectorAll('.add-to-cart-button').forEach(function(addToCartButton) {
            addToCartButton.addEventListener('click', function() {
                $.ajax({
                    url: "{{ route('Client.AddToCart') }}",
                    dataType: "json",
                    type: "POST",
                    async: true,
                    data: {
                        device_id: device_id,
                        color_id: color_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.success) {
                            if (data.cart_count) {
                                
                            }
                            addToCartButton.classList.add('added');
                            setTimeout(function() {
                                addToCartButton.classList.remove('added');
                            }, 2000);
                        }
                        toast(data.type,data.message)
                    }
                });
            });
        });
    </script>
@endpush
