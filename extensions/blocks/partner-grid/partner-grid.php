<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$section_title = get_field( 'section_title' ) ?: '';
$call_to_action = get_field('call_to_action') ?: null;
$partner_categories = get_field( 'partner_categories' ) ?: null;

$partners = array();
foreach ($partner_categories as $key => $partner_category) {
     $args = array(
          'post_type' => 'partner', // the post type
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
     //var_dump($the_query);
}


// The query

?>

<div <?php echo $anchor; ?>class="partner-grid-wrapper" >
     <div class="partner-grid-container">
          <h3 class="c-orange"><?php echo $section_title; ?></h3>

          <?php
          foreach($partners as $key => $partnerCat){
               echo '<div class="partner-grid-partner-cat">';
               foreach($partnerCat as $key => $partner){
                    $partnerID = $partner->ID;
                    echo '<div class="partner-grid-box">';
                    echo '<a href="'.get_field('website', $partnerID).'" target="_blank">';
                    echo '<img src="'.get_field('logo', $partnerID)['url'].'" alt="Logo '.get_field('company_name', $partnerID).'"/>';
                    echo '</a>';
                    echo '</div>';
               }
               echo '</div>';
          }
          ?>

          <?php
          if($call_to_action){ 
               echo '<a href="'.$call_to_action['url'].'" target="'.$call_to_action['target'].'"><button>'.$call_to_action['title'].'</button></a>';
          }
          ?>
     </div>
</div>
