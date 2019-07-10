<?php 
/**
 * Galleries Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    $return['section'] = '';
    $return['tabs'] = '';
    
    // if we have galleries
    if( !empty( $cB['galleries'] ) ){

        $return['galleries'] = '';

        // set the galleries guide string
        $guide['galleries'] = '<li class="site__fade site__fade-up"><div><div class="image" style="background-image: url(%s)"></div></div></li>';
        // set the galleries return string
        $return['galleries'] .= '<div class="galleries">';

        // open the tabs list
        if( $cB['tabs_style'] != 'none' ){
            $return['tabs'] .= '<div class="tabs site__fade site__fade-up"><ul>';
        }

        // loop thru the galleries
        foreach( $cB['galleries'] as $i => $gallery ){

            // create a tab for each gallery
            if( $cB['tabs_style'] !== 'none' ){
                $return['tabs'] .= '<li class="'.( ($i === 0 ) ? 'tab_active' : '' ).'"><a href="javascript:;">'.$gallery['title'].'</a></li>';
            }

            // open the galleries grid
            if ( $cB['tabs_style'] == 'none' ){
                $return['galleries'] .= '<div class="site__flexgrid '.( ($i===0) ? 'current_gallery' : 'hidden_gallery' ).'"><h2 class="site__fade site__fade-up">'.$gallery['title'].'</h2><ul class="flexboxGrid">';
            }else{
                $return['galleries'] .= '<div class="site__flexgrid '.( ($i===0) ? 'current_gallery' : 'hidden_gallery' ).'"><ul class="flexboxGrid">';
            }

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
        if( $cB['tabs_style'] !== 'none' ){
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
                <div class="tabsandgrids_container '.$cB['tabs_style'].'">
                    %s
                    %s
                </div>
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
        $guide['section']
        //  options for every block
        ,( !empty( $cB['anchor_enabled'] )? 'id="'.strtolower($cB['anchor_link_text']).'"' : '' ) // add an ID tag for the long scroll

        ,( !empty( $cB['options']['width'] )? $cB['options']['width'] : '' )  // container width

        ,( !empty( $cB['options']['background_color'] )? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['options']['background_color'] )? 'background-color:'.$cB['options']['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['options']['foreground_color'] )? 'color:'.$cB['options']['foreground_color'].';' : '' )           // container bg color style

        // post object grid options
        ,( !empty( $cB['heading_options']['heading'] )? '<h2 class=" block__heading site__fade site__fade-up" style="'.( !empty( $cB['heading_options']['heading_alignment'] )? 'text-align:'.$cB['heading_options']['heading_alignment'].';' : '' ).'">'.$cB['heading_options']['heading'].'</h2>' : '' )

        ,( !empty( $cB['heading_options']['sub_heading'] )? '<div class="block__details site__fade site__fade-up">'.$cB['heading_options']['sub_heading'].'</div>' : '' )

        // gallery options
        ,( !empty( $return['tabs'] )? $return['tabs'] : '' )

        ,( !empty( $return['galleries'] )? $return['galleries'] : '' )
        // view all
        ,( !empty( $cB['button']['url'] )? '<a class="site__button" href="'.$cB['button']['url'].'">'.$cB['button']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>