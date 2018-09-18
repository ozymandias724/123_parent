<?php 
	global $wp_query;
	$original_global = $wp_query;
	$wp_query = null;
	$wp_query = $the_query;

	echo paginate_links(array(
		'prev_text' => '<< Prev',
	));

	wp_reset_postdata();

	$wp_query = $original_global;
 ?>