<li class="nav-item @if(str_contains(Route::currentRouteName(), 'os')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#os" aria-controls="os" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-brands fa-windows mx-2"></i>
        </span>
        <span class="text">{{ __('trans.os') }}</span>
    </a>
    <ul id="os" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.os.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.os.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>