<?php 
	// The Blog Sidebar
 ?>
<div class="blog-blog-sidebar">
	
	<div class="blog-blog-sidebar-archive">
		<h3 class="blog-blog-sidebar-header">Archive</h3>
		
		<ul class='blog-blog-sidebar-list'>
			<?php 
				echo wp_get_archives(array(
					'post_type' => 'post',
				    'type' => 'monthly',
				    'echo' => 0,
				    'format' => 'custom',
				    'before' => '<li class="blog-blog-sidebar-list-item">',
				    'after' => '</li>',
				));
			?>
		</ul>

	</div>

	<?php if( !get_field('disable-categories', 'option') ) : ?>
		<div class="blog-blog-sidebar-categories">
			<h3 class="blog-blog-sidebar-header">Categories</h3>
			<ul class="blog-blog-sidebar-list">
				<?php 
					// terms with highest count returned first
					$terms = get_terms(array(
						'taxonomy' => 'category',
						'orderby' => 'count',
						'number' => 5,
						'order' => 'DESC',
					));
					foreach($terms as $term) :
				 ?>
						<li class="blog-blog-sidebar-list-item">
							<a href="<?php echo get_term_link($term, 'category'); ?>" class="blog-blog-sidebar-list-item-link"><?php echo $term->name ?></a>
						</li>								
				<?php
					endforeach;
				?>
			</ul>
		</div>
	<?php endif; ?>


	<div class="blog-blog-sidebar-recentposts">
		<h3 class="blog-blog-sidebar-header">Recent Posts</h3>
		<ul class="blog-blog-sidebar-list">
			<?php 
				$posts = get_posts(array(
					'numposts' => 5,
					'post_type' => 'post',
				)); 
				foreach($posts as $post) :
			?>
				<li class="blog-blog-sidebar-list-item">
					<a href="<?php echo get_the_permalink($post->ID); ?>" class="blog-blog-sidebar-list-item-link"><?php echo $post->post_title ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<a href="#" class="header-content-quickquote blog-blog-sidebar-quickquote estimate-toggle"><?php echo get_field('quickquote-button-text', 'option'); ?></a>
</div>