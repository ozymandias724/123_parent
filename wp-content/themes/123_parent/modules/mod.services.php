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
        ,'pagename' => 'services'
    );
    $res = get_posts($args);

    // get the gallery page fields
    $fields = get_fields($res[0]);

    if( !empty($fields['featured_services']['services']) ){

        $heading = ( !empty( $fields['featured_services']['heading'] ) ? '<h2>'.$fields['featured_services']['heading'].'</h2>' : '');
        $details = ( !empty( $fields['featured_services']['details'] ) ? '<div>'.$fields['featured_services']['details'].'</div>' : '');
        
        $return_services = '
            <section class="mod__services-featuredservice mod__featured_grid">
                <div class="container">
                    '.$heading.'
                    '.$details.'
                    <div class="site_grid"><ul> 
        ';
        
        $format_service = '
            <li>
                <h5>%s</h5>
                <div class="site__bgimg site__bgimg--zoom site__bgimg--gradient"><div class="site__bgimg_img block" style="background-image: url(%s)"></div></div>
                <div class="service_details">%s</div>
                <p class="service_price">%s</p>
            </li>
        ';

        foreach( $fields['featured_services']['services'] as $service ){

            $service_fields = get_fields($service['service']->ID);
            
            if( $service_fields['status'] ){ 
                $return_services .= sprintf(
                    $format_service
                    ,$service['service']->post_title 
                    ,$service_fields['image']['url']
                    ,$service_fields['details']
                    ,$service_fields['price']
                );
            }
        }
        $return_services .= '</ul></div>';

        $return_services .= '
            <a href="'.get_permalink($res[0]->ID).'" title="View all services" class="site__button">View All Services</a>
            </div>
            </section>
        ';
    }

 ?>
<section id="mod_services">
<?php 
    echo get_section_banner($res[0]->post_title);

    echo $return_services;
 ?>
</section>
<?php 
 ?>