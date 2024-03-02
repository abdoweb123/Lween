<div class="row">
    <div class="col-12 col-lg-8">

        <h1>{{ $Device->title() }}</h1>
        
        <h3 class="my-5">{{ __('trans.display') . ' ' . __('trans.size') }}</h3>
        
        <div class="row">
            @foreach($Sizes as $Item)
                <div class="col-4 col-mg-4 col-lg-3 point position-relative" wire:click="ChangeSelectedSize({{ $Item->size_id }})">
                    @if($SelectedSize ==  $Item->size_id)
                        <i class="fa-regular fa-circle-check text-success position-absolute" style="right: 17px;top: 5px;"></i>
                    @endif
                    <div class="rounded-0 p-3 h5 {{ $SelectedSize ==  $Item->size_id ? 'main_border border-2' : 'border border-dark' }}" data-size_id="{{ $Item->size_id }}">
                        <p>{{ $Item->Size->title() }}</p>
                        <p>
                            <small class="mx-1">@lang('trans.from'):</small>
                            <small class="mx-1">{{ $SelectedItem->CalcPriceWithCurrancy() }}</small>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <h3 class="my-5">{{ __('trans.color') }}</h3>
        <div class="row d-flex">
            @foreach($Colors as $Item)
                <a style="width: fit-content;" class="point"  wire:click="ChangeSelectedColor({{ $Item->color_id }})">
                    @if($SelectedColor ==  $Item->color_id)
                        <i class="fa-solid fa-circle mx-1 h2 border border-3 p-1 rounded-circle" style="border-style: dashed !important;border-color: {{ $Item->Color->hexa }} !important;color: {{ $Item->Color->hexa }}"></i>
                    @else
                        <i class="fa-solid fa-circle mx-1 h2 p-1 rounded-circle" style="border-color: {{ $Item->Color->hexa }} !important;color: {{ $Item->Color->hexa }}"></i>
                    @endif
                </a>
            @endforeach
        </div>
        <h3 class="my-5">{{ __('trans.specifications') }}</h3>
        <div class="row">
            @foreach($Specifications as $Item)
                <div class="col-6 col-mg-4 col-lg-3 point position-relative" wire:click="ChangeSpecification({{ $Item->id }})">
                    @if($SelectedSpecification ==  $Item->id)
                        <i class="fa-regular fa-circle-check text-success position-absolute" style="right: 17px;top: 5px;"></i>
                    @endif
                    <div class="rounded-0 p-3 h5 {{ $SelectedSpecification ==  $Item->id ? 'main_border border-2' : 'border border-dark' }}" data-size_id="{{ $Item->size_id }}">
                        <button type="button" class="btn btn-warning my-2">{{ $SelectedItem->CalcPriceWithCurrancy() }}</button>
                        <p>
                            <span>{{ $Item->Size->title() }}</span><br>
                            <span>{{ $Item->Processor->title() }}</span><br>
                            <span>{{ $Item->Memory->title() }}</span><br>
                            <span>{{ $Item->Storage->title() }}</span><br>
                            <span>{{ $Item->OS->title() }}</span><br>
                            <span>{{ $Item->Color->title() }}</span><br>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-lg-4 d-flex align-items-center">
        <div class="p-4" style="background-color: #ededed;">
            <div>
                <img class="w-100 img-responsive" style=" mix-blend-mode:multiply;" src="{{ asset($Device->Gallery->when($SelectedColor, fn($query) =>  $query->where('color_id', $SelectedColor) )->first()?->image) }}" />
            </div>
            <h2>@lang('trans.Summary')</h2>
            <div class="d-flex justify-content-between align-items-center">
                <p>{{ $Device->title() }}</p>
                <p>{{ $SelectedItem->CalcPriceWithCurrancy() }}</p>
            </div>
            
            <p>{{ $SelectedItem?->Size->title() }} @lang('trans.size')</p>
            <p>{{ $SelectedItem?->Processor->title() }} @lang('trans.processor')</p>
            <p>{{ $SelectedItem?->Memory->title() }} @lang('trans.memory')</p>
            <p>{{ $SelectedItem?->Storage->title() }} @lang('trans.storage')</p>
            <p>{{ $SelectedItem?->OS->title() }} @lang('trans.os')</p>
            
            <p>@lang('trans.return-days')</p>
            
            <button class="add-to-cart-button w-100">
                <svg class="add-to-cart-box box-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="24" height="24" rx="2" fill="#ffffff" />
                </svg>
                <svg class="add-to-cart-box box-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="24" height="24" rx="2" fill="#ffffff" />
                </svg>
                <svg class="cart-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <svg class="tick" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path fill="none" d="M0 0h24v24H0V0z" />
                    <path fill="#ffffff"
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM9.29 16.29L5.7 12.7c-.39-.39-.39-1.02 0-1.41.39-.39 1.02-.39 1.41 0L10 14.17l6.88-6.88c.39-.39 1.02-.39 1.41 0 .39.39.39 1.02 0 1.41l-7.59 7.59c-.38.39-1.02.39-1.41 0z" />
                </svg>
                <span class="add-to-cart">@lang('trans.addToCart')</span>
                <span class="added-to-cart">@lang('trans.addedSuccessfully')</span>
            </button>
            <a download class="btn third_btn w-100 mt-3" href="{{ route('Client.report',[
                'device_id' => $Device->id,
                'size_id' => $SelectedSize,
                'color_id' => $SelectedColor,
                'specification_id' => $SelectedSpecification
            ]) }}">
                <span class="report">@lang('trans.report')</span>
            </a>
        </div>
    </div>
        <script>
    
            addToCartButton = document.querySelectorAll(".add-to-cart-button");
            document.querySelectorAll('.add-to-cart-button').forEach(function(addToCartButton) {
                addToCartButton.addEventListener('click', function() {
                 	@this.AddToCart()
                    addToCartButton.classList.add('added');
                    setTimeout(function() {
                        addToCartButton.classList.remove('added');
                    }, 2000);
                    toast(data.type,data.message)
                });
            });
        </script>
</div>

