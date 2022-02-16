<?php

namespace Elementor;

if (!defined('ABSPATH')) {
  exit;
}

class PT_Elementor {

  public $widgets;

  public function __construct() {
    if (!defined('ELEMENTOR_VERSION')) {
      return;
    }

    require_once __DIR__ . '/functions.php';

    add_action('elementor/init', [$this, 'includes']);

    add_action('elementor/elements/categories_registered', [$this, 'register_categories']);
    add_action('elementor/controls/controls_registered', [$this, 'init_controls']);
    add_action('elementor/editor/after_enqueue_scripts', [$this, 'after_enqueue_scripts']);

    add_action('elementor/widgets/widgets_registered', array($this, 'widgets_registered'));

    add_action('wp_enqueue_scripts', function () {
      if (class_exists('\Elementor\Frontend')) {
        \Elementor\Plugin::instance()->frontend->enqueue_styles();
      }
    });

    // Ajax Events
    add_action('wp_ajax_loadmore_elementor_portfolio', array($this, 'portfolio_loadmore'));
    add_action('wp_ajax_nopriv_loadmore_elementor_portfolio', array($this, 'portfolio_loadmore'));

    add_action('wp_ajax_loadmore_elementor_blog', array($this, 'blog_loadmore'));
    add_action('wp_ajax_nopriv_loadmore_elementor_blog', array($this, 'blog_loadmore'));

    add_action('wp_ajax_loadmore_elementor_products', array($this, 'products_loadmore'));
    add_action('wp_ajax_nopriv_loadmore_elementor_products', array($this, 'products_loadmore'));
  }

  public function includes() {

    require_once __DIR__ . '/classes/shortcodes/product-query-interface.php';
    require_once __DIR__ . '/classes/shortcodes/products-query.php';

    // Include Widget files
    $widget_dir = dirname(__FILE__) . '/widgets';
    $widget_files = glob($widget_dir . '/*.php');
    foreach ($widget_files as $widget) {
      include_once $widget;
    }

    // Include Controls files
    require_once __DIR__ . '/controls/selectize.php';
    require_once __DIR__ . '/controls/gradient.php';
    require_once __DIR__ . '/controls/groups/link.php';
    require_once __DIR__ . '/controls/groups/cols.php';
    require_once __DIR__ . '/controls/groups/swiper.php';
    require_once __DIR__ . '/controls/groups/background_overlay.php';
    require_once __DIR__ . '/controls/groups/background_video.php';

  }

  public function init_controls() {
    if(!class_exists('\Elementor\Plugin')) return false;
    if(!class_exists('\Elementor\Gradient_Control')) return false;

    $controls_manager = \Elementor\Plugin::$instance->controls_manager;

    $controls_manager->register_control(\Elementor\Gradient_Control::GRADIENT, new \Elementor\Gradient_Control());
    $controls_manager->register_control(\Elementor\Selectize_Control::SELECTIZE, new \Elementor\Selectize_Control());

    $controls_manager->add_group_control('link', new \Elementor\Group_Control_Link());
    $controls_manager->add_group_control('cols', new \Elementor\Group_Control_Cols());
    $controls_manager->add_group_control('swiper', new \Elementor\Group_Control_Swiper());
    $controls_manager->add_group_control('background_overlay', new \Elementor\Group_Control_Background_Overlay());
    $controls_manager->add_group_control('background_video', new \Elementor\Group_Control_Background_Video());
  }

  public function register_categories($elements_manager) {
    $elements_manager->add_category(
      'novo-elements',
      array(
        'title' => esc_html__('Novo Elements', 'novo'),
      ) 
    );
  }

  public function widgets_registered() {
    
    if(!class_exists('\Elementor\Plugin')) return false;
    if(!class_exists('\Elementor\Elementor_Accordion_Widget')) return false;

    // Register widget
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Accordion_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Banner_Liquid_Slider_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Banner_Vertical_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Banner_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Blog_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Brands_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Button_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Categories_Slider_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Categories_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Decor_Elements_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Gallery_External_Link_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Gallery_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Google_MAP_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Heading_Block_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Icon_Box_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Image_Comparison_Slider_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Music_Album_Item_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Music_Albums_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Num_Box_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Photo_Carousel_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Podcast_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Portfolio_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Price_List_Type2_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Price_List_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Products_Banner_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Products_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Side_Image_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Skills_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Split_Screen_Type2_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Split_Screen_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Tabs_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Team_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Testimonials_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Video_Banner_Widget());
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Elementor_Video_Widget());
  }

  public function after_enqueue_scripts() {
    wp_register_style('pt-el-icons', plugins_url('pt-novo-shortcodes') . '/assets/css/pt-el-icons/style.css');
    wp_enqueue_style('pt-el-icons');

    wp_register_script('pt-admin', plugins_url('pt-novo-shortcodes') . '/assets/js/admin.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('pt-admin');
  }

  public function portfolio_loadmore() {
    $porfolio = new Elementor_Portfolio_Widget();

    $porfolio->loadmore();

    wp_die();
  }

  public function blog_loadmore() {
    $blog = new Elementor_Blog_Widget();

    $blog->loadmore();

    wp_die();
  }

  public function products_loadmore() {
    $products = new Elementor_Products_Widget();

    $products->loadmore();

    wp_die();
  }
}

new PT_Elementor();