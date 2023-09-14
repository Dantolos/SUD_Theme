<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$cards = get_field( 'cards' ) ?: null;
$section_title = get_field( 'section_title' ) ?: '';
?>

<div <?php echo $anchor; ?>class="flipcards-wrapper" style="min-height:200px;">
     <h3 class="c-orange" style="width: 100%; text-align:center; margin-bottom:40px;"><?php echo $section_title; ?></h3>
     <?php
     if($cards){
          foreach ($cards as &$card) {
               echo '<div class="flipcard-container ">';
               echo '<div class="flipcard-inner-container">';
                    // front
                    echo '<div class="flipcard-front primatyBox" style="background-image: url('.$card['image'].');">';
                         //echo '<img src="'.$card['image'].'" alt="image-'.$card['title'].'"/>';
                         echo '<h5 class="c-orange">'.$card['title'].'</h5>';
                    echo '</div>';
                    // back
                    echo '<div class="flipcard-back primatyBox">';
                         echo '<h5 class="c-orange">'.$card['title_content'].'</h5>';
                         echo '<p class="c-blue fxxs">'.$card['content'].'</p>';
                    echo '</div>';
               echo '</div>';
               echo '</div>';
          }
     }
     ?>
</div>
