<?php 
/**
 * Banner
 */
$format_banner = '
    <section class="banner">
        <h1>%s</h1>
	</section>
';
$return_banner .= sprintf(
    $format_banner
    ,$post->post_title
);
echo $return_banner;
 ?>