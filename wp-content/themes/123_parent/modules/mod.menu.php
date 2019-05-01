<?php 
/**
 * Module: Menu
 * 
 * Description:
 *  Concise view w/ link to full view
 */

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
        $price_full = $price;
        $price = (!empty($price)) ? explode('.',$price) : '';

        switch($menu_style)
        {
            case 'menu_photo_list':
            $ul .= sprintf(
                $format_item
                ,$image
                ,$title
                ,$description
                ,$price_full
            );
            break;
            case 'menu_photo_tiled_x3':
            $ul .= sprintf(
                $format_item
                ,$image
                ,$title
                ,$price[0]
                ,$price[1]
                ,$description
            );
            break;
            default:
            $ul .= sprintf(
                $format_item
                ,$image
                ,$title
                ,$price_full
                ,$description
            );
        }
        return $ul;
    }
   
    function _format_item($menu_style){
        switch($menu_style)
        {
            case 'menu_photo_list':
            $format_item = '
                <li class="menu_item">
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
                    <h3>%s <span>%s<span></h3>
                    %s
                </li>
            ';
        }
        return $format_item;
    }


    // get the menu page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'menu'
    );

    $res = get_posts($args);

    // Get the menu page fields
    $fields = get_fields($res[0]);

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
        <h4 class="%s">
            <a data-tab="%s" class="%s" href="javascript:;">%s</a>
        </h4>
    ';
    // Loop through all the menus
    foreach($fields['menus'] as $i => $menu){
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

    // Menu Section Header format
    $format_header_default = '
        <div><div class="menu_header">
            <h2><span>%s</span></h2>
            %s
        </div> 
    ';

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
            $menu_section .= sprintf(
                $format_header_default
                // Get title
                ,(!empty($section['title'])) ? $section['title'] : ''
                // Get description
                ,(!empty($section['description'])) ? $section['description'] : ''
            );

            // Loop through all the menu section items
            $ul = '<div class="menu_items"><ul>';
            foreach($section['item'] as $k => $item)
            {   
                $image = (!empty($item['image']['url'])) ? '<div class="image_prov" style="background-image:url('.$item['image']['url'].');"></div>' : '';
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
        <section id="mod_menu">
            %s
            <div id="tabs_%s">
                %s
                %s
            </div>
        </section>
    ';
    $content .= sprintf(
        $format_menu
        ,get_section_banner($res[0]->post_title)
        ,$tabs_style
        ,$tabs_area
        ,$content_menu
    );
    /**
     * End Menu Content
     */

    // Output the menu content
    echo $content;
    
?>