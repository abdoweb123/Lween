@extends('Admin.layout')
@section('pagetitle', __('trans.products'))
@section('content')

<form method="POST" action="{{ route('admin.products.update',$Product) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <label for="title_ar">@lang('trans.title_ar')</label>
            <input type="text" name="title_ar" required placeholder="@lang('trans.title_ar')" class="form-control" value="{{ $Product['title_ar'] }}">
        </div>
        <div class="col-md-6">
            <label for="title_en">@lang('trans.title_en')</label>
            <input type="text" name="title_en" required placeholder="@lang('trans.title_en')" class="form-control" value="{{ $Product['title_en'] }}">
        </div>
        <div class="col-md-6">
            <label for="quantity">@lang('trans.quantity')</label>
            <input type="number" min="0" name="quantity" value="{{ $Product['quantity'] }}" required placeholder="@lang('trans.quantity')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="price">@lang('trans.price')</label>
            <input type="number" min="0" name="price" value="{{ $Product['price'] }}" required placeholder="@lang('trans.price')" class="form-control">
        </div>
        
        <div class="col-md-6">
            <label >
                <span>@lang('trans.isThereDiscount')</span>
            </label>
            <select id="discountDiscount" name="have_discount" class="form-control">
                <option {{  $Product->discount_value > 0 ? 'selected' : '' }} value="1">@lang('trans.yes')</option>
                <option {{  $Product->discount_value > 0 ? '' : 'selected' }} value="0">@lang('trans.no')</option>
            </select>
        </div>
        <div class="col-md-6 discount {{  $Product->discount_value <= 0 ? 'hide' : '' }}">
            <label >@lang('trans.discount') <span class="h4">%</span></label>
            <input value="{{ $Product->discount_value }}" id="discount" type="number" step="any" min="0" max="100" name="discount_value" placeholder="@lang('trans.discount')" class="form-control">
        </div>
        <div class="col-md-6 discount {{  $Product->discount_value <= 0 ? 'hide' : '' }}">
            <label >@lang('trans.discount_from')</label>
            <input value="{{ $Product->discount_from }}" id="discount_from" type="datetime-local" name="discount_from" placeholder="@lang('trans.discount_from')" class="form-control">
        </div>
        <div class="col-md-6 discount {{  $Product->discount_value <= 0 ? 'hide' : '' }}">
            <label >@lang('trans.discount_to')</label>
            <input value="{{ $Product->discount_to }}" id="discount_to" type="datetime-local" name="discount_to" placeholder="@lang('trans.discount_to')" class="form-control">
        </div>



        <hr style="color: transparent">

        <div class="col-md-6">
            <label for="header" class="form-label">@lang('trans.header')</label>
            <input class="form-control" name="header" type="file">
        </div>

        <div class="col-md-6 d-flex justify-content-center">
            <div class="position-relative" style="width: fit-content;">
                @if ($Product->header)
                
                    @if(IsVideo($Product->header))
                        <video class="preview_image" src="{{ asset($Product->header) }}" autoplay /></video>  
                    @else
                        <img class="preview_image" src="{{ asset($Product->header) }}" />            
                    @endif
                @endif
            </div>
        </div>

        
        <hr style="color: transparent">
        
        <div class="col-md-6">
            <label >@lang('trans.Gallery')</label>
            <input class="form-control"  accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" multiple type="file" name="gallery[]">
        </div>
        <div class="row d-flex justify-content-center my-2">

        </div>
        <div class="row d-flex justify-content-center my-2">
            @foreach ($Product->Gallery as $item)
                @if ($item->image)    
                    <div class="position-relative" style="width: fit-content;">
                        <input type="hidden" name="old_gallery[]" value="{{ $item->image }}">
                        <img class="preview_image" style="max-width: 100px;" src="{{ $item->image }}"/>
                        <i data-path="{{ $item->image }}" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i>
                    </div>
                @endif
            @endforeach
        </div>

        
        <hr style="color: transparent">


        <div class="col-md-6">
            <label class="form-label">@lang('trans.category')</label>
            <select class="form-control selectpicker" data-live-search="true" id="categories">
                <option value="" selected disabled hidden>----------</option>
                @foreach ($Categories as $Item)
                    <option value="{{ $Item->id }}">{{ $Item->title() }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 my-2" style="display: flex;justify-content: space-evenly;">
            @foreach ($Product->Categories as $Category)
                <div class="position-relative" style="width: fit-content;"><input name="categories[]" type="hidden" value="{{ $Category->id }}">
{{--                    <button type="button" class="btn btn-dark">{{ $Category->Parent->title() }} -> {{ $Category->title() }}</button>--}}
                    <button type="button" class="btn btn-dark"> {{ $Category->title() }}</button>
                    <i data-path="" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-6 justify-content-center">
                <label class="form-label">@lang('trans.description_ar')</label>
                <textarea name="long_desc_ar">{!! $Product->long_desc_ar !!}</textarea>
            </div>

            <div class="col-md-6 justify-content-center">
                <label class="form-label">@lang('trans.description_en')</label>
                <textarea name="long_desc_en">{!! $Product->long_desc_en !!}</textarea>
            </div>
        </div>


        <div class="col-12">
            <div class="button-group my-4">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection



@section('css')
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        .features_block {
            border: 1px solid #CCC;
            margin: 10px 0px;
            padding: 10px 0px;
        }
    </style>
@endsection



@section('js')
    <script src="https://unpkg.com/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        features_i = 9999;
        items_i = 9999;
        $(".selectpicker").selectpicker();
        $(document).on('click', '#selectAll', function() {
            $('#permissions option').attr("selected", "selected");
            $(".selectpicker").selectpicker('refresh');
        });
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
        $(document).on('change', '#discountDiscount', function() {
            if ($(this).val() === '1') {
                $('.discount').removeClass('hide');
            } else {
                $('.discount').addClass('hide');
                $('#discount').val('');
                $('#discount_from').val('');
                $('#discount_to').val('');
            }
        });
        $(document).on("change", "#accessories_parent_id", function() {
            $('select#accessories_product_id').empty();
            $('select#accessories_category_id').empty();
            $('select#accessories_category_id').append( '<option value="" selected disabled hidden>----------</option>' );
            $.each(@json($Categories), function (key,ParentCategory) {
                if($('#accessories_parent_id').find("option:selected").val() == ParentCategory['id']){
                    $.each(ParentCategory['children'], function (key,Category) {
                        $('select#accessories_category_id').append( '<option value="'+Category['id']+'">'+Category['title_{{ lang() }}']+'</option>' );
                    });
                }
            });
            $(".selectpicker").selectpicker('refresh');
        });
        $(document).on("change", "#accessories_category_id", function() {
            $('select#accessories_product_id').empty();
            $('select#accessories_product_id').append( '<option value="" selected disabled hidden>----------</option>' );
            $.each(@json($Categories), function (key,ParentCategory) {
                if($('#accessories_parent_id').find("option:selected").val() == ParentCategory['id']){
                    $.each(ParentCategory['children'], function (key,Category) {
                        if($('#accessories_category_id').find("option:selected").val() == Category['id']){
                            $.each(Category['products'], function (key,Product) {
                                $('select#accessories_product_id').append( '<option value="'+Product['id']+'">'+Product['title_{{ lang() }}']+'</option>' );
                            });
                        }
                    });
                }
            });
            $(".selectpicker").selectpicker('refresh');
        });
        $(document).on('click', '.add_accessory', function() {
            exist = 0;
            $.each($('input[name="accessories[]"]'), function(key, item) {
                exist += $('#accessories_product_id').find("option:selected").val() == item.value ? 1 : 0
            });
            if (exist == 0 && $('#accessories_parent_id').find("option:selected").val() && $('#accessories_category_id').find("option:selected").val() && $('#accessories_product_id').find("option:selected").val()) {
                $(this).parent().parent().next().append(
                    '<div class="position-relative" style="width: fit-content;"><input name="accessories[]" type="hidden" value="'+ $('#accessories_product_id').find("option:selected").val() +'">'+
                        '<button type="button" class="btn btn-dark">'+ $('#accessories_product_id').find("option:selected").text() +'</button>'+
                        '<i data-path="" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i>'+
                    '</div>'
                );
            }
            $('select#accessories_category_id').empty();
            $('select#accessories_parent_id').find('option:eq(0)').prop('selected', true);
            $('select#accessories_product_id').empty();
            $(".selectpicker").selectpicker('refresh');
        });
        $(document).on('change', '#accessories', function() {
            if ($(this).val() == 1) {
                $('.accessories').removeClass('hide');
            }else if ($(this).val() == 0) {
                $('.accessories').addClass('hide');
            }
        });
        $(document).on('click', '.add_features', function() {
            $('<div class="row features_block position-relative">'+
                '<div class="col-md-6">'+
                    '<label for="title_ar">@lang("trans.title_ar")</label>'+
                    '<input type="text" name="features['+features_i+'][title_ar]" placeholder="@lang("trans.title_ar")" class="form-control">'+
                '</div>'+
                '<div class="col-md-6">'+
                    '<label for="title_en">@lang("trans.title_en")</label>'+
                    '<input type="text" name="features['+features_i+'][title_en]" placeholder="@lang("trans.title_en")" class="form-control">'+
                '</div>'+
                '<div class="col-md-6">'+
                    '<label for="image" class="form-label">@lang("trans.image")</label>'+
                    '<input class="form-control"  accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" type="file" data-feature-id="'+features_i+'">'+
                '</div>'+
                '<div class="col-md-6 preview_images">'+
                '</div>'+
                '<div class="col-md-6 col-sm-12">'+
                    '<label >@lang("trans.desc_ar")</label>'+
                    '<textarea rows="7" name="features['+features_i+'][desc_ar]" placeholder="@lang("trans.desc_ar")" class="form-control mceNoEditor"></textarea>'+
                '</div>'+
                '<div class="col-md-6 col-sm-12">'+
                    '<label >@lang("trans.desc_en")</label>'+
                    '<textarea rows="7" name="features['+features_i+'][desc_en]" placeholder="@lang("trans.desc_en")" class="form-control mceNoEditor"></textarea>'+
                '</div>'+
                '<button class="btn btn-danger position-absolute remove_features text-center mx-auto" style="width: 35px;{{ lang("en") ? "right" : "left" }}: 0px;top: 40%;" type="button">-</button>'+
            '</div>'
            ).insertBefore('.features_block:last');
            features_i++;
        });
        $(document).on('click', '.remove_features', function() {
            $(this).parent().remove();
        });
        
        
        
        
        
        
        $(document).on('click', '.add_items', function() {
            $('<div class="row items_block position-relative my-3 border border-dark">'+
                '<div class="col-md-6">'+
                '<div class="col-md-6">'+
                    '<label for="quantity">@lang("trans.quantity")</label>'+
                    '<input type="text" min="0"  name="items['+items_i+'][quantity]" placeholder="@lang("trans.quantity")" class="form-control">'+
                '</div>'+
                '<div class="col-md-6">'+
                    '<label for="price">@lang("trans.price")</label>'+
                    '<input type="number" step="0.01" min="0" name="items['+items_i+'][price]" placeholder="@lang("trans.price")" class="form-control">'+
                '</div>'+
                '<button class="btn btn-danger position-absolute remove_items text-center mx-auto" style="width: 35px;{{ lang("en") ? "right" : "left" }}: 0px;top: 40%;" type="button">-</button>'+
                '<hr class="my-2">'+
            '</div>'
            ).insertAfter('.items_block:last');

            features_i++;
        });
        $(document).on('click', '.remove_items', function() {
            $(this).parent().remove();
        });
        
        
        
        
        
        
        
        
        
        
        
        $(document).on('click', '.add_specs', function() {
            $('#specs_block').append(
                '<div class="row specs_block position-relative">'+
                    '<div class="col-md-12 text-center">'+
                        '<h4 for="specs">'+$('select[name="specs"]').find("option:selected").text()+'</h4>'+
                    '</div>'+
                    '<div class="col-md-6 col-sm-12">'+
                        '<label >@lang("trans.desc_ar")</label>'+
                        '<textarea rows="7" name="specs['+ $('select[name="specs"]').find("option:selected").val() +'][desc_ar]" placeholder="@lang("trans.desc_ar")" class="form-control mceNoEditor"></textarea>'+
                    '</div>'+
                    '<div class="col-md-6 col-sm-12">'+
                        '<label >@lang("trans.desc_en")</label>'+
                        '<textarea rows="7" name="specs['+ $('select[name="specs"]').find("option:selected").val() +'][desc_en]" placeholder="@lang("trans.desc_en")" class="form-control mceNoEditor"></textarea>'+
                    '</div>'+
                    '<button class="btn btn-danger position-absolute remove_specs text-center mx-auto" style="width: 35px;{{ lang("en") ? "right" : "left" }}: 0%;top: 50%;" type="button">-</button>'+
                '</div>'
            );
        });
        $(document).on('click', '.remove_specs', function() {
            $(this).parent().remove();
        });
        $(document).on("change", "#parent_id", function() {
            SubCat();
        });
        $(document).on("change", "#category_id", function() {
            $(this).parent().parent().next().append('<div class="position-relative" style="width: fit-content;"><input name="categories[]" type="hidden" value="' + $( "#category_id option:selected" ).val() + '"><button type="button" class="btn btn-dark">'+ $( "#category_id option:selected" ).attr('data-parent') +' -> '+ $( "#category_id option:selected" ).text() +'</button><i data-path="" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i></div>');
            SubCat();
        });
        $(document).on('click', '.fa-circle-xmark', function() {
            item = $(this);
            item.parent().remove();
            SubCat();
        });
        function SubCat() {
            $('select#category_id').empty();
            $('select#category_id').append('<option value="" selected>----------</option>');
            $.each(@json($Categories), function(key, ParentCategory) {
                if ($('#parent_id').find("option:selected").val() == ParentCategory['id']) {
                    $.each(ParentCategory['children'], function(key, Category) {
                        exist = 0;
                        $.each($('input[name="categories[]"]'), function(key, item) {
                            exist += Category['id'] == item.value ? 1 : 0
                        });
                        if(exist == 0){
                            console.log(Category['id']);
                            $('select#category_id').append('<option data-parent="' + Category['parent']['title_{{ lang() }}'] + '" value="' + Category['id'] + '">' + Category['title_{{ lang() }}'] + '</option>');
                        }
                    });
                }
            });
            $(".selectpicker").selectpicker('refresh');
        }
    </script>

@endsection
