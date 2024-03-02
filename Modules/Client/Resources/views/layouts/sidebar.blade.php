<li class="nav-item @if(str_contains(Route::currentRouteName(), 'clients')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#clients" aria-controls="clients" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-user-tag mx-2"></i>
        </span>
        <span class="text">{{ __('trans.clients') }}</span>
    </a>
    <ul id="clients" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.clients.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.clients.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>