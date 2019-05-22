<?php 
/**
 * Template Name: Testimonial
 * Template Post Type: testimonials
 */

function _get_testimonial($fields)
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
    
        $testimonial = get_fields($post->ID);
        
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
    $return .= '</ul></div>';
    return $return;
}
    get_header();
?>
<main class="single__template testimonial__single__template site__fade site__fade-up">
<?php
    echo _get_testimonial($fields);
?>
<?php 
    get_footer();
 ?>