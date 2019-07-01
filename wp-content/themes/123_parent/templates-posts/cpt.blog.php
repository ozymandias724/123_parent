<?php 
/**
 * Template Name: Blog
 * Template Post Type: post
 */
    $fields = get_fields(get_the_ID());

    $return['section'] = '';
    $return['sidebar'] = '';
    $return['recent_posts'] = '';
    $return['categories'] = '';
    $return['archives'] = '';
    
    $guide['section'] = '
        <div class="image site__bgimg_img" style="background-image:url(%s);"></div>
        <div class="post__content">
            <h2>%s</h2>
            <div class="post__meta">%s %s %s</div>
            <div class="post__details">%s</div>
        </div>
    ';
    
    $return['post_categories'] = '<ul class="border__right">';

    foreach( get_the_category() as $i => $category ){
        $return['post_categories'] .= '<li><a href="'.get_category_link($category).'">'.$category->name.'</a></li>';
    }

    $return['post_categories'] .= '</ul>';

    $guide['sidebar'] = '
        <div class="post_sidebar">
            %s
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

    $recent_posts = wp_get_recent_posts(
        array(
            'numberposts' => 5
            ,'post_type' => 'post'
            ,'post_status' => 'publish'
        )
    );

    if( !empty($recent_posts) ){
        $return['recent_posts'] = '<ul>';
    
        foreach( $recent_posts as $i => $recent_post ){
            $return['recent_posts'] .= '<li><a href="'.get_permalink($recent_post['ID']).'">'.$recent_post['post_title'].'</a></li>';
        }
    
        $return['recent_posts'] .= '</ul>';
    }

    $categories = get_categories(
        array(
            'number' => 5
        )
    );

    if( !empty($categories) ){
        $return['categories'] = '<ul>';
    
        foreach( $categories as $i => $category ){
            $return['categories'] .= '<li><a href="'.get_category_link($category).'">'.$category->name.'</a></li>';
        }
    
        $return['categories'] .= '</ul>';
    }

    // $return['archives'] = '<ul>';

    // $archives = wp_get_archives(
    //     array(
    //         'limit' => 5
    //     )
    // );

    // foreach( $archives as $i => $archive ){
    //     $return['archives'] .= '<li><a href="'.get_post_type_archive_link($archive).'">'.$archive->name.'</a></li>';
    // }

    // $return['archives'] .= '</ul>';

    if( $fields['status'] ){

        $return['section'] .= sprintf(
            $guide['section']
            ,( !empty($fields['featured_image']['url']) ? $fields['featured_image']['url']: '')
            ,$post->post_title
            ,'<p class="border__right">Posted: '.get_the_date().'</p>'
            ,$return['post_categories']
            ,'<p class="border__right">'.( get_comments_number() == 1 ? get_comments_number() . ' Comment' : get_comments_number() . ' Comments').'</p>'
            ,( !empty($fields['details'])? $fields['details'] : '' )
        );

        $return['sidebar'] .= sprintf(
            $guide['sidebar']
            ,'<div><p>Search</p>'.$search_form.'</div>'
            ,( !empty($return['recent_posts']) ? '<div><p>Recent Posts</p>'.$return['recent_posts'].'</div>' : '')
            ,( !empty($return['categories']) ? '<div><p>Categories</p>'.$return['categories'].'</div>' : '')
            ,( !empty($return['archives']) ? '<div><p>Archives</p>'.$return['archives'].'</div>' : '')
        );

    }

    $content = '
        <section class="mod__featured_grid">
            <div class="container">
                <div class="site__fade site__fade-up">
    ';

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
            ,'comment_field' => '
                <p class="comment-form-comment">
                    <textarea id="comment" name="comment" cols="10" rows="15" aria-required="true"></textarea>
                </p>'
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