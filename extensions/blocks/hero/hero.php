<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$title = get_field( 'title' ) ?: 'Titel ';
$subtitle = get_field( 'subtitle' ) ?: 'Subtitle';
$image = get_field( 'image' ) ?: null;
$video = get_field( 'video' ) ?: null;
$callToAction = get_field( 'call_to_action' )['text'] ? get_field( 'call_to_action' ) : null;
$button = get_field( 'button' )['link'] ? get_field( 'button' ) : null;
?>

<div <?php echo $anchor; ?>class="hero-wrapper bg-lightgrey" style="min-height:200px;">
    <div class="hero-background">
        <!-- Hero image -->
        <?php if($video){
            echo '<video id="hero_video" autoplay muted loop>';
            echo '<source src="'.$video.'">';
            echo '</video>';
        } ?>
        <?php if($image ){
            echo '<img src="' . $image . '" alt="hero-image" />';
        } ?>
    </div>

    <!-- hero content-->    
    <div class="hero-bg-element ">
        <?php if($callToAction){
            echo '<div class="hero-cta" style="background-color:'.$callToAction['color'].';">';
            echo '<h5 style="color:'.$callToAction['textcolor'].'; text-align:center;">'.$callToAction['text'].'</h5>';
            echo '</div>';
        } ?>
    </div>

    <div class="hero-content-container">
        
        <h1 class="fl c-orange"><?php echo $title; ?></h1>
        <h3 class="fs c-blue gtalpina"><?php echo $subtitle; ?></h3>
        <?php if($button){ 
            //var_dump($button['link']);
            echo '<a href="' . $button['link']['url'] . '"><button class="">' . $button['buttontext'] . '</button></a>';
         } ?>
    </div>

    <!-- Call to Action-->   
    
</div>


