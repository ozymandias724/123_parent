<?php 
/**
 * coupons Block
 * 
 */
    // empty return string
    $return = [];
    $guide = [];

    $return['posts'] ='<ul>';
    
    $guide['posts'] = '
        <li class="site__fade site__fade-up">
            <a href="%s">
                <div class="image" style="background-image: url(%s)"></div>
                <div class="blog_item_content">
                    <h5>%s</h5>
                    <div class="blog_item_excerpt">%s</div>
                    <p class="blog_item_read_more">Read More</p>
                </div>
            </a>
        </li>
    ';
    
    foreach($cB['blog_posts'] as $i => $post) {
        
        $fields = get_fields($post['post']->ID);
            
        if( $fields['status'] ){
            $return['posts'] .= sprintf(
                $guide['posts']
                ,get_post_permalink($post['post'])
                ,$fields['featured_image']['url']
                ,$post['post']->post_title
                ,(!empty($fields['excerpt']) ? $fields['excerpt'] : '')
            );
        }
    }
    $return['posts'] .= '</ul>';

    
    // empty guide string 
    $guide['section'] = '
        <section id="block__services" class="site__block">
            <div class="container %s %s" style="%s %s">
                %s
                %s
                %s
                %s
            </div>
        </section>
    ';

    $return['section'] .= sprintf(
        $guide['section']
        ,( !empty( $cB['width'] ) ? $cB['width'] : '' )                                                         // container width
        ,( !empty( $cB['background_color'] ) ? 'hasbg' :'' )                                                    // container has bg color class
        ,( !empty( $cB['background_color'] ) ? 'background-color:'.$cB['background_color'].';' : '' )           // container bg color style
        ,( !empty( $cB['foreground_color'] ) ? 'color:'.$cB['foreground_color'].';' : '' )           // container bg color style
        ,( !empty($cB['heading']) ? '<h2>'.$cB['heading'].'</h2>' : '' )
        ,( !empty($cB['text']) ? '<div>'.$cB['text'].'</div>' : '' )
        ,( !empty($return['posts']) ? '<div class="site__grid">'.$return['posts'].'</div>' : '' )
        ,( !empty($cB['view_all_button']['link']) ? '<a class="site__button" href="'.$cB['view_all_button']['link']['url'].'">'.$cB['view_all_button']['link']['title'].'</a>' : '' )
    );


    // echo return string
    echo $return['section'];

    // clear the $cB, $return, $index and $guide vars for the next block
    unset($cB, $return, $guide);
 ?>