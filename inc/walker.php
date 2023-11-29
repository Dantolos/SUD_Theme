<?php
/*--WALKER CLASSES--*/

class Walker_Nav_Primary extends Walker_Nav_menu {

    function start_lvl( &$output, $depth = 0, $args = array() ){ // ul
        $indent = str_repeat('\t',$depth);
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"se2-sub-menu$submenu depth_$depth\">\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // li + span
        $indent = ($depth) ? str_repeat("\t",$depth) : '';

        $li_attributes = ''; //add custom attributes
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $classes[] = ($args->walker->has_children) ? 'se2-submenu' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'se2-current' : '';
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = ($depth == 0) ? 'se2-lvl-1-item' : '';
        if( $depth && $args->walker->has_children ){
            $classes[] = 'sub-submenu';
        }

        $class_names = join( ' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = 'class="' . esc_attr($class_names) . '" ';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="'.esc_attr( $id ).'"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = '';
        if(! empty( $item->url ) && $item->url != '#'){
            $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= ' target="_blank"';
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : ''; 
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
        } elseif ($args->walker->has_children) {
          foreach( wp_get_nav_menu_items( 'Hauptmenu' ) as $menu ){
               if( $menu->menu_item_parent == $item->ID ){
                    $attributes = ! empty( $menu->title ) ? ' title="redirect-to-' . esc_attr($menu->title) . '"' : '';
                    $attributes .= ! empty( $menu->target ) ? ' target="' . esc_attr($menu->target) . '"' : '';
                    $attributes .= ! empty( $menu->url ) ? ' href="' . esc_attr($menu->url) . '"' : '';
                    break;
               }
          }
        }
        $attributes .= ( $args->walker->has_children ) ? ' class="parent-menu-item"' : '';

        $item_output = $item->befor;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $item->link_befor . apply_filters( 'the_title', $item->title, $item->ID ) . $item->link_after;
        $item_output .= ( $depth == 0 && $args->walker->has_children ) ? ' <b class="caret"></b></a>' : '</a>';
        $item_output .= $item->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    } 

    /* TO CHANGE TAG CLOSIGNS
    function end_el(){ // closing li + span
    }

    function end_lvl(){ // closing ul
    }
    */
}


class Burger_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Start of submenu
        
        $output .= '<ul class="sub-menu">';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Single menu item
        $output .= '<li>';

        // Output the menu item link and text
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        // Close the menu item
        $output .= '</li>';
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        // End of submenu
        $output .= '</ul>';
    }
}


class Footer_Menu_Walker extends Walker_Nav_Menu {
     function start_lvl(&$output, $depth = 0, $args = null) {
         // Start of submenu
         
         $output .= '<ul class="sub-menu">';
     }
 
     function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
         // Single menu item
         $output .= '<li>';
 
         // Output the menu item link and text
         $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
     }
 
     function end_el(&$output, $item, $depth = 0, $args = null) {
         // Close the menu item
         $output .= '</li>';
     }
 
     function end_lvl(&$output, $depth = 0, $args = null) {
         // End of submenu
         $output .= '</ul>';
     }
 }