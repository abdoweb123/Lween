
<style>
     .navbar{
         background: #fff;
         padding-top: 0;
         padding-bottom: 0;
         box-shadow: 1px 3px 4px 0 #adadad33;
    }
     .navbar-light .navbar-nav .nav-link {
         color: var(--main--color);
    }

     .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover {
         color: #fff;
    }
     .navbar-light .navbar-nav .nav-link{
         padding-top: 22px;
         padding-bottom: 22px;
         transition: 0.3s;
         padding-left: 24px;
         padding-right: 24px;
             font-size: 14px;
    }
     .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav .nav-link:hover{
         background: var(--main--color);
         transition: 0.3s;
    }
    .dropdown-item:focus, .dropdown-item:hover {
        color: #fff;
        text-decoration: none;
        background-color: var(--main--color) !important;
    }
    .sm-menu{
        border-radius: 0px;
        border: 0px;
        top: 97%;
        box-shadow: rgba(173, 173, 173, 0.2) 1px 3px 4px 0px;
    }
    .dropdown-item {
        color: #3c3c3c;
            font-size: 14px;
    }
    .dropdown-item.active, .dropdown-item:active {
        color: #fff;
        text-decoration: none;
        background-color: #2196F3;
    }
    .navbar-toggler{
        outline: none !important;
    }
    .navbar-tog{
        color: var(--main--color);
    }
    .megamenu-li {
    	position: static;
    }
    
    .megamenu {
    	position: absolute;
    	width: 100%;
    	left: 0;
    	right: 0;
    	padding: 15px;
    }
    .megamenu h6{
        margin-left: 21px;
    }
    .megamenu i{
        width: 20px;
    }

</style>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <div class="collapse navbar-collapse justify-content-center" id="mobile_nav">
            <ul class="navbar-nav navbar-light">
                <li class="nav-item"><a class="nav-link" href="{{ route('Client.home') }}">@lang('trans.home')</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('Client.about') }}">@lang('trans.about')</a></li>
                <li class="nav-item dmenu dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('trans.brands')
                    </a>
                    <div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown">
                        @foreach(Brands() as $Brand)
                        <a class="dropdown-item" href="{{ route('Client.categories',['brand_id'=>$Brand->id]) }}">
                            <img src="{{ asset($Brand->file) }}" width="20" >
                            <span class="mx-2">
                                {{ $Brand->title() }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </li>
                <!--========-->
                <li class="nav-item dropdown megamenu-li dmenu">
                    <a class="nav-link dropdown-toggle" href="#" id="Categories-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('trans.categories')</a>
                    <div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="Categories-dropdown">
                        <div class="row">
                            @foreach(Categories() as $Category)
                                <div class="col-sm-6 col-lg-3 border-right mb-4">
                                    <h6>{{ $Category->title() }}</h6>
                                    @foreach($Category->children as $SubCategory)
                                        <a style="overflow: hidden;" class="dropdown-item mx-4" href="{{ route('Client.categories',['category'=>$SubCategory->id]) }}">{{ $SubCategory->title() }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('Client.contact') }}">@lang('trans.contact')</a></li>
            </ul>
        </div>
    </div>
</nav>


@push('js')
<script>
    
    $(document).ready(function () {
        $('.navbar-light .dmenu').hover(function () {
            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
        }, function () {
            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
        });
    }); 
     
    $(document).ready(function() {
    	$(".megamenu").on("click", function(e) {
    		e.stopPropagation();
    	});
    });

</script>
@endpush