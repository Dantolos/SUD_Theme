<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$columns = get_field( 'columns' ) ?: '2-1';
$colstyle = [
     'left-width' => '61.8%',
     'right-width' => '38.2%'
];
switch ($columns) {
     case '1-2':
          $colstyle = [
               'left-width' => '38.2%',
               'right-width' => '61.8%'
          ];
          break;
     case '1-1':
          $colstyle = [
               'left-width' => '50%',
               'right-width' => '50%'
          ];
          break;
     default:
          # code...
          break;
}
$leftComponents = get_field('components_left') ?: null;
$rightComponents = get_field('components_right') ?: null;
 
if (!function_exists('sud_cast_component')) {
     function sud_cast_component($component, $col) {
          $componentHTML = '';
          switch ($component['acf_fc_layout']) {
               case 'big_title':
                    $componentHTML .= '<div class="component-title">';
                    $componentHTML .= '<h3 class="c-blue-mid">'.$component['title'].'</h3>';
                    $componentHTML .= '</div>';
                    break;
               case 'image':
                    $componentHTML .= '<div class="component-image">';
                    $componentHTML .= '<img src="'.$component['image']['url'].'" alt="'.$component['image']['alt'].'">';
                    $componentHTML .= '</div>';
                    break;
               case 'video':
                    $componentHTML .= '<div class="component-video">';
                    $componentHTML .= '<video poster="'.$component['video']['thumbnail'].'" controls>';
                    $componentHTML .= '<source src="'.$component['video']['webm'].'">';
                    $componentHTML .= '</video>';
                    $componentHTML .= '</div>';
                    break;
               case 'subtitle':
                    $componentHTML .= '<div class="component-subtitle">';
                    $componentHTML .= '<h5 class="c-orange">'.$component['subtitle'].'</h5>';
                    $componentHTML .= '</div>';
                    break;
               case 'paragraph':
                    $componentHTML .= '<div class="component-paragraph">';
                    $componentHTML .= '<p class="c-blue">'.$component['paragraph'].'</p>';
                    $componentHTML .= '</div>';
                    break;
               
               default:
                    # code...
                    break;
          }

          return $componentHTML;
     }
}
?>

<div <?php echo $anchor; ?>class="section-wrapper reveal" style="min-height:200px;">
     <!--Design Elements-->
     <div class="sud-bg-design">
          <div class="sud-bg-element-half-circle-01 sud-element-animation" style="right:-35vw; top:-55vw; width:120vw; height:120vw; transform: rotate(180deg);"></div>
     </div>

     <div class="sud-element" sud-shape="semicircle"></div>
     <div class="sud-element" sud-shape="polycon-01"></div>

     <div class="section-container">
          <div class="section-col section-col-l" style="width:<?php echo $colstyle['left-width']; ?>; ">
               <?php
               if($leftComponents) {
                    foreach($leftComponents as $leftComponent){
                         echo sud_cast_component($leftComponent, 'L');
                    }
               }
               ?>
          </div>

          <div class="section-col section-col-r" style="width:<?php echo $colstyle['right-width']; ?>; ">
               <?php
               if($rightComponents) {
                    foreach($rightComponents as $rightComponent){
                         echo sud_cast_component($rightComponent, 'R');
                    }
               }
               ?>
          </div>
     </div>
     

</div>

