<?php 
/**
 * Module: Contact
 * 
 * Description:
 *  gravity form call to action
 *  
 */
    // get the contact page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'contact'
    );
    $res = get_posts($args);

    // get the contact page fields
    $fields = get_fields($res[0]);
    $company_info = get_field('company_info','options');

    

 ?>
<section id="mod_contact">
<?php 
    echo get_section_banner($res[0]->post_title);

    if( !empty($fields['content_blocks']) ){
        foreach ($fields['content_blocks'] as $i => $cB) {
            include( get_template_directory() . '/modules/sub-modules/mod.'.$cB['acf_fc_layout'].'.php');
        }
    }
 ?>
</section>
<?php 
 ?>