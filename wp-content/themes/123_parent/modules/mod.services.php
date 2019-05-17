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
        $details = ( !empty( $fields['featured_services']['details'] ) ? $fields['featured_services']['details'] : '');
        
        $return_services = '
            <div class="container">
                <section class="mod__services-featuredservice mod__featured_grid">
                    '.$heading.'
                    '.$details.'
                    <div class="site_grid"><ul> 
        ';
        
        $format_service = '
            <li>
                <a href="%s">
                    <div><div class="block" style="background-image:url(%s);"></div></div>
                    <div>
                        <h5>%s</h5>
                        %s
                        <p class="service_price">%s</p>
                    </div>
                </a>
            </li>
        ';

        foreach( $fields['featured_services']['services'] as $service ){

            $service_fields = get_fields($service['service']->ID);
            
            if( $service_fields['status'] ){ 
                $return_services .= sprintf(
                    $format_service
                    ,get_permalink($service['service']->ID)
                    ,$service_fields['image']['url']
                    ,$service['service']->post_title 
                    ,$service_fields['details']
                    ,(!empty($service_fields['price']) ? '$'.$service_fields['price'] : '')
                );
            }
        }
        $return_services .= '</ul></div>';

        $return_services .= '
            <a href="'.get_permalink($res[0]->ID).'" title="View all services" class="site__button">View All Services</a>
            </section>
            </div>
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