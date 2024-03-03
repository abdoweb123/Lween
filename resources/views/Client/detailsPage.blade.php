@extends('Client.Layout.index')


@section('title')
  @lang('trans.product_details')
@stop

@section('link')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@stop

@section('content')

  <div class="container section-top">
    <div class="row gap-5 py-5 scrolling">
      <div class="col-lg-5 col-12">
        <div class="row row-res py-2">
          <div class="col-12">
            <img class="w-100 img-big " data-fancybox="gallery" data-src="{{asset($product->header)}}" src="{{asset($product->header)}}" />
          </div>
        </div>
        <div class="row gy-5 justify-content-between row-small">
          <div class="col-lg-6 row-res-img  zoom">
            <img class="w-100 img-big" data-fancybox="gallery" data-src="{{asset($product->header)}}" src="{{asset($product->header)}}" />
          </div>
          @foreach($product->gallery as $gallery)
            <div class="col-lg-6  zoom">
              <img class="w-100 img-big" data-fancybox="gallery" data-src="{{asset($gallery->image)}}" src="{{asset($gallery->image)}}" />
            </div>
          @endforeach
        </div>
      </div>

      <div class="col-lg-5  col-12">
        <form action="{{route('Client.AddToCart')}}" method="POST" class="p-0">
          @csrf
          <input type="hidden" name="device_id" value="{{$product->id}}">
          <div class="row py-2">
            <h5 class="header-card p-0">#{{$product->id}} </h5>
            <p class="card-text body-card fs-6 p-0">
              {{$product["title_".lang()]}}
            </p>
            <h5 class="p-0">
              @if($product->HasDiscount())
                <span style="text-decoration: line-through; display:block;">{{$product->Price()}} {{Country()->currancy_code}}</span>
                <span>{{$product->PriceWithCurrancy()}}</span>
              @else
                <span style="display:block; visibility: hidden;">...</span>
                <span>{{$product->price}}</span> {{Country()->currancy_code}}
              @endif
            </h5>
          </div>

          <div class="row gap-2  my-3">
            <h6 class="p-0">
              @lang('trans.height')
            </h6>
            @foreach($heights as $key => $height)
                  @php
                      $class = $key === 0 ? 'active' : '';
                      $checked = $key === 0 ? 'checked' : '';
                  @endphp
              <button id="{{$height->id}}" onclick="putHeight(this, event)" class="col-2 border-1 btn btn-outline-dark length rounded-0 w-auto px-2 {{$class}}">
                {{$height->title}}
                <input type="radio" name="height_id" value="{{$height->id}}" style="display: none" {{$checked}}>
              </button>
            @endforeach

          </div>

          <div class="row gap-2  my-3">
            <h6 class="p-0">
              @lang('trans.width')
            </h6>
            @foreach($widths as $key => $width)
                  @php
                      $class = $key === 0 ? 'active' : '';
                      $checked = $key === 0 ? 'checked' : '';
                  @endphp
              <button onclick="putWidth(this)" class="col-2 border-1 width btn btn-outline-dark rounded-0 w-auto px-2 {{$class}}">
                {{$width["title_".lang()]}}
                  <input type="radio" name="width_id" value="{{$width->id}}" style="display: none" {{$checked}}>
              </button>
            @endforeach

          </div>

          <div class="row  my-3">
            <h6 class="p-0">
              @lang('trans.closure_abaya')
            </h6>
              <div class="border border-1 p-2 my-2">
                <input type="checkbox" id="sides_closure" name="sides_closure">
                <label for="sides_closure" class="fs-6">
                  @lang('trans.sides_closure_abaya')
                </label>
              </div>
              <div class="border border-1 border-1 p-2 my-2">
                <input type="checkbox" id="front_closure" name="front_closure">
                <label for="front_closure" class="fs-6">
                  @lang('trans.front_closure_abaya')
                </label>
              </div>
          </div>
          <div class="row  my-3">
            <h6 class="p-0">
              @lang('trans.notes')
            </h6>
              <input type="text" name="notes" class="form-control py-2" placeholder="(@lang('trans.The_colour_cut_or_fabric_cannot_be_changed'))">
          </div>
          <div class="row  my-3">
            <h6 class="p-0 fw-bold">
               @lang('trans.quantity')
            </h6>
            <select class="form-select border border-1 rounded-0 w-100 px-4" name="quantity" aria-label="Default select example">
              @for($i=1; $i<=$product->quantity; $i++)
                <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
          <div class="row my-3">
            <button type="submit" class="btn btn-dark rounded-1 my-2">@lang('trans.Add to cart')</button>
          </div>
        </form>
      </div>

    </div>


  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 py-2">
        <h5 class="fw-semibold text-dark py-2">
          <span>
            <i class="fa-solid fa-list-check" style="font-size:larger ;"></i>
          </span>

          @lang('trans.desc_product')
        </h5>
        <p class="fs-6">
          {!! $product["long_desc_".lang()] !!}
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 py-2">
        <h5 class="fw-semibold text-dark py-2">
          <span>
            <i class="fa-solid fa-bars" style="font-size:larger ;"></i>

          </span>
          @lang('trans.options_product')
        </h5>
        <table class="table">
          <thead class="bg-light">
          <tr>
            <th scope="col">عرض العباية</th>
            <th scope="col">طول العباية </th>
            <th scope="col">صور المنتج
            </th>
            <th scope="col">السعر
            </th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>XS (١٩ انش)
            </td>
            <td>46.0
            </td>
            <td>لا يوجد صور
            </td>
            <td>3,200.00 دإ

            </td>
          </tr>
          <tr>
            <td>XS (١٩ انش)
            </td>
            <td>46.0
            </td>
            <td>لا يوجد صور
            </td>
            <td>3,200.00 دإ

            </td>
          </tr>
          <tr>
            <td>XS (١٩ انش)
            </td>
            <td>46.0
            </td>
            <td>لا يوجد صور
            </td>
            <td>3,200.00 دإ

            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

@stop


@section('script')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
          integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
          integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

  <script>
    Fancybox.bind('[data-fancybox="gallery"]', {
    });
    document.addEventListener('DOMContentLoaded', function () {

      function handleButtonClick(buttons, currentButton) {
        buttons.forEach(btn => {
          if (btn !== currentButton) {
            btn.classList.remove('active');
          }
        });
        currentButton.classList.toggle('active');
      }

      const sizeButtons = document.querySelectorAll('.length');
      sizeButtons.forEach(button => {
        button.addEventListener('click', function () {
          handleButtonClick(sizeButtons, this);
        });
      });

      const widthButtons = document.querySelectorAll('.width');
      widthButtons.forEach(button => {
        button.addEventListener('click', function () {
          handleButtonClick(widthButtons, this);
        });
      });




    });

    function putHeight(button, event) {
      event.preventDefault(); // Prevent default action

      // Get the radio input associated with the button
      var radioInput = button.querySelector('input[type="radio"]');

      // Uncheck all radio inputs with the same name
      var radioInputs = document.querySelectorAll('input[name="height"]');
      radioInputs.forEach(function(input) {
        input.checked = false;
      });

      // Check the radio input associated with the clicked button
      radioInput.checked = true;
    }

    function putWidth(button) {
          event.preventDefault(); // Prevent default action
      // Get the radio input associated with the clicked button
      var radioInput = button.querySelector('input[type="radio"]');

      // Uncheck all radio inputs with the same name
      var radioInputs = document.querySelectorAll('input[name="width"]');
      radioInputs.forEach(function(input) {
        input.checked = false;
      });

      // Check the radio input associated with the clicked button
      radioInput.checked = true;
    }

  </script>
@stop