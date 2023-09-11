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
          <div class="footer-mid">
               <button type="button" onclick="sudLightbox('newsletter')"><?php echo get_field('newsletter', 'option')['button_text'];?></button>
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
          </div>

          <!-- Footer Menu Section -->
          <div class="footer-right">
               <?php
               if(get_field('footer_menu', 'option')){
                    echo '<ul>';
                    foreach( get_field('footer_menu', 'option')[0]['navigation'] as $navitem ){
                         echo '<li>';
                         echo '<a href="'.$navitem['page'].'" class="c-white fxs">'.$navitem['label'].'</a>';
                         echo '</li>';
                    }
                    echo '</ul>';
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