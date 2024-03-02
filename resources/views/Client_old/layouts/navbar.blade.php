<div >
    <nav class="navbar navbar-expand-lg" style="color: #fff !important;background: var(--main--color);">
        <div class="container">
            <a class="navbar-brand me-0" href="{{ route('Client.home') }}">
                <img src="{{ asset('logo.png') }}" alt="logo" style="max-width: 200px">
            </a>
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" class=" d-lg-none third_link px-3"><i class="fa-solid fa-bars-staggered"></i></a>
            <div class="collapse navbar-collapse w-100" style="justify-content: space-around;" id="navbarSupportedContent">
                <form action="{{ route('Client.categories') }}" class="d-flex flex-grow-1" style="max-width: 400px;">
                    <input class="form-control me-2" type="search" name="search" placeholder="@lang('trans.search')" aria-label="Search">
                    <button class="btn third_border third_link" type="submit">@lang('trans.search')</button>
                </form>
                <ul class="navbar-nav">
                    
                    <li class="nav-item d-none d-lg-block">
                        <div class="dropdown-center">
                            <button class="third_link dropdown-toggle" style="display:contents" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset(country()->image) }}" alt="logo" style="max-width: 20px"> {{ country()->currancy_code }}
                            </button>
                            
                            <ul class="dropdown-menu" style="    z-index: 1030;">
                                @foreach(Countries() as $Country)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('change-country',$Country->id) }}">
                                            <img src="{{ asset($Country->image) }}" alt="logo" style="max-width: 20px"> {{ $Country->currancy_code }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li> 
                    
                     <li class="nav-item d-none d-lg-block">
                        <div class="dropdown-center">
                            <button class="third_link dropdown-toggle" style="display:contents" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user"></i>
                            </button>
                            
                            <ul class="dropdown-menu" style="    z-index: 1030;">
                        
                                @auth('client')
                                    <li><a href="{{ route('Client.profile') }}" class="dropdown-item"><i class="fa-regular fa-user"></i> @lang('trans.profile')</a></li>
                                    <li><a href="{{ route('Client.profile') }}/wishlist" class="dropdown-item"><i class="fa-solid fa-heart"></i> @lang('trans.WISHLIST')</a></li>
                                    <li><a href="{{ route('Client.logout') }}" class="dropdown-item"><i class="fa-solid fa-right-from-bracket"></i> @lang('trans.logout')</a></li>
                                @else
                                    <li><a href="{{ route('Client.login') }}" class="dropdown-item"><i class="fa-regular fa-user"></i> @lang('trans.login')</a></li>
                                    <li><a href="{{ route('Client.register') }}" class="dropdown-item"><i class="fa-regular fa-user"></i> @lang('trans.register')</a></li>
                                @endauth
                            </ul>
                        </div>
                    </li> 
                    
                    
                    @if (lang('en'))
                        <li class="nav-item d-none d-lg-block"><a href="{{ route('lang', 'ar') }}" class="third_link px-3">العربية</a></li>
                    @else
                        <li class="nav-item d-none d-lg-block"><a href="{{ route('lang', 'en') }}" class="third_link px-3">English</a></li> 
                    @endif
                   
                    <li class="nav-item d-none d-lg-block"><a href="{{ route('Client.cart') }}" class="third_link px-3"><i class="fa-solid fa-cart-shopping"></i>({{ cart_count() }})</a></li>
                  
                </ul>
            </div>
        </div>
    </nav>
</div>
{{--
<nav class="navbar navbar-expand-lg rounded d-flex justify-content-center" style="color: #fff !important;background: var(--main--color);">
    <div class="container">
        <header class="d-flex flex-wrap justify-content-between align-items-center w-100">
            <a class="navbar-brand me-0" href="{{ route('Client.home') }}">
                <img src="{{ asset(setting('logo')) }}" alt="logo" style="max-width: 200px">
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item  d-none d-lg-block"><a href="/" class="third_link px-3 active" aria-current="page">@lang('trans.home')</a></li>
                <li class="nav-item d-none d-lg-block"><a href="{{ route('Client.categories') }}" class="third_link px-3">@lang('trans.categories')</a></li>
                <li class="nav-item  d-none d-lg-block"><a href="#search" class="third_link px-3 active" aria-current="page">@lang('trans.search')</a></li>
                @auth('client')
                    <li class="nav-item d-none d-lg-block"><a href="{{ route('Client.profile') }}" class="third_link px-3">@lang('trans.profile')</a></li>
                    <li class="nav-item d-none d-lg-block"><a href="{{ route('Client.profile') }}/wishlist" class="third_link px-3">@lang('trans.WISHLIST')</a></li>
                    <li class="nav-item d-none d-lg-block"><a href="{{ route('Client.logout') }}" class="third_link px-3">@lang('trans.logout')</a></li>
                @else
                    <li class="nav-item d-none d-lg-block"><a href="{{ route('Client.login') }}" class="third_link px-3">@lang('trans.login')</a></li>
                @endauth
                <li class="nav-item d-none d-lg-block"><a href="{{ route('Client.cart') }}" class="third_link px-3"><i class="fa-solid fa-cart-shopping"></i>({{ cart_count() }})</a></li>
                @if (lang('en'))
                    <li class="nav-item d-none d-lg-block"><a href="{{ route('lang', 'ar') }}" class="third_link px-3">العربية</a></li>
                @else
                    <li class="nav-item d-none d-lg-block"><a href="{{ route('lang', 'en') }}" class="third_link px-3">English</a></li> 
                @endif
                <li class="nav-item d-none d-lg-block">
                    <div class="dropdown-center">
                        <button class="dropdown-toggle" style="display:contents" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset(country()->image) }}" alt="logo" style="max-width: 20px"> {{ country()->currancy_code }}
                        </button>
                        
                        <ul class="dropdown-menu" style="    z-index: 1030;">
                            @foreach(Countries() as $Country)
                                <li>
                                    <a class="dropdown-item" href="{{ route('change-country',$Country->id) }}">
                                        <img src="{{ asset($Country->image) }}" alt="logo" style="max-width: 20px"> {{ $Country->currancy_code }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li> 
                
                <li class="nav-item d-md-none"><a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" class="third_link px-3"><i class="fa-solid fa-bars-staggered"></i></a></li>
            </ul>
        </header>
    </div>
</nav>
--}}

<style>
    .nav-item-sm.active {
        border-left: 3px solid var(--main--color) !important;
        border-radius: 0px;
        padding: 5px;
    }
    .nav-item-sm.active .nav-link-sm, .nav-link-sm.active {
        padding: 0px;
        border-radius: 0px;
        background-color: transparent !important;
        color: var(--second--color) !important;
    }
</style>




<nav class="navbar fixed-top">
    <div class="container-fluid">
        <div class="offcanvas offcanvas-{{ lang('ar') ? 'end' : 'start' }}" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">{{ setting('title_'.lang()) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item nav-item-sm active"> <a class="nav-link nav-link-sm" href="#">Home </a> </li>
                    <li class="nav-item nav-item-sm"><a class="nav-link nav-link-sm" href="#"> About </a></li>
                    <li class="nav-item nav-item-sm"><a class="nav-link nav-link-sm" href="#"> Services </a></li>
                    @foreach (Categories()->where('children_count','>',0) as $Category)
                    <li class="nav-item nav-item-sm dropdown">
                        <a class="nav-link nav-link-sm {{ $Category->children_count ? 'dropdown-toggle' : '' }}" href="#" data-bs-toggle="dropdown">
                            {{ $Category->title() }}
                        </a>
                        <ul class="dropdown-menu border-0">
                            @foreach ($Category->children as $Children)
                            <li><a class="dropdown-item" href="{{ route('Client.categories',['category'=>$Children->id]) }}">{{ $Children->title() }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>


<form action="{{ route('Client.categories') }}" >
    <div id="search-box">
        <div class="container">
           <a class="close" href="#close"></a>
           <div class="search-main">
              <div class="search-inner">
                 <input name="search" type="text" id="inputSearch" placeholder="">
                 <span class="search-info">Hit enter to search or ESC to close</span>
              </div>
           </div>
        </div>
     </div>     
</form>

@push('js')
    <script>
     
        $('a[href="#search"]').click(function() {
            event.preventDefault()
            $("#search-box").addClass("-open");
            setTimeout(function() {
                inputSearch.focus();
            }, 800);
        });

        $('a[href="#close"]').click(function() {
            event.preventDefault()
            $("#search-box").removeClass("-open");
        });

        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                $("#search-box").removeClass("-open");
            }
        });
    </script>
@endpush
