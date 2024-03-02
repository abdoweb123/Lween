<li class="nav-item">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#devices" aria-controls="devices" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-laptop-code mx-2"></i>
        </span>
        <span class="text">{{ __('trans.devices') }}</span>
    </a>
    <ul id="devices" class="dropdown-nav mx-2 collapse" style="">
        <li><a href="{{ route('admin.devices.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.devices.create') }}">{{ __('trans.add') }}</a></li>
        <hr>
        @include('brand::layouts.sidebar')
        @include('specs::layouts.sidebar')
        @include('width::layouts.sidebar')
        @include('height::layouts.sidebar')
{{--        @include('Modules.Height.views.layouts.sidebar')--}}
{{--        @include('storage::layouts.sidebar')--}}
{{--        @include('memory::layouts.sidebar')--}}
{{--        @include('processor::layouts.sidebar')--}}
{{--        @include('os::layouts.sidebar')--}}
{{--        @include('color::layouts.sidebar')--}}
{{--        @include('size::layouts.sidebar')--}}
        <hr>
    </ul>
</li>