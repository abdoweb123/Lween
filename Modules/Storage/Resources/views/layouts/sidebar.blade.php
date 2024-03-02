<li class="nav-item @if(str_contains(Route::currentRouteName(), 'storages')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#storages" aria-controls="storages" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-database mx-2"></i>
        </span>
        <span class="text">{{ __('trans.storage') }}</span>
    </a>
    <ul id="storages" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.storages.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.storages.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>