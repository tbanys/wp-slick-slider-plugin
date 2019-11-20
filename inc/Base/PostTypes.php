<?php
/**
 * @package  tbSlickSlider
 */
namespace Inc\Base;

class PostTypes
{
	public function register() 
	{
    add_action( 'init',  array($this, 'register_post_types' ));
	}
	public function register_post_types() 
	{
    $args = array(
      'labels' => array(
      'name' => __( 'Slider' ),
      'singular_name' => __( 'Slider' )
      ),
      'public' => false,
      'has_archive' => false,
      'exclude_from_search' => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
      'menu_icon'           => 'dashicons-clipboard'
    );
      register_post_type( 'tb_slick_slider', $args );
	}
}
