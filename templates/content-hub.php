<?php

/*
 *Template Name: Content Hub
 */
get_header();

$args = array(
     'post_type' => 'podcast', // the post type
     'posts_per_page' => '-1', 
     'order' => 'ASC',
);
$podcasts = new WP_Query( $args );

$args = array(
     'post_type' => 'video', // the post type
     'posts_per_page' => '-1', 
     'order' => 'ASC',
);
$videos = new WP_Query( $args );

echo '<div class="template-content-hub-wrapper">';

echo '<div class="template-content-hub-container">';
echo the_content();
echo '</div>';

echo '<div class="template-content-hub-section">';
     echo '<div class="template-content-hub-section-container">';
          echo '<div class="content-hub-filter-bar">';
               echo '<div class="template-content-hub-tab">';
                    echo '<button data-contenttype="video">Videos</button>';
                    echo '<button data-contenttype="podcast">Podcast</button>'; 
               echo '</div>';

               echo '<form id="search-form" onsubmit="return handleSearch(event);" >';
                    echo '<input type="search" name="search" id="search-input" onchange="handleSearch(event)"/>';
                    echo '<button type="submit" ><img src="'.get_template_directory_uri().'/assets/img/utils/search.svg" /></button>';
               echo '</form>';

          echo '</div>';
          
          if( is_array($videos->posts ) ) {
               $videoWidth = '350';
               $videoHeight = '198';
               
               echo '<div class="video-wrapper content-hub-tab-content" data-content="video" data-search="" data-page="1">';
               echo '<div class="video-container contenthub-container" data-content="video" >';
                    // Load via JS --> main.js
               echo '</div>';
               echo '</div>';
          }

          if( is_array($podcasts->posts ) ) {
               echo '<div class="podcasts-wrapper content-hub-tab-content" data-content="podcast">';
               echo '<div class="podcasts-container contenthub-container">';
                    // Load via JS --> main.js
               echo '</div>';
               echo '</div>';
          }

     echo '</div>';
echo '</div>';
  

echo '</div>';

echo '</div>';

get_footer();