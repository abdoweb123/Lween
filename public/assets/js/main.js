


/*==============================================================*/
// Theme
/*==============================================================*/
if (localStorage.getItem("theme")) {
    theme = localStorage.getItem("theme");
    $("html").attr("data-bs-theme", theme);
} else {
    theme = 'light';
    localStorage.setItem('theme', 'light');
    $("html").attr("data-bs-theme", theme);
}
$(document).on("click", "#ToggleTheme", function () {
    theme = localStorage.getItem("theme") == 'light' ? 'dark' : 'light';
    $("html").attr("data-bs-theme", theme);
    localStorage.setItem('theme', theme);
});



/*==============================================================*/
// Loader
/*==============================================================*/
$(".preload").fadeOut();
$(".content").fadeIn();
// $(document).ready(function() {
//     $(".preload").fadeOut(2000, function() {
//         $(".content").fadeIn(1000);
//     });
// });


// data color
jQuery("[data-color]").each(function () {
    jQuery(this).css('color', jQuery(this).attr('data-color'));
});
// data background color
jQuery("[data-bgcolor]").each(function () {
    jQuery(this).css('background-color', jQuery(this).attr('data-bgcolor'));
});



/*==============================================================*/
// Back To Top
/*==============================================================*/
mybutton = document.getElementById("scrollTopButton");
whatsapp = document.getElementById("whatsappbutton");

function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
        whatsapp.style.bottom = '110px';
    } else {
        mybutton.style.display = "none";
        whatsapp.style.bottom = '50px';
    }
}
$(document).ready(function() {
    window.onscroll = function() {
        scrollFunction()
    };
});

var slider_format = {
    centerMode: true,
    dots: true,
    infinite: true,
    arrows: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 2,
    autoplay:false,
    cssEase: 'linear',
    rtl: document.documentElement.lang == 'ar' ? true : false,
    responsive: [
        {
            breakpoint: 1366,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 720,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 650,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
    ]
};


function toast(type,title) {
    classes = type == 'success' ? 'fa-regular fa-circle-check text-success' : 'fa-solid fa-xmark text-danger';
    $('#liveToast i').removeClass().addClass(classes);
    $('#liveToast strong').html(title);
    var toastLiveExample = document.getElementById('liveToast');
    var toast = new bootstrap.Toast(toastLiveExample);
    toast.show();
}

