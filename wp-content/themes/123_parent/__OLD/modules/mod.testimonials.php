<?php 
/**
 * Module: Testimonials
 * 
 * Description:
 *  gravity form call to action
 *  
 */
    // get the contact page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'testimonials'
    );
    $res = get_posts($args);

    // get the contact page fields
    $fields = get_fields($res[0]);

    $company_info = get_field('company_info','options');

    function _get_testimonials($fields, $res)
    {
        $format = '
            <section class="mod__testimonials-featuredtestimonial mod__featured_grid">
                <div class="container">
                    %s
                    %s
                    %s
                </div>
            </section>
        ';
        $return = sprintf(
            $format
            ,_get_header($fields)
            ,_get_body($fields)
            ,'<a href="'.get_permalink($res).'" title="View all Testimonials" class="site__button site__fade site__fade-up">View All Testimonials</a>'
        );
        return $return;
    }

    function _get_header($fields)
    {
        $heading = (!empty($fields['featured_testimonials']['heading']) ? $fields['featured_testimonials']['heading'] : '');
        $details = (!empty($fields['featured_testimonials']['details']) ? $fields['featured_testimonials']['details'] : '');
        $format = '<h2 class="site__fade site__fade-up">%s</h2><div class="site__fade site__fade-up">%s</div>';
        $return = sprintf(
            $format
            ,$heading
            ,$details
        );
        return $return;
    }
    function _get_body($fields)
    {
        $return = '<ul id="slick_slider_testimonials" class="site__fade site__fade-up">';
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
        
        foreach($fields['featured_testimonials']['testimonials'] as $i => $item)
        {
            $testimonial = get_fields($item['testimonial']);
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
        $return .= '</ul>';
        return $return;
    }
 ?>
<section id="mod_testimonials">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo _get_testimonials($fields, $res[0]->ID); 
 ?>
</section>
<?php 
 ?>