<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$hide = get_field('hide_block') ? 'none' : 'block';
 
$type = get_field('type') ?: 'type1';

$data['title'] = get_field( 'title' ) ?: 'Titel ';
$data['subtitle'] = get_field( 'subtitle' ) ?: 'Subtitle';
$data['text'] = get_field( 'text' ) ?: '';
$data['image'] = get_field( 'image' ) ?: null;
$data['video'] = get_field( 'video' ) ?: null;

$data['callToAction'] = get_field( 'call_to_action' ) && get_field( 'call_to_action' )['text'] ? get_field( 'call_to_action' ) : null;
$data['button'] = get_field( 'button' )['link'] ? get_field( 'button' ) : null;

//------------------------------------------------------
//---------------------- TYPE 1 ------------------------
//------------------------------------------------------
if (!function_exists('cast_hero_type_1')) {
    function cast_hero_type_1($data){
        $hero_type_1 = '';

        //Background
        $hero_type_1 .= '<div class="hero-background">';
        if($data['video']['videofiles']['webm']){
            $hero_type_1 .= '<video id="hero_video" poster="'.$data['video']['thumbnail'].'" autoplay muted loop>';
            $hero_type_1 .= '<source src="'.$data['video']['videofiles']['webm'].'" type="video/webm">';
                if($data['video']['videofiles']['mp4']){
                    $hero_type_1 .= '<source src="'.$data['video']['videofiles']['mp4'].'" type="video/mp4">';
                }
            $hero_type_1 .= '</video>';
        } 
        if( $data['image'] ){
            $hero_type_1 .= '<img src="' . $data['image'] . '" alt="hero-image" />';
        } 
        $hero_type_1 .= '</div>';
    
        //Call to Action
        $hero_type_1 .= '<div class="hero-bg-element ">';
        if($data['callToAction']){
            $hero_type_1 .= '<div class="hero-cta" style="background-color:'.$data['callToAction']['color'].';">';
            $hero_type_1 .= '<h5 style="color:'.$data['callToAction']['textcolor'].'; text-align:center;">'.$data['callToAction']['text'].'</h5>';
            $hero_type_1 .= '</div>';
        } 
        $hero_type_1 .= '</div>';

        //Content
        $hero_type_1 .= '<div class="hero-content-container">';
        $hero_type_1 .= '<h1 class="fl c-orange">'. $data['title'] .'</h1>';
        $hero_type_1 .= '<h3 class="fs c-blue gtalpina">'. $data['subtitle'] .'</h3>';
        if($data['button']){ 
            $hero_type_1 .= '<a href="' . $data['button']['link']['url'] . '"><button class="">' . $data['button']['buttontext'] . '</button></a>';
        } 
        $hero_type_1 .= '</div>';

        return $hero_type_1;
    }
}

//------------------------------------------------------
//---------------------- TYPE 2 ------------------------
//------------------------------------------------------
if (!function_exists('cast_hero_type_2')) {
    function cast_hero_type_2($data){
        $hero_type_2 = '';
        $hero_type_2 .= '<div class="hero-t2-container">';
             
            $hero_type_2 .= '<div class="hero-col hero-col-left">';
                // ELEMENT
                $hero_type_2 .= '<div class="hero-t2-bg-element bg-blue-ultra-light"></div>';
                 
                $hero_type_2 .= '<figure class="hero-t2-media" >';
                    /* image */
                    if ($data['image'] && !$data['video']['videofiles']['webm']) {
                        $hero_type_2 .= '<img src="'. $data['image']. '" alt="hero-image-'.$data['title'].'">';
                    }
                    /* Video */
                    if($data['video']['videofiles']['webm']){
                        $hero_type_2 .= '<video id="hero_video" poster="'.$data['video']['thumbnail'].'" autoplay muted loop>';
                        $hero_type_2 .= '<source src="'.$data['video']['videofiles']['webm'].'" type="video/webm"/>';
                            if($data['video']['videofiles']['mp4']){
                                $hero_type_2 .= '<source src="'.$data['video']['videofiles']['mp4'].'" type="video/mp4"/>';
                            }
                        $hero_type_2 .= '</video>';
                    } 
                $hero_type_2 .= '</figure>';
            $hero_type_2 .= '</div>';

            $hero_type_2 .= '<div class="hero-col hero-col-right">';
                $hero_type_2 .= '<h2 class="c-orange fl">'.$data['title'].'</h2>';
                $hero_type_2 .= '<p class="c-blue">'.$data['text'].'</p>';
            $hero_type_2 .= '</div>';
        $hero_type_2 .= '</div>';

        return $hero_type_2;
    }
}


//-------------------------------------------
//-----------------OUTPUT--------------------
//-------------------------------------------
echo '<div style="display: '.$hide.';">';
switch ($type) {
    case 'type1':
        echo '<div ' .$anchor. ' class="hero-wrapper" style="min-height:200px;">';
        echo cast_hero_type_1($data);
        echo '</div>';
        break;
    case 'type2':
        echo '<div ' .$anchor. ' class="hero-wrapper hero-wrapper-t2" style="min-height:200px;">';
        echo cast_hero_type_2($data);
        echo '</div>';
        break;
    default:
        echo '<div ' .$anchor. ' class="hero-wrapper" style="min-height:200px;">';
        echo cast_hero_type_1($data);
        echo '</div>';
        break;
}
echo '</div>';
?>
