<style>
    a {
        text-decoration: none;
    }
</style>
<nav class="main_bg" style="direction: ltr">
    <div class="container">
        <div class="row d-flex justify-content-between py-2">
            <div class="col-md-6 text-center text-md-start px-0">
                <a class="main_link mx-2" href="tel:{{ setting('email') }}">
                    <i class="fa-solid fa-phone"></i>
                    {{ setting('phone') }}
                </a>
                <a class="main_link mx-2" href="mailto:{{ setting('email') }}">
                    <i class="fa-solid fa-envelope-open"></i>
                    {{ setting('email') }}
                </a>
            </div>
            <div class="col-md-6 text-center text-md-end px-0">
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
    </div>
</nav>
