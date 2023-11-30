<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
     $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$title = get_field( 'title' ) ?: null;
$content = get_field( 'content' ) ?: null;
$speakers = get_field( 'speakers' ) ?: false;
?>

<div <?php echo $anchor; ?>class="speaker-teaser-wrapper" >
     <div class="speaker-teaser-container">
          <div class="speaker-teaser-grid">
               <div class="speaker-teaser-content">
                    <h3 class="c-orange fm"><?php echo $title; ?></h3>
                    <p class="c-blue"><?php echo $content; ?></p>
               </div>
               <?php 
               if( $speakers ) {
                    foreach ( $speakers as $key => $speaker ){
                         // Get speaker data
                         echo '<div class="speaker-teaser-speakerbox speakerbox-'.$key.'">';
                              echo '<img src="'.$speaker['image'].'" alt="'.$speaker['name'].'" />';
                              echo '<div class="speaker-teaser-info bg-blue">';
                                   echo '<h5>'.$speaker['name'].'</h5>';
                                   echo '<p>'.$speaker['function'].'</p>';
                              echo '</div>';
                         echo '</div>';
                    }
               }
               ?>
          </div>
     </div>
</div>