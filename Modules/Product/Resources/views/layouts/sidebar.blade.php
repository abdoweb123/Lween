<li class="nav-item">
    <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#products" aria-controls="products" aria-expanded="true" aria-label="Toggle navigation">
        <span class="icon text-center">
            <i style="width: 20px;" class="fa-solid fa-laptop-code mx-2"></i>
        </span>
        <span class="text">{{ __('trans.products') }}</span>
    </a>
    <ul id="products" class="dropdown-nav mx-2 collapse" style="">
        <li><a href="{{ route('admin.products.index') }}">{{ __('trans.viewAll') }}</a></li>
        <li><a href="{{ route('admin.products.create') }}">{{ __('trans.add') }}</a></li>
        <hr>
        @include('brand::layouts.sidebar')
        @include('width::layouts.sidebar')
        @include('height::layouts.sidebar')
        <hr>
    </ul>
</li>