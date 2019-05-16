<?php 
/**
 * Module: Blog
 * 
 * Description:
 *  3x3 grid of blog posts
 *      share this to social media icons (company level)
 *      posted on
 *  view all button
 *  
 * 
 */
    // get the blog page object
    $args = array(
        'posts_per_page' => 1
        ,'post_type' => 'page'
        ,'pagename' => 'blog' 
    );
    $res = get_posts($args);

    // get the blog page fields
    $fields = get_fields($res[0]);

    if( !empty($fields['featured_posts']['posts']) ){

        $heading = ( !empty( $fields['featured_posts']['heading'] ) ? '<h2>'.$fields['featured_posts']['heading'].'</h2>' : '');
        $details = ( !empty( $fields['featured_posts']['details'] ) ? $fields['featured_posts']['details'] : '');
        
        $return_posts = '
            <div class="container">
                <section class="mod__blog-featuredposts">
                    <div>
                        '.$heading.'
                        '.$details.'
                    </div>
                    <div class="site_grid"><ul>
        ';
        
        $format_post = '
            <li>
                <a href="%s">
                    <div class="site__bgimg site__bgimg--zoom"><div class="block" style="background-image: url(%s)"></div></div>
                    <div>
                        <a href="%s"><h5>%s</h5></a>
                        %s
                    </div>
                </a>
            </li>
        ';

        foreach( $fields['featured_posts']['posts'] as $post ){

            $post_fields = get_fields($post['post']->ID);
            
            if( $post_fields['status'] ){
                $return_posts .= sprintf(
                    $format_post
                    ,get_post_permalink($post['post'])
                    ,$post_fields['featured_image']['url']
                    ,get_post_permalink($post['post'])
                    ,$post['post']->post_title
                    ,(!empty($post_fields['excerpt']) ? $post_fields['excerpt'] : '')
                );
            }
        }
        $return_posts .= '</ul></div>';

        $return_posts .= '
            <a href="'.get_permalink($res[0]->ID).'" title="View all blog posts" class="site__button">View All</a>
            </section></div>
        ';
    }

    
    
 ?>
<section id="mod_blog">
<?php 
    echo get_section_banner($res[0]->post_title);
    echo $return_posts;
 ?>
</section>
<?php 
 ?>