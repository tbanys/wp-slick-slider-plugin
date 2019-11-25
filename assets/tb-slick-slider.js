(function($){

  // Initialize each block on page load (front end).
  $(document).ready(function(){
      $('.tb_slick_slider_wrapper').each(function(){
        initializeSlickSlider($(this));
      });
  });

  var initializeSlickSlider = function(slider) {
    var main_slider = slider.find('.tb_slick_slider').selector + '_' + slider.find('.tb_slick_slider').data('id');
    var thumnbs = slider.find('.tb_slick_slider_thumbnails').selector + '_' + slider.find('.tb_slick_slider_thumbnails').data('id') ;
    var thumnbs_slide = thumnbs + ' .slick-slide';
    $(main_slider).slick({
      fade: true,
      infinite: true,
      cssEase: 'ease-out',
      autoplaySpeed: $(main_slider).data('interval'),
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      dots: false,
      arrows: false,
    }); 
    
    $(thumnbs).slick({
      slidesToShow: $(thumnbs).data('items'),
      slidesToScroll: 1,
      asNavFor: main_slider,
      dots: false,
      arrows: false,
      focusOnSelect: true
    });

    // Remove active class from all thumbnail slides
    $(thumnbs_slide).removeClass('slick-active');
    $(thumnbs_slide).removeClass('slick-current');

    //Set active class to first thumbnail slides
    $(thumnbs_slide).eq(0).addClass('slick-active');
    $(thumnbs_slide).eq(0).addClass('slick-current');

    // On before slide change match active thumbnail to current slide
    $(main_slider).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
      var mySlideNumber = nextSlide;
      $(thumnbs_slide).removeClass('slick-active');
      $(thumnbs_slide).removeClass('slick-current');
      $(thumnbs_slide).eq(mySlideNumber).addClass('slick-active');
      $(thumnbs_slide).eq(mySlideNumber).addClass('slick-current');
    });
    
  }

})(jQuery);