@extends('Client.layouts.layout')
@section('content')

<div class="container my-5">
    <div class="row">
        <ul class="breadcrumb d-flex justify-content-center align-items-center">
            <li><h2>@lang('trans.home')</h2></li>
            <li><h4><i class="fa-solid fa-chevron-{{ lang('en') ? 'right' : 'left' }} mx-2"></i></h4></li>
            <li><h2>{{ $Device->title() }}</h2></li>
        </ul>
    </div>
    @livewire('build',['Device'=>$Device])
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



    </style>
@endpush

@push('js')
    <script>
        device_id = {{ $Device->id }};
        color_id = {{ 0 }};
        $(document).on("click", ".fa-circle", function () {
            color_id = $(this).attr('data-id');
            $('.fa-circle').removeClass('active');
            $(this).addClass('active');
        });
    </script>
@endpush
