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
        <a href="index.blade.php">
          <i class="fa-solid fa-arrow-right text-secondary"></i>
        </a>
      </div>
      <div class="col-4 d-flex justify-content-center align-items-center">
        <img src="assets/imgs/main-logo.png" />
      </div>
      <div class="col-4"></div>

    </div>

  </div>
  <div class="container my-5" style="min-height: 60vh;">
    <div class="row  border-bottom">
      <p>
        تعديل العنوان
      </p>
    </div>
    <form action="">
      <div class="row gap-2 my-5 p-2 bg-light">
        <div class="col-5">
          <h6>الدولة</h6>
          <select class=" btn-sm w-100 gray-bage border-0 px-2" aria-label="Default select example">
            <option selected> الدولة</option>
            <option value="الاحدث">السعودية</option>
            <option value="DE">ر.س</option>
          </select>
        </div>
        <div class="col-5">
          <h6>المدينة</h6>

          <select class=" btn-sm w-100 gray-bage border-0 px-2" aria-label="Default select example">
            <option selected> الرياض</option>
            <option value="الاحدث">دأ</option>
            <option value="DE">ر.س</option>
          </select>
        </div>
        <div class="col-5">
          <h6>
            الشارع

          </h6>
          <input type="text" class="form-control">
        </div>
        <div class="col-5">
          <h6>الحي
          </h6>
          <input type="text" class="form-control">
        </div>
        <div class="col-5">
          <h6>
            الشارع

          </h6>
          <input type="text" class="form-control">
        </div>
        <div class="col-5">
          <h6>الحي
          </h6>
          <input type="text" class="form-control">
        </div>
        <div class="col-5">
          <h6>
            الشارع

          </h6>
          <input type="text" class="form-control">
        </div>
        <div class="col-5">
          <h6>الحي
          </h6>
          <input type="text" class="form-control">
        </div>
        <div class="col-5">
          <h6>
            الشارع

          </h6>
          <input type="text" class="form-control">
        </div>
        <div class="col-5">
          <h6>الحي
          </h6>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="row my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <a class="btn btn-dark w-auto px-5" type="button" href="Purchase.html">التالي</a>
          <button class="btn btn-outline-dark w-auto px-5" type="button"
            onclick="document.location='Purchase.html'">الغاء</button>

        </div>
      </div>
    </form>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script src="assets/js/index.js"></script>

  <script>
    $("#example-basic").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      autoFocus: true
    });
  </script>
</body>

</html>