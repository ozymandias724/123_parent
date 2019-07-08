<?php 
/* 
* Service item
*/

    $return['content'] = '';

    $guide['content']= '
        <a href="javascript:;">
            <div>
                <div class="image" style="background-image:url(%s);"></div>
            </div>
            <div>
                <h3>%s</h3>
                <div class="service_details block__item-body">%s</div>
                <p class="service_price">%s</p>
            </div>
        </a>
    ';

    $the_fields = get_fields( $post->ID );

    if( $the_fields['status'] ){

        $return['content'] .= sprintf(
            $guide['content']
            //,get_permalink( $post->ID )
            ,( !empty( $the_fields['image']['url'] )? $the_fields['image']['url'] : '' )
            ,$post->post_title
            ,( !empty( $the_fields['details'] )? $the_fields['details'] : '')
            ,( !empty( $the_fields['price'] )? '$'.$the_fields['price'] : '')
        );  

    }

?>
<div class="grid_service grid_item">
<?php
    echo $return['content'];
?>
</div>