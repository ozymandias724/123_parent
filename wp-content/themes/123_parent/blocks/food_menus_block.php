<?php 

    $return['food_menus_block'] = '';

    // If there are menu posts added to the Food Menus block
    if( !empty($cB['food_menus']) ){

        // open buttons and menus container
        $return['buttons_and_menus'] = '<div id="tabs_style__'.$cB['tabs_style'].'" class="tabs">'; 
        
        // open buttons wrapper (sibling of content area)
        $return['buttons'] = '<ul class="button_group">';
        
        // open wrapper for the menus area (sibling of buttons)
        $return['menus'] = '<div class="menu_area tabs_style__'.$cB['tabs_style'].'">';

        // for each menu
        foreach( $cB['food_menus'] as $i => $menu ){

            // get fields for this menu post object
            $fields = get_fields($menu['food_menu']->ID);

            // guide for a button (pill etc)
            $guide['buttons'] = '
                <li class="'.( ($i===0) ? 'tab_active' : '' ).'">
                    <a href="javascript:;">%s</a>
                </li>
            ';
            
            // write to the button group
            $return['buttons'] .= sprintf(
                $guide['buttons'] 
                ,$menu['food_menu']->post_title
            );

            // if this menu post has menu sections
            if( !empty($fields['menu_sections']) ){

                if($fields['style'] !== 'menu_text_sub_group_half'){
                    // open the wrapper for the menu sections
                    $return['menu_sections'] = '<ul class="menu_section '.$fields['style'].( ($i===0) ? ' current_food_menu ' : ' hidden_food_menu ' ).'">';
                }else{
                    // open the wrapper for the menu sections
                    $return['menu_sections'] = '<ul class="menu_section '.$fields['style'].' menu_flex '.( ($i===0) ? ' current_food_menu ' : ' hidden_food_menu ' ).'">';
                }

                // loop thru each menu section (rows in the repeater)
                foreach( $fields['menu_sections'] as $i => $section ){

                    // Menu Header Format
                    if($fields['style'] !== 'menu_text_sub_group_half'){
                        $header_format = '
                            <h2><span>%s</span></h2>
                            %s
                        ';
                    }else{
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
                    if($fields['style'] !== 'menu_text_sub_group_half'){
                        $return['menu_sections'] .= '</ul>';
                    }else{
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

    $guide['food_menus_block'] = '
        <section class="site__block block__food_menus">
            <div class="container %s">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';
    
    $return['food_menus_block'] .= sprintf(
        $guide['food_menus_block'],
        (!empty($cB['width']) ? $cB['width'] : '')
        ,(!empty($cB['heading']) ? '<h3>' . $cB['heading'] . '</h3>' : '')
        ,(!empty($cB['sub_heading']) ? '<div>' . $cB['sub_heading'] . '</div>' : '')
        // Return the food menus block content which is the buttons and menus
        ,( !empty($return['buttons_and_menus']) ? $return['buttons_and_menus'] : '' )
        ,( !empty($cB['button']['url']) ? '<a class="site__button" href="'.$cB['button']['url'].'">'.$cB['button']['title'].'</a>' : '' )
    );

    echo $return['food_menus_block'];
     
?>