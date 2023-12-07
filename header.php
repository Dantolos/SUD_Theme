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

     <a href="<?php echo esc_url( get_home_url() ); ?>" style="max-width: 30%;">
          <div class="header-logo"><img src="<?php echo get_field('logo', 'option');?>" alt="startup days logo" /></div>
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
                              echo '<a href="'.$metamenuItem["link"].'" >';
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
          <?php 
          $menuArgs = array(
               'menu'              => "Hauptmenu", 
               'menu_class'        => "desktop-menu",
               'container'         => "nav", 
               'container_class'   => "se2-navigation desktop-menu-content ", 
               'walker'            => new Walker_Nav_Primary()
          );
          if($menuArgs){
               wp_nav_menu( $menuArgs );
          }

          if(get_field('header_cta', 'option')){
               echo '<a class="header-cta-desktop" href="'.get_field('cta_button', 'option')['url'].'" target="'.get_field('cta_button', 'option')['target'].'"><div class="header-cta btn-secondary btn-s">'.get_field('cta_button', 'option')['title'].'</div></a>';
          }
          echo '<div class="burger-menu-trigger"><img src="'.get_template_directory_uri().'/assets/img/utils/burger-menu.svg" alt="Burger Menu" /></div>';
          
          echo '<div class="burger-menu-wrapper">';
               echo '<div class="burger-menu-closer"><img src="'.get_template_directory_uri().'/assets/img/utils/close-cross-white.svg" alt="Close Icon" /></div>';
               echo '<div class="burger-menu-sud-icon"><img src="'.get_template_directory_uri().'/assets/img/sud_icon-white.svg" alt="Close Icon" /></div>';

               wp_nav_menu(array(
                    'menu'              => "Hauptmenu", 
                    'menu_class'        => "burger-menu",
                    'container'         => "nav", 
                    'container_class'   => "se2-navigation menu-burger-content ", 
                    'walker' => new Burger_Menu_Walker(),
               ));

               if(get_field('header_cta', 'option')){
                    echo '<div class="header-cta-wrapper">';
                    echo '<a class="header-cta" href="'.get_field('cta_button', 'option')['url'].'" target="'.get_field('cta_button', 'option')['target'].'"><div class="header-cta btn-secondary btn-s btn-neg">'.get_field('cta_button', 'option')['title'].'</div></a>';
                    echo '</div>';
               }
          echo '</div>';
          ?>
     </div>
</div>


<div id="main-wrapper">
