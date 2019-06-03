<?php 

    $guide = []; 
    $return = [];

    // Functions 
    function get_menu_items($menu_style, $item){

        switch($menu_style)
        {
            case 'menu_photo_list': 
            $format = '
                <li class="menu_item site__fade site__fade-up">
                    %s
                    <div>
                        <h3>%s</h3>
                        %s
                        <p class="menu_price">%s</p>
                    </div>
                </li>
            ';

            $return = sprintf(
                $format
                ,(!empty($item['image']) ? '<div class="image_provided block" style="background-image:url('.$item['image']['url'].');"></div>' : '')
                ,(!empty($item['title']) ? $item['title'] : '')
                ,(!empty($item['description']) ? $item['description'] : '')
                ,(!empty($item['price']) ? $item['price'] : '')
            );
            break;

            case 'menu_photo_tiled_x3':
            $format = '
                <li class="menu_item site__fade site__fade-up">
                    %s
                    <h3>%s <span class="menu_price">%s</span></h3>
                    %s
                </li>
            ';

            $return = sprintf(
                $format
                ,(!empty($item['image']) ? '<div class="image_provided block" style="background-image:url('.$item['image']['url'].');"></div>' : '')
                ,(!empty($item['title']) ? $item['title'] : '')
                ,(!empty($item['price']) ? $item['price'] : '')
                ,(!empty($item['description']) ? $item['description'] : '')
            );
            break;

            default: 
            $format = '
                <li class="menu_item site__fade site__fade-up">
                    %s
                    <h3>%s <span class="menu_price">%s</span></h3>
                    %s
                </li>
            ';
            
            $return = sprintf(
                $format
                ,(!empty($item['image']) ? '<div class="image_provided block" style="background-image:url('.$item['image']['url'].');"></div>' : '')
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
        $return['buttons_and_menus'] = '<div id="tabs_style__'.$cB['tabs_style'].'" class="tabs">'; 
        
        // open buttons wrapper (sibling of content area)
        $return['buttons'] = '<ul class="button_group">';
        
        // open wrapper for the menus area (sibling of buttons)
        $return['menus'] = '<div class="menu_area site__grid tabs_style__'.$cB['tabs_style'].'">';

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

                if($fields['style'] !== 'menu_text_sub_group_half')
                {
                    // open the wrapper for the menu sections
                    $return['menu_sections'] = '<ul class="menu_section '.$fields['style'].'">';
                }
                else
                {
                    // open the wrapper for the menu sections
                    $return['menu_sections'] = '<ul class="menu_section '.$fields['style'].' menu_flex">';
                }

                // loop thru each menu section (rows in the repeater)
                foreach( $fields['menu_sections'] as $i => $section ){

                    // Menu Header Format
                    if($fields['style'] !== 'menu_text_sub_group_half')
                    {
                        $header_format = '
                            <h2><span>%s</span></h2>
                            %s
                        ';
                    }
                    else
                    {
                        $header_format = '
                            <div><h2><span>%s</span></h2>
                            %s
                        ';
                    }

                    // Menu Title and Description
                    $return['menu_sections'] .= sprintf(
                        $header_format
                        ,(!empty($section['title']) ? $section['title'] : '')
                        ,(!empty($section['description']) ? $section['description'] : '')
                    );

                    // Open Menu Items Content
                    $return['menu_sections'] .= '<ul class="menu_items">';

                    foreach( $section['item'] as $i => $item){
                        $return['menu_sections'] .=  get_menu_items($fields['style'], $item);
                    }

                    // Close Menu Items Content
                    if($fields['style'] !== 'menu_text_sub_group_half')
                    {
                        $return['menu_sections'] .= '</ul>';
                    }
                    else
                    {
                        $return['menu_sections'] .= '</ul></div>';
                    }
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
        <section id="block__services" class="site__block">
            <div class="container %s %s" style="%s %s">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
        $guide['section']
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['foreground_color'] ) ? 'color:'.$cB['foreground_color'].';' : '' )           // container bg color style
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