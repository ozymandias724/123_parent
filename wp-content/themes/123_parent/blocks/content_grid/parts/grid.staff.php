<?php 
/* 
* Staff item
* 
*/

    $return['content'] = '';

    $guide['content'] = '
        <a href="javascript:;">
            <div class="staff_image">
                <div class="image site__bgimg_img" style="background-image:url(%s);"></div>
            </div>
            <div class="staff_content">
                <h3>%s</h3>
                <div class="staff_details block__item-body">%s</div>
            </div>
        </a>
        <div class="staff_social">%s</div>
    ';

    $the_fields = get_fields( $post->ID );


    $social_media = '';
    if( !empty($the_fields['social_media']) ){
        $social_media .= '<ul class="site__social-media">';
        $social_format = '
            <li>
                <a href="%s" title="%s" target="_blank">
                    %s
                </a>
            </li>
        ';
        foreach( $the_fields['social_media']['icons'] as $i => $social_icon ){

            $img = $social_icon['image'];
            $fa = $social_icon['icon'];

            $url = ( !empty($social_icon['link']['url']) ? $social_icon['link']['url'] : '' );
            $title = ( !empty($social_icon['link']['title']) ? $social_icon['link']['title'] : '' );

            if( !empty($social_icon['image']) ){
                $social_media .= sprintf(
                    $social_format
                    ,$url
                    ,$title
                    ,( !empty($img['url']) ? '<img src="'.$img['url'].'" />' : '')
                );
            }else if( !empty($social_icon['icon']) ){
                $social_media .= sprintf(
                    $social_format
                    ,$url
                    ,$title
                    ,( !empty($fa) ? $fa : '')
                );
            }else{
                $social_media = '';
            }
        }
        $social_media .= '</ul>';
    }


    if( $the_fields['status'] ){

        $return['content'] = sprintf(
            $guide['content']
            //get_permalink($post->ID)
            ,( !empty( $the_fields['image']['url'] )? $the_fields['image']['url'] : '')
            ,$post->post_title
            ,( !empty( $the_fields['short_bio'] )? $the_fields['short_bio'] : '')
            ,$social_media
        );   
    }
?>
<div class="grid_staff grid_item">
<?php 
    echo $return['content'];
?>
</div>