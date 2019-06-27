<?php 
/**
* Template Name: About Page
*/
$args = array(
    'post_type' => 'staff'
    ,'posts_per_page' => -1
);


$res = get_posts($args);
$fields = get_fields(get_the_ID());


$return['section'] = '';


if( !empty($res) ){
    $return['staff'] = '<ul>';

    foreach($res as $i => $staff_member){
        $staff_fields = get_fields($staff_member->ID);

        $social_media = '';

        if( !empty($staff_fields['social_media']) ){
            $social_media .= '<ul class="site__social-media">';
            $social_format = '
                <li>
                    <a href="%s" title="%s" target="_blank">
                        %s
                    </a>
                </li>
            ';
            foreach( $staff_fields['social_media']['icons'] as $j => $social_icon ){
                $img = $social_icon['image'];
                $fa = $social_icon['icon'];
                $url = ( !empty($social_icon['link']['url']) ? $social_icon['link']['url'] : '');
                $title = ( !empty($social_icon['link']['title']) ? $social_icon['link']['title'] : '');
                if( !empty($social_icon['image']) ){
                    $social_media .= sprintf(
                        $social_format
                        ,$url
                        ,$title
                        ,( !empty($img['url']) ? '<img src="'.$img['url'].'"/>' : '')
                    );
                }else if( !empty($social_icon['icon']) ){
                    $social_media .= sprintf(
                        $social_format
                        ,$url
                        ,$title
                        ,( !empty($fa) ? $fa : '')
                    );
                }else{
                    $social_media = '';
                }
            }
            $social_media .= '</ul>';
        }
        if( $fields['style'] == 'one' ){
            $guide['staff'] = '
                <li class="site__fade site__fade-up">
                    <a href="%s">
                        <div class="staff__image">
                            <div class="image less_size_block site__bgimg_img" style="background-image:url(%s);"></div>
                        </div>
                        <div class="staff__content">
                            <h3>%s</h3>
                            <div class="staff__details block__item-body">%s</div>
                        </div>
                    </a>
                    <div class="staff__social">%s</div>
                </li>
            ';

            $return['staff'] .= sprintf(
                $guide['staff']
                ,get_permalink( $staff_member->ID)
                ,( !empty($staff_fields['image']['url']) ? $staff_fields['image']['url'] : '')
                ,$staff_member->post_title
                ,( !empty($staff_fields['short_bio']) ? $staff_fields['short_bio'] : '')
                ,$social_media
            );
        }else if( $fields['style'] == 'two' ){
            // style two grid guide string
            $guide['staff'] = '
                <li class="site__fade site__fade-up">
                    <a href="%s">
                        <div class="staff__image">
                            <div class="image site__bgimg_img" style="background-image:url(%s);"></div>
                        </div>
                    </a>
                    <div class="staff__details block__item-body">%s</div>
                </li>
            ';

            // write to return string
            $return['staff'] .= sprintf(
                $guide['staff']
                ,get_permalink($staff_member->ID)
                ,( !empty($staff_fields['image']['url'] )? $staff_fields['image']['url'] : '' )
                ,( !empty($staff_fields['full_bio']) ? $staff_fields['full_bio'] : '' )
            );
        }
    }
    $return['staff'] .= '</ul>';

    // empty guide string 
    $guide['section'] = '
        <section class="page__template tpl_page_about">
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

        ,( !empty($fields['heading']) ? '<h2 class="block__heading" style="text-align:'.$fields['heading_alignment'].';">'.$fields['heading'].'</h2>' : '' )

        ,( !empty($fields['text']) ? '<div class="block__details">'.$fields['text'].'</div>' : '' )
        
        ,( !empty($return['staff']) ? '<div class="'.( ($fields['style'] == 'one')? 'staff__'.$fields['style'] .' site__grid' : 'staff__'.$fields['style']) .'">'.$return['staff'].'</div>' : '' )
    );
}

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