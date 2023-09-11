<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$section_title = get_field( 'section_title' ) ?: '';
$note = get_field('note') ?: '';
$benefit_title = get_field('benefits')['title'] ?: '';
$benefit_content = get_field('benefits')['benefit_description'] ?: '';
$tickets = get_field('tickets') ?: null;
$button = get_field('button') ?: null;
?>

<div <?php echo $anchor; ?>class="pricing-wrapper" style="min-height:200px;">
     
     <div class="pricing-container">

          <h3 class="c-orange" style="text-align:center; width:100%; margin-bottom:0; line-height: 0;"><?php echo $section_title; ?></h3>
          <p class="c-blue" style="margin:0;"><?php echo $note; ?></p>
          <div class="pricing-overview">
          <div class="pricing-benefits secondaryBox c-blue">
               <h5 class="c-orange" style="margin-bottom:20px;" ><?php echo $benefit_title; ?></h5>
               <?php echo $benefit_content; ?>
          </div>
          <?php
               if($tickets){
                    echo '<div class="pricing-tickets">';
                    foreach ($tickets as $ticket) {
                         echo '<div class="pricing-ticket-box primatyBox">';
                              echo '<div class="pricing-box-left">';
                                   echo '<h5 class="c-orange">'.$ticket['name'].'</h5>';
                                   if($ticket['subtext']){
                                        echo '<span class="c-blue-mid" >'.$ticket['subtext'].'</span>';
                                   }
                                   if($ticket['tag']){
                                        echo '<span class="c-blue bg-blue-ultra-light pricing-tag" >'.$ticket['tag'].'</span>';
                                   }
                              echo '</div>';
                              echo '<div class="pricing-box-right">';
                              if($ticket['original_price']){
                                   echo '<p class="original-price">CHF '.$ticket['original_price'].'</p>';
                              }
                              echo '<p class="fm c-blue">CHF '.$ticket['price'].'</p>';
                              echo '</div>';
                         echo '</div>';
                    }
                    echo '</div>';
               }
          echo '</div>';
              
          if($button){
               echo '<div style="width:100%;display:flex;justify-content:center;"><a href="'.$button['url'].' target="'.$button['target'].'" style="margin-top:40px;"><button>'.$button['title'].'</button></a></div>';
          }
          ?>
     </div>
     
    
</div>

<script>

</script>