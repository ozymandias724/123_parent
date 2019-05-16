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

    function _get_testimonials($fields)
    {
        $format = '
            <div class="container">
                %s
                %s
            </div>
        ';
        $return = sprintf(
            $format
            ,_get_header($fields)
            ,_get_body($fields)
        );
        return $return;
    }

    function _get_header($fields)
    {
        $heading = (!empty($fields['featured_testimonials']['heading']) ? $fields['featured_testimonials']['heading'] : '');
        $details = (!empty($fields['featured_testimonials']['details']) ? $fields['featured_testimonials']['details'] : '');
        $format = '<h2 class="testimonials_header">%s</h2>%s';
        $return = sprintf(
            $format
            ,$heading
            ,$details
        );
        return $return;
    }
    function _get_body($fields)
    {
        $return = '<ul>';
        $format_text = '
            <li class="testimonial_text">
                %s
                %s
            </li>
        ';
        $format_image = '
            <li class="testimonial_image">
                %s
                <div>
                    %s
                    %s
                </div>
            </li>
        ';
        $format_video = '
            <li class="testimonial_video">
                %s
                <div>
                    %s
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
                    ,(!empty($testimonial['details']) ? $testimonial['details'] : '')
                    ,(!empty($testimonial['image']) ? '<h3>'.$item['testimonial']->post_title.'</h3>' : '')
                );
            }
            else if($testimonial['status'] && $testimonial['type'] == 'image')
            {
                $return .= sprintf(
                    $format_image
                    ,(!empty($testimonial['image']) ? '<div class="block" style="background-image:url('.$testimonial['image']['url'].');"></div>' : '')
                    ,(!empty($testimonial['details']) ? $testimonial['details'] : '')
                    ,(!empty($testimonial['image']) ? '<h3>'.$item['testimonial']->post_title.'</h3>' : '')
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
                    ,(!empty($testimonial['image']) ? '<h3>'.$item['testimonial']->post_title.'</h3>' : '')
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
    echo _get_testimonials($fields);
 ?>
</section>
<?php 
 ?>