<div id="sideNav">
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasRightLabel">
        <img width="150" src="{{asset(setting('logo'))}}" style="width:55px; height:55px"/>

      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="fa-solid fa-xmark text-white"></i>
      </button>
    </div>
    <div class="offcanvas-body h-100 d-flex flex-column">
      <ul class="navbar-nav  mb-2 mb-lg-0 p-3">
        <li class="nav-item ">
          <a class="nav-link " aria-current="page" href="index.blade.php" onclick="setActiveLink(this)">الصفحة الرئيسية</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="allProducts.html" onclick="setActiveLink(this)">جميع المنتجات</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="allProducts.html" onclick="setActiveLink(this)">مينتورا كوليكشن</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="allProducts.html" onclick="setActiveLink(this)">عنان كوتور</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="allProducts.html" onclick="setActiveLink(this)">شنط عنان</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="allProducts.html" onclick="setActiveLink(this)">الأناقة البسيطة</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="allProducts.html" onclick="setActiveLink(this)">الفساتين والبناطيل</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.html" onclick="setActiveLink(this)">جميع التصنيفات</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.html" onclick="setActiveLink(this)">تسجيل الدخول</a>
        </li>
      </ul>
      <div class="mt-auto">
        <div class="btn-group direction" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
             role="group" aria-label="Basic outlined example">
          <button type="button" class="btn btn-outline-light">السعودية-الرياض</button>
          <button type="button" class="btn btn-outline-light">
          <span>
            <i class="fa-solid fa-globe"></i>
          </span>
            <span>
          English
        </span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $(".search").click(function () {
        $("#search").fadeToggle();
      });
    });
  </script>
</div>