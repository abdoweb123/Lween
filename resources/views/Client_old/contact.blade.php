@extends('Client.layouts.layout')
@section('content')

<div class="contact my-4">
    <div class="container">

        <div class="row">

            <div class="col-12 col-md-5">
                <div class=" m-2 w-100 {{ lang('ar') ? 'left_border' : 'right_border' }} h-100">
                    <h5 class="font-weight-bold pb-3 text-center">@lang('trans.contactInfo')</h5>
                    <ul class="list-unstyled {{ lang('ar') ? 'text-right' : '' }} p-0">
                        <li class="my-3 h6 main_bold"><i class="icon-mobile main_text h4 mx-2 {{ lang('ar') ? 'float-right' : '' }}"></i><span>{{ setting('phone') }}</span></li>
                        <li class="my-3 h6 main_bold"><i class="icon-envelope main_text h4 mx-2 {{ lang('ar') ? 'float-right' : '' }}"></i><span>{{ setting('email') }}</span></li>
                        <li class="my-3 h6 main_bold"><i class="icon-location main_text h4 mx-2 {{ lang('ar') ? 'float-right' : '' }}"></i><span>{{ setting('address_' . app()->getLocale()) }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="m-2">
                    <h5 class="font-weight-bold text-center">@lang('trans.leaveMessage')</h5>

                    <form method="POST" action="{{ route('Client.contact') }}">
                        <div class="row my-2 p-2">
                            @csrf
                       
                            <div class="col-12 col-md-6">
                                <div class="m-1">
                                    <input type="text" class="border rounded p-3 w-100" name="name" placeholder="@lang('trans.name')">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="m-1">
                                    <input type="email" class="border rounded p-3 w-100" name="email" placeholder="@lang('trans.email')">
                                </div>
                            </div>
                        </div>
                        <div class=" my-2 p-2 mx-1">
                            <input type="text" class="border rounded p-3 w-100" name="phone" placeholder="@lang('trans.phone')">
                        </div>
                        <div class=" my-2 p-2 mx-1">
                            <input type="text" class="border rounded p-3 w-100" name="subject" placeholder="@lang('trans.subject')">
                        </div>
                        <div class=" my-2 p-2 mx-1">
                            <textarea class="border rounded p-3 w-100" name="message" rows="5" placeholder="@lang('trans.message')"></textarea>
                        </div>
                        <div class="my-3 p-2 mx-1">
                            <button class="main_btn border-0 py-2 px-5 w-100 rounded transition-me main_bold">@lang('trans.send')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection