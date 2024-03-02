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
        <a href="{{route('Client.category.devices',$category->id)}}">
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




{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"--}}
{{--    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="--}}
{{--    crossorigin="anonymous" referrerpolicy="no-referrer">--}}
{{--    </script>--}}
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"--}}
{{--    integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A=="--}}
{{--    crossorigin="anonymous" referrerpolicy="no-referrer">--}}
{{--    </script>--}}
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"--}}
{{--    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="--}}
{{--    crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
{{--  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>--}}

{{--  <script src="assets/js/index.js"></script>--}}


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


