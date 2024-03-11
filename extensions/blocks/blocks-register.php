<?php

add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/hero' );
    register_block_type( __DIR__ . '/counter' );
    register_block_type( __DIR__ . '/flipcards' );
    register_block_type( __DIR__ . '/testimonials' );
    register_block_type( __DIR__ . '/pricing' );
    register_block_type( __DIR__ . '/photo-slider' );
    register_block_type( __DIR__ . '/partner-grid' );
    register_block_type( __DIR__ . '/section' );
    register_block_type( __DIR__ . '/people-grid' );
    register_block_type( __DIR__ . '/accordion' );
    register_block_type( __DIR__ . '/box-link' );
    register_block_type( __DIR__ . '/speaker-teaser' );
    register_block_type( __DIR__ . '/container' );
    register_block_type( __DIR__ . '/video-gallery' );
    register_block_type( __DIR__ . '/timeline' );
    register_block_type( __DIR__ . '/flashback-teaser' );
    register_block_type( __DIR__ . '/hub-teaser' );
    register_block_type( __DIR__ . '/infocards' );
    //require_once( __DIR__ . '/hero/hero-block.acf.php' );
}

function prefix_block_styles() {
     $theme_version = wp_get_theme()->get( 'Version' );
     wp_enqueue_style( 'sud-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version, 'all');
     wp_enqueue_style( 'prefix-editor-styles', get_template_directory_uri() . '/extensions/blocks/editor-style.css' );

     $prefix_heading_font = get_theme_mod( 'heading_font', 'Media Sans' );

     $prefix_body_font = get_theme_mod( 'body_font', 
     'GT Alpina' );

     //wp_enqueue_style( 'prefix-editor-font', '//fonts.googleapis.com/css?family=' . $prefix_heading_font . ':400,700|' . $prefix_body_font . ':400,700&display=swap');

     $prefix_custom_css = '
     .edit-post-visual-editor.editor-styles-wrapper { font-family:' . 
     esc_html( $prefix_body_font ) . ' }

     .editor-post-title__block .editor-post-title__input,
     .editor-styles-wrapper h1,
     .editor-styles-wrapper h2,
     .editor-styles-wrapper h3,
     .editor-styles-wrapper h4,
     .editor-styles-wrapper h5,
     .editor-styles-wrapper h6 { font-family:' .
          esc_html( $prefix_heading_font ) . ' } 

     .editor-styles-wrapper p { font-family:' .
          esc_html( $prefix_body_font ) . ' } 
     ';

    

     wp_add_inline_style( 'prefix-editor-styles', $prefix_custom_css );
}
add_action( 'enqueue_block_editor_assets', 'prefix_block_styles' );