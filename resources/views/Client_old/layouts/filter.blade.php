
<form>
    @foreach (Categories() as $P_Category)
        <div class="mt-3">
            <h4 class="">{{ $P_Category->title() }}</h4>
            @if($P_Category->children->count())
                @foreach ($P_Category->children as $Category)
                <div class="d-flex align-items-center">
                    <input  type="checkbox" name="categories[]" value="{{ $Category->id }}" {{ (in_array($Category->id, $Categories) || $Category->id == request('category')) ? 'checked' : '' }} class="me-2">
                    <label="teny_font mx-3">{{ $Category->title() }}</label>
                </div>
                @endforeach
            @else
                <div class="d-flex align-items-center">
                    <input  type="checkbox" name="categories[]" value="{{ $P_Category->id }}" {{ in_array($P_Category->id, $Categories) ? 'checked' : '' }} class="me-2">
                    <label="teny_font mx-3">{{ $P_Category->title() }}</label>
                </div>
            @endif
        </div>
    @endforeach
    <div class="mt-3">
        <h4 class="">@lang('trans.colors')</h4>
        @foreach (Colors() as $Color)
        <div class="d-flex align-items-center">
            <input type="checkbox" name="colors[]" value="{{ $Color['id'] }}"{{ in_array($Color['id'], $Colors) ? 'checked' : '' }} class="me-2">
            <label class="teny_font mx-3">
                <span class="fa fa-circle pr-1" style="color: {{ $Color['hexa'] }}"></span>{{ $Color->title() }}</label>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        <h4 class="">@lang('trans.size')</h4>
        @foreach (Sizes() as $Size)
        <div class="d-flex align-items-center">
            <input type="checkbox" name="sizes[]" value="{{ $Size['id'] }}"{{ in_array($Size['id'], $Sizes) ? 'checked' : '' }} class="me-2">
            <label class="teny_font mx-3">{{ $Size->title() }}</label>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        <h4 class="">@lang('trans.processor')</h4>
        @foreach (Processors() as $Processor)
        <div class="d-flex align-items-center">
            <input type="checkbox" name="processors[]" value="{{ $Processor['id'] }}"{{ in_array($Processor['id'], $Processors) ? 'checked' : '' }} class="me-2">
            <label class="teny_font mx-3">{{ $Processor->title() }}</label>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        <h4 class="">@lang('trans.storage')</h4>
        @foreach (Storages() as $Storage)
        <div class="d-flex align-items-center">
            <input type="checkbox" name="storages[]" value="{{ $Storage['id'] }}"{{ in_array($Storage['id'], $Storages) ? 'checked' : '' }} class="me-2">
            <label class="teny_font mx-3">{{ $Storage->title() }}</label>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        <h4 class="">@lang('trans.memory')</h4>
        @foreach (Memories() as $Memory)
        <div class="d-flex align-items-center">
            <input type="checkbox" name="memories[]" value="{{ $Memory['id'] }}"{{ in_array($Memory['id'], $Memories) ? 'checked' : '' }} class="me-2">
            <label class="teny_font mx-3">{{ $Memory->title() }}</label>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        <h4 class="">@lang('trans.os')</h4>
        @foreach (OS() as $OS)
        <div class="d-flex align-items-center">
            <input type="checkbox" name="os[]" value="{{ $OS['id'] }}"{{ in_array($OS['id'], $OperatingSystems) ? 'checked' : '' }} class="me-2">
            <labe class="teny_font mx-3">{{ $OS->title() }}</label>
        </div>
        @endforeach
    </div>
    <div class="py-3">
        <h4 class="">@lang('trans.priceRange')</h4>
        <div class="price-range-slider">
            <p class="range-value">
                <input type="hidden" class="min_price" name="min_price" value="{{ $min_price }}">
                <input type="text" class="amount border-0 w-100" readonly>
                <input type="hidden" class="max_price" name="max_price" value="{{ $max_price }}">
            </p>
            <div class="slider-range" class="range-bar"></div>
        </div>
    </div>
    <button class="main_btn border-0 p-3 mt-5 w-100 mx-2 rounded transition-me">@lang('trans.Search')</button>
</form>
