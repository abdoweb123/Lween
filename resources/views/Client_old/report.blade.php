<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $Device->title_en }}</title>
    </head>
    <body>
        <div style="display:flex">
            @foreach($Device->Gallery->when($SelectedColor, fn($query) =>  $query->where('color_id', $SelectedColor) ) as $image )
                <img  src="{{ asset($image->image) }}" style="max-width:200px;margin:20px" />
            @endforeach
        </div>
        <h2>@lang('trans.Summary',[],'en')</h2>
        <p>{{ $Device->title_en }}</p>
        <p>{{ $SelectedItem->CalcPrice() }} {{ country()->currancy_code_en }}</p>

        <p>{{ $SelectedItem?->Size->title_en }} @lang('trans.size',[],'en')</p>
        <p>{{ $SelectedItem?->Processor->title_en }} @lang('trans.processor',[],'en')</p>
        <p>{{ $SelectedItem?->Memory->title_en }} @lang('trans.memory',[],'en')</p>
        <p>{{ $SelectedItem?->Storage->title_en }} @lang('trans.storage',[],'en')</p>
        <p>{{ $SelectedItem?->OS->title_en }} @lang('trans.os',[],'en')</p>
        
        <p>@lang('trans.return-days',[],'en')</p>
        
        {!! $Device['short_desc_en'] !!}

    </body>
</html>