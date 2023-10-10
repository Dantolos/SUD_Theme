<?php
/*
 *Template Name: Partner Template
 */
get_header();

$partnerCategories = get_field('partnercategories');

echo the_content();

echo '<div class="template-partner-wrapper">';
echo '<div class="template-partner-container">';

?>

<div class="sud-partner-container">
     <?php
     if(is_array( $partnerCategories )){
          foreach ($partnerCategories as &$category) {
               $termID = $category["partner_category"]->term_id;
               $termName = $category["partner_category"]->name;
               $importance = $category["importance"];
               $prioclass = 'partner-prio-'.$importance;
               
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
                            'terms'    => $termID,      // provide the term slugs
                        ),
                    ),
               );
               $partners = new WP_Query( $args );

               echo '<div class="partner-logo-grid '.$prioclass.' partner-grid-width-'.$category["width"].'">';
               echo '<h5>';
                    echo  $termName;
               echo '</h5>';
               foreach($partners->posts as $partner){
                    $partnerID = $partner->ID;
                    $hoverIcon ='arrow-right';
                    if ( !$category['lightbox'] ){
                         echo '<a href="'.get_field('website', $partnerID).'" target="_blank" rel="external">';
                         echo '<div class="partner-logo-box">';
                    } else {
                         $hoverIcon ='search';
                         $lb_targeting = 'partner-'.$partner->ID;
                         echo '<div class="partner-logo-box partner-logo-a-placer" onclick="sudLightbox(\''.$lb_targeting.'\')">';
                         echo cast_partner_lightbox( $partnerID, $lb_targeting );
                    }
                         
                         echo '<div class="partner-box-overlay"></div>';
                         echo '<div class="partner-link-arrow"><img src="'. get_template_directory_uri() .'/assets/img/utils/'.$hoverIcon.'.svg" alt="arrow-right" /></div>';
                         echo '<img src="'.get_field('logo', $partnerID)['url'].'" alt="Logo '.get_field('company_name', $partnerID).'"/>';
                          
                    if ( !$category['lightbox'] ){
                         echo '</div>';
                         echo '</a>';
                    } else {
                         echo '</div>';
                    }
               }

               echo '</div>';

          }
     }
     ?>
</div>

<?php
echo '</div>';
echo '</div>';

get_footer();

function cast_partner_lightbox($partnerID, $target) {
     $partnerLightbox = '';
     $partnerLightbox .= '<div class="lightbox-wrapper partner-lightbox" lbtarget="'.$target.'">';
                    
          $partnerLightbox .= '<div class="lightbox-close-layer" lbcloser="'.$target.'" ><img src="'. get_template_directory_uri() .'/assets/img/utils/close-cross.svg" alt=""></div>';
          $partnerLightbox .= '<div class="lightbox-container" >'; 
               $partnerLightbox .= '<div class="lightbox-content">';
                    $partnerLightbox .= '<h3 class="c-white">'.get_field('company_name', $partnerID).'</h3>';
                    $partnerLightbox .= '<p class="c-white">'.get_field('description', $partnerID).'</p>';
                    if(get_field('quote_text', $partnerID)){
                         $partnerLightbox .= '<blockquote class="c-white">'.get_field('quote_text', $partnerID).'<br /><span>'.get_field('autor', $partnerID).'</span></blockquote>';
                    }
                    $partnerLightbox .= '<a class="partner-website-btn" href="'.get_field('website', $partnerID).'" target="_blank" rel="external"><div class="btn-secondary btn-neg">Website</div></a>';
               $partnerLightbox .= '</div>'; 

               $partnerLightbox .= '<div class="lightbox-bg-element-01"></div>';
               $partnerLightbox .= '<div class="lightbox-bg-element-02"></div>';
          $partnerLightbox .= '</div>';
     $partnerLightbox .= '</div>';

     return $partnerLightbox;
}
?>