<?php 
/**
 * Services Block
 * 
 */
    // empty return string
    $return['testimonials_block'] = '';
    $guide['testimonials_block'] = '';

    $guide['grid'] = '';
    
    $return['grid'] ='<ul class="site__fade site__fade-up square_ul">';

    foreach($cB['testimonials'] as $i => $testimonial){
        
        $fields = get_fields($testimonial['testimonial']->ID);

        if( $fields['type'] == 'text' ){
            $guide['grid'] = '
                <li class="testimonial_text">
                    <div>
                        %s
                        <div class="testimonial_content">
                            <div class="testimonial_name">
                                %s
                                %s
                            </div>
                            <div class="testimonial_details block__item-body">%s</div>
                        </div>
                    </div>
                </li>
            ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,(!empty($fields['image']) ? '<div class="block" style="background-image:url('.$fields['image']['url'].');"></div>' : '')
                ,(!empty($fields['name']) ? '<h3>'.$fields['name'].'</h3>' : '')
                ,(!empty($fields['location']) ? '<p>'.$fields['location'].'</p>' : '')
                ,(!empty($fields['details']) ? $fields['details'] : '')
            );    
        }
        else if( $fields['type'] == 'image' ){
            $guide['grid'] = '
                <li class="testimonial_image">
                    <div>
                        %s
                        <div class="testimonial_content">
                            <div class="testimonial_name">
                                %s
                                %s
                            </div>
                            <div class="testimonial_details block__item-body">%s</div>
                        </div>
                    </div>
                </li>
            ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,(!empty($fields['image']) ? '<div class="block" style="background-image:url('.$fields['image']['url'].');"></div>' : '')
                ,(!empty($fields['name']) ? '<h3>'.$fields['name'].'</h3>' : '')
                ,(!empty($fields['location']) ? '<p>'.$fields['location'].'</p>' : '')
                ,(!empty($fields['details']) ? $fields['details'] : '')
            );
        }
        else if( $fields['type'] == 'video' ){
            $guide['grid'] = '
                <li class="testimonial_video">
                    <div>
                        %s
                        <div class="testimonial_content">
                            <div class="testimonial_name">
                                %s
                                %s
                            </div>
                            <div class="testimonial_details block__item-body">%s</div>
                        </div>
                    </div>
                </li>
            ';
            $return['grid'] .= sprintf(
                $guide['grid']
                ,(!empty($fields['video_file']['url']) ? '<video controls><source src="'.$fields['video_file']['url'].'"type="video/mp4"></video>' : '')
                ,(!empty($fields['name']) ? '<h3>'.$fields['name'].'</h3>' : '')
                ,(!empty($fields['location']) ? '<p>'.$fields['location'].'</p>' : '')
                ,(!empty($fields['details']) ? $fields['details'] : '')
            );
        }
    }

    $return['grid'] .= '</ul>';

    // empty guide string 
    $guide['testimonials_block'] = '
        <section class="site__block block__testimonials">
            <div class="container %s">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';

    $return['testimonials_block'] .= sprintf(
        $guide['testimonials_block']
        ,( !empty($cB['width']) ? $cB['width'] : '')                                                         // container width
        ,( !empty($cB['heading']) ? '<h3>' . $cB['heading'] . '</h3>' : '')
        ,( !empty($cB['sub_heading']) ? '<div>' . $cB['sub_heading'] . '</div>' : '')
        ,( !empty($return['grid']) ? '<div class="site__grid">'.$return['grid'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );

    // echo return string
    echo $return['testimonials_block'];

?>