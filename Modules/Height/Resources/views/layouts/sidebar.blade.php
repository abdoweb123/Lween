<li class="nav-item @if(str_contains(Route::currentRouteName(), 'heights')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#heights" aria-controls="brands" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-brands fa-bandcamp mx-2"></i>
        </span>
        <span class="text">{{ __('trans.heights') }}</span>
    </a>
    <ul id="heights" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.heights.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.heights.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>