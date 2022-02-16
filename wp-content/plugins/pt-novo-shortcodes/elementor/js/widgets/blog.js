(function ($) {
  "use strict";

  var PTBlogs = function ($scope, $) {
    var blog_block = $scope.find('.blog-block');

    console.log(blog_block);
  }

  // Make sure you run this code under Elementor.
  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/yprm_blog.default', PTBlogs);
  });

})(jQuery);