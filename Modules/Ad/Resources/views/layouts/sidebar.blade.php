<li class="nav-item @if(str_contains(Route::currentRouteName(), 'ads')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#ads" aria-controls="ads" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-film mx-2"></i>
        </span>
        <span class="text">{{ __('trans.Ads') }}</span>
    </a>
    <ul id="ads" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.ads.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.ads.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>