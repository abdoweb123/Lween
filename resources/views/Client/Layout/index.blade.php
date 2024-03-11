<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" >
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=product-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets_client/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_client/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
    integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets_client/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets_client/css/Responsive.css')}}">
  <link rel="icon" href="{{ asset(setting('logo')) }}" type="image/x-icon">
    @yield('link')
    <title>@yield('title')</title>
  <style>
    .img-card {
      height: 300px !important;
    }
    #flag{
      display: none !important;
    }

    .social li:nth-child(3) a:before{
      background-color: yellow;
    }

    .social li:nth-child(4) a:before{
      background: linear-gradient(
              to right,
              #833ab4,#fd1d1d,#fcb045
      );
    }
     a .fa-snapchat{color:black !important;}

    @if(lang() == 'en')
      body{direction: ltr}
    @else
       body{direction: rtl}
    @endif
  </style>

  @yield('style')
</head>

<body>
  <div
    class="loading-screen position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
  </div>

  @include('Client.Layout.navslider')
  @include('Client.Layout.navBar')
  @include('Client.Layout.icons')

  <!-- For Errors -->
  @if($errors->any())
    <div class="position-fixed end-0" style="top: 25%;z-index: 1111">
      @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{$error}}
        </div>
      @endforeach
    </div>
  @endif

  @yield('content')


  @include('Client.Layout.gray-footer')
  @include('Client.Layout.Footer')
  @include('Client.Layout.Sidenavbar')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
    integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

{{--  <script src="assets_client/js/index.js"></script>--}}


  <!-- Include SweetAlert library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>
    // Get the data passed from the session
    var success = {!! json_encode(session('success')) !!};
    var type = {!! json_encode(session('type')) !!};
    var message = {!! json_encode(session('message')) !!};
    var cart_count = {!! json_encode(session('cart_count')) !!};

    let textMessage = '';
    // Check if cart_count is not empty
    if (cart_count) {
      // If cart_count is not empty, concatenate it with the label
      textMessage = '@lang('trans.cart_count')' + ' : ' + cart_count;
    } else {
      // If cart_count is empty, display a different message
      textMessage = '';
    }

    // Display SweetAlert based on the session data
    if (success) {
      Swal.fire({
        icon: type,
        title: message,
        text: textMessage,
        showConfirmButton: true,
        // timer: 1500 // Display duration in milliseconds
      });
    }
  </script>

  <script>

    AOS.init({
      once: true
    })

    document.addEventListener('DOMContentLoaded', function () {
      var seeAllProductLinks = document.querySelectorAll('.seeall-product');

      seeAllProductLinks.forEach(function (link) {
        link.addEventListener('click', function () {
          console.log("hi");

          var container = this.closest('.container');
          var h3Element = container.querySelector('h3');
          var activeLinkText = h3Element.textContent.trim();
          localStorage.setItem('activeLinkText', activeLinkText);
        });
      });
    });

    $(".slider2").slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      arrows: true,
      autoplaySpeed: 1000,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            infinite: true,
          },
        },
        {
          breakpoint: 919,
          settings: {
            slidesToShow: 2,
          },
        }
      ],
    });
    $(".slider1").slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      arrows: false,
      autoplaySpeed: 1000,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            infinite: true,
          },
        },
        {
          breakpoint: 919,
          settings: {
            slidesToShow: 2,
          },
        }
      ],
    });
    $(".slider4").slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      arrows: false,
      autoplaySpeed: 1000,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            infinite: true,
          },
        },
        {
          breakpoint: 919,
          settings: {
            slidesToShow: 2,
          },
        }
      ],
    });


    $(document).on("click", ".list-group-item .toggle", function () {
      $(this).parent().find('ul').toggleClass('d-none');
    });

    $(document).ready(() => {
      $(".loading-screen").fadeOut(1000);
    });
  </script>

  <script>
    AOS.init({
      once: true
    })
    document.getElementById('sizeDropdown').addEventListener('change', function () {
      var selectedValue = this.value;
      document.getElementById('sizeValue').textContent = selectedValue;
      var tbody = document.getElementById('sizeTableBody');
      var sizeOptions = [];
      if (selectedValue === 'BR') {
        sizeOptions = ['P', 'M', 'G', 'GG'];
      } else if (selectedValue === 'EU') {
        sizeOptions = ['36', '38', '40/42', '44'];
      } else if (selectedValue === 'DE') {
        sizeOptions = ['36', '38', '40/42', '44'];
      } else if (selectedValue === 'SG') {
        sizeOptions = ['SG-L', 'SG-XL', 'SG-XXL', 'SG-3XL'];
      } else if (selectedValue === 'AU') {
        sizeOptions = ['8', '10', '12/14', '16'];
      } else if (selectedValue === 'JP') {
        sizeOptions = ['JP-L', 'JP-XL', 'JP-XXL', 'JP-3XL'];
      } else if (selectedValue === 'UK') {
        sizeOptions = ['8', '10', '12/14', '16'];
      } else if (selectedValue === 'IT') {
        sizeOptions = ['40', '42', '44/46', '48'];
      } else if (selectedValue === 'MX') {
        sizeOptions = ['CH', 'M', 'G', 'XG'];
      } else if (selectedValue === 'FR') {
        sizeOptions = ['36', '38', '40/42', '44'];
      } else if (selectedValue === 'ES') {
        sizeOptions = ['36', '38', '40/42', '44'];
      } else if (selectedValue === 'US') {
        sizeOptions = ['4', '6', '8/10', '12'];
      }
      for (var i = 0; i < tbody.rows.length; i++) {
        var row = tbody.rows[i];
        var cell2 = row.cells[1];
        var size = sizeOptions[i];
        cell2.textContent = size;
      }
    });

    var multiply = true;

    document.getElementById('button-1').addEventListener('change', function () {
      multiply = !multiply;
      updateTable();
    });

    document.getElementById('button-1').addEventListener('click', function (event) {
      event.stopPropagation();
    });

    function updateTable() {
      var tbody = document.querySelector('.sizeTableBody');
      for (var i = 0; i < tbody.rows.length; i++) {
        var row = tbody.rows[i];
        for (var j = 0; j < row.cells.length; j++) {
          if (j === 1) {
            continue;
          }
          var cell = row.cells[j];
          var originalValue = parseFloat(cell.textContent);

          if (!isNaN(originalValue)) {
            var result = multiply ? (originalValue * 0.3937).toFixed(2) : (originalValue / 0.3937).toFixed(2);
            cell.textContent = result;
          }
        }
      }
    }




    // $(document).ready(function(){
      $('#country').change(function(){
        var countryId = $(this).val();

        if(countryId){
          $.ajax({
            url: '{{ route('Client.getRegionsOfCountry') }}',
            type: 'GET',
            data: {country_id: countryId},
            dataType: 'json',
            success:function(data){
              $('#region').empty();
              $.each(data, function(key, value){
                $('#region').append('<option value="'+ key +'">'+ value +'</option>');
              });
            }
          });
        }
      });
    // });
  </script>

  <!-- Start Add tostr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    // Check if there are any toast messages from the backend
    @if(session('toast_message'))
    // Display the toast message using Toastr
    toastr.{{ session('toast_message')['type'] }}('{{ session('toast_message')['message'] }}');
    @endif
  </script>
  <!-- End Add tostr -->



@yield('script')

</body>

</html>