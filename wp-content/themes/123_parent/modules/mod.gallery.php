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

    // Type of tabs
    $fields['tabs_type'] = 'tabs_side_menu';
    $fields['masonry'] = true;
 
    // check type
    // Standard
    if( $fields['type'] == 'standard' ){  
        
        $gallery_img = $fields['masonry'] == true ? '<img class="grid_image" src="%s" />' : '<div class="image" style="background-image:url(%s);"></div>';

        $format_gallery = '<li>' . $gallery_img . '</li>'; 

        $gallery_class = $fields['masonry'] == true ? "grid_gallery" : "non_grid";

        $return_gallery = '<div id="standard_gallery" class="'. $gallery_class . '"><h3>' . $fields['normal_gallery']['heading'] . '</h3><ul>';
        
        foreach( $fields['normal_gallery']['images'] as $i => $image ){
            $return_gallery .= sprintf(
                $format_gallery
                ,$fields['masonry'] == true ? $image['sizes']['medium_large'] : $image['url']
            );
        }

        $return_gallery .= '</ul></div>'; 
        
    // Tabbed Gallery
    } else if($fields['type'] == 'tabbed'){

        $format_gallery = '<h3><a class="%s %s" href="javascript:;">%s</a></h3>';

        $gallery_class = ($fields['masonry'] == true) ? 'grid_gallery ' : 'non_grid ';

        $return_gallery = '<div id="tabbed_gallery" class="' . $gallery_class . $fields['tabs_type'] . '"><div>';
        
        foreach($fields['tabbed_gallery'] as $i => $tab){
            $tab_title = strtolower(str_replace(' ', '', $tab['tab_title'])) . "_tab";
            
            $return_gallery .= sprintf(
                $format_gallery
                ,$tab_title
                ,($i === 0 ? "active_gallery" : "")
                ,$tab['tab_title']
            );
        }

        $return_gallery .= '</div>'; 

        $gallery_list = '<div>'; 
    
        foreach($fields['tabbed_gallery'] as $i => $tab){

            $tab_title = strtolower(str_replace(' ', '', $tab['tab_title'])). '_section ';

            $active_gallery_section = ($i === 0 ? "active_gallery_section" : "");

            $gallery = '<ul class="gallery_section ' . $tab_title . $active_gallery_section . '">';  

            foreach($tab['images'] as $image){
                $image_url = ($fields['masonry'] == true) ? $image['sizes']['medium_large'] : $image['url'];
                if($fields['masonry'] == true){
                    $gallery .= '<li><img src="' . $image_url . '"/></li>'; 
                }else{
                    $gallery .= '<li><div class="image" style="background-image:url(' . $image_url . ');"></div></li>';
                }
            }

            $gallery .= '</ul>';
            $gallery_list .=  $gallery;
        }
        
        $return_gallery .= $gallery_list . '</div>';

        $return_gallery .= '</div>';

    }   
 
?>
<section id="mod_gallery">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_gallery;
?>
</section>