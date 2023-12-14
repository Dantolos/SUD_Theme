<?php

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$hide = get_field('hide_block') ? 'none' : 'block';

// Load values and assign defaults.
$videos = get_field( 'videos' ) ?: null; 
?>

<div style="display:<?php echo $hide; ?>;">
    <div <?php echo $anchor; ?>class="sud-main-wrapper" style="min-height:200px;">
        <div class="sud-main-container">
            
        </div> 
    </div>
</div>
