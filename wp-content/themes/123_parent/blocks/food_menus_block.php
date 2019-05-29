<?php 

    $guide = []; 
    $return = [];

    // Functions
    // 
    // there is no need for this... just looking at it, theres no way this is needed.
    function _get_menu_header_format($menu_style){
        $return = '';
        if(
            $menu_style == 'menu_text_list_center' || 
            $menu_style == 'menu_text_list_left' ||
            $menu_style == 'menu_photo_tiled_x3' || 
            $menu_style == 'menu_photo_list'
        )
        {
            $return = '
                <h2>%s</h2>
                %s
            ';
        }
        else 
        {
            $return = '
                <h2><span>%s</span></h2>
                %s 
            ';
        }
        return $return;
    }  

    // this makes a lot of sense and i want to keep this
    // you dont need to start with an _ for your functions, please stop
    function _get_menu_items($menu_style, $item){

        $return = '';

        switch($menu_style)
        {
            case 'menu_photo_list':
            $format = '
                <li class="menu_item site__fade site__fade-up">
                    <div style="background-image:url(%s);"></div>
                    <div>
                        <h3>%s</h3>
                        <p class="menu_price">%s</p>
                        %s
                    </div>
                </li>
            ';

            $return = sprintf(
                $format
                ,(!empty($item['image']) ? $item['image']['url'] : '')
                ,(!empty($item['title']) ? $item['title'] : '')
                ,(!empty($item['price']) ? $item['price'] : '')
                ,(!empty($item['description']) ? $item['description'] : '')
            );
            break;

            case 'menu_photo_tiled_x3':
            $format = '
                <li class="menu_item site__fade site__fade-up">
                    <div style="background-image:url(%s);"></div>
                    <h3>%s <div class="menu_price">%s.<span class="price_decimal">%s</span></div></h3>
                    %s
                </li>
            ';

            $price = (!empty($item['price'])) ? explode('.',$item['price']) : '';
            $return = sprintf(
                $format
                ,(!empty($item['image']) ? $item['image']['url'] : '')
                ,(!empty($item['title']) ? $item['title'] : '')
                ,$price[0]
                ,$price[1]
                ,(!empty($item['description']) ? $item['description'] : '')
            );
            break;

            default: 
            $format = '
                <li class="menu_item site__fade site__fade-up">
                    <div style="background-image:url(%s);"></div>
                    <h3>%s <span class="menu_price">%s</span></h3>
                    %s
                </li>
            ';
            
            $return = sprintf(
                $format
                ,(!empty($item['image']) ? $item['image']['url'] : '')
                ,(!empty($item['title']) ? $item['title'] : '')
                ,(!empty($item['price']) ? $item['price'] : '')
                ,(!empty($item['description']) ? $item['description'] : '')
            );
            break;
        }

        return $return;
    }

    // If there are menu posts added to the Food Menus block
    if( !empty($cB['menus']) ){


        // guide for a button (pill etc)
        $guide['buttons'] = '
            <li>
                <a href="javascript:;">%s</a>
            </li>
        ';

        // open buttons and menus container
        $return['buttons_and_menus'] = '<div id="tabs_style__pills" class="tabs">';            
        
        // open buttons wrapper (sibling of content area)
        $return['buttons'] = '<ul class="button_group">';
        
        // open wrapper for the menus area (sibling of buttons)
        $return['menus'] = '<div class="menu_area">';

        // for each menu
        foreach( $cB['menus'] as $i => $menu ){

            // get fields for this menu post object
            $fields = get_fields($menu['menu_post']->ID);
            
            // write to the button group
            $return['buttons'] .= sprintf(
                $guide['buttons']
                ,$menu['menu_post']->post_title
            );

            // if this menu post has menu sections
            if( !empty($fields['menu_sections']) ){

                // open the wrapper for the menu sections
                $return['menu_sections'] = '<ul class="menu_section '.$fields['style'].'">';

                // loop thru each menu section (rows in the repeater)
                foreach( $fields['menu_sections'] as $i => $section ){

                    // Menu Title and Description
                    $return['menu_sections'] .= sprintf(
                        _get_menu_header_format($fields['style'])   // REVIEW: there is no need for this. see declaration.
                        ,(!empty($section['title']) ? $section['title'] : '')
                        ,(!empty($section['description']) ? $section['description'] : '')
                    );

                    // Open Menu Items Content
                    $return['menu_sections'] .= '<ul>';

                    foreach( $section['item'] as $i => $item){
                        $return['menu_sections'] .=  _get_menu_items($fields['style'], $item);
                    }

                    // Close Menu Items Content
                    $return['menu_sections'] .= '</ul>';
                }

                // close the menu sections wrapper
                $return['menu_sections'] .= '</ul>';

                // write this menu into the menus wrapper
                $return['menus'] .= $return['menu_sections'];
            }
        }

        // close buttons
        $return['buttons'] .= '</ul>';

        // close content
        $return['menus'] .= '</div>';
        
        // close buttons and menus container
        $return['buttons_and_menus'] .= $return['buttons'] . $return['menus'];
        
        $return['buttons_and_menus'] .= '</div>';
    }

    $guide['section'] = '
        <section id="block__food_menus" class="site__block">
            <div class="container %s" style="background-color: %s; color: %s;">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(

        $guide['section']
        ,$cB['width']
        ,$cB['background_color']
        ,$cB['foreground_color']
        ,( !empty($cB['heading']) ? '<h2 style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<p>'.$cB['text'].'</p>' : '' )

        // Return the food menus block content which is the buttons and menus
        ,( !empty($return['buttons_and_menus']) ? $return['buttons_and_menus'] : '' )

        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    echo $return['section'];
     
    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
?>