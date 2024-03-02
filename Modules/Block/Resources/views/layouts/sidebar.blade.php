<li class="nav-item @if(str_contains(Route::currentRouteName(), 'blocks')) active @endif">
    <a class="collapsed" href="{{ route('admin.blocks.index') }}" class="">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-calendar-day mx-2"></i>
        </span>
        <span class="text">{{ __('trans.blocks') }}</span>
    </a>
</li>