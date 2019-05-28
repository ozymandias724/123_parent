<?php 

    function _menu_name($post_title){
        $menu_name = strtolower(str_replace(' ', '', $post_title)) . '_menu';
        return $menu_name;
    }

    function _menu_style($style){
        switch($style)
        {
            case 'Text 1/2':
                $menu_style = 'menu_text_half';
                break;
            case 'Text List Left':
                $menu_style = 'menu_text_list_left';
                break;
            case 'Text List Center':
                $menu_style = 'menu_text_list_center';
                break;
            case 'Text Sub Group 1/2':
                $menu_style = 'menu_text_sub_group_half';
                break;
            case 'Photo Tiled x3':
                $menu_style = 'menu_photo_tiled_x3';
                break;
            case 'Photo List':
                $menu_style = 'menu_photo_list';
                break;
            case 'PDF Embed':
                $menu_style = 'menu_pdf_embed';
                break;
            case 'JPEG Embed':
                $menu_style = 'menu_jpeg_embed';
                break;
        }
        return $menu_style;
    }

    function _menu_item($format_item, $menu_style, $image, $title, $description, $price){
        $price_full = (!empty($price)) ? $price : '';
        $price = (!empty($price)) ? explode('.',$price) : '';

        switch($menu_style)
        {
            case 'menu_photo_list':
            $ul = sprintf(
                $format_item
                ,$image
                ,$title
                ,$description
                ,$price_full
            );
            break;
            case 'menu_photo_tiled_x3':
            $ul = sprintf(
                $format_item
                ,$image
                ,$title
                ,$price[0]
                ,$price[1]
                ,$description
            );
            break;
            default:
            $ul = sprintf(
                $format_item
                ,$image
                ,$title
                ,$price_full
                ,$description
            );
        }
        return $ul;
    }

    function _format_header($menu_style){
        if(
            $menu_style == 'menu_text_list_center' || 
            $menu_style == 'menu_text_list_left' ||
            $menu_style == 'menu_photo_tiled_x3' || 
            $menu_style == 'menu_photo_list'
        )
        {
            $format_header = '
                <div><div class="menu_header">
                    <h2>%s</h2>
                    %s
                </div> 
            ';
        }
        else 
        {
            $format_header = '
                <div><div class="menu_header">
                    <h2><span>%s</span></h2>
                    %s
                </div> 
            ';
        }
        return $format_header;
    }
   
    function _format_item($menu_style){
        switch($menu_style)
        {
            case 'menu_photo_list':
            $format_item = '
                <li class="menu_item site__fade site__fade-up">
                    %s
                    <div>
                        <h3>%s</h3>
                        %s
                        <p>%s</p>
                    </div>
                </li>
            ';
            break;
            case 'menu_photo_tiled_x3':
            $format_item = '
                <li class="menu_item">
                    %s
                    <h3>%s <div>%s.<span>%s</span></div></h3>
                    %s
                </li>
            ';
            break;
            default: 
            $format_item = '
                <li class="menu_item">
                    %s
                    <h3>%s <span>%s</span></h3>
                    %s
                </li>
            ';
        }
        return $format_item;
    }


    $guide = [];
    $return = [];

    //Maybe change this
    $fields = $cB;

    // Assign the tabs style
    $tabs_style = $fields['tabs_style'];

    // Make an array to contain the fields for each menu
    $menus = array();

    // Loop through all the menus
    foreach($fields['menus'] as $i => $menu)
    {
        // Get menu fields and push to $menus array
        array_push($menus, get_fields($menu['menu_post']));
    }

    // Tabs area
    $tabs_area = '<div id="menu_tabs">';
    $format_tab = '
        <h5 class="%s">
            <a data-tab="%s" class="%s" href="javascript:;">%s</a>
        </h5>
    ';
    // Loop through all the menus
    foreach($fields['menus'] as $i => $menu)
    {
        $menu_name = strtolower(str_replace(' ', '', $menu['menu_post']->post_title)) . '_menu';
        $tabs_area .= sprintf(
            $format_tab
            ,($i == 0) ? 'active_menu_header': ''
            ,$menu_name
            ,($i == 0) ? 'active_menu_link' : ''
            ,$menu['menu_post']->post_title
        );
    }
    $tabs_area .= '</div>';
    // End Tabs Area

    // Loop through all the menus
    foreach($menus as $i => $menu)
    {
        // Get menu style
        $style = $menu['style'];

        // Get menu section 
        $sections = $menu['menu_sections'];

        // Set menu style
        $menu_style = _menu_style($style);

        // Set menu name
        $menu_name = _menu_name($fields['menus'][$i]['menu_post']->post_title);

        $format_menu_section = '
            <div data-tab="%s" class="menu_section %s %s %s">
        ';
        $menu_section = sprintf(
            $format_menu_section
            ,$menu_name
            ,($i == 0) ? 'active_menu_section' : ''
            ,$menu_style
            ,($menu_style == 'menu_text_sub_group_half') ? 'flex_menu' : ''
        );

        // Format Menu Section Item
        $format_item = _format_item($menu_style);

        // Loop through all the menu sections 
        foreach($sections as $j => $section)
        {
            $format_header = _format_header($menu_style);
            $menu_section .= sprintf(
                $format_header
                // Get title
                ,(!empty($section['title'])) ? $section['title'] : ''
                // Get description
                ,(!empty($section['description'])) ? $section['description'] : ''
            );

            // Loop through all the menu items
            $ul = '<div class="menu_items"><ul>';
            foreach($section['item'] as $k => $item)
            {   
                $image = (!empty($item['image']['url'])) ? '<div class="image_prov block" style="background-image:url('.$item['image']['url'].');"></div>' : '';
                $title = (!empty($item['title'])) ? $item['title'] : '';
                $description = (!empty($item['description'])) ? $item['description'] : '';
                $price = (!empty($item['price'])) ? $item['price'] : '';

                $ul .= _menu_item($format_item, $menu_style, $image, $title, $description, $price);
            }
            $ul .= '</ul></div></div>';
            $menu_section .= $ul;
        } 
        $content_menu .= $menu_section . '</div>';
    }

    /**
     * Start Menu Content
     */
    $format_menu = '
        <div id="tabs_%s">
            %s
            %s
        </div>
    ';
    $content .= sprintf(
        $format_menu
        ,$tabs_style
        ,$tabs_area
        ,$content_menu
    );
    /**
     * End Menu Content
     */
    // Output the menu content
    // echo $content;

    $return['grid'] = $content;
    // My Stuff Above, Kyles Stuff Below
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
        ,( !empty($return['grid']) ? $return['grid'] : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    echo $return['section'];
     
     // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
?>