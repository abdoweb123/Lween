<li class="nav-item @if(str_contains(Route::currentRouteName(), 'processors')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#processors" aria-controls="processors" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-microchip mx-2"></i>
        </span>
        <span class="text">{{ __('trans.processor') }}</span>
    </a>
    <ul id="processors" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.processors.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.processors.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>