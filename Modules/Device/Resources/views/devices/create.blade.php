@extends('Admin.layout')
@section('pagetitle', __('trans.add') . ' ' . __('trans.device'))
@section('content')


<form method="POST" action="{{ route('admin.devices.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="title_ar">@lang('trans.title_ar')</label>
            <input type="text" name="title_ar" value="{{ old('title_ar') }}" required placeholder="@lang('trans.title_ar')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="title_en">@lang('trans.title_en')</label>
            <input type="text" name="title_en" value="{{ old('title_en') }}" required placeholder="@lang('trans.title_en')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="quantity">@lang('trans.quantity')</label>
            <input type="number" min="1" name="quantity" value="{{ old('quantity'),1 }}" required placeholder="@lang('trans.quantity')" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="price">@lang('trans.price')</label>
            <input type="number" min="0" name="price" value="{{ old('price') }}" required placeholder="@lang('trans.price')" class="form-control">
        </div>

        {{--     <div class="col-md-6">
                 <label class="form-label">@lang('trans.brand')</label>
                 <select class="form-control" id="brand_id" name="brand_id">
                     <option value="" selected disabled hidden>----------</option>
                     @foreach ($Brands as $Item)
                         <option value="{{ $Item->id }}">{{ $Item->title() }}</option>
                     @endforeach
                 </select>
             </div> --}}


         <div class="col-md-6">
             <label class="my-1">@lang('trans.isThereDiscount')</label>
             <select id="discountDiscount" name="have_discount"  class="form-control">
                 <option value="1">@lang('trans.yes')</option>
                 <option selected value="0">@lang('trans.no')</option>
             </select>
         </div>
        <div class="col-md-6 discount {{ old('discount') ? '' : 'hide' }}">
            <label class="my-1">@lang('trans.discount') <span class="h4">%</span></label>
            <input id="discount" type="number" step="any" value="0" name="discount_value" min="0" max="100" placeholder="@lang('trans.discount')" class="form-control">
        </div>
         <div class="col-md-6 discount {{ old('from') ? '' : 'hide' }}">
             <label class="my-1">@lang('trans.discount_from')</label>
             <input id="discount_from" type="datetime-local" name="discount_from" placeholder="@lang('trans.discount_from')" class="form-control">
         </div>
         <div class="col-md-6 discount {{ old('to') ? '' : 'hide' }}">
             <label class="my-1">@lang('trans.discount_to')</label>
             <input id="discount_to" type="datetime-local" name="discount_to" placeholder="@lang('trans.discount_to')" class="form-control">
         </div>


        <hr style="color: transparent">

        <div class="col-md-6">
            <label for="header" class="form-label">@lang('trans.header')</label>
            <input class="form-control" name="header" type="file">
        </div>
        <div class="row d-flex justify-content-center my-2"></div>
        <div class="col-md-6">
            <label class="my-1">@lang('trans.Gallery')</label>
            <input class="form-control" accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" multiple type="file" name="gallery[]">
        </div>
        <div class="row d-flex justify-content-center my-2"></div>

        <div class="col-md-6 justify-content-center">
            <label class="form-label">@lang('trans.category')</label>
            <select class="form-control selectpicker" data-live-search="true" id="parent_id" name="categories">
                <option value="" selected disabled hidden>----------</option>
                @foreach ($Categories as $Item)
                    <option value="{{ $Item->id }}">{{ $Item->title() }}</option>
                @endforeach
            </select>
        </div>

       <div class="row">
           <div class="col-md-6 justify-content-center">
               <label class="form-label">@lang('trans.description_ar')</label>
               <textarea name="long_desc_ar"></textarea>
           </div>

           <div class="col-md-6 justify-content-center">
               <label class="form-label">@lang('trans.description_en')</label>
               <textarea name="long_desc_en"></textarea>
           </div>
       </div>

        <hr style="color: transparent" class="my-4">

        <!-- Items -->
        {{--
       <div  class="my-5"  style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
           <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
               <h2>@lang('trans.items')</h2>
           </span>
       </div>
       <div class="row border-0 my-3">
           <div class="items_block"></div>
           <div class="col-md-1 mx-auto text-center">
               <button class="main-btn add_items text-center mx-auto" type="button">+</button>
           </div>
       </div>

       <hr style="color: transparent">

       <div class="col-md-6 col-sm-12">
           <label class="my-1">@lang('trans.short_desc_ar')</label>
           <textarea rows="7" name="short_desc_ar" placeholder="@lang('trans.short_desc_ar')" class="form-control mceNoEditor">{{ old('short_desc_ar') }}</textarea>
       </div>
       <div class="col-md-6 col-sm-12">
           <label class="my-1">@lang('trans.short_desc_en')</label>
           <textarea rows="7" name="short_desc_en" placeholder="@lang('trans.short_desc_en')" class="form-control mceNoEditor">{{ old('short_desc_en') }}</textarea>
       </div>

       <div class="col-md-12 col-sm-12">
           <label class="my-1">@lang('trans.long_desc_ar')</label>
           <textarea rows="7" name="long_desc_ar" placeholder="@lang('trans.long_desc_ar')" class="form-control" cols="9">{{ old('long_desc_ar') }}</textarea>
       </div>
       <div class="col-md-12 col-sm-12">
           <label class="my-1">@lang('trans.long_desc_en')</label>
           <textarea rows="7" name="long_desc_en" placeholder="@lang('trans.long_desc_en')" class="form-control" cols="9">{{ old('long_desc_en') }}</textarea>
       </div>


       <hr style="color: transparent">

       <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
           <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
               <h2 >@lang('trans.categories')</h2>
           </span>
       </div>
       <div class="col-md-6">
           <label class="form-label">@lang('trans.parent')</label>
           <select class="form-control selectpicker" data-live-search="true" id="parent_id">
               <option value="" selected disabled hidden>----------</option>
               @foreach ($Categories as $Item)
               <option value="{{ $Item->id }}">{{ $Item->title() }}</option>
               @endforeach
           </select>
       </div>
       <div class="col-md-6">
           <label class="form-label">@lang('trans.category')</label>
           <select class="form-control selectpicker" data-live-search="true" id="category_id" name="categories[]">

           </select>
       </div>
       <div class="col-12 my-2" style="display: flex;justify-content: space-evenly;">

       </div>

       <hr style="color: transparent">

               <!-- accessories , features , specs-->
       <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
           <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
               <h2>@lang('trans.accessories')</h2>
           </span>
       </div>
       <div class="col-md-6">
           <label for="accessories" class="form-label">@lang('trans.accessories')</label>
           <select class="form-control" id="accessories" name="have_accessories">
               <option value="0">{{ __('trans.No') }}</option>
               <option value="1">{{ __('trans.yes') }}</option>
           </select>
       </div>

       <div class="col-12 accessories hide">
           <div class="row accessories_block">
               <div class="col-md-3">
                   <label class="form-label">@lang('trans.parent')</label>
                   <select class="form-control selectpicker" data-live-search="true" id="accessories_parent_id">
                       <option value="" selected disabled hidden>----------</option>
                       @foreach ($Categories as $Item)
                           <option value="{{ $Item->id }}">{{ $Item->title() }}</option>
                       @endforeach
                   </select>
               </div>
               <div class="col-md-4">
                   <label class="form-label">@lang('trans.category')</label>
                   <select class="form-control selectpicker" data-live-search="true" id="accessories_category_id">

                   </select>
               </div>
               <div class="col-md-4">
                   <label class="form-label">@lang('trans.device')</label>
                   <select class="form-control selectpicker" data-live-search="true" id="accessories_product_id">

                   </select>
               </div>
               <div class="col-md-1 text-center">
                   <label class="form-label w-100">@lang('trans.add')</label>
                   <button class="main-btn add_accessory text-center mx-auto" type="button">+</button>
               </div>
           </div>
       </div>


       <hr style="color: transparent">

       <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
           <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
               <h2>@lang('trans.features')</h2>
           </span>
       </div>
       <div class="row features_block position-relative my-2">
           <div class="col-md-6">
               <label for="title_ar">@lang('trans.title_ar')</label>
               <input type="text" name="features[0][title_ar]" placeholder="@lang('trans.title_ar')" class="form-control">
           </div>
           <div class="col-md-6">
               <label for="title_en">@lang('trans.title_en')</label>
               <input type="text" name="features[0][title_en]" placeholder="@lang('trans.title_en')" class="form-control">
           </div>
           <div class="col-md-6">
               <label for="image" class="form-label">@lang('trans.image')</label>
               <input class="form-control"  name="features[0][image]" accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" type="file" data-feature-id="0">
           </div>
           <div class="col-md-6">
           </div>
           <div class="col-md-6 col-sm-12">
               <label >@lang('trans.desc_ar')</label>
               <textarea rows="7" name="features[0][desc_ar]" placeholder="@lang('trans.desc_ar')" class="form-control mceNoEditor"></textarea>
           </div>
           <div class="col-md-6 col-sm-12">
               <label >@lang('trans.desc_en')</label>
               <textarea rows="7" name="features[0][desc_en]" placeholder="@lang('trans.desc_en')" class="form-control mceNoEditor"></textarea>
           </div>
           <button class="btn btn-danger position-absolute remove_features text-center mx-auto" style="width: 35px;{{ lang("en") ? "right" : "left" }}: 0px;top: 40%;" type="button">-</button>
       </div>
       <div class="row features_block border-0">
           <div class="col-md-1 mx-auto text-center">
               <label class="form-label w-100">@lang('trans.add')</label>
               <button class="main-btn add_features text-center mx-auto" type="button">+</button>
           </div>
       </div>

       <hr style="color: transparent">

       <div style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
           <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
               <h2>@lang('trans.specs')</h2>
           </span>
       </div>
       <div class="row pt-5">
           <div class="col-12">
               <div class="row">
                   <div class="col-md-6">
                       <label for="specs" class="form-label">@lang('trans.specs')</label>
                       <select class="form-control" id="specs" name="specs">
                           <option value="" selected disabled hidden>----------</option>
                           @foreach (Specs() as $Item)
                           <option value="{{ $Item->id }}">{{ $Item->title() }}</option>
                           @endforeach
                       </select>
                   </div>
                   <div class="col-md-2">
                       <label class="form-label w-100">@lang('trans.add')</label>
                       <button class="main-btn add_specs text-center mx-auto" type="button">+</button>
                   </div>
               </div>
           </div>
           <div class="col-12" id="specs_block">

           </div>
       </div>
      --}}
                

        <hr style="color: transparent">


        <div class="row">
            <div class="col-sm-12 my-4">
                <div class="text-center p-20">
                    <button type="submit" class="btn btn-primary">{{ __('trans.add') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('trans.cancel') }}</button>
                </div>
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
    $(".selectpicker").selectpicker();
    features_i = 1;
    items_i = 9999;
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
            '<div class="col-md-6">'+
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
                '<label for="items['+items_i+'][size_id]">@lang("trans.size")</label>'+
                '<select class="form-control" id="items['+items_i+'][size_id]" name="items['+items_i+'][size_id]"></select>'+
            '</div>'+
            '<div class="col-md-6">'+
                '<label fo="#items['+items_i+'][memory_id]">@lang("trans.memory")</label>'+
                '<select class="form-control" id="items['+items_i+'][memory_id]" name="items['+items_i+'][memory_id]"></select>'+
            '</div>'+
            '<div class="col-md-6">'+
                '<label for="items['+items_i+'][color_id]">@lang("trans.color")</label>'+
                '<select class="form-control" id="items['+items_i+'][color_id]" name="items['+items_i+'][color_id]"></select>'+
            '</div>'+
            '<div class="col-md-6">'+
                '<label for="items['+items_i+'][storage_id]">@lang("trans.storage")</label>'+
                '<select class="form-control" id="items['+items_i+'][storage_id]" name="items['+items_i+'][storage_id]"></select>'+
            '</div>'+
            '<div class="col-md-6">'+
                '<label for="items['+items_i+'][processor_id]">@lang("trans.processor")</label>'+
                '<select class="form-control" id="items['+items_i+'][processor_id]" name="items['+items_i+'][processor_id]"></select>'+
            '</div>'+
            '<div class="col-md-6">'+
                '<label for="items['+items_i+'][os]">@lang("trans.os")</label>'+
                '<select class="form-control" id="items['+items_i+'][os]" name="items['+items_i+'][os]"></select>'+
            '</div>'+
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
        
        $.each(@json(Sizes()), function (key,Item) {
            $('select[name="items['+items_i+'][size_id]"]').append( '<option value="'+Item['id']+'">'+Item['title_{{ lang() }}']+'</option>' );
        });
        $.each(@json(Memories()), function (key,Item) {
            $('select[name="items['+items_i+'][memory_id]"]').append( '<option value="'+Item['id']+'">'+Item['title_{{ lang() }}']+'</option>' );
        });
        $.each(@json(Colors()), function (key,Item) {
            $('select[name="items['+items_i+'][color_id]"]').append( '<option value="'+Item['id']+'">'+Item['title_{{ lang() }}']+'</option>' );
        });
        $.each(@json(Storages()), function (key,Item) {
            $('select[name="items['+items_i+'][storage_id]"]').append( '<option value="'+Item['id']+'">'+Item['title_{{ lang() }}']+'</option>' );
        });
        $.each(@json(Processors()), function (key,Item) {
            $('select[name="items['+items_i+'][processor_id]"]').append( '<option value="'+Item['id']+'">'+Item['title_{{ lang() }}']+'</option>' );
        });
        $.each(@json(OS()), function (key,Item) {
            $('select[name="items['+items_i+'][os]"]').append( '<option value="'+Item['id']+'">'+Item['title_{{ lang() }}']+'</option>' );
        });
        features_i++;
    });
    $(document).on('click', '.remove_items', function() {
        $(this).parent().remove();
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
                        $.each(Category['devices'], function (key,Product) {
                            $('select#accessories_product_id').append( '<option value="'+Product['id']+'">'+Product['title_{{ lang() }}']+'</option>' );
                        });
                    }
                });
            }
        });
        $(".selectpicker").selectpicker('refresh');
    });
    $(document).on('click', '.add_accessory', function() {
        if ($('#accessories_parent_id').find("option:selected").val() && $('#accessories_category_id').find("option:selected").val() && $('#accessories_product_id').find("option:selected").val()) {
            $('.accessories_block:last').parent().append(
                '<div class="row accessories_block">'+
                    '<div class="col-md-3">'+
                        '<label class="form-label">@lang("trans.parent")</label>'+
                        '<input type="text" class="form-control" readonly value="'+ $('#accessories_parent_id').find("option:selected").text() +'">'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<label class="form-label">@lang("trans.category")</label>'+
                        '<input type="text" class="form-control" readonly value="'+ $('#accessories_category_id').find("option:selected").text() +'">'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<label class="form-label">@lang("trans.device")</label>'+
                        '<input type="hidden" class="form-control" name="accessories[]" value="'+ $('#accessories_product_id').find("option:selected").val() +'">'+
                        '<input type="text" class="form-control" readonly value="'+ $('#accessories_product_id').find("option:selected").text() +'">'+
                    '</div>'+
                    '<div class="col-md-1 text-center">'+
                        '<label class="form-label w-100">@lang("trans.add")</label>'+
                        '<button class="btn btn-danger remove_accessory text-center mx-auto" type="button">-</button>'+
                    '</div>'+
                '</div>'
            );
            $('select#accessories_category_id').empty();
            $('select#accessories_product_id').empty();
            $(".selectpicker").selectpicker('refresh');
        }
    });
    $(document).on('click', '.remove_accessory', function() {
        $(this).parent().parent().remove();
    });
    $(document).on('change', '#accessories', function() {
        if ($(this).val() == 1) {
            $('.accessories').removeClass('hide');
        }else if ($(this).val() == 0) {
            $('.accessories').addClass('hide');
        }
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
                        $('select#category_id').append('<option data-parent="' + Category['parent']['title_{{ lang() }}'] + '" value="' + Category['id'] + '">' + Category['title_{{ lang() }}'] + '</option>');
                    }
                });
            }
        });
        $(".selectpicker").selectpicker('refresh');
    }
</script>
@endsection
