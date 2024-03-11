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
            <a class="nav-link" href="{{route('Client.category.products',$Category->id)}}" onclick="setActiveLink(this)">{{$Category['title_'.lang()]}}</a>
          </li>
        @empty
        @endforelse

        <li class="nav-item">
          <a class="nav-link" href="{{route('Client.getAllCategories')}}" onclick="setActiveLink(this)">@lang('trans.allCategories')</a>
        </li>

        <li class="mt-2">
          <ul class="px-1">
            @if(auth()->guard('client')->check())
              <li class="mb-1"><a class="dropdown-item" href="{{route('Client.profile')}}">@lang('trans.myProfile')</a></li>
              <li><a class="dropdown-item" href="{{route('Client.logout')}}">@lang('trans.logout')</a></li>
            @else
              <li class="mb-1"><a class="dropdown-item" href="{{route('Client.login')}}">@lang('trans.login')</a></li>
              <li><a class="dropdown-item" href="{{route('Client.register')}}">@lang('trans.register_as_a_new_user')</a></li>
            @endif
          </ul>
        </li>


      </ul>
      <div class="mt-auto">
        <div class="btn-group" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" role="group"
             aria-label="Basic outlined example">
          <button type="button" class="btn btn-outline-dark text-white">{{session()->get('addressCountry')['title_'.lang()] ?? country()['title_'.lang()]}} - {{session()->get('addressRegion')['title_'.lang()] ?? region()['title_'.lang()] }}</button>
          <button type="button" class="btn btn-outline-dark text-white"><span>
                <i class="fa-solid fa-globe"></i>
              </span>

            @if(lang() == 'ar')
              English
            @else
              اللغة العربية
            @endif
          </button>
        </div>
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