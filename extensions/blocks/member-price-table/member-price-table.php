<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$hide = get_field('hide_block') ? 'none' : 'block';
$hide_on_mobile = get_field('hide_on_mobile') ? 'sud__hide_on_mobile' : '';

if(!function_exists('sud_render_price')){
     function sud_render_price(int $priceinput, string $currency){ 
          $pricing = number_format($priceinput, 2, '.', "'");
          $curr = $currency ?: 'CHF';
          $pricingOutput = $curr . ' ' . $pricing; 
          return $pricingOutput;
     }
}


// Load values and assign defaults.
$title = get_field( 'title' ) ?: '';
$content = get_field('content') ?: '';
$benefits = get_field('benefits') ?: null;
$price = get_field('price') ? sud_render_price(get_field('price'), get_field('currency')) : 'Free';
$signup_button = get_field('signup') ?: null;
$price_description = get_field('price_informations') ?: null;

?>

<div class="<?php echo $hide_on_mobile; ?>" style="display:<?php echo $hide; ?>;">

     <div <?php echo esc_attr($anchor); ?>class="member-price-table-wrapper" style="min-height:50px;">
          <div class="member-price-table-container">
               <h1 class="c-orange fm"><?php echo esc_html($title); ?></h1>
               <p class="c-blue"><?php echo wp_kses_data($content); ?></p>
               <?php if($benefits){
                    echo '<div class="member-price-table-benefits">';
                    foreach ($benefits as $key => $benefit) {
                         echo '<div class="member-benefit">';
                              echo '<img src="'.get_template_directory_uri().'/assets/img/utils/checkmark.svg" alt="sud-benefit-checkmark" />';
                              echo '<div>';
                                   echo '<p class="c-blue"><b>'.esc_html($benefit['head']).'</b></p>';
                                   echo '<p class="c-blue">'.esc_html($benefit['info']).'</p>';
                              echo '</div>';
                         echo '</div>';
                    }
                    echo '</div>';
               } ?>
               <div class="member-price-pricetag">
                    <h4 class="c-orange">PRICE</h4>
                    <div class="member-price-pricetag-price">  
                         <h4 class="c-orange"><?php echo esc_html($price); ?></h4>
                         <p><?php echo esc_html($price_description); ?></p>
                    </div> 
               </div>
               <?php if($signup_button){
                    echo '<div class="member-price-signup-button">';
                    echo '<a href="'. esc_url($signup_button['url']). '" target="'.esc_attr($signup_button['target']).'">';
                    echo '<button>'.esc_html($signup_button['title']).'</button>';
                    echo '</a>';
               } ?>
               </div>
          </div>
          <?php

          ?>
     </div>
</div>
