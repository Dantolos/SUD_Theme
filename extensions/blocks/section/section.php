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
     case '2-1':
          $colstyle = [
               'left-width' => '61.8%',
               'right-width' => '38.2%'
          ];
          break;
     default:
          $colstyle = [
               'left-width' => '50%',
               'right-width' => '50%'
          ];
          break;
}
$leftComponents = get_field('components_left') ?: null;
$rightComponents = get_field('components_right') ?: null;


if (!function_exists('sud_cast_component')) {
     function sud_cast_component($component, $col) {
          $componentHTML = '';
          switch ($component['acf_fc_layout']) {
               case 'title':
                    $componentHTML .= '<div class="component-title">';
                    $componentHTML .= '<h3 class="c-blue-mid '.$component['font_size'].'" style="color: '.$component['font_color'].';">'.$component['title'].'</h3>';
                    $componentHTML .= '</div>';
                    break;
               case 'image':
                    $componentHTML .= '<figure class="component-image">';
                    $componentHTML .= '<img src="'.$component['image']['url'].'" alt="'.$component['image']['alt'].'">';
                    $componentHTML .= '</figure>';
                    break;
               case 'video':
                    $componentHTML .= '<div class="component-video">';
                    $componentHTML .= '<video poster="'.$component['thumbnail'].'" controls>';
                    $componentHTML .= '<source src="'.$component['videofiles']['webm'].'" type="video/webm">';
                    if($component['videofiles']['mp4']){ 
                         $componentHTML .= '<source src="'.$component['videofiles']['mp4'].'" type="video/mp4">';
                    }
                    $componentHTML .= '</video>';
                    $componentHTML .= '</div>';
                    break;
               case 'content':
                    $componentHTML .= '<div class="component-paragraph">';
                    $componentHTML .= $component['content'];
                    $componentHTML .= '</div>';
                    break;
               case 'button':
                    switch($component['type']){
                         case 'link':
                              $componentHTML .= '<a class="component-button" href="'.$component['buttonlink']['url'].'" target="'.$component['buttonlink']['target'].'">';
                                   $componentHTML .= '<div class="'.$component['button_type'].'">'; 
                                        $componentHTML .= $component['buttontext'];
                                   $componentHTML .= '</div>';
                              $componentHTML .= '</a>';
                              break;
                         case 'lb': 
                              $targeting = 'lb-target-'.rand(100, 999);
                              $componentHTML .= '<div class="component-button">';
                                   $componentHTML .= '<button class=" '.$component['button_type'].'" onclick="sudLightbox(\''.$targeting.'\')">'.$component['buttontext'].'</button>';
                                   //CONTENT
                                   $componentHTML .= '<div class="lightbox-wrapper" lbtarget="'.$targeting.'">'; 
                                        $componentHTML .= '<div class="lightbox-close-layer" lbcloser="'.$targeting.'" ><img src="'. get_template_directory_uri() .'/assets/img/utils/close-cross.svg" alt=""></div>';
                                        $componentHTML .= '<div class="lightbox-container" >'; 
                                             $componentHTML .= '<div class="lightbox-content">';
                                                  $componentHTML .= $component['lightbox_content'];
                                             $componentHTML .= '</div>';
                                             $componentHTML .= '<div class="lightbox-bg-element-01"></div>';
                                             $componentHTML .= '<div class="lightbox-bg-element-02"></div>';
                                        $componentHTML .= '</div>';
                                   $componentHTML .= '</div>';
                              $componentHTML .= '</div>';
                              break;
                    }
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
          <div class="sud-bg-element-half-circle-01 sud-element-animation" style="display:none; right:-35vw; top:-55vw; width:120vw; height:120vw; transform: rotate(180deg);"></div>
     </div>

     <div class="sud-element" sud-shape="semicircle" style=" bottom:-15%; right:-20%; width:100vw; height:100vw;"></div>
     
     <div class="section-container">
          <div class="section-col section-col-l" style="width:<?php echo $colstyle['left-width']; ?>; ">
               <?php
               if($leftComponents) {
                    foreach($leftComponents['components'] as $leftComponent){
                         echo sud_cast_component($leftComponent, 'L');
                    }
               }
               ?>
          </div>

          <div class="section-col section-col-r" style="width:<?php echo $colstyle['right-width']; ?>; ">
               <?php
               if($rightComponents) {
                    foreach($rightComponents['components'] as $rightComponent){
                         echo sud_cast_component($rightComponent, 'R');
                    }
               }
               ?>
          </div>
     </div>
     

</div>

