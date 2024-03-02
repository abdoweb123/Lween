<li class="nav-item @if(str_contains(Route::currentRouteName(), 'categories')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#categories" aria-controls="categories" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-clone mx-2"></i>
        </span>
        <span class="text">{{ __('trans.categories') }}</span>
    </a>
    <ul id="categories" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.categories.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.categories.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>