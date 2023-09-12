<?php

/*
 *Template Name: Default Template
 */
get_header();

echo '<div class="template-default-wrapper">';
echo '<div class="template-default-container">';
echo the_content();
echo '</div>';
echo '</div>';

get_footer();