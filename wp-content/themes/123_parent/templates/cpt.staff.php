<?php 
/**
 * Template Name: Staff
 * Template Post Type: staff
 */

    $fields = get_fields($post->ID);  

    if( $fields['status'] ){
        $format_staff = '
            <li>
                <div class="image site__bgimg site__bgimg--zoom site__bgimg--gradient"><div style="background-image: url(%s)" class="site__bgimg_img"></div></div>
            </li>
            <div>
                <h5>%s</h5>
                %s
            </div>
        ';
        $return_staff = sprintf(
            $format_staff
            ,$fields['image']['url']
            ,$post->post_title
            ,$fields['bio']
        );
    } else {
        $return_staff = '';
    }

    $return = '
        <section class="mod__featured_grid">
            <div class="container">
                <div class="site__grid">
                    <ul>
                        '.$return_staff.'
                    </ul>
                </div>
            </div>
        </section>
    ';

    get_header();
?>
<main class="single__template staff__single__template">
<?php 
    echo $return;
    get_footer();
 ?>