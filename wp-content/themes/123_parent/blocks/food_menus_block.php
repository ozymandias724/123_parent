<?php 

    $guide = [];
    $return = [];

    if( !empty($cB['menus']) ){
        // guide for a menu section
        $guide['menu_sections'] = '<li>%s</li>';
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
                $return['menu_sections'] = '<ul>';
                // loop thru each menu section (rows in the repeater)
                foreach( $fields['menu_sections'] as $i => $section ){
                    $return['menu_sections'] .= sprintf(
                        $guide['menu_sections']
                        ,$menu['menu_post']->post_title . 'menu section' .($i+1)  // this is just a example data point
                    );
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
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return['buttons_and_menus']) ? $return['buttons_and_menus'] : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    
    echo $return['section'];
     
     // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
?>