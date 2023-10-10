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
                    echo '<a href="'.get_field('website', $partnerID).'" target="_blank" rel="external">';
                         echo '<div class="partner-logo-box">';
                         echo '<div class="partner-box-overlay"></div>';
                         echo '<div class="partner-link-arrow"><img src="'. get_template_directory_uri() .'/assets/img/utils/arrow-right.svg" alt="arrow-right"></div>';
                         echo '<img src="'.get_field('logo', $partnerID)['url'].'" alt="Logo '.get_field('company_name', $partnerID).'"/>';
                         echo '</div>';
                    echo '</a>';
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
?>