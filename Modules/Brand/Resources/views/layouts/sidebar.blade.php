<li class="nav-item @if(str_contains(Route::currentRouteName(), 'brands')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#brands" aria-controls="brands" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-brands fa-bandcamp mx-2"></i>
        </span>
        <span class="text">{{ __('trans.brands') }}</span>
    </a>
    <ul id="brands" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.brands.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.brands.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>