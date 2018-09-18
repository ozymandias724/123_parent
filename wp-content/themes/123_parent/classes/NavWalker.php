<?php

	class NavWalker extends Walker_Nav_Menu {

	    var $number = 1;

	    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

	        $class_names = $value = '';

	        $classes[] = 'nav-menu-item';

	        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
	        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

	        $output .= $indent . '<li' . $value . $class_names .'>';

	        

	        $atts = array();
	        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
	        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
	        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
	        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

	        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

	        $attributes = '';
	        foreach ( $atts as $attr => $value ) {
	            if ( ! empty( $value ) ) {
	                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
	                $attributes .= ' ' . $attr . '="' . $value . '"';
	            }
	        }

	        $item_output = $args->before;
	        $item_output .= '<a class="nav-menu-item-link"'. $attributes .'>';
	        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
	        $item_output .= '</a>';
	        $item_output .= $args->after;

	        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	    }
	}
?>