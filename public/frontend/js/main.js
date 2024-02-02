jQuery(function($) {
  $('body').on('keyup input paste', '.phone_number, .mask_us_phone', function() {
      $(this).mask('+1 (999) 999-9999')
  });
  $('.mask_us_phone').trigger('input');

  $('.video-play').click(function(){
    $('.video-wrap').show();
    $('.bl-video').show();

    $('.blv-video').trigger('play');

    $('.bl-video').click();
    $('.bl-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
    return false;

    
  });
  
  
  // For Zoom 
  $('.zoom-images').each(function() {
      $(this).imageZoom();
  });
  // For Zoom 

   // check video 
   $(document).on('init', '.product-plugin-upper', function(){
    var firstVideo = $(this).find('[data-slick-index="0"] video').get(0);
    if (firstVideo == undefined) {
        console.log("not a video");
    }
    else{
        $(this).find('[data-slick-index="0"] video').get(0).play();
        console.log("video");
    }
});
// check video end

  $('.product-plugin-upper').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      adaptiveHeight:true,
      asNavFor: '.product-plugin-lower'
  });

  $('.product-plugin-lower').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      asNavFor: '.product-plugin-upper',
      dots: false,
      arrows: true,
      centerMode: true,
      focusOnSelect: true,
      responsive: [ 
          {
          breakpoint: 390,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1
              }
          },
      ]
  }); 

});

// play video product details page 

$(document).on('beforeChange', '.product-plugin-upper', function(event, slick, currentSlide, nextSlide){
  let currentVideo = $(slick.$slides[currentSlide]).find('video').get(0);
  let nextVideo = $(slick.$slides[nextSlide]).find('video').get(0);
  if (currentVideo) {
      currentVideo.pause();
  }
  if(nextVideo){
      nextVideo.play();
  }
  setTimeout(() => {
      currentVideo.currentTime = 0;
  }, 2000);
});
// play video product details page end

const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const navMain = document.querySelector(".mob-nav");

hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
  navMain.classList.toggle("active");
  if (navMain.classList.contains('active')) {
    navMain.classList.add("d-flex");
    
  }else{
    setTimeout(() => {
      navMain.classList.remove("d-flex");
    }, 200);
    
  }
});

document.querySelectorAll(".nav-link").forEach((link) =>
  link.addEventListener("click", () => {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
  })
);
