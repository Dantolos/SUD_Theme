<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$hide = get_field('hide_block') ? 'none' : 'block';

// Load values and assign defaults.
$title = get_field( 'title' ) ?: null;
$cards = get_field('infocard') ?: null;
?>
<div style="display:<?php echo $hide; ?>;">
     <div <?php echo $anchor; ?>class="infocards-wrapper" style="min-height:200px; ">
          <?php
               if($cards){
                    foreach( $cards as $card ){
                         ?>
                         <div class="infocard-container primatyBox">
                              <?php if($card['icon']): ?> 
                                   <div class="infocard-icon">
                                        
                                        <img src="<?php echo $card['icon']; ?>" alt="<?php echo $card['cardtitle']; ?> Icon">
                                        
                                   </div>
                              <?php endif; ?>
                              <h4 class="c-orange fs" ><?php if($card['cardtitle']){ echo $card['cardtitle']; } ?></h4>
                              <div class="infocard-content c-blue ">
                                   <?php if($card['cardtitle']){ echo $card['content']; }?>
                              </div>
                         </div>
                         <?php
                    }
               }
          ?>
          
     </div>
</div>