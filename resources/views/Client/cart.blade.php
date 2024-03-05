@extends('Client.Layout.index')


@section('title')
    @lang('trans.shopping_cart')
@stop


@section('style')
    <style>
        .hasDiscount_lineThrough, .each, .no_discount, .increase_quantity{
            display: block;
            font-size: 12px
        }
        .hasDiscount_lineThrough{text-decoration: line-through}
        .hasDiscount, .no_discount{font-size: 16px}
        .sub_total{
            font-size: 13px;
            font-weight: 700;
            opacity: 0.9;
        }

        .icon-delete-circle {
            display: inline-block;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #ccc;
            text-align: center;
            line-height: 25px; /* Adjust line height for vertical alignment */
        }

        .icon-delete {
            font-size: 14px;
            color: #fff;
        }
    </style>
@stop



@section('content')
  <div class="position-fixed congratulation top-0 start-0 end-0 bottom-0 ">

  <div class="js-container" style="top:0px !important;"></div>
  </div>
  <div class="container section-top my-5 " style="min-height: 60vh;">
    <div class="row gap-5 justify-content-center">
        <div class="col-lg-7 col-12 ">
           <h3 class="py-2 fw-bold">
            @lang('trans.products')
           </h3>
           <div class="row  p-1 my-2" >
            <div class="col-lg-7 col-6">@lang('trans.product')</div>
            <div class="col-lg-2 col-3">@lang('trans.quantity')</div>
            <div class="col-lg-3 col-3">@lang('trans.price')</div>
           </div>
            @foreach($carts as $cart)
                <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center" data-aos="fade-up" data-aos-duration="1000">
                    <div class="col-lg-1 cart-product-delete">
                        <a onclick="deleteCartItem(this)" data-cart-id="{{$cart->id}}" data-product-id="{{$cart->device_id}}" data-template="template_for_cart_products_list">
                            <span class="prefix load_img" style="display: none">
                                <img class="send-coupon-progress" src="{{asset('assets_client/imgs/spinner.png')}}" width="15" height="15"></span>
                            <span class="icon-delete-circle">
                            <span class="icon-delete">x</span>
                        </span>
                            <span class="delete-text"></span>
                            <span class="postfix"></span>
                        </a>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0 rounded-0">
                                <img class="w-100 h-100" src="{{asset($cart->Device->header)}}" alt="...">
                            </div>
                            <div class="flex-grow-1 p-3  fw-bold">
                                #{{$cart->device_id}} - {{$cart->Height->title}} - {{$cart->Width['title_'.lang()]}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-3">
                        <select id="updateQuantity_{{$cart->id}}" class="form-select border border-1 rounded-0 w-100 px-4">
                            @for($i=1; $i<=$cart->Device->quantity; $i++)
                                <option value="{{$i}}" {{$cart->quantity == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-lg-3 col-3 text-price">
                        @if($cart->Device->HasDiscount())
                            <span id="cart-item_{{$cart->id}}" data-has-discount="true" data-cart-id="{{$cart->id}}">
                                <span class="hasDiscount">
                                    <span id="price_after_discount_{{$cart->id}}" class="hasDiscount_price cart_final_price">
                                        {{ number_format($cart->Device->RealPrice() * $cart->quantity, 2) }}
                                    </span>
                                    {{Country()->currancy_code}}
                                </span>
                                <span class="hasDiscount_lineThrough">
                                    <span id="price_before_discount_{{$cart->id}}">
                                        {{ number_format($cart->Device->Price() * $cart->quantity, 2) }}
                                    </span>
                                    {{Country()->currancy_code}}
                                </span>
                                <span class="increase_quantity" id="increase_quantity_{{$cart->id}}" style="display:{{$cart->quantity>1? 'block;' : 'none;'}}">
                                    <span id="each_{{$cart->id}}">
                                        {{ number_format($cart->Device->RealPrice(), 2) }}
                                    </span>
                                  {{Country()->currancy_code}} @lang('trans.each')
                                </span>
                            </span>
                        @else
                            <span id="cart-item_{{$cart->id}}" data-has-discount="false" data-cart-id="{{$cart->id}}">
                                <span class="no_discount" id="no_discount_{{$cart->id}}">
                                    <span id="no_discount_price_{{$cart->id}}" class="hasDiscount_price cart_final_price">
                                      {{ number_format($cart->Device->Price() * $cart->quantity, 2) }}
                                    </span>
                                    {{Country()->currancy_code}}
                                </span>
                                <span class="increase_quantity" id="increase_quantity_{{$cart->id}}" style="display:{{$cart->quantity>1? 'block;' : 'none;'}}">
                                    <span class="each_{{$cart->id}}">
                                      {{ number_format($cart->Device->Price(), 2) }}
                                    </span>
                                    {{Country()->currancy_code}} @lang('trans.each')
                                </span>
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-lg-4 col-12">
      <h3 class="py-2 fw-bold">
        @lang('trans.invoice_details')
       </h3>
        <div class="row  p-1 my-2">
            <div class="col-7">@lang('trans.description')</div>
            <div class="col-5">@lang('trans.value')</div>
        </div>

        <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center">
            <div class="col-5">
                @lang('trans.sub_total')
            </div>
            <div class="col-7 sub_total text-center">
                <span class="sub_total_price">
                    {{ number_format($sub_total, 2) }}
                </span>
                &nbsp; {{Country()->currancy_code}}
            </div>
        </div>
        <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center">
            <div class="col-5">
                @lang('trans.total')
            </div>
            <div class="col-7 fw-bold total text-center">
                <span class="total_price">
                    {{ number_format(($sub_total * (setting('vat')/100)) + $sub_total, 2) }}
                </span>
                &nbsp; {{Country()->currancy_code}}
            </div>
        </div>
        <div class="row">
            <div class="col-7" style="font-size:15px;">
                <span>@lang('trans.vat')</span> &nbsp; <span> {{setting('vat')}} %</span>
            </div>
        </div>
        <div class="row p-1 my-2">
            <div class="m-0 p-0 row">
                <label for="coupon" class="py-2" >@lang('trans.coupon') </label>
                <div class="col align-items-center">
                    <input type="text" class="form-control" id="coupon_code" placeholder="@lang('trans.enterCoupon')">
                </div>
                <div class="col-auto align-items-center">
                    <button onclick="sendCoupon()" class="btn btn-dark rounded-1 mb-3 send_coupon">
                        <span class="send_coupon_span">@lang('trans.send')</span>
                        <span class="prefix load_img_coupon" style="display: none">
                           <img class="send-coupon-progress" src="{{asset('assets_client/imgs/spinner.png')}}" width="15" height="15">
                        </span>
                    </button>
                </div>
            </div>

            <form class="row g-2" action="{{ route('Client.chooseAddressShipping') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-dark rounded-1 my-2">@lang('trans.purchase_follow_up')</button>
                <a class="btn btn-outline-dark rounded-1 my-2" href="{{route('Client.home')}}" >@lang('trans.back_to_shopping') </a>
            </form>
        </div>

    </div>
    </div>
  </div>
@stop


@section('script')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    @foreach($carts as $cart)

        <script>
            // Update price depending on quantity
            $(document).ready(function() {
                $('select[id^="updateQuantity_{{$cart->id}}"]').change(function() {
                    var selectedOption = $(this).val();
                    var cartId = $(this).attr('id').split('_')[1]; // Extract the cart ID from the select element's ID

                    console.log('Selected Option:', selectedOption);
                    console.log('Cart ID:', cartId);
                    if (selectedOption) {
                        $.ajax({
                            url: '{{route('Client.updateProductCartQuantity')}}', // Replace '/' with your base URL
                            type: 'POST',
                            data: {
                                cart_id: cartId,
                                quantity: selectedOption,
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log('success');

                                var hasDiscount = $('#cart-item_'+cartId).data('has-discount');

                                console.log(hasDiscount);

                                if (hasDiscount) {
                                    // update price_after_discount
                                    var price_after_discount = {{$cart->Device->RealPrice()}} * selectedOption;
                                    $('#price_after_discount_'+cartId).text(price_after_discount);

                                    // update price_before_discount
                                    var price_before_discount = {{$cart->Device->Price()}} * selectedOption;
                                    $('#price_before_discount_'+cartId).text(price_before_discount);

                                    var new_quantity = Number(response.quantity);
                                    console.log(new_quantity);
                                    if (new_quantity > 1){
                                        $('#increase_quantity_'+cartId).show();
                                        // update price_after_discount for each
                                        var price_after_discount_each = {{$cart->Device->RealPrice()}} ;
                                        $('#each_'+cartId).text(price_after_discount_each);
                                    }else {
                                        $('#increase_quantity_'+cartId).hide();
                                    }
                                }
                                else {
                                    var new_quantity_noDiscount = Number(response.quantity);
                                    console.log(new_quantity_noDiscount);

                                    // update price_all
                                    var price_after = {{$cart->Device->Price()}} * new_quantity_noDiscount;
                                    $('#no_discount_price_'+cartId).text(price_after);

                                    if (new_quantity_noDiscount > 1){
                                        $('#increase_quantity_'+cartId).show();
                                        // update price_after_discount for each
                                        var price_each = {{$cart->Device->Price()}} ;
                                        $('#each_'+cartId).text(price_each);
                                    }else {
                                        $('#increase_quantity_'+cartId).hide();
                                    }
                                }


                                // Update Sub_total
                                var subTotalPrice = 0;
                                // Iterate over each element with class 'cart_final_price'
                                $('.cart_final_price').each(function() {
                                    var price = parseFloat($(this).text());
                                    subTotalPrice += price;
                                });
                                subTotalPrice = subTotalPrice.toFixed(2);
                                $('.sub_total_price').text(subTotalPrice);

                                // Update total
                                var subTotalPriceNum = parseFloat(subTotalPrice);
                                $('.total_price').text((subTotalPriceNum * ({{setting('vat')}}) / 100) + subTotalPriceNum);


                            },
                            error: function(xhr, status, error) {
                                console.log('failed');
                            }
                        });
                    }
                });

            });


            // Remove element from cart
            function deleteCartItem(element) {
                // Show the spinner
                var spinner = element.querySelector('.send-coupon-progress');

                // Hide the delete icon and text
                element.querySelector('.icon-delete').classList.add('d-none');
                element.querySelector('.icon-delete-circle').classList.add('d-none');
                element.querySelector('.load_img').classList.add('d-inline-block');

                // Extract the data attributes
                var cartProductId = element.getAttribute('data-cart-id');
                var productId = element.getAttribute('data-product-id');

                // Perform AJAX request to remove the element
                $.ajax({
                    type: "POST",
                    url: "{{route('Client.removeCartElement')}}",
                    data: {
                        cart_id: cartProductId,
                        product_id: productId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Remove the parent element after a successful response
                        spinner.closest('.row').remove();

                        // Update Sub_total
                        var subTotalPrice = 0;
                        // Iterate over each element with class 'cart_final_price'
                        $('.cart_final_price').each(function() {
                            var price = parseFloat($(this).text());
                            subTotalPrice += price;
                        });
                        subTotalPrice = subTotalPrice.toFixed(2);
                        $('.sub_total_price').text(subTotalPrice);

                        // Update total
                        var subTotalPriceNum = parseFloat(subTotalPrice);
                        $('.total_price').text(subTotalPriceNum * ({{setting('vat')}}) / 100 + subTotalPriceNum);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if needed
                        console.error('Error:', error);
                    }
                });
            }
        </script>
    @endforeach


    <script>
        function sendCoupon() {

            // Hide the send_coupon_span and show the load_img_coupon
            $('.send_coupon_span').hide();
            $('.load_img_coupon').show();

            // Retrieve the value of the coupon code input field
            var couponCode = $('#coupon_code').val();

            var totalPriceText = $('.total_price').text();

            // Remove any non-numeric characters and convert the string to a number
            var totalPrice = parseFloat(totalPriceText.replace(/[^\d.-]/g, ''));


            // Make an AJAX request to the server
            $.ajax({
                type: "POST",
                url: "{{ route('Client.findCoupon') }}",
                data: {
                    coupon_code: couponCode,
                    total_price: totalPrice,
                    _token: '{{ csrf_token() }}', // Add CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        // Coupon applied successfully
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            html: '<p>' + response.message + '</p>' +
                                '<p>' + '@lang('trans.total')' + ': ' + response.total + ' {{Country()->currancy_code}}' + '</p>' +
                                '<form id="saveForm" action="{{ route('Client.chooseAddressShipping') }}" method="get">' +
                                '@csrf' +
                                '<button type="submit" class="btn btn-dark rounded-1 my-2">{{__('trans.purchase_follow_up')}}</button>' +
                                '</form>' +
                                '<a class="btn btn-outline-dark rounded-1 my-2" href="{{ route('Client.home') }}">{{__('trans.back_to_shopping')}}</a>',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        }).then(() => {
                            // Handle any additional logic after the SweetAlert closes
                        });

                        $(".congratulation").fadeToggle();
                        $('.total_price').text(response.total);

                        $('.send_coupon_span').show();
                        $('.load_img_coupon').hide();

                    } else {
                        // Invalid coupon code or usage limit reached
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                            showCloseButton: false,
                            allowOutsideClick: false,
                        });
                    }
                    $('.send_coupon_span').show();
                    $('.load_img_coupon').hide();
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                    // Optionally display an error message to the user
                    alert('An error occurred while processing your request.');
                }
            });
        }
    </script>


    <script>

        function preventFormSubmission(event) {
            event.preventDefault();
            triggerConfettiAnimation();
        }


        $(document).ready(function(){
            $("#success").click(function(){
                $(".congratulation").fadeToggle();
            });
        });

        // let confetti = new Confetti('success');
        // confetti.setCount(50);
        // confetti.setSize(3);
        // confetti.setPower(75);
        // confetti.setFade(true);
        // // confetti.destroyTarget(true);
        // confetti.destroyTarget(false);



        const Confettiful = function(el) {
            this.el = el;
            this.containerEl = null;

            this.confettiFrequency = 10;
            this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E','#EFFF1D'];
            this.confettiAnimations = ['slow', 'medium', 'fast'];

            this._setupElements();
            this._renderConfetti();
        };

        Confettiful.prototype._setupElements = function() {
            const containerEl = document.createElement('div');
            const elPosition = this.el.style.position;

            if (elPosition !== 'relative' || elPosition !== 'absolute') {
                this.el.style.position = 'relative';
            }

            containerEl.classList.add('confetti-container');

            this.el.appendChild(containerEl);

            this.containerEl = containerEl;
        };

        Confettiful.prototype._renderConfetti = function() {
            this.confettiInterval = setInterval(() => {
                const confettiEl = document.createElement('div');
                const confettiSize = (Math.floor(Math.random() * 3) + 7) + 'px';
                const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
                const confettiLeft = (Math.floor(Math.random() * this.el.offsetWidth)) + 'px';
                const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];

                confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
                confettiEl.style.left = confettiLeft;
                confettiEl.style.width = confettiSize;
                confettiEl.style.height = confettiSize;
                confettiEl.style.backgroundColor = confettiBackground;

                confettiEl.removeTimeout = setTimeout(function() {
                    confettiEl.parentNode.removeChild(confettiEl);
                }, 3000);

                this.containerEl.appendChild(confettiEl);
            }, 25);
        };

        window.confettiful = new Confettiful(document.querySelector('.js-container'));

    </script>
@stop