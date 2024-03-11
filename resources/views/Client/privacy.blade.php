@extends('Client.Layout.index')

@section('title')
  @lang('trans.privacy')
@stop



@section('content')
  <div class="loading-screen position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
  </div>

  <div class="container section-top  my-5" style="min-height: 60vh;">
    <div class="row justify-content-center">
      <div class="col-12 ">
        <h4>{{ __('trans.privacy')}}</h4>
        <p>{!! nl2br(Setting('privacy_'.lang())) !!}</p>
      </div>


    </div>
  </div>


@stop
