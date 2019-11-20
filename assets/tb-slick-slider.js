(function($){

  // Initialize each block on page load (front end).
  $(document).ready(function(){
    if ($('.tb_slick_slider').length > 0) {
      initializeBlock();
    }
  });

  var initializeBlock = function() {
    $('.tb_slick_slider').slick({
      fade: true,
      infinite: true,
      cssEase: 'ease-out',
      autoplaySpeed: 8000,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      dots: false,
      arrows: false,
    }); 
    
    $('.tb_slick_slider_thumbnails').slick({
      slidesToShow: $('.tb_slick_slider_thumbnails').data('items'),
      slidesToScroll: 1,
      asNavFor: '.tb_slick_slider',
      dots: false,
      arrows: false,
      focusOnSelect: true
    });

    // Remove active class from all thumbnail slides
    $('.tb_slick_slider_thumbnails .slick-slide').removeClass('slick-active');
    $('.tb_slick_slider_thumbnails .slick-slide').removeClass('slick-current');

    //Set active class to first thumbnail slides
    $('.tb_slick_slider_thumbnails .slick-slide').eq(0).addClass('slick-active');
    $('.tb_slick_slider_thumbnails .slick-slide').eq(0).addClass('slick-current');

    // On before slide change match active thumbnail to current slide
    $('.tb_slick_slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
      var mySlideNumber = nextSlide;
      $('.tb_slick_slider_thumbnails .slick-slide').removeClass('slick-active');
      $('.tb_slick_slider_thumbnails .slick-slide').removeClass('slick-current');
      $('.tb_slick_slider_thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-active');
      $('.tb_slick_slider_thumbnails .slick-slide').eq(mySlideNumber).addClass('slick-current');
    });
    
  }

})(jQuery);