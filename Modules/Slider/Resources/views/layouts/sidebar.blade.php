<li class="nav-item @if(str_contains(Route::currentRouteName(), 'sliders')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#sliders" aria-controls="sliders" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-regular fa-images mx-2"></i>
        </span>
        <span class="text">{{ __('trans.sliders') }}</span>
    </a>
    <ul id="sliders" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.sliders.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.sliders.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>