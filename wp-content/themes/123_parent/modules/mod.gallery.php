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
 
    // check type
    if( $fields['type'] == 'standard' ){ 
        
        $format_gallery = '<li><div class="image" style="background-image:url(%s);"></div></li>';
        
        $return_gallery = '<div><h2>'.$fields['normal_gallery']['heading'].'</h2><ul>';
        
        foreach( $fields['normal_gallery']['images'] as $i => $image ){
            $return_gallery .= sprintf(
                $format_gallery
                ,$image['url']
            );

        }

        $return_gallery .= '</ul></div>'; 
        
    } else if($fields['type'] == 'tabbed'){

        $format_gallery = '<h3><a class="%s %s" href="javascript:;">%s</a></h3>';

        $return_gallery = '<div id="tabbed_gallery"><div>';
        
        $count = 0;
        foreach($fields['tabbed_gallery'] as $tab){
            $return_gallery .= sprintf(
                $format_gallery
                ,strtolower(str_replace(' ', '', $tab['tab_title'])) 
                ,($count === 0 ? "active_gallery" : "")
                ,$tab['tab_title']
            );
            $count++;
        }

        $return_gallery .= '</div>'; 

        $gallery_list = '<div>';
 
        $count = 0;
        foreach($fields['tabbed_gallery'] as $tab){
            $gallery = '<ul class="gallery_list '.strtolower(str_replace(' ', '', $tab['tab_title'])). ' ' .($count === 0 ? "active_gallery_list" : "").'">';  
            foreach($tab['images'] as $image){
                $gallery .= '<li><div class="image" style="background-image:url('.$image['url'].');"></div></li>';
            }
            $gallery .= '</ul>';
            $gallery_list .=  $gallery;
            $count++;
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