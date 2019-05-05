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

        $heading = ( !empty( $fields['featured_services']['heading'] ) ? '<h4>'.$fields['featured_services']['heading'].'</h4>' : '');
        $details = ( !empty( $fields['featured_services']['details'] ) ? '<p>'.$fields['featured_services']['details'].'</p>' : '');
        
        $return_services = '
            <section class="mod__services-featuredservice">
                <div>
                    '.$heading.'
                    '.$details.'
                </div>
                <div class="site_grid"><ul>
        ';
        
        $format_service = '
            <li>
                <h5>%s</h5>
            </li>
        ';

        foreach( $fields['featured_services']['services'] as $service ){

            $service_fields = get_fields($service['service']->ID);
            
            if( $service_fields['status'] ){ 
                $return_services .= sprintf(
                    $format_service
                    ,$service['service']->post_title
                );
            }
        }
        $return_services .= '</ul></div>';

        $return_services .= '
            <a href="javascript:;" title="View all service" class="site_button">View All Services</a>
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