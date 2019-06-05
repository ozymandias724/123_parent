<?php 
/**
 * coupons Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    
    // if we have galleries
    if( !empty($cB['galleries']) ){

        $return['galleries'] = '';

        // set the galleries guide string
        $guide['galleries'] = '<li><div><div class="image" style="background-image: url(%s)"></div></div></li>';
        // set the galleries return string
        $return['galleries'] .= '<div class="galleries">';

        // open the tabs list
        if( $cB['tab_type'] != 'none' ){
            $return['tabs'] .= '<div class="tabs '.$cB['tab_type'].'"><ul>';
        }

        // loop thru the galleries
        foreach( $cB['galleries'] as $i => $gallery ){

            // create a tab for each gallery
            if( $cB['tab_type'] !== 'none' ){
                $return['tabs'] .= '<li><a href="javascript:;" style="color:'.$cB['foreground_color'].';">'.$gallery['title'].'</a></li>';
            }

            // open the galleries grid
            $return['galleries'] .= '<div class="site__grid '.( ($i===0) ? 'current_gallery' : 'hidden_gallery' ).'"><h2>'.$gallery['title'].'</h2><ul>';

            // loop thru the gallery images to create line items
            foreach( $gallery['images'] as $image ){
                $return['galleries'] .= sprintf(
                    $guide['galleries']
                    ,$image['url']
                );
            }
            $return['galleries'] .= '</ul></div>';
        }
        // close the tabs list
        if( $cB['tab_type'] !== 'none' ){
            $return['tabs'] .= '</ul></div>';
        }

        $return['galleries'] .= '</div>';
    }
    
    // empty guide string 
    $guide['section'] = '
        <section %s class="site__block block__galleries">
                <div class="container %s %s" style="%s %s">
                %s
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
        ,( !empty($cB['heading']) ? '<h2>'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div class="block__details">'.$cB['text'].'</div>' : '' )
        ,( !empty($return['tabs']) ? $return['tabs'] : '' )
        ,( !empty($return['galleries']) ? $return['galleries'] : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>