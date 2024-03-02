<li class="nav-item @if(str_contains(Route::currentRouteName(), 'orders')) active @endif">
    <a class="collapsed" href="{{ route('admin.orders.index') }}">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-arrow-up-wide-short mx-2"></i>
        </span>
        <span class="text">{{ __('trans.orders') }}</span>
    </a>
</li>