@extends('Client.Layout.index')


@section('title')
  @lang('trans.categories')
@stop

@section('content')
  <div class="loading-screen  position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
  </div>

  <div class="container section-top my-5">
    <div class="row  g-5 ">
      @foreach($categories as $category)
        <div class="col-lg-3 col-6 my-3">
        <a href="{{route('Client.category.products',$category->id)}}">
          <div class="position-relative item-container">
            <div class="item overflow-hidden position-absolute  ">

              <img class="w-100 h-100" src='{{asset($category->image)}}' alt="" />

              <div class="overlay text-white ">

              </div>
              <div class="overlay2">{{$category['title_'.lang()]}}</div>
              <div>

              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
@stop



@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var container = document.querySelectorAll('.item-container');

      container.forEach(function (link) {
        link.addEventListener('click', function () {
          var Linkadded = this.querySelector('.overlay2');
          var activeLinkText = Linkadded.textContent.trim();
          localStorage.setItem('activeLinkText', activeLinkText);
        });
      });
    });

  </script>
@stop


