<?php 
/**
 * @package tbSlickSlider
 */

/*
Plugin Name: Slick Slider
Plugin URI: tbanys.com
Description: Slick slider plugin
Version: 1.0.0
Author: Tautvydas Banys
License: GPLv2 or later
Text Domain: tb-slick-slider
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Require once the Composer Autoload
if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
  require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_tb_slick_slider() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_tb_slick_slider' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_tb_slick_slider() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_tb_slick_slider' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists('Inc\\Init') ) {
  Inc\Init::register_services();
}