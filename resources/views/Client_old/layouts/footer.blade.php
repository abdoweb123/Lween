
<footer class="">
    
    <section class="p-4 border-bottom">
        <div class="container d-flex justify-content-center justify-content-lg-between ">
            <div class="me-5 d-none d-lg-block">
                <span>@lang('trans.Get_in_Touch'):</span>
            </div>
            
    
            <div>
                <a target="_blank" href="{{ setting('facebook') }}" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a target="_blank" href="{{ setting('twitter') }}" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a target="_blank" href="{{ setting('instagram') }}" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a target="_blank" href="{{ setting('snapchat') }}" class="me-4 text-reset">
                    <i class="fab fa-snapchat"></i>
                </a>
                <a target="_blank" href="https://wa.me/{{ setting('whatsapp') }}" class="me-4 text-reset">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </section>
    

    
    <section class="">
        <div class="container mt-5">
            
            <div class="row mt-3">
                
                <div class="col-md-2 mx-auto mb-4">
                    <img src="{{ asset(setting('logo')) }}" class="mx-4" alt="logo" style="max-width: 200px">
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-9 mx-auto mb-4 px-5">
                    <div class="row">
                        <div class="col-12 col-md mx-auto mb-4">
                            <h6 class="mb-4 point" onclick="window.location.href='{{ route('Client.home') }}'">
                                @lang('trans.home')
                            </h6>
                            <h6 class="mb-4 point" onclick="window.location.href='{{ route('Client.categories') }}'">
                                @lang('trans.products')
                            </h6>
                            <h6 class="mb-4 point" onclick="window.location.href='{{ route('Client.faq') }}'">
                                @lang('trans.faq')
                            </h6>
                        </div>
                        <div class="col-12 col-md mx-auto mb-4">
                            <h6 class="mb-4 point" onclick="window.location.href='{{ route('Client.about') }}'">
                                @lang('trans.about')
                            </h6>
                            <h6 class="mb-4 point" onclick="window.location.href='{{ route('Client.terms') }}'">
                                @lang('trans.terms')
                            </h6>
                            <h6 class="mb-4 point" onclick="window.location.href='{{ route('Client.contact') }}'">
                                @lang('trans.contact')
                            </h6>
                            <h6 class="mb-4 point" onclick="window.location.href='{{ route('Client.privacy') }}'">
                                @lang('trans.privacy')
                            </h6>
                        </div>
                        <div class="col-12 col-md mx-auto mb-md-0 mb-4">
                           
                        </div>
                      
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    

    
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        @lang('trans.copyrights') 
        <a target="_blank" href="https://emcan-group.com/" class="text-decoration-none">
            @lang('trans.emcan')
        </a>
    </div>
    
</footer>
