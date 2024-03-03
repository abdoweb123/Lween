<nav id="navBar">
  <nav class="navbar navbar-expand-lg bg-body-tertiary " style="background:black">
    <div class="container-fluid ">
      <a class="d-lg-none d-flex align-items-center icon-menu" role="button" data-bs-toggle="offcanvas"
         data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <i class="fa-solid fa-bars text-white"></i>
      </a>
      <a class="navbar-brand py-2" href="{{route('Client.home')}}">

        <img width="150" src="{{asset(setting('logo'))}}" style="width:55px; height:55px"/>
      </a>


      <form class="form-res">
        <div class="px-2 search-input-icon">
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <a class="px-2 text-white" href="{{route('Client.continuePurchasingCart')}}">
          <i class="fa-solid fa-cart-shopping"></i>
        </a>
      </form>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav m-auto mb-2 mb-lg-0 fs-6 ">
          <li class="nav-item ">
            <a class="nav-link " aria-current="page" href="{{route('Client.home')}}" onclick="setActiveLink(this)">@lang('trans.MainPage')</a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="{{route('Client.allProducts')}}" onclick="setActiveLink(this)">@lang('trans.allProducts')</a>
          </li>

          @php
              $Categories_navbar = Categories()->take(6);
          @endphp

          @forelse($Categories_navbar as $Category)
            <li class="nav-item ">
              <a class="nav-link" href="{{route('Client.category.devices',$Category->id)}}" onclick="setActiveLink(this)">{{$Category['title_'.lang()]}}</a>
            </li>
          @empty
          @endforelse

          <li class="nav-item">
            <a class="nav-link" href="{{route('Client.getAllCategories')}}" onclick="setActiveLink(this)">@lang('trans.allCategories')</a>
          </li>
        </ul>
        <form class="d-flex">
          <div class="px-2 search-input-icon">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
          <a class="px-2 text-white" href="{{route('Client.continuePurchasingCart')}}">
            <i class="fa-solid fa-cart-shopping"></i>
          </a>
        </form>
      </div>
    </div>
  </nav>
  <div class="search-container position-fixed top-0 start-0 end-0 bottom-0  ">
    <a type="button" class="close-div position-absolute">
      <i class="fa-solid fa-xmark  text-white"></i>
    </a>
    <form class="h-100 w-100 d-flex justify-content-center align-items-center">
      <input type="text" class="nosubmit search-input border-bottom rounded-0 border-3" placeholder="ابحث">
    </form>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
          integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>
  <script>
    function setActiveLink(clickedLink) {
      localStorage.setItem('activeLinkText', clickedLink.textContent);
    }
    function restoreActiveLink() {
      var activeLinkText = localStorage.getItem('activeLinkText');
      if (activeLinkText) {
        var links = document.querySelectorAll('.navbar-nav .nav-item .nav-link');
        console.log(links)
        for (var i = 0; i < links.length; i++) {
          if (links[i].textContent == activeLinkText) {
            links[i].classList.add('active');
            localStorage.removeItem('activeLinkText');

            break;
          }
        }
      } else {
        var homeLink = document.querySelector('.navbar-nav .nav-item .nav-link[href="index.html"]');
        if (homeLink) {
          homeLink.classList.add('active');
        }
      }
    }
    document.addEventListener('DOMContentLoaded', restoreActiveLink());
    $(document).ready(function () {
      $(".search-input-icon").click(function () {
        $(".search-container").fadeIn();
        $(".search-input").animate({
          width: '80%'
        });
      });
      $(".close-div").click(function () {
        $(".search-container").fadeOut();
        $(".search-input").animate({
          width: '0%',
        });
      });

    });


  </script>
</nav>