<div class="card cccard position-relative my-4">
    @if ($Device->HasDiscount())
        <div class="ribbon">
            {{ $Device->discount_value }}%
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="ccc text-center">
                <img src="{{ $Device->Gallery->first()?->image ?? setting('logo') }}"  style="max-height: 200px;max-width: 70%" class="imw point point" onclick="window.location.href='{{ route('Client.device',$Device) }}'">
            </div>
        </div>
        <div class="col-md-6 py-3">
            <div class="card-body">
                <div class="py-3" style="background: #2f957d;border-radius: {{ lang('en') ? '0 50px 50px 0' : '50px 0 0 50px' }};color: white;font-weight: bold;width: fit-content;padding: 15px;">
                    <div id="{{ $Device->id }}-countdown" class="px-2">
                        <span>@lang('trans.expire_date') </span>
                        <span id="{{ $Device->id }}-days"></span> :
                        <span id="{{ $Device->id }}-hours"></span> :
                        <span id="{{ $Device->id }}-minutes"></span> :
                        <span id="{{ $Device->id }}-seconds"></span>
                    </div>
                </div>
                <h6 class="my-2"><b>{{ $Device->title() }}</b></h6>
                <div class="">@if ($Device->HasDiscount()) <small class="text-danger" style="text-decoration: line-through">{{ $Device->Price() }}</small> @endif {{  $Device->CalcPriceWithCurrancy()  }}</div>
                @if($Device->Specs()->count())
                    <ul class="list-group text-start">
                        @foreach($Device->Specs()->take(3)->get() as $Item)
                            <li class="p-0"><i class="fa-solid fa-circle main_color mx-2"></i>{{ $Item->title() }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
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
