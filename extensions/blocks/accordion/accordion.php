<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$title = get_field('title') ?: '';
$text = get_field('text') ?: '';
$accordions = get_field( 'accordions' ) ?: null;
?>

<div <?php echo $anchor; ?>class="accordion-wrapper" style="min-height:200px;">
     <div class="accordion-container">
          <h3 class="c-orange fl"><?php echo $title; ?></h3>
          <p class="c-blue"><?php echo $text; ?></p>
          <!-- Accordion -->
          <?php
          if($accordions){
               echo '<div class="accordion-list">';
               foreach ($accordions as $key => $accordion) {
                    echo '<div class="accordion-item sud-shadow">';
                         echo '<div class="accordion-item-title active">';
                              echo '<h6 class="c-blue ">'.$accordion['title'].'</h6>';
                              echo '<img src="'.get_template_directory_uri().'/assets/img/utils/arrrow-c-down.svg" alt="sud-arrow">';
                         echo '</div>';
                         echo '<div class="accordion-item-content">';
                              echo '<div class="c-blue">'.$accordion['content'].'</div>';
                         echo '</div>';
                    echo '</div>';
               }
               echo '</div>';
          }
          ?>
          
     </div>
</div>
