<?php 
/**
 * Services Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];
    $return['grid'] ='<ul>';
    $guide['grid'] = '';
    
    foreach($cB['testimonials'] as $i => $testimonial) {
        
        $fields = get_fields($testimonial['testimonial']->ID);


        if( $fields['type'] == 'text' ){
            $guide['grid'] = '
                <li class="testimonial_text site__fade site__fade-up">
                    <div class="testimonial_content">
                        <div>
                            %s
                            %s
                        </div>
                        %s
                    </div>
                </li>
            ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,'<h3>Jane Doe</h3>'
                ,'<p> - Irvine, CA </p><i class="fas fa-quote-left"></i>'
                ,(!empty($testimonial['details']) ? $testimonial['details'] : '')
            );    
        }
        else if( $fields['type'] == 'image' ){
            $guide['grid'] = '
                <li class="testimonial_image site__fade site__fade-up">
                    %s
                    <div class="testimonial_content">
                        <div>
                            %s
                            %s
                        </div>
                        %s
                    </div>
                </li>
            ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,(!empty($testimonial['image']) ? '<div class="block" style="background-image:url('.$testimonial['image']['url'].');"></div>' : '')
                ,'<h3>Jane Doe</h3>'
                ,'<p> - Irvine, CA </p><i class="fas fa-quote-left"></i>'
                ,(!empty($testimonial['details']) ? $testimonial['details'] : '')
            );
        }
        else if( $fields['type'] == 'video' ){
            $video_format = '
                <video> 
                    <source src="%s" type="video/mp4">
                </video>
            ';
            $video_tag = sprintf(
                $video_format
                ,(!empty($testimonial['video_url']) ? $testimonial['video_url'] : '')
            );
            $guide['grid'] = '
                <li class="testimonial_video site__fade site__fade-up">
                    %s
                    <div class="testimonial_content">
                        <div class="testimonial_address">
                            %s
                        </div>
                        %s
                    </div>
                </li>
                ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,$video_tag
                ,(!empty($testimonial['details']) ? $testimonial['details'] : '')
                ,''
            );
        }
        
    }
    $return['grid'] .= '</ul>';

    
    // empty guide string 
    $guide['section'] = '
        <section %s class="site__block block__testimonials">
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
        ,( !empty($cB['heading']) ? '<h2 class="site__fade site__fade-up" style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div class="site__fade site__fade-up">'.$cB['text'].'</div>' : '' )
        ,( !empty($return['grid']) ? '<div class="site__grid">'.$return['grid'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>