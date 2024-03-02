@extends('Client_old.layouts.layout')
@section('content')



@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
@endpush


@include('Client_old.layouts.slider')

<style>
    .box {
        box-shadow: 7px 8px 11px 4px rgba(0, 0, 0, 0.3);
        height: 175px;
        border-radius: 10px;
    }

</style>

<div class="category_shop my-5">
    <div class="container">
        <h3 class="py-4 text-center">@lang('trans.brands')</h3>
        <div class="row justify-content-center align-items-center brands">
            @foreach ($Brands as $Brand)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 text-center m-4 point" onclick="location.href='{{ route('Client.categories',['brand_id'=>$Brand->id]) }}'">
                <div class="box text-center d-flex justify-content-center align-items-center">
                    <img  style="max-width: 150px;max-height: 100%;" src="{{ asset($Brand->file ?? setting('logo')) }}" alt="image" class="img-fluid">
                </div>
                <div class="mt-3 text-center d-flex justify-content-center">
                    <h6 style="width: max-content;">{{ $Brand->title() }}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="category_shop my-5">
    <div class="container">
        <h3 class="py-4 text-center">@lang('trans.categories')</h3>
        <div class="row justify-content-center align-items-center categories">
            @foreach (Categories() as $Category)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 text-center m-4 point" onclick="location.href='{{ route('Client.categories',['category'=>$Category->id]) }}'">
                <div class="box text-center d-flex justify-content-center align-items-center">
                    <img  style="max-width: 150px;max-height: 100%;" src="{{ asset($Category->image ?? setting('logo')) }}" alt="image" class="img-fluid">
                </div>
                <div class="mt-3 text-center d-flex justify-content-center">
                    <h6 style="width: max-content;">{{ $Category->title() }}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    #tabs .nav-link {
        font-weight: bold;
        padding: 10px 30px;
        border-radius: 50px;
        transition: unset;
        border: 1px solid #000;
    }
    #tabs .nav-item {
        border: 1px solid #000;
    }

    #tabs .nav-item{
        margin: 10px;
        border: 1px solid #000 !important;
        border-radius: 50px;
    }
</style>
<div class="container" id="tabs" style="margin-top: 10px;">
    <ul class="nav nav-tabs d-flex justify-content-center">
        @if ($new_arrivals->count())
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" data-slick="new_arrivals" href="#new_arrivals">@lang('trans.new_arrivals')</a>
            </li>
        @endif
        @if ($most_selling->count())
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-slick="most_selling" href="#most_selling">@lang('trans.most_selling')</a>
            </li>
        @endif
        @if ($featured->count())
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-slick="featured" href="#featured">@lang('trans.featured')</a>
            </li>
        @endif
    </ul>

    <div class="tab-content">
        <div class="tab-pane container active" id="new_arrivals">
            <div class="row new_arrivals">
                @foreach ($new_arrivals as $Device)
                    <div class="col-12 col-md-6 col-lg-4">
                        @include('Client_old.layouts.singledevice',['Device'=>$Device,'New'=>1])
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane container fade" id="most_selling">
            <div class="row most_selling">
                @foreach ($most_selling as $Device)
                    <div class="col-12 col-md-6 col-lg-4">
                        @include('Client_old.layouts.singledevice',['Device'=>$Device])
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane container fade" id="featured">
            <div class="row featured">
                @foreach ($featured as $Device)
                    <div class="col-12 col-md-6 col-lg-4">
                        @include('Client_old.layouts.singledevice',['Device'=>$Device])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div id="ads" class="carousel slide" data-bs-ride="carousel">
    @if($Ads->count() > 1)
    <div class="carousel-indicators">
        @foreach ($Ads as $Ad)
        <button type="button" data-bs-target="#ads" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $loop->index }}"></button>
        @endforeach
    </div>
    @endif

    <div class="carousel-inner">
        @foreach ($Ads as $Ad)
        <div class="carousel-item py-3 {{ $loop->first ? ' active' : '' }}">
            <img src="{{ $Ad->file }}" class="w-100" alt="AdImage">
        </div>
        @endforeach
    </div>
    @if($Ads->count() > 1)
    <button class="carousel-control-prev" type="button" data-bs-target="#ads" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#ads" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    @endif
</div>

<div class="container my-4">
    <h2 class="text-center">
        @lang('trans.offers')
    </h2>
    <div class="row">
        <div class="col-lg-6 py-4">
            @if(isset($offers[0]))
                @include('Client_old.layouts.offerdeviceV',['Device'=>$offers[0]])
            @endif
        </div>
        <div class="col-lg-6">
            @if(isset($offers[1]))
                @include('Client_old.layouts.offerdeviceH',['Device'=>$offers[1]])
            @endif
            @if(isset($offers[2]))
                @include('Client_old.layouts.offerdeviceH',['Device'=>$offers[2]])
            @endif
        </div>
    </div>
</div>



<div class="container px-4 py-5" id="hanging-icons">
    <h2 class="pb-2 border-bottom text-center">@lang('trans.Why Choose Us')</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        @foreach ($Services as $Service)
        <div class="col d-flex align-items-start">
            <div class="icon-square text-bg-light d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                <img src="{{ asset($Service->file) }}" class="bi" style="max-width: 50px" alt="{{  $Service->title()  }}">
            </div>
            <div>
                <h3 class="fs-2">{{ $Service->title() }}</h3>
                <p>{!! $Service->desc() !!}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>


<div class="container" id="tabs" style="margin-top: 10px;">
    @foreach ($Categories as $Category)
        <h2 class="py-4 text-center">{{ $Category->parent_id ? $Category->Parent->title() : NULL }} @if( $Category->parent_id ) <i class="fa-solid fa-angle-{{ lang('en') ? 'right' : 'left' }}"></i> @endif  {{ $Category->title() }}</h2>
        <div class="row category-{{ $Category->id }}">
            @foreach ($Category->Devices as $Device)
                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                    @include('Client_old.layouts.singledevice',['Device'=>$Device,'New'=>1])
                </div>
            @endforeach
        </div>
        
        
        @push('js')
        
        <script>
           
            $('.category-{{ $Category->id }}').slick(slider_format);
        </script>
        
        @endpush

    @endforeach
</div>
@endsection


@push('js')

<script>
    $('.categories').slick({
            dots: true,
            infinite: true,
            arrows: true,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 2,
            autoplay:false,
            cssEase: 'linear',
            rtl: document.documentElement.lang == 'ar' ? true : false,
            responsive: [
                {
                    breakpoint: 1366,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 650,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
            ]
        });
    $('.brands').slick({
            dots: true,
            infinite: true,
            arrows: true,
            speed: 300,
            slidesToShow: 5,
            slidesToScroll: 2,
            autoplay:false,
            cssEase: 'linear',
            rtl: document.documentElement.lang == 'ar' ? true : false,
            responsive: [
                {
                    breakpoint: 1366,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 650,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
            ]
        });
    $('.new_arrivals').slick(slider_format);
    $('.most_selling').slick(slider_format);
    $('.featured').slick(slider_format);

    $('.nav-link').on('shown.bs.tab', function() {
        $('.'+$(this).attr('data-slick')).slick('refresh');
    })
</script>

@endpush
