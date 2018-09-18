<?php 
	if( Pagedata::is_active_page('blog') ) :
 ?>
 
	<section class="global-recentposts section">
		<h2 class="fade fade-up global-recentposts-header section-header">Featured Posts</h2>
		<?php 

			$_posts = get_field('featured-posts', 'option');
			$posts = [];
			foreach($_posts as $_post){
				$_post = $_post['featured-posts-post'];
				if( !empty($_post) ){
					array_push($posts,$_post);	
				}
			}

			if(!empty($posts)):
		?>
		<div class="global-recentposts-grid">
			<?php foreach($posts as $post): 
			if($post != null):
			?>
			<div class="fade fade-up global-recentposts-grid-item">
				<div class="global-recentposts-grid-item-imagecontainer">
					<img src="<?php echo get_blog_image($post->ID); ?>" class="global-recentposts-grid-item-imagecontainer-image">
				</div>
				<h3 class="global-recentposts-grid-item-header"><?php echo $post->post_title; ?></h3>
				<div class="global-recentposts-grid-item-description"><?php echo wp_trim_words(wp_strip_all_tags($post->post_content), 25); ?></div>
				<a href="<?php echo get_permalink($post->ID); ?>" class="global-recentposts-grid-item-link">read more</a>
			</div>
			<?php else: 

				$used_ids = [];

				foreach($posts as $post){
					if($post != null){
						array_push($used_ids, $post->ID);
					}
				}

				$new_post = get_posts(array(
					'posts_per_page' => 1,
					'post_type' => 'post',
					'post__not_in' => $used_ids,
				))[0]; 


			?>
				<div class="global-recentposts-grid-item">
					<div class="global-recentposts-grid-item-imagecontainer">	
						<img src="<?php echo get_blog_image($new_post->ID); ?>" class="global-recentposts-grid-item-imagecontainer-image">
					</div>
					<h3 class="global-recentposts-grid-item-header"><?php echo $new_post->post_title; ?></h3>
					<div class="global-recentposts-grid-item-description"><?php echo wp_trim_words(wp_strip_all_tags($new_post->post_content), 25); ?></div>
					<a href="<?php echo get_permalink($new_post->ID); ?>" class="global-recentposts-grid-item-link">read more >></a>
				</div>
			<?php 
			endif;
			endforeach; ?>
		</div>
		<?php endif; ?>
		<a href="<?php echo site_url() ?>/blog" class="global-recentposts-viewall button-viewall">view all</a>
	</section>
<?php endif; ?>