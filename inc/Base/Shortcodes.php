<?php
/**
 * @package  tbSlickSlider
 */
namespace Inc\Base;

class Shortcodes
{

	public function register() 
	{
    add_shortcode( 'tb-slick-slider', array( $this, 'create_slider_shortcode' ));
    add_action( 'init', array( $this, 'vc_map_product_list' ));
    // add_image_size( 'slider-large', 1901, 708 );
    // add_image_size( 'slider-small', 2000, 508 );
    add_image_size( 'slider-thumb', 250, 96 );
	}
	public function create_slider_shortcode($atts) 
	{
    $a = shortcode_atts( array(
      'slider_images' => '',
      // 'id' => '',
      'thumbnails' => '',
      'image' => '',
      'badge' => '',
      'breadcrumbs' => '',
      'interval' => '5000',
      'image_size' => 'full',
    ), $atts );
    
    $image_size_array = explode("x", $a['image_size']);
    if (count($image_size_array) < 2) {
      $image_size = $image_size_array[0];
    } else {
      $image_size = $image_size_array;
    }

    ob_start();
    ?>
    <?php if(!empty($a['slider_images'])) : ?>
      <?php $slider_id = rand(1, 200); ?>
      <div class="tb_slick_slider_wrapper_outer">
        <div class="tb_slick_slider_wrapper">
          <?php $images_id = explode(",", $a['slider_images']); ?>
          <!-- Slider -->
          <?php if (!empty($images_id)) : ?>
            <div class="tb_slick_slider_<?php echo $slider_id; ?> tb_slick_slider" data-id="<?php echo $slider_id; ?>" data-interval="<?php echo $a['interval']; ?>">
              <?php foreach($images_id as $image_id) : ?>
                <?php $image = wp_get_attachment_image_src( $image_id, $image_size ); ?>
                  <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="" style="max-height:<?php echo count($image_size_array) < 2 ? '' : $image[2]; ?>px">
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <!-- Thumbnails -->
          <?php if (!empty($a['thumbnails'])) : ?>
            <div class="tb_slick_slider_thumbnails_<?php echo $slider_id; ?> tb_slick_slider_thumbnails" data-id="<?php echo $slider_id; ?>" data-items="<?php echo count($images_id); ?>">
              <?php foreach($images_id as $image_id) : ?>
                <?php $image = wp_get_attachment_image_src( $image_id, 'slider-thumb' ); ?>
                  <img src="<?php echo $image[0]; ?>" alt="">
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($a['image'])) : ?>
            <?php $image = wp_get_attachment_image_src( $a['image'], 'full' ); ?>
            <img class="top_image" src="<?php echo $image[0]; ?>" alt="">
          <?php endif; ?>
        </div>
        <?php if (!empty($a['badge'])) : ?>
          <?php $image = wp_get_attachment_image_src( $a['badge'], 'full' ); ?>
          <img class="badge_image" src="<?php echo $image[0]; ?>" alt="">
        <?php endif; ?>
        <?php if (!empty($a['breadcrumbs'])) : ?>
          <?php if ( function_exists('yoast_breadcrumb') ) : ?>
            <?php yoast_breadcrumb( '<div class="breadcrumb_wrapper">','</div>' ); ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php else : ?>
      <p><?php _e('You have to provide slider id', 'tbSlickSlider'); ?></p>
    <?php endif; ?>
    <?php
    return ob_get_clean();
  }

  public function get_gallery_attachments($post_id){
    
    $post = get_post($post_id);
    $post_content = $post->post_content;
    preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
    $images_id = explode(",", $ids[1]);
    
    return $images_id;
  }

  public function vc_map_product_list() {
    if(function_exists("vc_map")){
      vc_map([
          "name" => "Slick Slider",
          "base" => "tb-slick-slider",
          "vc_map" => "Slick Slider",
          "content_element" => true,
          "is_container" => false,
          "params" => [
            [
              "type" => "attach_images",
              "class" => "",
              "heading" => __( "Slider images", "tbSlickSlider" ),
              "param_name" => "slider_images",
              "value" => '',
            ],
            [
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Slider image size", "tbSlickSlider" ),
              "param_name" => "image_size",
              "value" => "slider-large",
              "description" => __( "full, large, medium, thumbnail or custom size 1920x1080", "tbSlickSlider" )
            ],
            [
              "type" => "checkbox",
              "class" => "",
              "heading" => __( "Show thumbnails", "tbSlickSlider" ),
              "param_name" => "thumbnails",
              "value" => "Yes",
              "description" => __( "Show thumbnails", "tbSlickSlider" )
            ],
            [
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Interval in miliseconds", "tbSlickSlider" ),
              "param_name" => "interval",
              "value" => "5000",
              "description" => __( "Default 5s. 1000 = 1s", "tbSlickSlider" )
            ],
            [
              "type" => "checkbox",
              "class" => "",
              "heading" => __( "Breadcrumbs", "tbSlickSlider" ),
              "param_name" => "breadcrumbs",
              "value" => "Yes",
              "description" => __( "Show breadcrumbs", "tbSlickSlider" )
            ],
            [
              "type" => "attach_image",
              "class" => "",
              "heading" => __( "Image", "tbSlickSlider" ),
              "param_name" => "image",
              "value" => '',
              "description" => __( "Always on top", "tbSlickSlider" )
            ],
            [
              "type" => "attach_image",
              "class" => "",
              "heading" => __( "Badge", "tbSlickSlider" ),
              "param_name" => "badge",
              "value" => '',
              "description" => __( "Always on top", "tbSlickSlider" )
            ]
          ]
      ]);
    }
  }
}