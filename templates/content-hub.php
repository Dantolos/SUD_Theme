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
          
          if( is_array($videos->posts ) ) {
               echo '<h2>Videos</h2>';

               echo '<div class="video-container">';
               foreach ($videos->posts as $key => $video) {
                    $videoID = $video->ID;
                    $videoLink = get_field('link', $videoID);
                    echo '<div class="video-item">';
                    echo $videoLink;
                    echo '</div>';
               }
               echo '</div>';
          }

          if( is_array($podcasts->posts ) ) {

               echo '<h2>Podcasts</h2>';

               foreach ($podcasts->posts as $key => $podcast) {
                    $podcastID = $podcast->ID;

                    //Create Spotify Embed Link out the inputted share link
                    $podcastLink = get_field('spotity_link', $podcastID);
                    $parsedPodcastLink = parse_url(str_replace('episode', 'embed/episode', $podcastLink));
                    $podcastEmbedLink =  $parsedPodcastLink['scheme'].'://'.$parsedPodcastLink['host'].$parsedPodcastLink['path'].'?utm_source=generator&theme=0';

                    echo '<div class="podcast-item">';
                         echo '<p class="fxs">'.$podcast->post_date.'</p>';     
                         echo '<h3 class="fxs">'.$podcast->post_title.'</h3>';
                         echo '<div class="podcast-links">';
                              echo '<iframe style="border-radius:12px" src="'.$podcastEmbedLink.'" width="70%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy">';
                              echo '</iframe>';

                              echo '<a href="'.get_field('apple_podcast_link', $podcastID).'" target="_blank">';
                              echo '<div class="podcast-button apple-podcast-button bg-blue">';
                              echo '<img src="'.get_template_directory_uri().'/assets/img/utils/sm/apple-neg.svg" alt="apple podcast"/>';
                              echo '</div>';
                              echo '</a>';

                              echo '<a href="'.get_field('swisspreneur_link', $podcastID).'" target="_blank">';
                              echo '<div class="podcast-button swisspreneur-podcast-button bg-blue">';
                              echo '<img src="'.get_template_directory_uri().'/assets/img/utils/sm/swisspreneur-neg.svg" alt="swisspreneur podcast"/>';
                              echo '</div>';
                              echo '</a>';
                         echo '</div>';
                       
                    echo '</div>';
               }
          }

     echo '</div>';
echo '</div>';
  

echo '</div>';

echo '</div>';

get_footer();