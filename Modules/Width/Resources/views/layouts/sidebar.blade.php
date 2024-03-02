<li class="nav-item @if(str_contains(Route::currentRouteName(), 'widths')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#widths" aria-controls="brands" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-brands fa-bandcamp mx-2"></i>
        </span>
        <span class="text">{{ __('trans.widths') }}</span>
    </a>
    <ul id="widths" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.widths.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.widths.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>