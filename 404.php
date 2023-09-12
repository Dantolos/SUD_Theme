<?php
get_header();

echo '<div class="sud-404-wrapper">';
     echo '<div class="sud-404-container">';  
          echo '<h3>oops</h3>';
          echo '<h5 class="c-blue">Page not found</h5>';
          echo '<a href="'.esc_url( get_home_url() ).'"><button>Back to Home</button></a>';
     echo '</div>';
echo '</div>';

get_footer();