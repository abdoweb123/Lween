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
          <button class="nav-link active my-3" id="v-pills-home-tab" data-bs-toggle="pill"
            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
            <div class="row">
              <div class="col-lg-3 col-12 d-flex align-items-center justify-content-center  ">
                <i class="fa-solid fa-user" style="font-size: 30px;"></i>
              </div>
              <div class="col-lg-9 col-12 d-flex flex-column justify-content-center text-end">
                <h6 class="fw-bold  py-2">
                  المعلومات الشخصية
                </h6>
                <p class="text-white fw-semibold nav-pills-profile">
                  معلومات التواصل الخاصه بك
                </p>
              </div>
            </div>
          </button>
          <button class="nav-link my-3" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
            type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
            <div class="row">
              <div class="col-lg-3 col-12 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-address-card" style="font-size: 30px;"></i>
              </div>
              <div class="col-xl-9 col-12 d-flex flex-column justify-content-center text-end">
                <h6 class="fw-bold py-2">
                  دليل العناوين
                </h6>
                <p class="text-white fw-semibold nav-pills-profile">
                  من خلال دليل العنواين يمكنك إضافة و تعديل عناوينك المفضلة
                </p>
              </div>
            </div>
          </button>
          <button class="nav-link my-3" id="v-pills-messages-tab" data-bs-toggle="pill"
            data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
            aria-selected="false">
            <div class="row">
              <div class="col-lg-3 col-12 d-flex align-items-center justify-content-center  ">
                <i class="fa-solid fa-cart-shopping" style="font-size: 30px;"></i>
              </div>
              <div class="col-xl-9 col-12 d-flex flex-column justify-content-center text-end">
                <h6 class="fw-bold  py-2">
                  الطلبات
                </h6>
                <p class="text-white fw-semibold nav-pills-profile">
                  من خلال قائمة الطلبات يمكنك إستعراض الطلبات السابقة و الحالية
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
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                aria-labelledby="v-pills-home-tab" tabindex="0">
                <form action="">
                  <div class="row gap-2 my-5 p-2 ">
                    <div class="col-lg-5 col-12">
                      <h6>
                        الاسم الكامل
                      </h6>
                      <input type="text" class="form-control" value="{{auth()->user()->name}}">
                    </div>
                    <div class="col-lg-5 col-12">
                      <h6>رقم الجوال
                      </h6>
                      <input type="tel" class="form-control" value="{{auth()->user()->phone}}">
                    </div>
                    <div class="col-lg-5 col-12">
                      <h6>
                        البريد الإلكتروني
                      </h6>
                      <input type="email" class="form-control" value="{{auth()->user()->email}}">
                    </div>
{{--                    <div class="col-12">--}}
{{--                      <div class="py-2 my-2">--}}
{{--                        <input type="checkbox" id="check2" name="check2">--}}
{{--                        <label for="check2"> الاشتراك في النشرة الاخبارية--}}
{{--                        </label>--}}
{{--                      </div>--}}
{{--                    </div>--}}
                  </div>
                  <div class="row my-5">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <a class="btn btn-dark w-auto px-5" type="button" href="index.blade.php">حفظ</a>
                    </div>
                  </div>
                  <div class="row my-5 border-bottom border-2 border-dark">
                    <h2>
                      حذف الحساب
                    </h2>
                  </div>
                  <div class="row my-5">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <a class="btn btn-dark w-auto px-5" type="button" href="index.blade.php">احذف حسابي</a>
                    </div>
                  </div>
                </form>


              </div>
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                tabindex="0">

                <div class="row py-3">
                  <a class="btn btn-dark w-auto px-5" type="button" href="addNewAddress.blade.php">اضافة عنوان</a>
                </div>
                <div class="row gap-3 address py-2 justify-content-center">
                  <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
                    <div class=" position-absolute d-icon">

                      <span class="p-2"><i class="fa-solid fa-trash"></i></span>
                      <span class="p-2">
                        <a href="editAdress.html">
                          <i class="fa-solid fa-pen"></i>
                        </a>
                      </span>

                    </div>
                    <p><span class="text-secondary px-2">الدولة:</span><span>السعودية</span></p>
                    <p><span class="text-secondary px-2">المدينة:</span><span>الرياض</span></p>
                    <p><span class="text-secondary px-2">الحي:</span><span>Egypt</span></p>
                    <p><span class="text-secondary px-2">الشارع:</span><span>sidi bshr</span></p>
                  </div>
                  <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
                    <div class=" position-absolute d-icon">

                      <span class="p-2"><i class="fa-solid fa-trash"></i></span>
                      <span class="p-2">
                        <a href="editAdress.html">
                          <i class="fa-solid fa-pen"></i>
                        </a>
                      </span>

                    </div>
                    <p><span class="text-secondary px-2">الدولة:</span><span>السعودية</span></p>
                    <p><span class="text-secondary px-2">المدينة:</span><span>الرياض</span></p>
                    <p><span class="text-secondary px-2">الحي:</span><span>Egypt</span></p>
                    <p><span class="text-secondary px-2">الشارع:</span><span>sidi bshr</span></p>
                  </div>
                  <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
                    <div class=" position-absolute d-icon">

                      <span class="p-2"><i class="fa-solid fa-trash"></i></span>
                      <span class="p-2">
                        <a href="editAdress.html">
                          <i class="fa-solid fa-pen"></i>
                        </a>
                      </span>

                    </div>
                    <p><span class="text-secondary px-2">الدولة:</span><span>السعودية</span></p>
                    <p><span class="text-secondary px-2">المدينة:</span><span>الرياض</span></p>
                    <p><span class="text-secondary px-2">الحي:</span><span>Egypt</span></p>
                    <p><span class="text-secondary px-2">الشارع:</span><span>sidi bshr</span></p>
                  </div>
                  <div class="col-lg-3 col-8 py-3 position-relative" data-aos="flip-left" data-aos-duration="1000">
                    <div class=" position-absolute d-icon">

                      <span class="p-2"><i class="fa-solid fa-trash"></i></span>
                      <span class="p-2">
                        <a href="editAdress.html">
                          <i class="fa-solid fa-pen"></i>
                        </a>
                      </span>

                    </div>
                    <p><span class="text-secondary px-2">الدولة:</span><span>السعودية</span></p>
                    <p><span class="text-secondary px-2">المدينة:</span><span>الرياض</span></p>
                    <p><span class="text-secondary px-2">الحي:</span><span>Egypt</span></p>
                    <p><span class="text-secondary px-2">الشارع:</span><span>sidi bshr</span></p>
                  </div>
                  <div class="col-lg-3 col-8 py-3" onclick="document.location='addNewadress.html'">
                    <span><i class="fa-solid fa-plus"></i></span>
                    اضافة عنوان جديد
                  </div>

                </div>

              </div>
              <div class="tab-pane fade " id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"
                tabindex="0">
                <div class="row py-2">


                  <div class="accordion border-0 accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item border-0">
                      <h2 class="accordion-header direction">
                        <a class="accordion-button collapsed bg-black text-white my-2 w-100 p-3 rounded d-flex align-items-center phoneButton"
                          type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                          aria-expanded="false" aria-controls="flush-collapseOne">
                          # 19 - 2024-01-01 - Net Total: 11525.00 SR
                        </a>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <table class="table ">
                            <thead class="bg-light">
                              <tr>
                                <th scope="col">رقم الطلب</th>
                                <th scope="col">حالة الطلب
                                </th>
                                <th scope="col">تاريخ الطلب
                                </th>
                                <th scope="col">المجموع

                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td scope="col">1</td>
                                <td scope="col">
                                  في الانتظار
                                </td>
                                <td scope="col">
                                  10/3
                                </td>
                                <td scope="col">350

                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <div class="p-2 my-4 shadow">
                            <div class="row justify-content-center align-items-center">
                              <div class="col-12 col-md-5">
                                <div class="row justify-content-center align-items-center">
                                  <div class="col-6">
                                    <img src="assets/imgs/a2.jpg" class="img-fluid w-75" alt="abaia">
                                  </div>
                                  <div class="col-6">
                                    <div class="">
                                      <span class="font-weight-bold d-block mb-3">اسم المنتج</span>
                                      <span style="font-size: 13px">عباية</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 col-md-7">
                                <div class="row mt-2">
                                  <div class="col-4">
                                    <span class="font-weight-bold d-block mb-3">الكمية</span>
                                    <span>1</span>
                                  </div>
                                  <div class="col-4">
                                    <span class="font-weight-bold d-block mb-3">السعر</span>
                                    <span>10000.00</span>
                                  </div>
                                  <div class="col-4">
                                    <span class="font-weight-bold d-block mb-3">الاجمالي</span>
                                    <span>10000.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="bg-light ">
                            <div class="container">
                              <div class="sub-total d-flex justify-content-between my-2">
                                <span>المجموع الفرعي </span>
                                <span>10000.00 SR</span>
                              </div>
                              <div class="sub-total d-flex justify-content-between my-2">
                                <span>الخصم:</span>
                                <span>0.00 SR</span>
                              </div>
                              <div class="sub-total d-flex justify-content-between my-2">
                                <span>الضريبة</span>
                                <span>1500.00 SR</span>
                              </div>
                              <div class="sub-total d-flex justify-content-between my-2">
                                <span>تكلفةالتوصيل</span>
                                <span>25.00 SR</span>
                              </div>
                              <div class="sub-total d-flex justify-content-between my-2">
                                <span>المجموع الكلي</span>
                                <span>11525.00 SR</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>


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