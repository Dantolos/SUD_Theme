<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$photos = get_field( 'photos' ) ?: null;
?>

<div <?php echo $anchor; ?>class="photo-slide-wrapper" >
     <!--Design Elements-->
     <div class="sud-bg-design" style="display: none;">
          <div class="sud-bg-element-half-circle-01 " style="left:-35vw; top: 25%; width:75vw; height:75vw; "></div>
          <div class="sud-bg-element-polygon-01 " style="right:0; top: 0; width:75vw; height:100%; "></div>
     </div>

     <div class="sud-element" sud-shape="polycon-01" style=" width:150vw; height:150vh;  top: 0; bottom:0; left:0;"></div>
     <div class="sud-element" sud-shape="semicircle" style=" bottom:-15%; right:-60%; width:100vw; height:100vw;"></div>

     <?php if($photos){ ?>
          <div id="photo-slide" class="splide">
               <div class="splide__track" style="overflow:visible;">
                    <ul class="splide__list" style="overflow-y:visible;">
                         <?php
                         foreach($photos as $key => $photo){
                              $alt = $photo['alt'] ?: $photo['name'].$key;
                              echo '<li class="splide__slide photo-slide-li-element">';
                              echo '<div class="photo-slide-box " >';
                                   echo '<div class="photo-slide-image sud-shadow">';
                                   echo '<img src="'.$photo['url'].'" alt="'.$alt.'" />';
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
