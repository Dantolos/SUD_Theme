<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
     $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$hide = get_field('hide_block') ? 'none' : 'block';

// Load values and assign defaults.
$title = get_field( 'title' ) ?: null;
$content = get_field( 'content' ) ?: null;
$speakers = get_field( 'speakers' ) ?: false;
?>

<div style="display:<?php echo $hide; ?>;">
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

               <?php if(get_field('button')) {
                    echo '<div class="speakerbutton-box">';
                    echo '<a href="'.get_field('button')['url'].'" target="'.get_field('button')['target'].'">';
                    echo '<button>'.get_field('button')['title'].'</button>';
                    echo '</a>';
                    echo '</div>';
               } ?>
          </div>
     </div>
</div>