<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$counters = get_field( 'counters' ) ?: null;
?>

<div <?php echo $anchor; ?>class="counter-wrapper bg-white" style="min-height:200px;">
     <?php
     if($counters){
          echo '<div class="counter-container">';
          foreach($counters as $counter){
               echo '<div class="counter">';
               echo '<div class="counter-value"><h3 class="c-orange">'.$counter['prefix'].$counter['value'].$counter['sufix'].'</h3></div>';
               echo '<div class="counter-label"><h5 class="c-blue gtalpina fs" style="font-weight:normal;">'.$counter['label'].'</h5></div>';
               echo '</div>';
          }
          echo '</div>';
     }
     ?>
</div>
