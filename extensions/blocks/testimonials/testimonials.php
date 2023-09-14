<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$section_title = get_field( 'section_title' ) ?: null;
$testimonials = get_field( 'testimonials' ) ?: null;
?>

<div <?php echo $anchor; ?>class="testimonials-wrapper" style="min-height:200px;">
     <div class="testimonials-header bg-blue-ultra-light">
          <h4 class="c-orange" style="text-align:center; max-width: 95vw;"><?php echo $section_title; ?></h4>
     </div>
     
     <div class="testimonials-container bg-blue-ultra-light">
          <!-- Loop through testimonial items -->
          <?php if($testimonials) { ?>
          <div id="testimonial-slide" class="splide">
               <div class="splide__track">
                    <ul class="splide__list">
                         <?php
                         foreach($testimonials as $testimonial){
                              echo '<li class="splide__slide">';
                              echo '<div class="testimonial-box">';
                                   echo '<div class="testimonial-portrait" style="background-image:url('.$testimonial['portrait'].');"></div>';
                                   echo '<div class="testimonial-content">';
                                        echo '<span class="c-orange fxl">"</span>';
                                        echo '<blockquote class="c-blue">'.$testimonial['quote'].'</blockquote>';
                                        echo '<h6 class="c-orange">'.$testimonial['autor'].'</h6>';
                                   echo '</div>';
                              echo '</div>';
                              echo '</li>';
                         }
                         ?>
            
                    </ul>
               </div>
          </div>
          <?php } ?>
     </div>

     <div class="testimonials-footer bg-blue-ultra-light">
         
     </div>
</div>
