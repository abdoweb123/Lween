<div id="icons">
  <div class="floatwhatsapp ">
    <i class="fa-brands fa-whatsapp "></i>

  </div>
  <div class="back-to-top" id="backTop">
    <i class="fa fa-arrow-up "></i>

  </div>
  <div class="flag d-flex align-items-center justify-content-center" id="flag">
    <p class="h-100 mb-0">
      <img class="flag_image flag_image--1 h-100"
           src="//bh.elnlondon.com/cdn/shop/files/bahrain_256x256_333b265a-f4b0-48ff-a617-c61cde98a36e_60x.png?v=1684861032"
           alt="">
      <span class="flag-country fs-6 ">BH</span>
      <i class="fa-solid fa-chevron-down fs-6"></i>
    </p>
    <span>

  </span>

  </div>
  <ul class="flag-list p-2 toggleshow">
    <li class="py-2 d-flex justify-content-between align-items-center w-100 fs-6">

      <img class="flag_image flag_image--3 h-100" width="40"
           src="//bh.elnlondon.com/cdn/shop/files/UAE_256x256_ca69ff20-bddb-4c18-bd64-5d6cfa6e3328_60x.png?v=1683650798"
           alt="">
      <span class="flag-country  px-1 fw-light"> aed</span>
    </li>
    <li class="py-2 d-flex justify-content-between align-items-center w-100 fs-6">

      <img class="flag_image flag_image--1 h-100" width="40"
           src="//bh.elnlondon.com/cdn/shop/files/bahrain_256x256_333b265a-f4b0-48ff-a617-c61cde98a36e_60x.png?v=1684861032"
           alt=""> <span class="flag-country  px-1 fw-light"> bh</span>
    </li>
    <li class="py-2 d-flex justify-content-between align-items-center w-100 fs-6">
      <img class="flag_image flag_image--3 " width="40"
           src="//bh.elnlondon.com/cdn/shop/files/qatar_256x256_db0e7820-b33f-4982-a2bc-b7a606ac22be_60x.png?v=1683650779"
           alt="">
      <span class="flag-country  px-1 fw-light"> Qar</span>
    </li>
    <li class="py-2 d-flex justify-content-between align-items-center w-100 fs-6">
      <img class="flag_image flag_image--3" width="40"
           src="//bh.elnlondon.com/cdn/shop/files/KSA_256x256_6b9e1f76-0a07-4ce0-ab82-b4a478ee9393_60x.png?v=1683650703"
           alt="">
      <span class="flag-country px-1 fw-light">Sar</span>

    </li>
  </ul>
  <script>
    $(document).ready(() => {
      let container = $(".section-top").offset().top;
      $(window).scroll(function () {
        let windowScroll = $(window).scrollTop();
        if (windowScroll > container) {
          $("#backTop").show(500);
          $("#backTop").fadeIn(500);
        }
        else {
          $("#backTop").fadeOut(500);

        }
      })
      $("#backTop").click(function () {
        $("html,body").animate({ scrollTop: 0 }, 300)
      })
    });
    var toggleshow = document.querySelector(".toggleshow");
    var flag = document.querySelector(".flag");
    flag.onclick = function () {
      if (toggleshow.style.display === "block") {
        toggleshow.style.display = "none";
        $(this).find(".fa-chevron-down").removeClass("rotate");
      } else {
        toggleshow.style.display = "block";
        $(this).find(".fa-chevron-down").toggleClass("rotate");

      }
    };
  </script>

</div>