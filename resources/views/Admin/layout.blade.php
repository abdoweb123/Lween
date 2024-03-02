<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ setting('title_'.lang()) }}</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" value="{{ csrf_token() }}" content="{{ csrf_token() }}"/>
    <meta name="DT_Lang" value="{{ DT_Lang() }}" content="{{ DT_Lang() }}"/>
    <link rel="icon" href="{{ asset(setting('logo')) }}" type="image/x-icon">

    <style>
        :root {
            --main--color: {{ setting('main_color') }};
        }
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item a::before {
            @if (lang('en'))
                left: 0 !important;
            @else
                right: 0 !important;
            @endif
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.tiny.cloud/1/lj3niasi9s3d111t7rdmcli3m6lwbc6k3gs85xciou7c0oyn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    @yield('css')
    @if (lang('ar'))
        <link rel="stylesheet" href="{{ asset('css/ar.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/en.css') }}">
    @endif
</head>

<body>
    <aside class="sidebar-nav-wrapper active">
        <div class="navbar-logo">
            <a href="{{ route('admin.home') }}">
                <img src="{{ asset(setting('logo')) }}" alt="logo" style="height: 200px;max-width: 100%" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item">
                    <a href="/">
                        <span class="icon text-center">
                            <i style="width: 20px;" class="fa-solid fa-share mx-2"></i>
                        </span>
                        <span class="text">{{ __('trans.visit_website') }}</span>
                    </a>
                </li>

                <li class="nav-item @if(str_contains(Route::currentRouteName(), 'home')) active @endif">
                    <a href="{{ route('admin.home') }}">
                        <span class="icon text-center">
                            <i style="width: 20px;" class="fa-solid fa-chart-simple mx-2"></i>
                        </span>
                        <span class="text">{{ __('trans.dashboardTitle') }}</span>
                    </a>
                </li>

                @include('order::layouts.sidebar')
                @include('category::layouts.sidebar')
                @include('device::layouts.sidebar')
                @include('slider::layouts.sidebar')
                @include('ad::layouts.sidebar')
                @include('service::layouts.sidebar')
                @include('delivery::layouts.sidebar')
                @include('payment::layouts.sidebar')
                @include('branch::layouts.sidebar')
                @include('setting::layouts.sidebar')
                @include('faq::layouts.sidebar')
                @include('contact::layouts.sidebar')
                @include('admin::layouts.sidebar')
                @include('client::layouts.sidebar')
                @include('country::layouts.sidebar')


                @if (lang('en'))
                <li class="nav-item">
                    <a href="{{ route('lang', 'ar') }}">
                        <span class="icon text-center">
                            <img src="{{ asset('countries/Bahrain.png') }}" style="width: 20px;" class="mx-2">
                        </span>
                        <span class="text">العربية</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('lang', 'en') }}">
                        <span class="icon text-center">
                            <img src="{{ asset('language/en.png') }}" style="border-radius: 50%;width: 20px;" class="mx-2">
                        </span>
                        <span class="text">English</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>


    <main class="main-wrapper active">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6" style="z-index: 100">
                        <div class="header-left">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn main-btn btn-hover">
                                    <i class="lni lni-menu"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6>{{ auth()->user()->name }}</h6>
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <a href="{{ route('admin.profile.show') }}"> <i class="lni lni-user"></i> {{ __('trans.myProfile') }}</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"> <i class="lni lni-exit"></i> {{ __('trans.logout') }}</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="section">
            <div class="container-fluid">
                <div class="title-wrapper pt-30 d-flex" style="justify-content: space-between;">
                    <div class="title mb-30">
                        <h1>@yield('pagetitle')</h1>
                    </div>
                    @hasSection('back')
                        <div class="title mb-30">
                            <a href="@yield('back')"><i class="fa-solid fa-arrow-{{ lang('ar') ? 'left' : 'right' }}-long h1"></i></a>
                        </div>
                    @endif
                </div>

                <div class="card-styles">
                    @yield('content')
                </div>
            </div>
        </section>

    </main>



    @include('sweetalert::alert')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    {{-- datatables  --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


    @yield('js')
    @yield('script')

</body>
</html>
