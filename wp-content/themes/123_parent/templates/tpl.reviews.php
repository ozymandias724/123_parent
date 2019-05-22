<?php 
/**
 * Template Name: Testimonials
 */
    $args_posts = array(
        'posts_per_page' => -1
        ,'post_type' => 'testimonials'
    );

    $res1 = get_posts($args_posts);

    $args_page = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'testimonials'
    );

    $res2 = get_posts($args_page);

    $fields = get_fields($res2[0]);

    function _get_testimonials($fields, $res)
    {
        $format = '
            <section class="mod__testimonials-featuredtestimonial mod__featured_grid">
                <div class="container">
                    %s
                    %s
                </div>
            </section>
        ';
        $return = sprintf(
            $format
            ,_get_header($fields)
            ,_get_body($fields, $res)
        );
        return $return;
    }

    function _get_header($fields)
    {
        $heading = (!empty($fields['featured_testimonials']['heading']) ? $fields['featured_testimonials']['heading'] : '');
        $details = (!empty($fields['featured_testimonials']['details']) ? $fields['featured_testimonials']['details'] : '');
        $format = '<h2>%s</h2><div>%s</div>';
        $return = sprintf(
            $format
            ,$heading
            ,$details
        );
        return $return;
    }

    function _get_body($fields, $res)
    {
        $return = '<div class="site__grid"><ul>';
        $format_text = '
            <li class="testimonial_text">
                <div class="testimonial_content">
                    <div>
                        %s
                        %s
                    </div>
                    %s
                </div>
            </li>
        ';
        $format_image = '
            <li class="testimonial_image">
                %s
                <div class="testimonial_content">
                    <div>
                        %s
                        %s
                    </div>
                    %s
                </div>
            </li>
        ';
        $format_video = '
            <li class="testimonial_video">
                %s
                <div class="testimonial_content">
                    <div class="testimonial_address">
                        %s
                    </div>
                    %s
                </div>
            </li>
        ';
        
        foreach($res as $i => $item)
        {
            $testimonial = get_fields($item->ID);
            
            if($testimonial['status'] && $testimonial['type'] == 'text')
            {
                $return .= sprintf(
                    $format_text
                    ,'<h3>Jane Doe</h3>'
                    ,'<p> - Irvine, CA </p><i class="fas fa-quote-left"></i>'
                    ,(!empty($testimonial['details']) ? $testimonial['details'] : '')
                );
            }
            else if($testimonial['status'] && $testimonial['type'] == 'image')
            {
                $return .= sprintf(
                    $format_image
                    ,(!empty($testimonial['image']) ? '<div class="block" style="background-image:url('.$testimonial['image']['url'].');"></div>' : '')
                    ,'<h3>Jane Doe</h3>'
                    ,'<p> - Irvine, CA </p><i class="fas fa-quote-left"></i>'
                    ,(!empty($testimonial['details']) ? $testimonial['details'] : '')
                );
            }
            else if($testimonial['status'] && $testimonial['type'] == 'video')
            {
                $video_format = '
                    <video> 
                        <source src="%s" type="video/mp4">
                    </video>
                ';
                $video_tag = sprintf(
                    $video_format
                    ,(!empty($testimonial['video_url']) ? $testimonial['video_url'] : '')
                );
                $return .= sprintf(
                    $format_video
                    ,$video_tag
                    ,(!empty($testimonial['details']) ? $testimonial['details'] : '')
                );
            }
        }
        $return .= '</ul></div>';
        return $return;
    }

?>
<?php
    get_header();
    get_hero();
?>
<main class="page__template testimonials_page_template">
<?php
    echo _get_testimonials($fields, $res1);
?>
<?php 
    get_footer();
 ?>