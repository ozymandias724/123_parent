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
    if( $fields['type'] == 'one' ){
        
        $format_gallery_one = '<li><div class="image" style="background-image:url(%s);" /></li>';
        
        $return_gallery_one = '<div><h2>'.$fields['gallery_one']['heading'].'</h2><ul>';
        
        foreach( $fields['gallery_one']['images'] as $i => $image ){
            $return_gallery_one .= sprintf(
                $format_gallery_one
                ,$image['url']
            );

        }

        $return_gallery_one .= '</ul></div>';
        
    } 
 
 ?>
<section id="mod_gallery">
<?php 

    echo $return_gallery_one;

?>
</section> 