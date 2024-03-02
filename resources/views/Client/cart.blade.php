<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
    integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link
    rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/Responsive.css">
  <title>cart</title>
</head>

<body>

<div class="loading-screen position-fixed top-0 start-0 end-0 bottom-0 bg-black justify-content-center align-items-center">
    <i class="fa fa-spinner fa-spin fa-5x"></i>
</div>
  <div id="navSlider">

  </div>
    <nav id="navBar">
  
    </nav>
  <div id="icons">
  </div>
  <div class="position-fixed congratulation top-0 start-0 end-0 bottom-0 ">

  <div class="js-container" style="top:0px !important;"></div>
  </div>
    <div class="container section-top my-5 " style="min-height: 60vh;">
    <div class="row gap-5 justify-content-center">
      <div class="col-lg-7 col-12 ">
   <h3 class="py-2 fw-bold">
    المنتجات
   </h3>
   <div class="row  p-1 my-2" >
    <div class="col-lg-7 col-6">المنتج</div>
    <div class="col-lg-2 col-3">الكمية</div>
    <div class="col-lg-3 col-3">السعر</div>
   </div>
<div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center" data-aos="fade-up" data-aos-duration="1000">
  <div class="col-lg-7 col-6">

    <div class="d-flex">
      <div class="flex-shrink-0 rounded-0">
        <img class="w-100 h-100" src="assets/imgs/b4.jpeg" alt="...">
      </div>
      <div class="flex-grow-1 p-3  fw-bold">
        2369 - 46.0 - XS ( ١٩ انش )
      </div>
    </div>
  </div>
  <div class="col-lg-2 col-3">
    <select  class="form-select border border-1 rounded-0 w-100 px-4" aria-label="Default select example">
      <option selected>1</option>
      <option value="2" >2</option>
      <option value="DE">3</option>
      <option value="SG">4</option>
      <option value="AU">5</option>
    </select>
  </div>
  <div class="col-lg-3 col-3 text-price">
    3,300.00 AED
  </div>
</div>
<div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center" data-aos="fade-up" data-aos-duration="1000">
  <div class="col-lg-7 col-6">

    <div class="d-flex">
      <div class="flex-shrink-0 rounded-0">
        <img class="w-100 h-100" src="assets/imgs/b4.jpeg" alt="...">
      </div>
      <div class="flex-grow-1 p-3  fw-bold">
        2369 - 46.0 - XS ( ١٩ انش )
      </div>
    </div>
  </div>
  <div class="col-lg-2 col-3">
    <select  class="form-select border border-1 rounded-0 w-100 px-4" aria-label="Default select example">
      <option selected>1</option>
      <option value="2" >2</option>
      <option value="DE">3</option>
      <option value="SG">4</option>
      <option value="AU">5</option>
    </select>
  </div>
  <div class="col-lg-3 col-3 text-price">
    3,300.00 AED
  </div>
</div>
    </div>
    <div class="col-lg-4 col-12">
      <h3 class="py-2 fw-bold">
        تفاصيل الفاتورة
       </h3>
       <div class="row  p-1 my-2">
        <div class="col-7">الوصف</div>
        <div class="col-5">القيمة</div>
       </div>

       <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center">
        <div class="col-7">
          المجموع الفرعي
        </div>
        <div class="col-5">
          3,300.00 AED
        </div>

      </div>
      <div class="row border-1 border border-secondary p-1 rounded-1 my-2 align-items-center">
        <div class="col-7">
          المجموع
        </div>
        <div class="col-5 fw-bold">
          3,300.00 AED
        </div>

      </div>
      <div class="row p-1  my-2 ">
        <form class="row g-2" onsubmit="preventFormSubmission(event)">
          <label for="discount" class="py-2" >كوبون الخصم            </label>

          <div class="col align-items-center">
            <input type="text" class="form-control" id="discount" placeholder="ادخل كود الخصم">
          </div>
          <div class="col-auto align-items-center">
            <button  id="success" class="btn btn-dark rounded-1 mb-3">ارسال</button>
          </div>
          <a  class="btn btn-dark rounded-1 my-2" href="Purchase.html" >متابعة الشراء</a>
          <a  class="btn btn-outline-dark rounded-1 my-2" href="index.blade.php" >العودة للتسوق </a>
        </form>


      </div>

    </div>

    </div>
  </div>
  
  <div id="gray-footer">
  </div>
       <footer id="footer" >
        </footer>
        <div id="sideNav">
        </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
    integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/confetti.min.js"></script>
  <script src="assets/js/index.js"></script>

<script>

function preventFormSubmission(event) {
      event.preventDefault();   
      triggerConfettiAnimation();

    }


    $(document).ready(function(){
  $("#success").click(function(){
    $(".congratulation").fadeToggle();
  });
});
    AOS.init({
      once: true
    })

// let confetti = new Confetti('success');
// confetti.setCount(50);
// confetti.setSize(3);
// confetti.setPower(75);
// confetti.setFade(true);
// // confetti.destroyTarget(true);
// confetti.destroyTarget(false);



const Confettiful = function(el) {
  this.el = el;
  this.containerEl = null;
  
  this.confettiFrequency = 10;
  this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E','#EFFF1D'];
  this.confettiAnimations = ['slow', 'medium', 'fast'];
  
  this._setupElements();
  this._renderConfetti();
};

Confettiful.prototype._setupElements = function() {
  const containerEl = document.createElement('div');
  const elPosition = this.el.style.position;
  
  if (elPosition !== 'relative' || elPosition !== 'absolute') {
    this.el.style.position = 'relative';
  }
  
  containerEl.classList.add('confetti-container');
  
  this.el.appendChild(containerEl);
  
  this.containerEl = containerEl;
};

Confettiful.prototype._renderConfetti = function() {
  this.confettiInterval = setInterval(() => {
    const confettiEl = document.createElement('div');
    const confettiSize = (Math.floor(Math.random() * 3) + 7) + 'px';
    const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
    const confettiLeft = (Math.floor(Math.random() * this.el.offsetWidth)) + 'px';
    const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];
    
    confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
    confettiEl.style.left = confettiLeft;
    confettiEl.style.width = confettiSize;
    confettiEl.style.height = confettiSize;
    confettiEl.style.backgroundColor = confettiBackground;
    
    confettiEl.removeTimeout = setTimeout(function() {
      confettiEl.parentNode.removeChild(confettiEl);
    }, 3000);
    
    this.containerEl.appendChild(confettiEl);
  }, 25);
};

window.confettiful = new Confettiful(document.querySelector('.js-container'));

</script>
</body>

</html>