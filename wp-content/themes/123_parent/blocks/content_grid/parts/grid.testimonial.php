<?php 
/* 
* Testimonial item
*
*
*/
    $return['content'] = '';

    // Testimonials format guides
    $guide['content_video'] = '
        <div class="testimonial_video">
            %s
            <div class="testimonial_content">
                <div class="testimonial_name">
                    %s
                    %s
                </div>
                <div class="testimonial_details block__item-body">%s</div>
            </div>
        </div>
    ';

    $guide['content_image'] = '
        <div class="testimonial_image">
            %s
            <div class="testimonial_content">
                <div class="testimonial_name">
                    %s
                    %s
                </div>
                <div class="testimonial_details block__item-body">%s</div>
            </div>
        </div>
    ';

    $guide['content_text'] = '
        <div class="testimonial_text">
            <div class="testimonial_content">
                <div class="testimonial_name">
                    %s
                    %s
                </div>
                <div class="testimonial_details block__item-body">%s</div>
            </div>
        </div>
    ';

    $the_fields = get_fields( $post->ID );

    // Video testimonial
    if( $the_fields['type'] == 'video' ){

        $return['content'] = sprintf(
            $guide['content_video']
            ,( !empty( $the_fields['video_file']['url'] )? '<video controls><source src="'.$the_fields['video_file']['url'].'"type="video/mp4"></video>' : '')
            ,( !empty( $the_fields['name'] )? '<h3>'.$the_fields['name'].'</h3>' : '')
            ,( !empty( $the_fields['location'] )? '<p>'.$the_fields['location'].'</p>' : '')
            ,( !empty( $the_fields['details'] ) ? $the_fields['details'] : '')
        );

    // Image testimonial    
    }else if( $the_fields['type'] == 'image' ){

        $return['content'] = sprintf(
            $guide['content_image']
            ,( !empty( $the_fields['image'] )? '<div class="image" style="background-image:url('.$the_fields['image']['url'].');"></div>' : '')
            ,( !empty( $the_fields['name'] )? '<h3>'.$the_fields['name'].'</h3>' : '')
            ,( !empty( $the_fields['location'] )? '<p>'.$the_fields['location'].'</p>' : '')
            ,( !empty( $the_fields['details'] )? $the_fields['details'] : '')
        );
        
    // Text testimonial
    }else if( $the_fields['type'] == 'text' ){
        $return['content'] = sprintf(
            $guide['content_text']
            ,( !empty( $the_fields['name'] )? '<h3>'.$the_fields['name'].'</h3>' : '')
            ,( !empty( $the_fields['location'] )? '<p>'.$the_fields['location'].'</p>' : '')
            ,( !empty( $the_fields['details'] )? $the_fields['details'] : '')
        );
    }

?>
<div class="grid_testimonial grid_item">
<?php
    echo $return['content'];
?>
</div>