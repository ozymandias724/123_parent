<?php 
/* 
*
* Food Menu item
*
*/
    $return['content'] = '';

    // Food Menus format guides
    $guide['menu_photo_tiled_x3'] = '';

    $guide['menu_text_half'] = '';

    $guide['menu_photo_list'] = '';

    $guide['menu_text_list_left'] = '';

    $guide['menu_text_list_center'] = '';

    $guide['menu_text_sub_group_half'] = '';

    $the_fields = get_fields( $post->ID );

    if( $the_fields['style'] == 'menu_photo_tiled_x3'){

    }else if( $the_fields['style'] == 'menu_text_half' ){
        
    }else if( $the_fields['style'] == 'menu_photo_list' ){

    }else if( $the_fields['style'] == 'menu_text_list_left' ){

    }else if( $the_fields['style'] == 'menu_text_list_center' ){

    }else if( $the_fields['style'] == 'menu_text_sub_group_half' ){

    }

?>
<div class="grid_food_menu grid_item">
<?php 
    echo $return['content'] = '';
?>
</div>