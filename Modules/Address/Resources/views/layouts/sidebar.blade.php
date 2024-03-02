<li class="nav-item @if(str_contains(Route::currentRouteName(), 'addresses')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#addresses" aria-controls="addresses" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-earth-asia mx-2"></i>
        </span>
        <span class="text">{{ __('trans.Address Us') }}</span>
    </a>
    <ul id="addresses" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.addresses.index') }}">{{ __('trans.viewAll') }}</a></li>
    </ul>
</li>
