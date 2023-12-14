<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
     $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
 
$hide = get_field('hide_block') ? 'none' : 'block';


?>

<div style="display:<?php echo $hide; ?>;">
     <div <?php echo $anchor; ?>class="sud-containerblock-wrapper">
          <div class="sud-containerblock-container">
               <InnerBlocks />
          </div>
     </div>
</div>