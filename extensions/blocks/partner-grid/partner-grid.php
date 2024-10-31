<?php

// Support custom "anchor" values.
$anchor = ''; 
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$hide = get_field('hide_block') ? 'none' : 'block';

// Load values and assign defaults.
$section_title = get_field( 'section_title' ) ?: '';
$section_desc = get_field( 'description' ) ?: '';
$call_to_action = get_field('call_to_action') ?: null;
$partner_categories = get_field( 'partner_categories' ) ?: null;
$style_type = get_field( 'styletype' ) ?: 'standard';

$partners = array();
foreach ($partner_categories as $key => $partner_category) {
     $args = array(
          'post_type' => 'partner', // the post type
          'posts_per_page' => '-1',
          'meta_key' => 'company_name',
          'orderby' => 'meta_value',
          'order' => 'ASC',
          'tax_query' => array(
              array(
                  'taxonomy' => 'partner-category', // the custom vocabulary
                  'field'    => 'term_id',          // term_id, slug or name  (Define by what you want to search the below term)    
                  'terms'    => $partner_categories[$key],      // provide the term slugs
              ),
          ),
     );
     $the_query = new WP_Query( $args );
     array_push($partners, $the_query->posts); 
}


if(!function_exists('render_partner_grid_standard')){ 
     function render_partner_grid_standard($title, $desc, $partners, $call_to_action ) {
          $standard_grid = '';
          $standard_grid .= '<div class="partner-grid-container">';
          $standard_grid .= '<h3 class="c-orange">'. $title .'</h3>';
          $standard_grid .= $desc ? '<p class="c-blue">'. $desc .'</p>' : '';
          foreach($partners as $key => $partnerCat){
               $standard_grid .= '<div class="partner-grid-partner-cat">';
               foreach($partnerCat as $key => $partner){
                    $partnerID = $partner->ID;
                    $standard_grid .= '<div class="partner-grid-box">';
                         $standard_grid .= '<a href="'.get_field('website', $partnerID).'" target="_blank">';
                         $standard_grid .= '<img src="'.get_field('logo', $partnerID)['url'].'" alt="Logo '.get_field('company_name', $partnerID).'"/>';
                         $standard_grid .= '</a>';
                    $standard_grid .= '</div>';
               }
               $standard_grid .= '</div>';
          }
          if($call_to_action){ 
               $standard_grid .= '<a href="'.$call_to_action['url'].'" target="'.$call_to_action['target'].'" style="margin-top:40px;"><button>'.$call_to_action['title'].'</button></a>';
          }
          $standard_grid .= '</div>';
     
          return $standard_grid; 
     }
}

if(!function_exists('render_partner_grid_name_only')){
     function render_partner_grid_name_only(string $title, string $desc, array $partners, $call_to_action) {
          $n_o_grid = '';
          $n_o_grid .= '<div class="partner-grid-container">'; 
          $n_o_grid .= '<h3 class="c-orange">'. $title .'</h3>';
          $n_o_grid .= $desc ? '<p class="c-blue">'. $desc .'</p>' : '';
          foreach($partners as $key => $partnerCat){
               $n_o_grid .= '<div class="partner-grid-partner-cat">';
                    foreach($partnerCat as $key => $partner){
                         $partnerID = $partner->ID;
                         $partnerlink = get_field('website', $partnerID) ?: false;
                         $n_o_grid .= '<div class="partner-grid-box-name_only">';
                         $n_o_grid .= $partnerlink ? '<a href="'.get_field('website', $partnerID).'" target="_blank">' : '';
                         $n_o_grid .= '<h6>'.get_field('company_name', $partnerID).'</h6>';
                         $n_o_grid .= $partnerlink ? '</a>' : '';
                         $n_o_grid .= '</div>';
                    }
               $n_o_grid .= '</div>';
          }
          if($call_to_action){ 
               $n_o_grid .= '<a href="'.$call_to_action['url'].'" target="'.$call_to_action['target'].'" style="margin-top:40px;"><button>'.$call_to_action['title'].'</button></a>';
          }
          $n_o_grid .= '</div>';
          return $n_o_grid;
     }
}
?>
<div style="display:<?php echo $hide; ?>;">
     <div <?php echo $anchor; ?>class="partner-grid-wrapper" >
          <?php 
          switch ($style_type) {
               case 'standard':
                    echo render_partner_grid_standard( $section_title, $section_desc, $partners, $call_to_action );
                    break;
               case 'nameonly':
                    echo render_partner_grid_name_only( $section_title, $section_desc, $partners, $call_to_action );
                    break; 
               default:
                    echo render_partner_grid_standard( $section_title, $section_desc, $partners, $call_to_action );
                    break;
          } 
          ?> 
     </div>
</div>

<?php 