<!DOCTYPE html>
<html lang="en">
<head>     

     <!-- Favicon Settings -->
     <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-touch-icon.png">
     <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-32x32.png">
     <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-16x16.png">
     <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/site.webmanifest">
     <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
     <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon.ico">
     <meta name="msapplication-TileColor" content="#ffffff">
     <meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/browserconfig.xml">
     <meta name="theme-color" content="#ffffff">

     <meta charset="<?php bloginfo( 'charset' ); ?>">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php bloginfo('name'); ?></title>

     <?php
     wp_head();
     ?>
</head>
<body>

<!-- Header -->
<div class="header-wrapper">

     <a href="<?php echo esc_url( get_home_url() ); ?>">
          <div class="header-logo"><img src="<?php echo get_field('logo', 'option');?>" alt=""></div>
     </a>
     

     <div class="header-meta-menu">
          <?php
          if( get_field('meta_menu', 'option') ){
               echo '<ul>';
               foreach(get_field('meta_menu', 'option') as $metamenuItem){
                    switch ($metamenuItem["acf_fc_layout"]) {
                         case 'external_link':
                              echo '<li>';
                              echo '<a href="'.$metamenuItem["link"].'" target="_blank">';
                              echo $metamenuItem['label'];
                              echo '</a>';
                              echo '</li>';
                              break;
                         default:
                              echo '<li>';
                              echo '<a href="'.$metamenuItem["link"].'" target="">';
                              echo $metamenuItem['label'];
                              echo '</a>';
                              echo '</li>';
                              break;
                    }
                  
               }
               echo '</ul>';
          }
          ?>
     </div>

     <div class="header-menu">
          <ul>
               <li>Home</li>
              
          </ul>
     </div>
</div>


<div id="main-wrapper">
