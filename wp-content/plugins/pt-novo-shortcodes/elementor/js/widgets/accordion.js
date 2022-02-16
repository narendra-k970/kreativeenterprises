(function($) {
    "use strict";

    var ptAccordion = function( $scope, $ ) {
        var wrapper = $scope.find('.accordion-items');

        if ( ! wrapper.length || typeof elementor === "undefined" ) {
            return false;
        }

        if ( ! wrapper.find('.item:first .top').hasClass('active') ) {
            setTimeout( function() {
                wrapper.find('.item:first .top').trigger('click');
            }, 3000 );
        }

        wrapper.find('.item .top').on('click', function ( e ) {
            e.preventDefault();
            e.stopPropagation();

            if ( jQuery(this).parent().hasClass('active') ) {
                jQuery(this).removeClass('elementor-active');
                jQuery(this).parent().removeClass('active').find('.wrap').slideUp();
            } else {
                jQuery(this).addClass('elementor-active');
                jQuery(this).parent().addClass('active').find('.wrap').slideDown();
            }

            jQuery(window).trigger('resize.px.parallax').trigger('resize').trigger('scroll');
            setTimeout(function () {
                jQuery(window).trigger('resize.px.parallax').trigger('resize').trigger('scroll');
            }, 300);
        });
    }

    // Make sure you run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/yprm_accordion.default', ptAccordion );
    });

})(jQuery);