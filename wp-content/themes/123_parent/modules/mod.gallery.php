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

    function _get_tab_name($fields)
    {
        return (!empty($fields['tab_type']) ? 'tab_' . $fields['tab_type'] : '');
    }
    
    function _get_titles($fields)
    {
        $gallery = $fields['gallery'];

        $format_title = '<h3><a class="%s %s" href="javascript:;">%s</a></h3>';

        $tab_titles = '<div id="gallery_titles" class="site__fade site__fade-up">';

        foreach($gallery as $i => $row)
        {
            $active_title = ($i === 0 ? 'active_title' : '');

            $title = (!empty($row['title']) ? strtolower(str_replace(' ', '', $row['title'])) : '');

            $tab_title =  $title . '_title';

            $title = sprintf(
                $format_title
                ,$active_title
                ,$tab_title
                ,(!empty($row['title']) ? $row['title'] : '')
            );

            $tab_titles .= $title;
        }
        $tab_titles .= '</div>';
        return $tab_titles;
    }

    function _get_rows_with_titles($fields)
    {
        $gallery = $fields['gallery'];

        $content = '<div id="gallery">';

        foreach($gallery as $i => $row)
        {
            $content .= (!empty($row['title']) ? '<h3>'.$row['title'].'</h3>' : '');

            $title = (!empty($row['title']) ? strtolower(str_replace(' ', '', $row['title'])) : '');

            $content .= '<ul class="gallery_row">';

            foreach($row['images'] as $image){
                $image = (!empty($image['url'])) ? $image['url'] : '';
                $content .= '
                    <li class="gallery_item site__fade site__fade-up">
                        <div class="gallery_image block" style="background-image:url(' . $image . ');"></div>
                    </li>'; 
            }

            $content .= '</ul>';
        }
        $content .= '</div>';

        return $content;
    }
    
    function _get_rows($fields)
    {
        $gallery = $fields['gallery'];

        $format_rows = '
            <div id="gallery_rows">
                %s
            </div>
        ';

        foreach($gallery as $i => $row)
        {
            $title = (!empty($row['title']) ? strtolower(str_replace(' ', '', $row['title'])) : '');

            $tab_title =  $title . '_row';
                    
            $active_row = ($i === 0 ? 'active_row' : '');

            $content .= '<ul class="gallery_row '.$tab_title .' '.$active_row.'">';

            foreach($row['images'] as $image){
                $image = (!empty($image['url'])) ? $image['url'] : '';
                $content .= '
                    <li class="gallery_item">
                        <div class="gallery_image block" style="background-image:url(' . $image . ');"></div>
                    </li>'; 
            }

            $content .= '</ul>';
        }

        $rows = sprintf(
            $format_rows
            ,$content
        );

        return $rows; 
    }

    function _get_gallery($fields)
    {
        // With tabs
        if($fields['use_tabs'])
        {
            $format_tab_gallery = '
                <div id="gallery" class="%s">
                    %s
                    %s
                </div>
            ';

            $gallery = sprintf(
                $format_tab_gallery
                ,_get_tab_name($fields)
                ,_get_titles($fields)
                ,_get_rows($fields)
            );
        }
        // Without tabs
        else
        {
            $gallery = _get_rows_with_titles($fields);
        }
        echo $gallery;
    }
 
?>
<section id="mod_gallery">
<?php 
    echo get_section_banner($res[0]->post_title);
    _get_gallery($fields);
?>
</section>