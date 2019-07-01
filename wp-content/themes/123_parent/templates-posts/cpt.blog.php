<?php 
/**
 * Template Name: Blog
 * Template Post Type: post
 */

    $fields = get_fields(get_the_ID());

    $return['section'] = '';

    $return['sidebar'] = '';

    //form
    //recent posts links
    //categories links
    //archives links
    $guide['sidebar'] = '
        <div class="post_sidebar">
            %s
            %s
        </div>
    ';

    $search_form = '
        <form role="search" method="get" id="search-form" action="'.esc_url( home_url( '/' ) ).'">
            <div class="search-wrap">
                <input type="search" name="s" id="search-input" value="'.esc_attr( get_search_query() ).'" />
                <button class="screen-reader-text type="submit" id="search-submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    ';
    
    $guide['section'] = '
        <div class="image site__bgimg_img" style="background-image:url(%s);"></div>
        <div class="post__content">
            <h2>%s</h2>
            <div class="post__meta">%s %s %s</div>
            <div class="post__details">%s</div>
        </div>
    ';
    
    $return['categories'] = '<ul>';

    foreach( get_the_category() as $i => $category ){
        $return['categories'] .= '<li><a href="'.get_category_link($category).'">'.$category->name.'</a></li>';
    }

    $return['categories'] .= '</ul>';

    $return['recent_posts'] = '<ul>';

    $recent_posts = wp_get_recent_posts(
        array(
            'numberposts' => 5
            ,'post_type' => 'post'
            ,'post_status' => 'publish'
        )
    );

    // foreach( $recent_posts as $i => $recent_post ){
    //     $return['recent_posts'] .= '<li><a href="'..'">'..'</a></li>'
    // }

    $return['recent_posts'] .= '</ul>';

    if( $fields['status'] ){

        $return['section'] .= sprintf(
            $guide['section']
            ,(!empty($fields['featured_image']['url']) ? $fields['featured_image']['url']: '')
            ,$post->post_title
            ,get_the_date()
            ,$return['categories']
            ,( get_comments_number() == 1 ? get_comments_number() . ' Comment' : get_comments_number() . ' Comments')
            ,(!empty($fields['details'])? $fields['details'] : '' )
        );

        $return['sidebar'] .= sprintf(
            $guide['sidebar']
            ,$search_form
            ,$return['recent_posts']
        );

    }

    $content = '
        <section class="mod__featured_grid">
            <div class="container">
                <div class="site__fade site__fade-up">';

    get_header();
?>
<main id="cpt_page_blog">
<?php 

    echo $content;
    echo $return['section'];

    comment_form(
        array(
            'title_reply' => __('Leave A Comment')
            ,'label_submit' => __( 'Submit Comment' ) 
            ,'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="15" aria-required="true"></textarea></p>'
        )
    );

    echo '
                </div>
                '.$return['sidebar'].'
            </div>
        </section>
    ';

    get_footer();
 ?>