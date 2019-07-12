<?php 
/* 
*   Blog Post item
*/

    $the_fields = get_fields( $post->ID );

    $return['content'] = '';

    $guide['content'] = '
        <a href="javascript:;">
            %s
            <div class="content">
                <h5>%s</h5>
                <div class="excerpt block__item-body">%s</div>
                <p class="read_more">Read More</p>
            </div>
        </a>
    ';

    if( $the_fields['status'] ){

        $return['content'] = sprintf(
            $guide['content']
            //,get_permalink( $post->ID )
            ,( !empty( $the_fields['featured_image']['url'] )? '<div class="image_container"><div class="image" style="background-image:url('.$the_fields['featured_image']['url'].');"></div></div>' : '')
            ,$post->post_title
            ,( !empty( $the_fields['excerpt'] )? $the_fields['excerpt'] : '')
        );
    }

?>
<div class="grid_blog_post grid_item site__fade site__fade-up">
<?php
    echo $return['content'];
?>
</div>