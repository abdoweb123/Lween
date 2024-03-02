<li class="nav-item @if(str_contains(Route::currentRouteName(), 'specs')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#specs" aria-controls="specs" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-microchip mx-2"></i>
        </span>
        <span class="text">{{ __('trans.specs') }}</span>
    </a>
    <ul id="specs" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.specs.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.specs.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>