<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$cards = get_field( 'cards' ) ?: null;
$type = get_field('type') ?: 'type1';
$section_title = get_field( 'section_title' ) ?: '';


//---------------------- Gross ------------------------
if (!function_exists('cast_flipcard_type_1')) {
     function cast_flipcard_type_1($cards){
          foreach ($cards as &$card) {
               echo '<div class="flipcard-container flipcard-container-t1">';
               echo '<div class="flipcard-inner-container flipcard-inner-container-t1">';
                    // front
                    echo '<div class="flipcard-front flipcard-front-t1 primatyBox" style="background-image: url('.$card['image'].');">';
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
}

//---------------------- Klein ------------------------
if (!function_exists('cast_flipcard_type_2')) {
     function cast_flipcard_type_2($cards){
          foreach ($cards as &$card) {
               echo '<div class="flipcard-container flipcard-container-t2">';
               echo '<div class="flipcard-inner-container flipcard-inner-container-t2">';
                    // front
                    echo '<div class="flipcard-front flipcard-front-t2 primatyBox">';
                         echo '<img src="'.$card['image'].'" alt="image-'.$card['title'].'"/>';
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
}

?>

<div <?php echo $anchor; ?>class="flipcards-wrapper" style="min-height:200px;">
     <h3 class="c-orange" style="width: 100%; text-align:center; margin-bottom:40px;"><?php echo $section_title; ?></h3>
     <?php
     if($cards){
          switch ($type) {
               case 'type1':
                    echo cast_flipcard_type_1($cards);
                    break;
               case 'type2':
                    echo cast_flipcard_type_2($cards);
                    break;
               default:
                    echo '<h4>please choose type</h4>';
                    break;
          }
          
     }
     ?>
</div>

