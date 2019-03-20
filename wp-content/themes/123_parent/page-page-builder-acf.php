<?php
/*
Template Name: Page Builder ACF
*/

get_header(); ?>

<?php //$page_builder_layout = get_field('layout'); 
    //var_dump($page_builder_layout);
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php
// check if the flexible content field has rows of data
if( have_rows('layout') ):?>
    <!--	// loop through the rows of data-->
	<?php  while ( have_rows('layout') ) : the_row();?>
        <?php if( get_row_layout() == '1_column' ):?>
            <section class="section headline-content">
                <div class="grid-container">
                  <div class="grid-x grid-margin-x">
                     <div class="large-12 cell">
                         <h2 class="
                           <?php if( get_sub_field('center_headline') == true ) { echo 'text-center'; }?> ">
                             <?php echo get_sub_field('headline');?>
                         </h2>
                         <?php echo get_sub_field('column_1');?>
                     </div>
                  </div>
                </div>
            </section>
        <?php elseif( get_row_layout() == '2_column' ):?>
            <section class="section headline-content">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="large-12 cell">
                            <h2 class="
                           <?php if( get_sub_field('center_headline') == true ) { echo 'text-center'; }?> ">
								<?php echo get_sub_field('headline');?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="large-6 cell">
	                        <?php echo get_sub_field('column_1');?>
                        </div>
                        <div class="large-6 cell">
		                    <?php echo get_sub_field('column_2');?>
                        </div>
                    </div>
                </div>

            </section>
		<?php elseif( get_row_layout() == '3_column' ):?>
            <section class="section headline-content">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="large-12 cell">
                            <h2 class="
                           <?php if( get_sub_field('center_headline') == true ) { echo 'text-center'; }?> ">
								<?php echo get_sub_field('headline');?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="large-4 cell">
							<?php echo get_sub_field('column_1');?>
                        </div>
                        <div class="large-4 cell">
							<?php echo get_sub_field('column_2');?>
                        </div>
                        <div class="large-4 cell">
		                    <?php echo get_sub_field('column_3');?>
                        </div>
                    </div>
                </div>

            </section>
		<?php elseif( get_row_layout() == '4_column' ):?>
            <section class="section headline-content">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="large-12 cell">
                            <h2 class="
                           <?php if( get_sub_field('center_headline') == true ) { echo 'text-center'; }?> ">
								<?php echo get_sub_field('headline');?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="large-3 cell">
							<?php echo get_sub_field('column_1');?>
                        </div>
                        <div class="large-3 cell">
							<?php echo get_sub_field('column_2');?>
                        </div>
                        <div class="large-3 cell">
							<?php echo get_sub_field('column_3');?>
                        </div>
                        <div class="large-3 cell">
		                    <?php echo get_sub_field('column_4');?>
                        </div>
                    </div>
                </div>

            </section>
		<?php elseif( get_row_layout() == 'featured_services' ):?>

    <section class="section services">
      <div class="row">
					<?php
					if( have_rows('featured_services') ):
						$count = 0;
						while ( have_rows('featured_services') ) : the_row();
							//odd & even styling
							$oe_style = ++$count % 2 ? "odd" : "even";?>
                            <div class="large-6 medium-6 small-12 columns fh5co-feature-border
							<?php if( get_sub_field('right_border') == true ) { echo 'no-right-border'; }?> <?php
							echo
							$oe_style?>">
              <div class="fh5co-feature <?php if( get_sub_field('bottom_border') == true ) { echo 'no-bottom-border'; }?>">
                <div class="fh5co-feature-icon to-animate bounceIn animated">
										<?php $icon = get_sub_field( 'icon' );
										if ( !empty( $icon ) ):
											$url = $icon['url'] ;
											$ext = pathinfo( $url, PATHINFO_EXTENSION ); ?>
											<?php
											if ( $ext == 'svg' ):
												echo file_get_contents( $url ) ;
											// Non SVG Fallback
											else: ?>
                       <img src="<?php echo $url; ?>"> <?php
											endif; ?>
										<?php endif;?>
                 </div>
                    <div class="fh5co-feature-text">
                      <h3><?php echo get_sub_field('name');?></h3>
                      <p><?php echo get_sub_field('description');?><p><a href="#">Read more</a></p>
                    </div>
                  </div>￼
              </div>
						<?php
						endwhile;
					endif;
					?>
      </div>
 </section>
 <?php endif;?>
<?php endwhile;?>

<?php else :?>

    <!--	// no layouts found-->

<?php endif;?> 
                </main>
            </div>

</div><!-- .content-area -->

<?php get_footer(); ?>
