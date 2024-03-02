<li class="nav-item @if(str_contains(Route::currentRouteName(), 'sizes')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#sizes" aria-controls="sizes" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-desktop mx-2"></i>
        </span>
        <span class="text">{{ __('trans.sizes') }}</span>
    </a>
    <ul id="sizes" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.sizes.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.sizes.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>