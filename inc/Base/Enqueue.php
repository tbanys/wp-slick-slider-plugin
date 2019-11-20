<?php 
/**
 * @package  tbSlickSlider
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

/**
* 
*/
class Enqueue extends BaseController
{
	public function register() {
    add_action( 'wp_enqueue_scripts', array($this, 'enqueue') );
  }
  
  function enqueue() {
    wp_enqueue_script( 'slick', $this->plugin_url . 'assets/slick/slick.min.js', array( 'jquery' ), '2.09', true );
    wp_enqueue_style( 'slick', $this->plugin_url . 'assets/slick/slick.css', array(), '2.09');
    wp_enqueue_style( 'slick-theme', $this->plugin_url . 'assets/slick/slick-theme.css', array(), '2.09');
    wp_enqueue_style( 'tb-slick-slider', $this->plugin_url . 'assets/style.css' );
    wp_enqueue_script( 'tb-slick-slider', $this->plugin_url . 'assets/tb-slick-slider.js', array('jquery'), '1.0.0', true );
  }
}