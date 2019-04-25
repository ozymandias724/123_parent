<?php 
/**
 * Module: Menu
 * 
 * Description:
 *  Concise view w/ link to full view
 */
    // get the menu page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'menu'
    );

    $res = get_posts($args);

    // get the menu page fields
    $fields = get_fields($res[0]);
 ?>

<section id="mod_menu">

<?php 
    // Output the banner with post title
    echo get_section_banner($res[0]->post_title);
?>

<?php
    // Make an array containing the fields for each menu
    $menus = array();
    
    // Loop through each menu
    foreach($fields['menus'] as $i => $menu)
    {
        // Get menu fields and push to $menus array
        array_push($menus, get_fields($menu['menu_post']));
    }

    // Tabs area
    $tabs_area = '<div id="tabs_side_menu" class="menu_content"><div id="menu_tabs">';
    $format_tab = '
        <h4 class="%s">
            <a data-tab="%s" class="%s" href="javascript:;">%s</a>
        </h4>
    ';
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

    // Loop through each menu in $menus
    foreach($menus as $i => $menu)
    {
        // Get menu style
        $style = $menu['style'];

        // Get menu section 
        $sections = $menu['menu_sections'];

        // Set menu style
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

        // Set active menu section
        $active_menu_section = ($i == 0) ? ' active_menu_section' : '';
        $menu_name = strtolower(str_replace(' ', '', $fields['menus'][$i]['menu_post']->post_title)) . '_menu';

        $menu_section = '<div data-tab="'.$menu_name.'" class="menu_section'. $active_menu_section . ' ' . $menu_style . '">';

        // Format Menu Section Title and Description
        $format_header = '
            <div class="menu_header">
                <h2>%s</h2>
                %s
            </div>
        ';
        // Format Menu Section Item
        $format_item = '
            <li class="menu_item">
                <div style="background-image:url(%s);"></div>
                <h3>%s</h3>
                <div>%s<span>%s</span></div>
            </li>
        ';

        // Get each menu section 
        foreach($sections as $j => $section)
        {
            $menu_section .= sprintf(
                $format_header
                // Get title
                ,$section['title']
                // Get description
                ,$section['description']
            );

            // For each menu section item
            $ul = '<ul>';
            foreach($section['item'] as $k => $item)
            {
                $ul .= sprintf(
                    $format_item
                    // Get image url
                    ,$item['image']['url']
                    // Get title
                    ,$item['title']
                    // Get description
                    ,$item['description']
                    // Get price
                    ,$item['price']
                );
            }
            $ul .= '</ul>';

            $menu_section .= $ul;
        }
        $content_menu .= $menu_section . '</div>';    
    }
    $content .=  $tabs_area . $content_menu . '</div></section>';
    echo $content;
?>