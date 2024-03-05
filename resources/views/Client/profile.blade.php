@extends('Client.Layout.index')

@section('title')

  @lang('trans.profile')

@stop

@section('content')

  <div
          class="loading-screen position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
  </div>

  <div class="container-fluid section-top">
    <div class="row profile" style="column-gap: 40px;">
      <div class="col-lg-3 bg-dark ">
        <div class="nav flex-lg-column flex-row  nav-pills  me-3" id="v-pills-tab" role="tablist"
             aria-orientation="vertical">
          <!-- personal_details -->
          <button class="nav-link active my-3" id="v-pills-home-tab" data-bs-toggle="pill"
                  data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
            <div class="row">
              <div class="col-lg-3 col-12 d-flex align-items-center justify-content-center  ">
                <i class="fa-solid fa-user" style="font-size: 30px;"></i>
              </div>
              <div class="col-lg-9 col-12 d-flex flex-column justify-content-center text-end">
                <h6 class="fw-bold  py-2">
                  @lang('trans.personal_details')
                </h6>
                <p class="text-white fw-semibold nav-pills-profile">
                  @lang('trans.your_contact_info')
                </p>
              </div>
            </div>
          </button>
          <!-- address_directory -->
          <button class="nav-link my-3" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                  type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
            <div class="row">
              <div class="col-lg-3 col-12 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-address-card" style="font-size: 30px;"></i>
              </div>
              <div class="col-xl-9 col-12 d-flex flex-column justify-content-center text-end">
                <h6 class="fw-bold py-2">
                  @lang('trans.address_directory')
                </h6>
                <p class="text-white fw-semibold nav-pills-profile">
                  @lang('trans.address_directory_desc')
                </p>
              </div>
            </div>
          </button>
          <!-- orders -->
          <button class="nav-link my-3" id="v-pills-messages-tab" data-bs-toggle="pill"
                  data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
                  aria-selected="false">
            <div class="row">
              <div class="col-lg-3 col-12 d-flex align-items-center justify-content-center  ">
                <i class="fa-solid fa-cart-shopping" style="font-size: 30px;"></i>
              </div>
              <div class="col-xl-9 col-12 d-flex flex-column justify-content-center text-end">
                <h6 class="fw-bold py-2">
                  @lang('trans.orders')
                </h6>
                <p class="text-white fw-semibold nav-pills-profile">
                  @lang('trans.orders_desc_show')
                </p>
              </div>
            </div>
          </button>
        </div>
      </div>

      <div class="col-lg-8 col-12" style="min-height: 70vh;">
        <div class="row">
          <div class="col-12">
            <div class="tab-content" id="v-pills-tabContent">
              <!-- show/update profile -->
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                   aria-labelledby="v-pills-home-tab" tabindex="0">
                <form action="{{route('Client.updateProfile')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row gap-2 my-5 p-2 ">
                    <div class="col-lg-5 col-12">
                      <h6>
                        @lang('trans.Full Name')
                      </h6>
                      <input type="text" class="form-control" name="name" value="{{$client->name}}" required>
                    </div>
                    <div class="col-lg-5 col-12">
                      <h6>
                        @lang('trans.email')
                      </h6>
                      <input type="email" class="form-control" name="email" value="{{$client->email}}" required>
                    </div>
                    <div class="col-lg-5 col-12">
                      <h6>
                        @lang('trans.current_password')
                      </h6>
                      <input class="form-control" type="password" name="current_password" required>
                    </div>
                    <div class="col-lg-5 col-12">
                      <h6>
                        @lang('trans.new_password')
                      </h6>
                      <input type="password" class="form-control" name="password">
                    </div>
                    <div class="col-lg-5 col-12">
                      <h6>
                        @lang('trans.new_password_confirmation')
                      </h6>
                      <input type="password" class="form-control" name="password_confirmation">
                    </div>
                  </div>
                  <div class="row my-5">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button class="btn btn-dark w-auto px-5" type="submit" href="index.blade.php"> @lang('trans.save')</button>
                    </div>
                  </div>
                </form>
                <div class="row my-5 border-bottom border-2 border-dark">
                  <h2>
                    @lang('trans.deleteAccount')
                  </h2>
                </div>
                <div class="row my-5">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-dark w-auto px-5" onclick="confirmDeleteProfile()"> @lang('trans.deleteMyAccount')</button>
                  </div>
                </div>
              </div>
              <!-- show/update/delte address -->
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">

                <div class="row py-3">
                  <a class="btn btn-dark w-auto px-5" type="button" href="{{route('Client.addNewAddress','profile')}}">@lang('trans.add_new_address')</a>
                </div>
                <div class="row gap-3 address py-2">
                  @if($address)
                  <div id="address_{{$address->id}}" class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
                    <div class=" position-absolute d-icon">
                      <span class="p-2">
                          <a href="#delete" onclick="confirmDeleteAddress({{$address->id}})">
                            <i class="fa-solid fa-trash"></i>
                          </a>
                      </span>
                      <span class="p-2">
                        <a href="{{route('Client.editAddress',['id'=>$address->id,'type'=>'profile'])}}">
                           <i class="fa-solid fa-pen"></i>
                        </a>
                      </span>
                    </div>
                    <p class="mt-3"><span class="text-secondary px-2">@lang('trans.country'): </span><span>{{$address->Region->Country['title_'.lang()]}}</span></p>
                    <p><span class="text-secondary px-2">@lang('trans.theRegion'): </span><span>{{$address->Region['title_'.lang()]}}</span></p>
                    <p><span class="text-secondary px-2">@lang('trans.theBlock'): </span><span>{{$address->block}}</span></p>
                    <p><span class="text-secondary px-2">@lang('trans.road'):</span><span>{{$address->road}}</span></p>
                  </div>
                  @endif
                  <div class="col-lg-3 col-8 py-3" onclick="document.location='{{route('Client.addNewAddress','profile')}}'" style="min-height: 200px;">
                    <span><i class="fa-solid fa-plus"></i></span>
                    @lang('trans.add_new_address')
                  </div>
                </div>

              </div>
              <!-- show orders -->
              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                <div class="row py-2">
                  @forelse($orders as $order)
                    <div class="accordion border-0 accordion-flush" id="accordionFlushExample_{{$order->id}}">
                      <div class="accordion-item border-0">
                        <h2 class="accordion-header direction">
                          <a class="accordion-button collapsed bg-black text-white my-2 w-100 p-3 rounded d-flex align-items-center phoneButton"
                             type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_{{$order->id}}"
                             aria-expanded="false" aria-controls="flush-collapseOne_{{$order->id}}">
                            # {{$order->id}} - {{$order->created_at}} - @lang('trans.net_total'): {{number_format($order->net_total * Country()->currancy_value,2)}} {{Country()->currancy_code}}
                          </a>
                        </h2>
                        <div id="flush-collapseOne_{{$order->id}}" class="accordion-collapse collapse"
                             data-bs-parent="#accordionFlushExample_{{$order->id}}">
                          <div class="accordion-body">
                            <table class="table ">
                              <thead class="bg-light">
                              <tr>
                                <th scope="col">@lang('trans.order_number')</th>
                                <th scope="col">@lang('trans.order_status')</th>
                                <th scope="col">@lang('trans.order_date')</th>
                                <th scope="col">@lang('trans.net_total')</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                <td scope="col">{{$order->id}}</td>
                                <td scope="col">
                                 {{$order->orderStatus()}}
                                </td>
                                <td scope="col">
                                  {{$order->created_at->format('Y-m-d')}}
                                </td>
                                <td scope="col">
                                  {{number_format($order->net_total * Country()->currancy_value,2)}} {{Country()->currancy_code}}
                                </td>
                              </tr>
                              </tbody>
                            </table>
                            @forelse($order->Devices as $device)
                              <div class="p-2 my-4 shadow">
                              <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-md-5">
                                  <div class="row justify-content-center align-items-center">
                                    <div class="col-6">
                                      <img src="{{asset($device->header)}}" class="img-fluid w-75" alt="abaia">
                                    </div>
                                    <div class="col-6">
                                      <div class="">
                                        <span class="font-weight-bold d-block mb-3">@lang('trans.Product Name')</span>
                                        <span style="font-size: 13px">{{$device['title_'.lang()]}}</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12 col-md-7">
                                  <div class="row mt-2">
                                    <div class="col-4">
                                      <span class="font-weight-bold d-block mb-3">@lang('trans.quantity')</span>
                                      <span style="font-size:14px">{{$device->pivot->quantity}}</span>
                                    </div>
                                    <div class="col-4">
                                      <span class="font-weight-bold d-block mb-3">@lang('trans.price')</span>
                                      <span style="font-size:14px">{{number_format($device->pivot->price * Country()->currancy_value,2)}} {{Country()->currancy_code}}</span>
                                    </div>
                                    <div class="col-4">
                                      <span class="font-weight-bold d-block mb-3">@lang('trans.total')</span>
                                      <span style="font-size:14px">{{number_format($device->pivot->total * Country()->currancy_value,2)}} {{Country()->currancy_code}}</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @empty
                            @endforelse
                            <div class="bg-light ">
                              <div class="container">
                                <div class="sub-total d-flex justify-content-between my-2">
                                  <span>@lang('trans.sub_total') </span>
                                  <span>{{number_format($order->sub_total * Country()->currancy_value,2)}} {{Country()->currancy_code}}</span>
                                </div>
                                <div class="sub-total d-flex justify-content-between my-2">
                                  <span>@lang('trans.discount')</span>
                                  <span>{{$order->discount * Country()->currancy_value}} {{Country()->currancy_code}}</span>
                                </div>
                                <div class="sub-total d-flex justify-content-between my-2">
                                  <span>@lang('trans.vat')</span>
                                  <span>{{$order->vat * Country()->currancy_value}}  {{Country()->currancy_code}}</span>
                                </div>
                                <div class="sub-total d-flex justify-content-between my-2">
                                  <span>@lang('trans.charge_cost')</span>
                                  <span>{{$order->charge_cost * Country()->currancy_value}}  {{Country()->currancy_code}}</span>
                                </div>
                                <div class="sub-total d-flex justify-content-between my-2">
                                  <span>@lang('trans.net_total')</span>
                                  <span>{{number_format($order->net_total * Country()->currancy_value,2)}}  {{Country()->currancy_code}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @empty
                  @endforelse
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
      <div>


      </div>

    </div>
  </div>

@stop


@section('script')
  <script>
    // Function to handle the delete account
    function confirmDeleteProfile() {
      // Show SweetAlert confirmation dialog
      Swal.fire({
        icon: 'warning',
        title: '@lang("trans.confirmDeleteTitle")',
        text: '@lang("trans.confirmDeleteMessage")',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '@lang("trans.confirmDelete")',
        cancelButtonText: '@lang("trans.cancel")'
      }).then((result) => {
        // If user confirms deletion, proceed with redirection
        if (result.isConfirmed) {
          window.location.href = "{{ route('Client.deleteAccount') }}"; // Replace with your delete profile route
        }
      });
    }


    // confirm delete address
    function confirmDeleteAddress(addressId) {
      Swal.fire({
        title: '{{__('trans.confirmDelete')}}',
        // text: 'Are you sure you want to delete this address?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{__('trans.yes')}}',
        cancelButtonText: '{{__('trans.no')}}',
      }).then((result) => {
        if (result.isConfirmed) {
          // Send AJAX request to delete the address
          $.ajax({
            type: 'POST',
            url: '{{ route("Client.deleteAddress") }}',
            data: {
              address_id: addressId,
              _token: '{{ csrf_token() }}'
            },
            success: function (response) {
              // If deletion is successful, remove the HTML element
              $('#address_' + addressId).remove();
              Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success'
              });
            },
            error: function (xhr, status, error) {
              console.error('Error:', error);
              Swal.fire({
                title: 'Error',
                text: '{{__('trans.somethingWrong')}}',
                icon: 'error'
              });
            }
          });
        }
      });
    }
  </script>
@stop
