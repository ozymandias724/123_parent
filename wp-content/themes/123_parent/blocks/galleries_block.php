<?php 
/**
 * coupons Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];


    $fields = $cB;

    function _get_tab_name($fields)
    {
        return (!empty($fields['tab_type']) ? 'tab_' . $fields['tab_type'] : '');
    }
    
    function _get_titles($fields)
    {
        $gallery = $fields['galleries'];

        $format_title = '<h5><a class="%s %s" href="javascript:;">%s</a></h5>';

        $tab_titles = '<div id="gallery_titles" class="site__fade site__fade-up">';

        foreach($gallery as $i => $row)
        {
            $active_title = ($i === 0 ? 'active_title' : '');

            $title = (!empty($row['title']) ? strtolower(str_replace(' ', '', $row['title'])) : '');

            $tab_title =  $title . '_title';

            $title = sprintf(
                $format_title
                ,$active_title
                ,(!empty($row['title']) ? $row['title'] : '')
            );

            $tab_titles .= $title;
        }
        $tab_titles .= '</div>';
        return $tab_titles;
    }

    function _get_rows_with_titles($fields)
    {
        $gallery = $fields['galleries'];

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
        $gallery = $fields['galleries'];

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
                    <li class="gallery_item site__fade site__fade-up">
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
        return $gallery;
    }


    // 
    $return['galleries'] = _get_gallery($fields);
    
    
    // empty guide string 
    $guide['section'] = '
        <section id="block__galleries" class="site__block">
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
        ,( !empty($cB['heading']) ? '<h2>'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return['galleries']) ? $return['galleries'] : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>