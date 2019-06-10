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
        <section id="mod_menu">
            %s
            <div id="tabs_%s" class="site__fade site__fade-up">
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