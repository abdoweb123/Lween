<li class="nav-item @if(str_contains(Route::currentRouteName(), 'memories')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#memories" aria-controls="memories" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-sd-card mx-2"></i>
        </span>
        <span class="text">{{ __('trans.memory') }}</span>
    </a>
    <ul id="memories" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.memories.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.memories.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>