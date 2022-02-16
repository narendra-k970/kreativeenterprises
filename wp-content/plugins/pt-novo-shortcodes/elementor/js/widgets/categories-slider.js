(function ($) {
  "use strict";

  var CategoriesSlider = function ($scope, $) {
    var category_block = $scope.find('.category-slider-area');

    category_block.each(function () {
      var el_area = jQuery(this),
        items = el_area.find('.item'),
        images_area = el_area.find('.category-slider-images'),
        flag = true;
  
      items.each(function () {
        jQuery(this).attr('data-eq', jQuery(this).index());
        images_area.append('<div class="img-item" style="background-image: url(' + jQuery(this).attr('data-image') + ')"><div class="num">' + leadZero(jQuery(this).index() + 1) + '</div></div>');
      });
  
      el_area.find('.category-slider').on('initialized.owl.carousel translated.owl.carousel', function (e) {
        var eq = jQuery(this).find('.center .item').attr('data-eq');
        images_area.find('.img-item').eq(eq).addClass('active').siblings().removeClass('active');
      });
  
      el_area.find('.category-slider').owlCarousel({
        loop: true,
        items: 1,
        center: true,
        autoWidth: true,
        nav: false,
        dots: false,
        autoplay: false,
        autoplayHoverPause: true,
        navText: false,
        slideBy: 1,
      });
  
      el_area.on('mousewheel wheel', function (e) {
        if (!flag) return false;
        flag = false;
  
        var d = e.originalEvent.deltaY;
        if (e.originalEvent.deltaY) {
          d = e.originalEvent.deltaY;
        } else {
          d = e.deltaY;
        }
  
        if (d > 0) {
          el_area.find('.category-slider').trigger('next.owl');
        } else {
          el_area.find('.category-slider').trigger('prev.owl');
        }
  
        setTimeout(function () {
          flag = true
        }, 600)
        e.preventDefault();
      });
    });
  }

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/yprm_categories_slider.default', CategoriesSlider);
  });

})(jQuery);