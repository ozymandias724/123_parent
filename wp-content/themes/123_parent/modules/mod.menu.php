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
    // Get menu fields
    $menu = get_fields($fields['menus'][0]['menu_post']);
    
    // Get menu style
    $style = $menu['style'];

    // Get menu section array
    $sections = $menu['menu_sections'];

    // Tabs area
    $tabs_area = '<div id="menu_tabs">';
    $format_tab = '
        <h4 class="%s">
            <a class="%s" href="javascript:;">%s</a>
        </h4>
    ';
    foreach($sections as $i => $item)
    {   
        $tabs_area .= sprintf(
            $format_tab
            ,($i == 0) ? 'active_menu_header' : ''
            ,($i == 0) ? 'active_menu_link' : ''
            ,$item['title']
        );
    }
    $tabs_area .= '</div>';

    // Check menu style
    if($style == 'Text 1/2')
    {
        
        $menu_section = '<div class="menu_section" id="menu_text_half">';
        
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
        foreach($sections as $i => $section)
        {
            $menu_section .= sprintf(
                $format_header
                // Get title
                ,$section['title']
                // Get description
                ,$section['description']
            );
            $ul = '<ul>';
            // For each menu section item
            foreach($section['item'] as $j => $item)
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
    else if($style == 'Text List Left')
    {
        echo $style;
    }
    else if($style == 'Text List Center')
    {
        echo $style;
    }
    else if($style == 'Text Sub Group 1/2')
    {
        echo $style;
    }
    else if($style == 'Photo Tiled x3')
    {
        echo $style;
    }
    else if($style == 'Photo List')
    {
        echo $style;
    }
    else if($style == 'PDF Embed')
    {
        echo $style;
    }
    else if($style == 'JPEG Embed')
    {
        echo $style;
    }    
    $content .=  $tabs_area . $content_menu . '</section>';
    echo $content;
?>