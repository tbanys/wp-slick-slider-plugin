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
	}
	public function create_slider_shortcode($atts) 
	{
    $a = shortcode_atts( array(
      'id' => '',
      'thumbnails' => '',
      'image' => '',
      'badge' => '',
      'breadcrumbs' => '',
    ), $atts );

    ob_start();
    ?>
    <?php if(!empty($a['id'])) : ?>
      <div class="tb_slick_slider_wrapper_outer">
        <div class="tb_slick_slider_wrapper">
          <?php $images_id = $this->get_gallery_attachments($a['id']); ?>
          <!-- Slider -->
          <?php if (!empty($images_id)) : ?>
            <div class="tb_slick_slider">
              <?php foreach($images_id as $image_id) : ?>
                <?php $image = wp_get_attachment_image_src( $image_id, 'full' ); ?>
                  <div class="tb_slick_slider_slide" style="background-image:url(<?php echo $image[0]; ?>)"></div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <!-- Thumbnails -->
          <?php if (!empty($a['thumbnails'])) : ?>
            <div class="tb_slick_slider_thumbnails" data-items="<?php echo count($images_id); ?>">
              <?php foreach($images_id as $image_id) : ?>
                <?php $image = wp_get_attachment_image_src( $image_id, 'full' ); ?>
                  <div class="thumbnail_wrapper" style="background-image:url(<?php echo $image[0]; ?>)"></div>
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
              "type" => "textfield",
              "class" => "",
              "heading" => __( "Slider id", "tbSlickSlider" ),
              "param_name" => "id",
              "value" => "",
              "description" => __( "Post id of slider", "tbSlickSlider" )
            ],
            [
              "type" => "checkbox",
              "class" => "",
              "heading" => __( "Thumbnails", "tbSlickSlider" ),
              "param_name" => "thumbnails",
              "value" => "Yes",
              "description" => __( "Show thumbnails", "tbSlickSlider" )
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