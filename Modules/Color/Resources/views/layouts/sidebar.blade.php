<li class="nav-item @if(str_contains(Route::currentRouteName(), 'colors')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#colors" aria-controls="colors" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-palette mx-2"></i>
        </span>
        <span class="text">{{ __('trans.colors') }}</span>
    </a>
    <ul id="colors" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.colors.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.colors.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>