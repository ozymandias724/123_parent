<?php 
/* 
*
* Food Menu item
*
*/
    $the_fields = get_fields( $post->ID );

    $return['content'] = '';

    // Food Menus format guides
    $guide['menu_text_half'] = '';
    
    $guide['menu_photo_list'] = '';
    
    $guide['menu_text_list_left'] = '';

    $guide['menu_photo_tiled_x3'] = '';

    $guide['menu_text_list_center'] = '';

    $guide['menu_text_sub_group_half'] = '';


    if( !empty( $the_fields['menu_sections'] ) ){

        // $return['content'] = '<div id="tabs_style_" class="tabs">';

        // $return['content'] .= '<ul class="button_group">';

        // $return['content'] .= '<div class="menu_area tabs_style_">';

        $return['menu_sections'] = '<ul class="menu_section">';
            
        foreach( $the_fields['menu_sections'] as $i => $section ){

            if( $the_fields['style'] !== 'menu_text_sub_group_half' ){

                $return['header_format'] = '<h2><span>%s</span></h2>%s';
            }else{

                $return['header_format'] = '<div><h2><span>%s</span></h2>%s';
            }

            $return['menu_sections'] .= sprintf(
                $return['header_format'] 
                ,( !empty( $section['title'] )? $section['title'] : '')
                ,( !empty( $section['description'] )? $section['description'] : '')
            );

            $return['menu_sections'] .= '<ul class="menu_items">';

            foreach( $section['item'] as $i => $item ){

                $return['menu_sections'] .= get_menu_items( $the_fields['style'], $item );
            }

            if( $the_fields['style'] !== 'menu_text_sub_group_half' ){
                
                $return['menu_sections'] .= '</ul>';
            }else{
                
                $return['menu_sections'] .= '</ul></div>';
            }
        }

        $return['menu_sections'] .= '</ul>';

        $return['content'] .= $return['menu_sections'];
    }

?> 
<div class="grid_food_menu grid_item">
<?php 
    echo $return['content'];
?>
</div>