<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$videos = get_field( 'videos' ) ?: null; 
?>

<div <?php echo $anchor; ?>class="sud-main-wrapper" style="min-height:200px;">
     <div class="sud-main-container">
         
     </div> 
</div>
