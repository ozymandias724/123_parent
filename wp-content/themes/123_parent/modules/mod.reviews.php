<?php 
/**
 * Module: Menu
 * 
 * Description:
 *  Concise view w/ link to full view
 */
    // get the gallery page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'reviews'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);

    if( !empty($fields['featured_testimonials']['testimonials']) ){

        $heading = ( !empty( $fields['featured_testimonials']['heading'] ) ? '<h4>'.$fields['featured_testimonials']['heading'].'</h4>' : '');
        $details = ( !empty( $fields['featured_testimonials']['details'] ) ? '<p>'.$fields['featured_testimonials']['details'].'</p>' : '');
        
        $return_testimonials = '
            <section class="mod__testimonials-featuredtestimonial">
                <div>
                    '.$heading.'
                    '.$details.'
                </div>
                <div class="site_grid"><ul>
        ';
        
        $format_testimonial = '
            <li>
                %s
                <h4>%s</h4>
            </li>
        ';

        foreach( $fields['featured_testimonials']['testimonials'] as $testimonial ){

            $testimonial_fields = get_fields($testimonial['testimonial']->ID);

            if( $testimonial_fields['status'] ){ 

                $return_testimonial_content = '';

                switch ( $testimonial_fields['type'] ) {
                    case 'image':
                        $format_testimonial_content = '
                            <div class="image" style="background-image:url(%s)"></div>
                        ';
                        $return_testimonial_content .= sprintf(
                            $format_testimonial_content
                            ,$testimonial_fields['image']['url']
                        );
                        break;
                    case 'video':
                        $format_testimonial_content = '<div class="site_js_video_popup image" style="background-image: url(%s)" data-url="%s"></div>';
                        $return_testimonial_content .= sprintf(
                            $format_testimonial_content
                            ,$testimonial_fields['video_url']
                        );
                        break;
                    case 'text':
                        $format_testimonial_content = '';
                        $return_testimonial_content .= sprintf(
                            $format_testimonial_content
                            ,$testimonial_fields['details']
                        );
                        break;
                    
                    default:
                        # code...
                        break;
                }

                $return_testimonial_content .= '';
                

                $return_testimonials .= sprintf(
                    $format_testimonial
                    ,$return_testimonial_content
                    ,$testimonial['testimonial']->post_title
                );
            }
        }
        $return_testimonials .= '</ul></div>';

        $return_testimonials .= '
            <a href="javascript:;" title="View all testimonial" class="site_button">View All testimonials</a>
            </section>
        ';
    }
    
 ?>
<section id="mod_reviews">
<?php 
    echo get_section_banner($res[0]->post_title);

    echo $return_testimonials;
    
 ?>
</section>
<?php 
 ?>