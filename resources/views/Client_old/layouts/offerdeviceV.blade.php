<div class="position-relative h-100">
    <div class="card cccard h-100 px-2">
        @if ($Device->HasDiscount())
            <div class="ribbon">
                {{ $Device->discount_value }}%
            </div>
        @endif
        <h5 class="text-center mt-3 mb-3">{{ mb_strimwidth($Device->title(), 0, 37, '...') }}</h5>
        <div class="text-center">
            <b>{{  $Device->PriceWithCurrancy()  }}</b>
        </div>
        <div class="ccc text-center">
            <img src="{{ $Device->Gallery->first()?->image ?? setting('logo') }}"  style="max-width: 100%; height:auto;max-height: 200px;" class="imw point point" onclick="window.location.href='{{ route('Client.device',$Device) }}'">
        </div>
        <div class="card-body">
            <div class="text-center" style="overflow: hidden;">
                <div style="width: max-content;margin: auto">
                    @foreach ($Device->Categories as $CategoryItem)
                        <small class="point" onclick="window.location.href='{{ route('Client.device',$Device) }}'">
                            {{ $CategoryItem->title() }} @if (!$loop->last) , @endif
                        </small>
                    @endforeach
                </div>
            </div>
            <div class="">
                <div id="{{ $Device->id }}-countdown" class="text-center countdown">
                    <ul class="p-0">
                        <li><span id="{{ $Device->id }}-days"></span>@lang('trans.days')</li>
                        <li><span id="{{ $Device->id }}-hours"></span>@lang('trans.hours')</li>
                        <li><span id="{{ $Device->id }}-minutes"></span>@lang('trans.minutes')</li>
                        <li><span id="{{ $Device->id }}-seconds"></span>@lang('trans.seconds')</li>
                    </ul>
                </div>
            </div>
            <div class="text-center">
                <button class="main_btn border-0 m-auto px-4 py-2" style="border-radius: 50px;" onclick="window.location.href='{{ route('Client.device',$Device) }}'">
                    @lang('trans.shopNow')
                </button>
            </div>
        </div>
    </div>
    
    @push('js')
    <script>
        const targetDate_{{ $Device->id }} = new Date("{{ $Device->discount_to }}").getTime();
        function startCountdown() {
            const  timeRemaining_{{ $Device->id }} = targetDate_{{ $Device->id }} - new Date().getTime();
    
            let days = Math.floor( timeRemaining_{{ $Device->id }} / (1000 * 60 * 60 * 24));
            let hours = Math.floor(( timeRemaining_{{ $Device->id }} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor(( timeRemaining_{{ $Device->id }} % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor(( timeRemaining_{{ $Device->id }} % (1000 * 60)) / 1000);
            hours = String(hours).padStart(2, "0");
            minutes = String(minutes).padStart(2, "0");
            seconds = String(seconds).padStart(2, "0");
            document.getElementById("{{ $Device->id }}-days").textContent = days;
            document.getElementById("{{ $Device->id }}-hours").textContent = hours;
            document.getElementById("{{ $Device->id }}-minutes").textContent = minutes;
            document.getElementById("{{ $Device->id }}-seconds").textContent = seconds;
        }
    
        setInterval(startCountdown, 1000);
    </script>
    @endpush
    
</div>