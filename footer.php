</div>

<div class="footer-wrapper">
     <div class="footer-container">
          <!-- Address Section -->
          <div class="footer-left">
               <h5 class="c-white"><?php echo get_field('address', 'option')['company_name'];?></h5>
               <p class="c-white"><?php echo get_field('address', 'option')['address']; ?></p>
               <a class="c-white" href="mailto:<?php echo get_field('address', 'option')['e-mail'];?>">E-Mail</a>
          </div>

          <!-- Newsletter Section -->
          <div class="footer-right">
               <?php
               wp_nav_menu(array(
                    'menu'              => "Footermenu", 
                    'menu_class'        => "footer-menu",
                    'container'         => "nav", 
                    'container_class'   => "se2-navigation footer-menu-content ", 
                    'walker' => new Footer_Menu_Walker(),
               ));
               ?>
          </div>



          <!-- Footer Bottom Line -->
          <div class="footer-bottom-line">

               <button type="button" onclick="sudLightbox('newsletter')" class="btn-s"><?php echo get_field('newsletter', 'option')['button_text'];?></button>
               <div class="lightbox-wrapper" lbtarget="newsletter">
                    
                    <div class="lightbox-close-layer" lbcloser="newsletter" ><img src="<?php echo get_template_directory_uri(); ?>/assets/img/utils/close-cross.svg" alt=""></div>
                    <div class="lightbox-container" >
                         
                         <div class="lightbox-content">
                              <h3 class="c-white"><?php echo get_field('newsletter', 'option')['lightbox_content']['title'];?></h3>
                              <p class="c-white"><?php echo get_field('newsletter', 'option')['lightbox_content']['text'];?></p>
                              <?php echo get_field('newsletter', 'option')['lightbox_content']['form'];?>
                         </div>
                         <div class="lightbox-bg-element-01"></div>
                         <div class="lightbox-bg-element-02"></div>
                    </div>
               </div>

               <?php
               if(get_field('channels', 'option')){
                    echo '<div class="footer-social-media">';
                    foreach( get_field('channels', 'option') as $sm ){
                         echo '<a href="'.$sm['url'].'" target="_blank">';
                         echo '<img src="'.get_template_directory_uri().'/assets/img/utils/sm/'.$sm['icon'].'-neg.svg" alt="icon-'.$sm['icon'].'">';
                         echo '</a>';
                    }
                    echo '</div>';
               }
               ?>
          </div>
     </div>
</div>

<?php
wp_footer();
?>
</body>
</html>