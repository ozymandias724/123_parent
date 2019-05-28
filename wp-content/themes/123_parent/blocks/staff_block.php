<?php 
/**
 * Staff Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    $return['grid'] ='<ul>';
    $guide['grid'] = '
        <li class="site__fade site__fade-up">
            <a href="%s">
                <div class="image site__bgimg site__bgimg--zoom site__bgimg--gradient"><div style="background-image: url(%s)" class="site__bgimg_img"></div></div>
                <h5>%s</h5>
            </a>
        </li>
    ';
    

    // build a grid of post objects
    if( !empty($cB['staff_members']) ){
        foreach($cB['staff_members'] as $i => $staff_member) {
            
            // get fields for this post
            $fields = get_fields($staff_member['staff_member']->ID);
            
            // write to return string
            $return['grid'] .= sprintf(
                $guide['grid']
                ,get_permalink($staff_member['staff_member']->ID)
                ,$fields['image']['url']
                ,$staff_member['staff_member']->post_title
            );
        }
    }
    $return['grid'] .= '</ul>';

    
    // empty guide string 
    $guide['section'] = '
        <section id="block__staff" class="site__block">
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
        ,( !empty($cB['heading']) ? '<h2 style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return['grid']) ? '<div class="site__grid">'.$return['grid'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>