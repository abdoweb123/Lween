@extends('Admin.layout')

@section('pagetitle',  $Product->title() . ' > ' . (isset($Color) ? $Color->title() :  __('trans.gallery')))
@section('content')

@if( isset($Colors) && $Colors->count())
<table class="table table-bordered text-center" >
    <thead>
        <tr>
            <th>#</th>
            <th>@lang('trans.color')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Colors as $Model)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td><a href="{{ route('admin.products.gallery', ['product_id'=>$Product,'color_id'=>$Model]) }}">{{ $Model->title() }}</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@elseif(isset($Color))
    
    <form method="POST" action="{{ route('admin.products.gallery',['product_id'=>$Product,'color_id'=>$Color->id]) }}" enctype="multipart/form-data" >
        @csrf

        <div class="row">
            <div class="col-md-12">
                <label for="header" class="form-label">@lang('trans.header')</label>
                <input class="form-control" name="header" type="file">
            </div>
        
            <div class="col-md-12 d-flex justify-content-center">
                <div class="position-relative" style="width: fit-content;">
                    @foreach ($Product->Headers as $item)
                        @if(IsVideo($item->header))
                            <video class="preview_image" src="{{ asset($item->header) }}" autoplay /></video>  
                        @else
                            <img class="preview_image" src="{{ asset($item->header) }}" />            
                        @endif
                    @endforeach
                </div>
            </div>
        
            
            <hr style="color: transparent">
                
            <div class="col-md-12">
                <label >@lang('trans.Gallery')</label>
                <input class="form-control"  accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" multiple type="file" name="gallery[]">
            </div>
            <div class="row d-flex justify-content-center my-2">
        
            </div>
            @if($Product->Gallery->where('color_id',$Color->id)->count())
            <div class="row d-flex justify-content-center my-2">
                @foreach ($Product->Gallery->where('color_id',$Color->id) as $item)
                    @if ($item->image)  
                        <div class="position-relative" style="width: fit-content;">
                            <input type="hidden" name="old_gallery[]" value="{{ $item->image }}">
                            <img class="preview_image" style="max-width: 100px;" src="{{ $item->image }}"/>
                            <i data-path="{{ $item->image }}" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i>
                        </div>
                    @endif
                @endforeach
            </div>
            @endif
            @if($Product->Gallery->whereNull('color_id')->count())
            <div class="row d-flex justify-content-center my-2">
                <div class="position-relative" style="width: fit-content;">
                    <h2>
                        <i class="fa-solid fa-arrows-spin"></i>
                    </h2>
                </div>
                @foreach ($Product->Gallery->whereNull('color_id') as $item)
                    @if ($item->image)  
                        <div class="position-relative" style="width: fit-content;">
                            <input type="hidden" name="old_gallery[]" value="{{ $item->image }}">
                            <img class="preview_image" style="max-width: 100px;" src="{{ $item->image }}"/>
                            <i data-path="{{ $item->image }}" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i>
                        </div>
                    @endif
                @endforeach
            </div>
            @endif
            <div class="col-12">
                <div class="button-group my-4">
                    <button type="submit" class="main-btn btn-hover w-100 text-center">
                        {{ __('trans.Submit') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endif


@endsection

@section('js')
<script>
    $(document).on('change', 'input[type="file"]', function() {
        var Preview = $(this).parent().next();
        Preview.empty();
        files = this.files;
        if (files && files.length > 0) {
            for (var i = 0; i < files.length; i++) {
                file = files[i];
                var reader = new FileReader();
                reader.onload = function(e) {
                    const fileType = file.type;
                    if (fileType.startsWith('image/')) {
                        var image = $("<img>").attr("src", e.target.result);
                        image.addClass("preview_image");
                        Preview.append(image);
                    } else if (fileType.startsWith('video/')) {
                        var video = $("<video>").attr("src", e.target.result);
                        video.addClass("preview_image");
                        Preview.append(video);
                    } else {
                      console.log('Unknown file type.');
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    });
    
    $(document).on('click', '.fa-circle-xmark', function() {
        item = $(this);
        item.parent().remove();
    });
</script>
@endsection
