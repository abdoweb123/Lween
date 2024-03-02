<li class="nav-item @if(str_contains(Route::currentRouteName(), 'branches')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#branches" aria-controls="branches" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-code-branch mx-2"></i>
        </span>
        <span class="text">{{ __('trans.branch') }}</span>
    </a>
    <ul id="branches" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.branches.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.branches.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>