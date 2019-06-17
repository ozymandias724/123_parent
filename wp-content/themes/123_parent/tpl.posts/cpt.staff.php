<?php 
/**
 * Template Name: Staff
 * Template Post Type: staff
 */

    $fields = get_fields($post->ID);  

    if( $fields['status'] ){
        $format_staff = '
            <ul>    
                <li>
                    <div class="image site__bgimg site__bgimg--zoom site__bgimg--gradient"><div style="background-image: url(%s)" class="site__bgimg_img"></div></div>
                </li>
            </ul>
            <div>
                <h3>%s</h3>
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
                <div class="site__grid site__fade site__fade-up">
                    '.$return_staff.'
                </div>
            </div>
        </section>
    ';

    get_header();
?>
<main id="single_about">
<?php 
    echo $return;
    get_footer();
 ?>