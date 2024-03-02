
<div id="navSlider">
  <div class="nav-slider">
    <div class="container d-block">
      <div class="d-flex justify-content-between py-2">
        <div class=" login btn-group">
          <button type="button" class="btn btn-outline-dark dropdown-toggle gap-2 d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
            <span >
              @if(auth('client'))
                <img width="20" height="20" class="rounded-circle border" src="{{asset('assets_client/imgs/defult_user.png')}}"/>
              @else
                <i class="fa-solid fa-user"></i>
              @endif
            </span>
          </button>
          <ul class="dropdown-menu">
              @if(auth('client'))
                <li><a class="dropdown-item" href="{{route('Client.profile')}}">@lang('trans.myProfile')</a></li>
                <li><a class="dropdown-item" href="{{route('Client.logout')}}">@lang('trans.logout')</a></li>
              @else
                <li><a class="dropdown-item" href="{{route('Client.login')}}">@lang('trans.login')</a></li>
                <li><a class="dropdown-item" href="{{route('Client.register')}}">@lang('trans.register_as_a_new_user')</a></li>
              @endif
          </ul>
        </div>

        <div class="direction">
          <div class="btn-group" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" role="group"
               aria-label="Basic outlined example">
            <button type="button" class="btn btn-outline-dark">{{session()->get('addressCountry')['title_'.lang()] ?? country()['title_'.lang()]}} - {{session()->get('addressRegion')['title_'.lang()] ?? region()['title_'.lang()] }}</button>
            <button type="button" class="btn btn-outline-dark"><span>
                <i class="fa-solid fa-globe"></i>
              </span>

              @if(lang() == 'ar')
                English
              @else
                اللغة العربية
              @endif
            </button>
          </div>
        </div>

      </div>
  </div>
  <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?php
          $countriesWithRegions = Countries()->filter(function ($country) {
            return $country->Regions->isNotEmpty();
//            return $country;
          });
        ?>
        <form action="{{route('Client.changeWebsiteSettings')}}" method="post">
          @csrf
          <div class="modal-body">
          <div class="container">
            <div class="row gap-2 fs-6">
              <div class="col-5">
                <h6>
                  @lang('trans.currency')
                </h6>
                <select class=" btn-sm w-100 gray-bage border-0 px-2" name="currancy_code" aria-label="Default select example">
                  @foreach(Countries() as $country)
                    <option value="{{$country['currancy_code_en']}}" {{Country()['id'] == $country['id'] ? 'selected' : ''}}>{{$country['currancy_code_'.lang()]}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-5">
                <h6>@lang('trans.language') </h6>
                <select class=" btn-sm w-100 gray-bage border-0 px-2" name="language" aria-label="Default select example">
                  <option value="ar" {{lang() == 'ar' ? 'selected' : ''}}>اللغة العربية</option>
                  <option value="en" {{lang() == 'en' ? 'selected' : ''}}>English</option>
                </select>
              </div>
              <div class="col-5">
                <h6> @lang('trans.country')</h6>
                <select class=" btn-sm w-100 gray-bage border-0 px-2" name="addressCountry_id" id="country" aria-label="Default select example">
                   @foreach($countriesWithRegions as $country)
                    @if(session()->get('addressCountry'))
                      <option value="{{$country->id}}" {{session()->get('addressCountry')['id'] ==  $country['id'] ? 'selected' : ''}}>{{$country['title_'.lang()]}}</option>
                    @else
                      <option value="{{$country->id}}" {{Country()['id'] ==  $country['id'] ? 'selected' : ''}}>{{$country['title_'.lang()]}}</option>
                    @endif
                   @endforeach
                </select>
              </div>
              <div class="col-5">
                <h6>@lang('trans.region')</h6>
                <select class=" btn-sm w-100 gray-bage border-0 px-2" name="region_id" id="region" aria-label="Default select example">
                  <?php
                  $country_id =
                  $regionsOfCountry = regions()->where('country_id',session()->get('addressCountry')->id??Country()->id); ?>
                  @foreach($regionsOfCountry as $region)
                      @if(session()->get('addressRegion'))
                        <option value="{{$region->id}}" {{session()->get('addressRegion')['id'] == $region['id'] ? 'selected' : ''}}>{{$region['title_'.lang()]}}</option>
                      @else
                        <option value="{{$region->id}}" {{region()['id'] == $region['id'] ? 'selected' : ''}}>{{$region['title_'.lang()]}}</option>
                      @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
          <div class="modal-footer modal-footer-nav">
          <button type="submit" class="btn gray-bage border-0">@lang('trans.save')</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>