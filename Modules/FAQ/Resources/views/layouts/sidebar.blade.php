<li class="nav-item @if(str_contains(Route::currentRouteName(), 'faq')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#faq" aria-controls="faq" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-person-circle-question mx-2"></i>
        </span>
        <span class="text">{{ __('trans.FAQ') }}</span>
    </a>
    <ul id="faq" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.faq.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.faq.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>