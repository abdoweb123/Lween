<li class="nav-item @if(str_contains(Route::currentRouteName(), 'services')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#services" aria-controls="services" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-icons mx-2"></i>
        </span>
        <span class="text">{{ __('trans.services') }}</span>
    </a>
    <ul id="services" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.services.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.services.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>