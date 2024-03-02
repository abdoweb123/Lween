<li class="nav-item @if(str_contains(Route::currentRouteName(), 'payments')) active @endif">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#payments" aria-controls="payments" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-credit-card mx-2"></i>
        </span>
        <span class="text">{{ __('trans.payments') }}</span>
    </a>
    <ul id="payments" class="dropdown-nav mx-4 collapse" style="">
        <li><a href="{{ route('admin.payments.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.payments.create') }}">{{ __('trans.add') }}</a></li>
    </ul>
</li>