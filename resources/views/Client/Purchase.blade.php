<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/Responsive.css">
  <title></title>
</head>

<body>


  <div
    class="loading-screen position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
  </div>
  <div id="icons">
  </div>

  <div class="container-fluid section-top ">
    <div class="row border-bottom align-items-center py-3">

      <div class="col-4 d-flex justify-content-center align-items-center">
        <a href="cart.html">
          <i class="fa-solid fa-arrow-right text-secondary"></i>
        </a>
      </div>
      <div class="col-4 d-flex justify-content-center align-items-center">
        <img src="assets/imgs/main-logo.png" />
      </div>
      <div class="col-4"></div>

    </div>

  </div>
  <div class="container py-5">
    <div class="row ">
      <ol class="list-inline text-center step-indicator d-flex justify-content-around">
        <li class="active ">
          <div class="step border border-2 border-dark bg-black  text-white "><span>1</span></div>
          <div class="caption hidden-xs hidden-sm">العنوان و التوصيل</div>
        </li>
        <li class="incomplete hover-step">
          <a href="payment.html">
            <div class="step border border-2 border-secondary text-secondary"><span>2</span></div>
          </a>
          <div class="caption hidden-xs hidden-sm">الدفع و التأكيد</div>
        </li>
      </ol>
    </div>
    <div class="row py-2 ">
      <h6 class="fw-semibold py-2 ">
        العنوان و التوصيل
      </h6>
      <p>
        اختر عنوانك:

      </p>
    </div>

    <div class="row gap-3 address py-2 justify-content-center">
      <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
        <div class=" position-absolute d-icon">

          <span class="p-2"><i class="fa-solid fa-trash"></i></span>
          <span class="p-2">
            <a href="editAdress.html">
              <i class="fa-solid fa-pen"></i>
            </a>
          </span>

        </div>
        <p><span class="text-secondary px-2">الدولة:</span><span>السعودية</span></p>
        <p><span class="text-secondary px-2">المدينة:</span><span>الرياض</span></p>
        <p><span class="text-secondary px-2">الحي:</span><span>Egypt</span></p>
        <p><span class="text-secondary px-2">الشارع:</span><span>sidi bshr</span></p>
      </div>
      <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
        <div class=" position-absolute d-icon">

          <span class="p-2"><i class="fa-solid fa-trash"></i></span>
          <span class="p-2">
            <a href="editAdress.html">
              <i class="fa-solid fa-pen"></i>
            </a>
          </span>

        </div>
        <p><span class="text-secondary px-2">الدولة:</span><span>السعودية</span></p>
        <p><span class="text-secondary px-2">المدينة:</span><span>الرياض</span></p>
        <p><span class="text-secondary px-2">الحي:</span><span>Egypt</span></p>
        <p><span class="text-secondary px-2">الشارع:</span><span>sidi bshr</span></p>
      </div>
      <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
        <div class=" position-absolute d-icon">

          <span class="p-2"><i class="fa-solid fa-trash"></i></span>
          <span class="p-2">
            <a href="editAdress.html">
              <i class="fa-solid fa-pen"></i>
            </a>
          </span>

        </div>
        <p><span class="text-secondary px-2">الدولة:</span><span>السعودية</span></p>
        <p><span class="text-secondary px-2">المدينة:</span><span>الرياض</span></p>
        <p><span class="text-secondary px-2">الحي:</span><span>Egypt</span></p>
        <p><span class="text-secondary px-2">الشارع:</span><span>sidi bshr</span></p>
      </div>
      <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
        <div class=" position-absolute d-icon">

          <span class="p-2"><i class="fa-solid fa-trash"></i></span>
          <span class="p-2">
            <a href="editAdress.html">
              <i class="fa-solid fa-pen"></i>
            </a>
          </span>

        </div>
        <p><span class="text-secondary px-2">الدولة:</span><span>السعودية</span></p>
        <p><span class="text-secondary px-2">المدينة:</span><span>الرياض</span></p>
        <p><span class="text-secondary px-2">الحي:</span><span>Egypt</span></p>
        <p><span class="text-secondary px-2">الشارع:</span><span>sidi bshr</span></p>
      </div>
      <div class="col-lg-3 col-8 py-3" onclick="document.location='addNewadress.html'">
        <span><i class="fa-solid fa-plus"></i></span>
        اضافة عنوان جديد
      </div>

    </div>
    <div class="row py-2">
      <p>
        المنتجات
      </p>
      <div class="col-12">
        <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center " data-aos="fade-up"
          data-aos-duration="1000">
          <div class="col-lg-7 col-6">
            <div class="d-flex">
              <div class="flex-shrink-0 rounded-0">
                <img class="w-100 h-100" src="assets/imgs/b4.jpeg" alt="...">
              </div>
              <div class="flex-grow-1 p-3  fw-bold">
                2369 - 46.0 - XS ( ١٩ انش )
              </div>
            </div>
          </div>

          <div class="col-lg-5 col-6 text-price">
            3,300.00 AED
          </div>
        </div>
      </div>
    </div>
    <div class="row py-2 ">
      <p>
        اختر احد شركات التوصيل:
      </p>
      <div class="col-12 ">
        <div class="row border-1 border border-secondary p-1 rounded-1 my-2">
          <div class="col-6">
            <div class="form-check">
              <div class="">
                <input class="form-check-input px-2" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                  checked>
                <label class="form-check-label" for="flexRadioDefault1">
                  <span class="px-2"><i class="fa-solid fa-truck-fast"></i></span>
                  <span>شحن مجاني</span>
                </label>
              </div>
            </div>
          </div>
          <div class="col-6">
            <span>سعر الشحن:</span><span class="px-2">00</span>
          </div>
        </div>
      </div>
      <div class="col-12 ">
        <div class="row border-1 border border-secondary p-1 rounded-1 my-2">
          <div class="col-6">
            <div class="form-check">
              <div class="">
                <input class="form-check-input px-2" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                  checked>
                <label class="form-check-label" for="flexRadioDefault2">
                  <span class="px-2"><i class="fa-solid fa-house"></i></span>
                  <span>توصيل الي المنزل</span>
                </label>
              </div>
            </div>
          </div>
          <div class="col-6">
            <span>سعر الشحن:</span><span class="px-2">00</span>
          </div>
        </div>
      </div>
      <div class="col-12 ">
        <div class="row border-1 border border-secondary p-1 rounded-1 my-2">
          <div class="col-6">
            <div class="form-check">
              <div class="">
                <input class="form-check-input px-2" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                <label class="form-check-label" for="flexRadioDefault3">
                  <span class="px-2"><i class="fa-solid fa-shop"></i></span>
                  <span>استلام من المحل</span>
                </label>
              </div>
            </div>
          </div>
          <div class="col-6">
            <span>سعر الشحن:</span><span class="px-2">00</span>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-5">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-dark w-auto px-5" type="button" onclick="document.location='cart.html'">رجوع</button>
        <button class="btn btn-dark w-auto px-5" type="button"
          onclick="document.location='payment.html'">التالي</button>
      </div>
    </div>
  </div>
  <footer id="footer">
  </footer>
  <div id="sideNav">
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
    integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script src="assets/js/index.js"></script>
  <script>
    const selectedAddress = document.querySelectorAll('.address div');

    selectedAddress.forEach(selectedDiv => {
      selectedDiv.addEventListener('click', function () {
        selectedAddress.forEach(btn => {
          if (btn !== selectedDiv) {
            btn.classList.remove('active');
          }
        });
        this.classList.toggle('active');
      });
    });


    $(document).ready(function () {
      $('input[name="flexRadioDefault"]').change(function () {
        $('.row').removeClass('shadow');
        if ($(this).is(':checked')) {
          $(this).closest('.row').addClass('shadow');
        }
      });
    });
    $(document).ready(function () {
      $('input[name="flexRadioDefault"]').change(function () {
        $('.row').removeClass('shadow');
        if ($(this).is(':checked')) {
          $(this).closest('.row').addClass('shadow');
        }
      });

      // Trigger the change event on page load
      $('input[name="flexRadioDefault"]:checked').trigger('change');
    });

  </script>
  </script>
</body>

</html>