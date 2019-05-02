<?php 
/**
 * Module: Gallery
 * 
 * Description:
 *  Concise view w/ link to full view
 */

    // get the gallery page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'gallery'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);

    // If status is 1, (possibly)

    // Get id of $format_gallery
    function _get_gallery_id($fields){
        return ($fields['type'] == 'standard') ? 'standard_gallery' : 'tabbed_gallery';
    }
     
    // Get class of masonry
    function _get_masonry_class($fields){
        return ($fields['masonry'] == true) ? 'masonry' : 'non_masonry';
    }

    // Get type of tabs
    function _get_tabs_style($fields){
        return ($fields['type'] == 'standard') ? '' : $fields['tabs_type'];
    }

    // Get standard gallery title
    function _get_standard_title($fields){
        return $fields['normal_gallery']['heading'];
    }

    // Get standard list items
    function _get_standard_list_items($fields){
        if($fields['type'] == 'standard')
        {
            if($fields['masonry'] == true)
            {
                $format_list_item = '<li><img src="%s" /></li>';
    
                foreach($fields['normal_gallery']['images'] as $i => $image)
                {
                    $gallery_items .= sprintf(
                        $format_list_item
                        ,$image['url']
                    );
                }
            }
            else
            {
                $format_list_item = '<li><div class="image" style="background-image:url(%s)";></div></li>';
    
                foreach($fields['normal_gallery']['images'] as $i => $image)
                {
                    $gallery_items .= sprintf(
                        $format_list_item
                        ,$image['sizes']['medium_large']
                    );
                }
            }
        }
        return $gallery_items;
    }

    // Get tabbed gallery titles
    function _get_tabbed_titles($fields){
        if($fields['type'] == 'tabbed')
        {
            foreach($fields['tabbed_gallery'] as $i => $tab)
            {
                $format_title = '<h3 class="%s"><a class="%s %s" href="javascript:;">%s</a></h3>';

                $active_tab_title = ($i == 0) ? 'active_tab_title' : '';

                $tab_title = strtolower(str_replace(' ', '', $tab['tab_title'])) . "_tab";
                
                $titles .= sprintf(
                    $format_title
                    ,$active_tab_title
                    ,$tab_title
                    ,($i === 0 ? 'active_gallery' : '')
                    ,$tab['tab_title']
                );
            }
        }
        return $titles;
    }

    // Get tabbed list items
    function _get_tabbed_list_items($fields){
        if($fields['type'] == 'tabbed')
        {
            if($fields['masonry'] == true)
            {
                foreach($fields['tabbed_gallery'] as $i => $tab)
                {
                    $tab_title = strtolower(str_replace(' ', '', $tab['tab_title'])). '_section ';
                    
                    $active_gallery_section = ($i === 0 ? 'active_gallery_section' : '');

                    $list .= '<ul class="gallery_section '.$tab_title .' '.$active_gallery_section.'">';

                    foreach($tab['images'] as $image){
                        $list .= '<li><img src="' . $image['url'] . '"/></li>'; 
                    }
                    
                    $list .= '</ul>';
                }
            }
            else
            {
                foreach($fields['tabbed_gallery'] as $i => $tab)
                {
                    $tab_title = strtolower(str_replace(' ', '', $tab['tab_title'])). '_section ';
                    
                    $active_gallery_section = ($i === 0 ? 'active_gallery_section' : '');

                    $list .= '<ul class="gallery_section '.$tab_title .' '.$active_gallery_section.'">';

                    foreach($tab['images'] as $image){
                        $list .= '<li><div class="image" style="background-image:url(' . $image['sizes']['medium_large'] . ');"></div></li>'; 
                    }

                    $list .= '</ul>';
                }
            }
        }
        return $list;
    }
    
    // Create gallery content
    function _get_gallery_content($format_standard_gallery, $format_tabbed_gallery, $fields){
        if($fields['type'] == 'standard')
        {
            $gallery = sprintf(
                $format_standard_gallery
                ,_get_standard_title($fields)
                ,_get_standard_list_items($fields)
            );
        }
        else
        {
            $gallery = sprintf(
                $format_tabbed_gallery
                ,_get_tabbed_titles($fields)
                ,_get_tabbed_list_items($fields)
            );
        }
        return $gallery;
    }

    // Type of tabs
    $fields['tabs_type'] = 'tabs_side_menu';
    $fields['masonry'] = false; 
        
    $format_standard_gallery = '
        <h3>%s</h3>
        <ul>%s</ul>
    ';
    $format_tabbed_gallery = '
        <div>
            %s
        </div>
        <div>
            %s
        </div>
    ';

    $format_gallery = '
        <div id="%s" class="%s %s">
            %s
        </div>
    ';

    $gallery = sprintf(
        $format_gallery
        ,_get_gallery_id($fields)
        ,_get_masonry_class($fields)
        ,_get_tabs_style($fields)
        ,_get_gallery_content($format_standard_gallery, $format_tabbed_gallery, $fields)
    );  
 
?>
<section id="mod_gallery">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $gallery;
?>
</section>