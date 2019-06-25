<?php 
/**
* Template Name: Testimonials Page
*/
$args = array(
    'post_type' => 'testimonials'
    ,'posts_per_page' => -1
);


$res = get_posts($args);
$fields = get_fields(get_the_ID());


$return = [];
$guide = [];
$guide['grid'] = '';
$return['section'] = '';


$return['grid'] ='<ul class="site__fade site__fade-up square_ul">';


foreach($res as $i => $testimonial){
    
    $testimonial_fields = get_fields($testimonial->ID);

    if( $testimonial_fields['type'] == 'text' ){
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
            ,(!empty($testimonial_fields['image']) ? '<div class="block" style="background-image:url('.$testimonial_fields['image']['url'].');"></div>' : '')
            ,(!empty($testimonial_fields['name']) ? '<h3>'.$testimonial_fields['name'].'</h3>' : '')
            ,(!empty($testimonial_fields['location']) ? '<p>'.$testimonial_fields['location'].'</p>' : '')
            ,(!empty($testimonial_fields['details']) ? $testimonial_fields['details'] : '')
        );    
    }
    else if( $testimonial_fields['type'] == 'image' ){
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
            ,(!empty($testimonial_fields['image']) ? '<div class="block" style="background-image:url('.$testimonial_fields['image']['url'].');"></div>' : '')
            ,(!empty($testimonial_fields['name']) ? '<h3>'.$testimonial_fields['name'].'</h3>' : '')
            ,(!empty($testimonial_fields['location']) ? '<p>'.$testimonial_fields['location'].'</p>' : '')
            ,(!empty($testimonial_fields['details']) ? $testimonial_fields['details'] : '')
        );
    }
    else if( $testimonial_fields['type'] == 'video' ){
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
            ,(!empty($testimonial_fields['video_url']) ? '<a class="video_anchor" href="'.$testimonial_fields['video_url'].'"><div></div></a>' : '')
            ,(!empty($testimonial_fields['name']) ? '<h3>'.$testimonial_fields['name'].'</h3>' : '')
            ,(!empty($testimonial_fields['location']) ? '<p>'.$testimonial_fields['location'].'</p>' : '')
            ,(!empty($testimonial_fields['details']) ? $testimonial_fields['details'] : '')
        );
    }
}

$return['grid'] .= '</ul>';

// empty guide string 
$guide['section'] = '
    <section class="page__template tpl_page_testimonials">
        <div class="container %s">
            %s
            %s
            %s
        </div>
    </section>
';

$return['section'] .= sprintf(
    $guide['section']

    ,( !empty( $fields['width'] ) ? $fields['width'] : '' ) // container width

    ,( !empty($fields['heading']) ? '<h2 class="site__fade site__fade-up block__heading" style="text-align:'.$fields['heading_alignment'].';">'.$fields['heading'].'</h2>' : '' )

    ,( !empty($fields['text']) ? '<div class="site__fade site__fade-up block__details">'.$fields['text'].'</div>' : '' )

    ,( !empty($return['grid']) ? '<div>'.$return['grid'].'</div>' : '' )
);

?>
<?php
    get_header();
?>
<main>
<?php 
    include( get_template_directory() . '/parts/part.hero.php');
    echo $return['section'];
    unset($return, $guide);
?>
<?php 
    get_footer();
 ?>