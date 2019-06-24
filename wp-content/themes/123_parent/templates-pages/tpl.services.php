<?php 
/**
* Template Name: Services
*/
$args = array(
    'post_type' => 'services',
    'posts_per_page' => -1,
);


$res = get_posts($args);
$fields = get_fields(get_the_ID());


$return = [];
$return['section'] = '';
$guide = [];
$guide['services'] = '';

$return['services'] = '<ul>';


foreach($res as $i => $service){
    $service_fields = get_fields($service->ID);
    if( $fields['style'] == 'one' ){
        $guide['services'] = '
            <li>
                <a href="%s">
                    <div><div class="image '.( ($fields['style'] == 'one') ? 'less_size_block' : '').'" style="background-image:url(%s);"></div></div>
                    <div>
                        %s 
                        <div class="service__details block__item-body">%s</div>
                        <p class="service_price">%s</p>
                    </div>
                </a>
            </li>
        ';
        if( $service_fields['status'] ){
            $return['services'] .= sprintf(
                $guide['services']
                ,get_permalink($service->ID)
                ,( !empty($service_fields['image']['url']) ? $service_fields['image']['url'] : '')
                ,( !empty($service->post_title) ? '<h3>'.$service->post_title.'</h3>' : '')
                ,( !empty($service_fields['details']) ? $service_fields['details'] : '')
                ,( !empty($service_fields['price']) ? '$'.$service_fields['price'] : '')
            );
        }
    }else if( $fields['style'] == 'two' || $fields['style'] == 'three' ){
        if($i % 2 == 0){
            $guide['services'] = '
                <li>
                    <a href="%s">
                        <div><div class="image '.( ($fields['style'] == 'one') ? 'less_size_block' : '').'" style="background-image:url(%s);"></div></div>
                        <div>
                            %s 
                            <div class="service__details block__item-body">%s</div>
                        </div>
                    </a>
                </li>
            ';
            if( $service_fields['status'] ){ 
                $return['services'] .= sprintf(
                    $guide['services']
                    ,get_permalink($service->ID)
                    ,(!empty($service_fields['image']['url']) ? $service_fields['image']['url'] : '')
                    ,( !empty($service->post_title) ? '<h3><span>'.$service->post_title.'</span><span>'.(!empty($service_fields['price']) ? '$'.$service_fields['price'] : '').'</span></h3>' : '' )
                    ,(!empty($service_fields['details']) ? $service_fields['details'] : '')
                );
            }
        }else{
            $guide['services'] = '
                <li>
                    <a href="%s">
                        <div>
                            %s 
                            <div class="service__details block__item-body">%s</div>
                        </div>
                        <div><div class="image '.( ($fields['style'] == 'one') ? 'less_size_block' : '').'" style="background-image:url(%s);"></div></div>
                    </a>
                </li>
            ';
            if( $service_fields['status'] ){ 
                $return['services'] .= sprintf(
                    $guide['services']
                    ,get_permalink($service->ID)
                    ,( !empty($service->post_title) ? '<h3><span>'.$service->post_title.'</span><span>'.(!empty($service_fields['price']) ? '$'.$service_fields['price'] : '').'</span></h3>' : '' )
                    ,(!empty($service_fields['details']) ? $service_fields['details'] : '')
                    ,(!empty($service_fields['image']['url']) ? $service_fields['image']['url'] : '')
                );
            }
        }
    }
}

$return['services'] .= '</ul>';

// empty guide string 
$guide['section'] = '
    <section class="page__template tpl_page_service">
        <div class="container %s services__%s">
            %s
            %s
            %s
        </div>
    </section>
';

$return['section'] .= sprintf(
    $guide['section']

    ,( !empty( $fields['width'] ) ? $fields['width'] : '' )    // container width                                                    
    ,( !empty( $fields['style']) ? $fields['style'] : '')                                                     
    ,( !empty($fields['heading']) ? '<h2 class="block__heading" style="text-align:'.$fields['heading_alignment'].';">'.$fields['heading'].'</h2>' : '' )

    ,( !empty($fields['text']) ? '<div class="block__details">'.$fields['text'].'</div>' : '' )

    ,( !empty($return['services']) ? '<div '.( ($fields['style'] == 'one') ? 'class="site__grid"' : '').'>'.$return['services'].'</div>' : '' )
);

?>
<?php
    get_header();
?>
<main>
<?php 
    include( get_template_directory() . '/parts/part.hero.php');
    echo $return['section'];
?>
<?php 
    get_footer();
 ?>