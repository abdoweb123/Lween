<!DOCTYPE html>
<html lang="{{ lang() }}" dir="{{ lang('ar') ? 'rtl' : 'ltr' }}" data-bs-theme="">
<head>
    <meta charset="utf-8">
    <title>{{ setting('title_'.lang()) }}</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf_token" value="{{ csrf_token() }}" content="{{ csrf_token() }}"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="robots" content="max-snippet:-1,max-image-preview:large,max-video-preview:-1">
    <meta name="description" content="{{ strip_tags(setting('desc')) }}">
    <meta name="keywords" content="{{ strip_tags(setting('keywords')) }}">
    <meta name="author" content="{{ setting('title_'.lang()) }}">
    <meta name="image" content="{{ asset(setting('logo')) }}">
    <meta property="og:title" content="{{ setting('title_'.lang()) }}">
    <meta property="og:description" content="{{ strip_tags(setting('desc')) }}">
    <meta property="og:locale" content="en">
    <meta property="og:image" content="{{ asset(setting('logo')) }}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{ setting('title_'.lang()) }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="{{ setting('title_'.lang()) }}">
    <meta name="twitter:title" content="{{ setting('title_'.lang()) }}">
    <meta name="twitter:description" content="{{ strip_tags(setting('desc')) }}">
    <meta name="twitter:site" content="{{ setting('title_'.lang()) }}">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    
    <link rel="canonical" href="{{ url()->full() }}">
    <link rel="sitemap" href="/sitemap.xml" title="Sitemap" type="application/xml">
    <link href="{{ asset(setting('logo')) }}" rel="shortcut icon">

    <link href="{{ asset('bootstrap-5.3.0-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar_'. lang() .'.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.4.0-web/css/all.min.css') }}" />

    @include('Client.layouts.css')
    @stack('css')

</head>
<body class="{{ lang() == 'ar' ? 'text-right' : '' }}" dir="{{ lang('ar') ? 'rtl' : 'ltr' }}">
    <div class="preload">
        <div class="sound-wave">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="content">
        @include('Client.layouts.navbar')
        @include('Client.layouts.mega-menu')
        @yield('content')
        @include('Client.layouts.footer')
        @include('Client.layouts.backtotop')
    </div>


    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11;direction: ltr">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
           <div class="toast-header py-3">
                <i style="font-size: 25px;padding: 0px 5px;" class=""></i>
                <strong class="me-auto"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
           </div>
        </div>
     </div>


    <script src="{{ asset('jquery/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.0-dist/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.0-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('js')
    @include('sweetalert::alert')
</body>

</html>
