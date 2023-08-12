
  var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});



$('.testimonial_slide').owlCarousel({
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
items:4,
loop:false,
margin:25,
autoplay:true,
nav:true,
navText : ['<i class="fa-solid fa-caret-left"></i>', '<i class="fa-solid fa-caret-right"></i>'],
responsive: {
    0: {
      items: 1
    },

    600: {
      items: 2
    },

    1024: {
      items: 3
    },

    1366: {
      items: 3
    }
  }
});


      /*services slider*/
$('.banner_slide').owlCarousel({
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
items:4,
loop:false,
margin:0,
autoplay:true,
nav:true,
navText : ['<i class="fa-solid fa-caret-left"></i>', '<i class="fa-solid fa-caret-right"></i>'],
responsive: {
    0: {
      items: 1
    },

    600: {
      items: 1
    },

    1024: {
      items: 1
    },

    1366: {
      items: 1
    }
  }
});
 
      /*services slider*/
$('.services_slide').owlCarousel({
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
items:4,
loop:false,
margin:20,
autoplay:true,
nav:true,
navText : ['<i class="fa-solid fa-caret-left"></i>', '<i class="fa-solid fa-caret-right"></i>'],
responsive: {
    0: {
      items: 1
    },

    600: {
      items: 1
    },

    1024: {
      items: 3
    },

    1366: {
      items: 4
    }
  }
});
 