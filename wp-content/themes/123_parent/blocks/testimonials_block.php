<?php 
/**
 * Services Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];

    $guide['grid'] = '';
    
    $return['grid'] ='<ul class="site__fade site__fade-up">';

    foreach($cB['testimonials'] as $i => $testimonial){
        
        $fields = get_fields($testimonial['testimonial']->ID);

        if( $fields['type'] == 'text' ){
            $guide['grid'] = '
                <li class="testimonial_text">
                    <div>
                        %s
                        <div class="testimonial_content">
                            %s
                            <div class="testimonial_name">
                                %s
                                %s
                            </div>
                            <div class="testimonial_details">%s</div>
                        </div>
                    </div>
                </li>
            ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,(!empty($fields['image']) ? '<div class="block" style="background-image:url('.$fields['image']['url'].');"></div>' : '')
                ,'<i class="fas fa-quote-left"></i>'
                // HARD CODED CONTENT
                ,'<h3>Joe Doe</h3>'
                // HARD CODED CONTENT
                ,'<p> - Irvine, CA </p>'
                ,(!empty($fields['details']) ? $fields['details'] : '')
            );    
        }
        else if( $fields['type'] == 'image' ){
            $guide['grid'] = '
                <li class="testimonial_image">
                    <div>
                        %s
                        <div class="testimonial_content">
                            %s
                            <div class="testimonial_name">
                                %s
                                %s
                            </div>
                            <div class="testimonial_details">%s</div>
                        </div>
                    </div>
                </li>
            ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,(!empty($fields['image']) ? '<div class="block" style="background-image:url('.$fields['image']['url'].');"></div>' : '')
                ,'<i class="fas fa-quote-left"></i>'
                // HARD CODED CONTENT
                ,'<h3>Jane Doe</h3>'
                // HARD CODED CONTENT
                ,'<p> - Irvine, CA </p>'
                ,(!empty($fields['details']) ? $fields['details'] : '')
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
                ,(!empty($fields['video_url']) ? $fields['video_url'] : '')
            );
            $guide['grid'] = '
                <li class="testimonial_video">
                    %s
                    <div class="testimonial_content">
                        <div class="testimonial_address">
                            %s
                        </div>
                        <div class="testimonial_details">%s</div>
                    </div>
                </li>
                ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,$video_tag
                ,(!empty($fields['details']) ? $fields['details'] : '')
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
        ,( !empty($cB['heading']) ? '<h2 class="site__fade site__fade-up block__heading" style="text-align:'.$cB['heading_alignment'].';">'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div class="site__fade site__fade-up block__details">'.$cB['text'].'</div>' : '' )
        ,( !empty($return['grid']) ? '<div class="site__grid">'.$return['grid'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>