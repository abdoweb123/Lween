
@php($Gallery = $Device->Gallery->whereNotNull('image'))
<div class="card cccard point position-relative m-1" onclick="window.location.href='{{ route('Client.device',$Device) }}'">
    @isset ($New)        
        <div class="position-absolute main_bg mx-2 my-1 px-3 py-1 rounded" style="z-index: 999">
            @lang('trans.New')
        </div>
    @endisset
    @if ($Device->HasDiscount())        
        <div class="position-absolute second_bg mx-2 {{ isset($New) ? 'my-5' : 'my-1' }} py-1 rounded third_color" style="z-index: 999;padding: 3px 13px !important;">
            {{ $Device->discount_value }}<i class="fa-solid fa-percent mx-1"></i>
        </div>
    @endif
    @php($front = isset($Gallery[0]) ? $Gallery[0]['image'] : setting('logo'))
    @php($back = isset($Gallery[1]) ? $Gallery[1]['image'] : $front)
    <div class="ccc">
        <div class="flip-container w-100 text-center">
            <div class="flipper">
                <div class="front text-center">
                    <img  src="{{ asset($front) }}" class="imw">
                </div>
                <div class="back text-center">
                    <img  src="{{ asset($back)  }}" class="imw">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center mx-auto" style="height: 50px;">
            <small>
                @foreach ($Device->Categories as $CategoryItem)
                    <b class="">
                        {{ $CategoryItem?->title() }} @if (!$loop->last) , @endif
                    </b>
                @endforeach
            </small>
        </div>
        <div class="text-center"  style="    width: max-content;height: 30px">
            <b>{{  mb_strimwidth($Device->title(), 0, 33, '...')  }}</b>
        </div>
        <div class="text-center">@if ($Device->HasDiscount()) <small class="text-danger" style="text-decoration: line-through">{{ $Device->Price() }}</small> @endif {{  $Device->CalcPriceWithCurrancy()  }}</div>
    </div>
</div>