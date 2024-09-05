<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$hide = get_field('hide_block') ? 'none' : 'block';

 

?>

<div style="display:<?php echo $hide; ?>;">
     <div <?php echo $anchor; ?>class="hub-teaser-wrapper" style="min-height:200px;"> 
          <div class="hub-teaser-container">
               <div class="hub-teaser-heading ">
                    <h3 class="c-orange"><?php echo get_field('title'); ?></h3>
                    <p class="c-blue"><?php echo get_field('description'); ?></p>
               </div>

               <div class="hub-teaser-columns">
                    <div class="hub-teaser-row">
                         <a href="<?php echo get_field('podcast')['link']; ?>"> 
                              <div class="hub-teaser-button">
                                   <div class="hub-teaser-button-hover"><h3><?php echo __('Podcast') ?></h3></div>
                                   <img src="<?php echo get_template_directory_uri().'/assets/img/utils/icon_podcast.svg'; ?>" alt="podcast">
                              </div>
                         </a>
                    </div>
                    <div class="hub-teaser-row">
                         <a href="<?php echo get_field('video')['link']; ?>"> 
                              <div class="hub-teaser-button">
                                   <div class="hub-teaser-button-hover"><h3><?php echo __('Video') ?></h3></div>
                                   <img src="<?php echo get_template_directory_uri().'/assets/img/utils/icon_video.svg'; ?>" alt="video">
                              </div>
                         </a>
                    </div>
               </div>

          </div>
     </div>
</div>