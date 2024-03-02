<div id="Sliders" class="carousel slide" data-bs-ride="carousel">
    @if($Sliders->count() > 1)
    <div class="carousel-indicators">
        @foreach ($Sliders as $Slider)
        <button type="button" data-bs-target="#Sliders" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $loop->index }}"></button>
        @endforeach
    </div>
    @endif

    <div class="carousel-inner">
        @foreach ($Sliders as $Slider)
        <div class="carousel-item py-3 {{ $loop->first ? ' active' : '' }} position-relative">
            <img src="{{ $Slider->file }}" class="w-100" alt="SliderImage">
            @if($Slider->title())
            <div class="carousel-caption">
                <b class="mb-3 text-center text-white">{{ $Slider->title() }}</b>
                <div class="mb-2 text-center text-white d-none d-md-block">{!! $Slider->desc() !!}</div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @if($Sliders->count() > 1)
    <button class="carousel-control-prev" type="button" data-bs-target="#Sliders" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#Sliders" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    @endif
</div>
