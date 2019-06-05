<?php 
/**
*  Heading Content Block
* 
* 
*/
     // set return and guide string arrays
    $return = [];
    $guide = [];
    
    // build a grid of post objects
    if( !empty($cB['staff_members']) ){

        // set grid return string
        $return['staff'] = '<ul>';
        // set grid guide string
        $guide['staff'] = '
            <li class="site__fade site__fade-up">
                <a href="%s">
                    <div><div class="image" style="background-image: url(%s)" class="site__bgimg_img"></div></div>
                    <h5>%s</h5>
                </a>
            </li>
        ';

        // loop thru each staff member
        foreach($cB['staff_members'] as $i => $staff_member) {
            
            // get fields for this sttaff member
            $fields = get_fields($staff_member['staff_member']->ID);
            
            // write to return string
            $return['staff'] .= sprintf(
                $guide['staff']
                ,get_permalink($staff_member['staff_member']->ID)
                ,$fields['image']['url']
                ,$staff_member['staff_member']->post_title
            );
        }
        $return['staff'] .= '</ul>';
    }

    
    // empty guide string 
    $guide['section'] = '
        <section %s class="site__block block__staff">
            <div class="container %s %s" style="%s %s">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
        $guide['section']
        ,( !empty($cB['anchor_enabled']) ? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['foreground_color'] ) ? 'color:'.$cB['foreground_color'].';' : '' )           // container bg color style
        ,( !empty($cB['heading']) ? '<h2 style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return['staff']) ? '<div class="site__grid">'.$return['staff'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>