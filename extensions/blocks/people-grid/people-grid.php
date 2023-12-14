<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$hide = get_field('hide_block') ? 'none' : 'block';

// Load values and assign defaults.
$title = get_field( 'title' ) ?: null;

$sort = get_field( 'sort' ) ?: null;
$people = array();

if($sort && $sort != 'custom'){
     $group = get_field('group') ?: '';

     $args = array(
          'post_type' => 'people', // the post type
          'posts_per_page' => '-1',
          'meta_key' => 'surname',
          'orderby' => 'meta_value',
          'order' => $sort,
          'meta_query' => array(
               array(
                 'key' => 'groups_'.$group,
                 'value' => true,
                 'compare' => '==',
                 'type' => 'BOOLEAN'
               )
          ),
     );
     $the_query = new WP_Query( $args );
     $people = $the_query->posts;
    
} else {
     $people = get_field('people');
     
}
?>

<div style="display:<?php echo $hide; ?>;">
     <div <?php echo $anchor; ?>class="people-grid-wrapper" style="min-height:200px;"> 
          <?php
          if(is_array($people)){
               echo '<div class="people-grid-container">';
               echo '<h2 class="people-grid-title c-orange fl">'. $title .'</h2>';
               foreach ($people as $person) { 
                    $personID = ( is_int($person) ) ? $person : $person->ID;
                    echo '<div class="people-grid-box">';
                         echo '<div class="people-grid-image"><img src="'.get_field('portrait', $personID)['url'].'" alt="'.get_field('name', $personID).'-'.get_field('surname', $personID).'"/></div>';
                         echo '<h4 class="c-orange fxs">'.get_field('name', $personID).' '.get_field('surname', $personID).'</h4>';
                         echo '<p class="c-blue">';
                              if( get_field( 'settings' )['show_function'] && get_field( 'function', $personID ) ){
                                   echo get_field( 'function', $personID );
                              }
                              if( get_field( 'settings' )['show_function'] && get_field( 'function', $personID ) && get_field( 'settings' )['show_company'] && get_field( 'company', $personID ) ){ echo ', '; }
                              if( get_field( 'settings' )['show_company'] && get_field( 'company', $personID ) ){
                                   echo '<span>'.get_field( 'company', $personID ).'</span>';
                              }
                         echo '</p>';
                         if(get_field( 'settings' )['show_social_media']){
                              echo '<div class="people-grid-icons">';
                              if(get_field('contacts', $personID)['e-mail']){
                                   echo '<a href="mailto:'.get_field('contacts', $personID)['e-mail'].'" target="_blank"><img src="'.get_template_directory_uri().'/assets/img/utils/icon_mail.svg" /></a>';
                              }
                              
                              if(get_field('contacts', $personID)['channels']){
                                   foreach( get_field('contacts', $personID)['channels'] as $sm ){
                                        echo '<a href="'.$sm['url'].'" target="_blank">';
                                        echo '<img src="'.get_template_directory_uri().'/assets/img/utils/sm/'.$sm['icon'].'-blue.svg" alt="icon-'.$sm['icon'].'" target="_blank">';
                                        echo '</a>';
                                   }                   
                              }
                              echo '</div>';
                         }
                    echo '</div>';
               } 
               echo '</div>';
          } 
          ?>
     </div>
</div>
