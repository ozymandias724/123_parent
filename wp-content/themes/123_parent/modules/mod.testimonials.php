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
            <div id="container">
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
        $format = '<p>%s</p>%s';
        $return = sprintf(
            $format
            ,$heading
            ,$details
        );
        return $return;
    }
    function _get_body($fields)
    {
        
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