<?php 
/**
 * Banner
 */

    function get_section_banner($title, $text){

        $title = ( !empty($title) ) ? $title : $post->post_title;
        $text = ( !empty($text) ) ? $text : '';
        
        $format_banner = '
            <section class="banner">
                %s
                %s
            </section>
        ';
        $return_banner .= sprintf(
            $format_banner
            ,'<h1>'.$title.'</h1>'
            ,( !empty($text) ) ? '<h3>'.$text.'</h3>' : ''
        );
        return $return_banner;
    }
 ?>