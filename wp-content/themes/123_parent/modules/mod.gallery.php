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
    $fields['masonry'] = false; 
 
    // check type
    // Standard
    if( $fields['type'] == 'standard' ){  
        
        if($fields['masonry'] == true){
            $format_gallery = '<li><img class="grid_image" src="%s" /></li>';
            
            $return_gallery = '<div id="standard_gallery" class="grid_gallery"><h3>' . $fields['normal_gallery']['heading'] . '</h3><ul class="grid_masonry">';
            
            foreach( $fields['normal_gallery']['images'] as $i => $image ){
                $return_gallery .= sprintf(
                    $format_gallery,
                    $image['sizes']['medium_large']
                );
            }
    
            $return_gallery .= '</ul></div>'; 
        }else{
            
            $format_gallery = '<li><div class="image" style="background-image:url(%s);"></div></li>';
            
            $return_gallery = '<div id="standard_gallery" class="non_grid"><h3>' . $fields['normal_gallery']['heading'] . '</h3><ul>';
            
            foreach( $fields['normal_gallery']['images'] as $i => $image ){
                $return_gallery .= sprintf(
                    $format_gallery,
                    $image['url']
                );
            }
    
            $return_gallery .= '</ul></div>'; 

        }
        
    // Tabbed Gallery
    } else if($fields['type'] == 'tabbed'){

        if($fields['masonry'] == true){
            
        }else{
            $format_gallery = '<h3><a class="%s %s" href="javascript:;">%s</a></h3>';

            $return_gallery = '<div id="tabbed_gallery" class="non_grid ' . $fields['tabs_type'] . '"><div>';
            
            foreach($fields['tabbed_gallery'] as $i => $tab){
                $return_gallery .= sprintf(
                    $format_gallery ,
                    strtolower(str_replace(' ', '', $tab['tab_title'])) . "_tab",
                    ($i === 0 ? "active_gallery" : ""),
                    $tab['tab_title']
                );
            }
    
            $return_gallery .= '</div>'; 
    
            $gallery_list = '<div>'; 
     
            foreach($fields['tabbed_gallery'] as $i => $tab){
    
                $tab_title = strtolower(str_replace(' ', '', $tab['tab_title'])). '_section ';
                $active_gallery_section = ($i === 0 ? "active_gallery_section" : "");
    
                $gallery = '<ul class="gallery_section ' . $tab_title . $active_gallery_section . '">';  
                foreach($tab['images'] as $image){
                    $image_url = $image['url'];
                    $gallery .= '<li><div class="image" style="background-image:url(' . $image_url . ');"></div></li>';
                }
    
                $gallery .= '</ul>';
                $gallery_list .=  $gallery;
            }
            
    
            $return_gallery .= $gallery_list . '</div>';
    
            $return_gallery .= '</div>';
        }
    }   
 
?>
<section id="mod_gallery">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_gallery;
    var_dump($fields);
?>
</section>