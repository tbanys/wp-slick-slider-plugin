<?php

/**
 * @package tbSlickSlider
*/

namespace Inc;

final class Init
{

  /**
   * Store all the classes inide an array
   * @return array full list of classes
   */
  public static function get_services() {
    return [
      Pages\Admin::class,
      Base\Enqueue::class,
      Base\PostTypes::class,
      Base\Shortcodes::class,
      Base\SettingsLinks::class
    ];
  }

  /**
   * Loop through the classes, initialize them, 
   * and call register() method if its exists
   * @return
   */
  public static function register_services() {
    foreach ( self::get_services() as $class ) {
      $service = self::instantiate( $class );
      if( method_exists($service, 'register')) {
        $service->register();
      }
    }
  }

  /**
   * Initialize the class
   * @param class $class class from the services array
   * @return class instance new instace of the class
   */
  private static function instantiate( $class ) {
    $service = new $class();
    return $service;
  }
}