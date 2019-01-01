<?php 
/**
 * 
 */
?>
<div class="mobileheaderinfo">
    <div class="mobileheaderinfo-grid">
        <div class="mobileheaderinfo-grid-item">
            <div class="mobileheaderinfo-grid-item-left">
                <i class="mobileheaderinfo-grid-item-left-icon fa fa-phone"></i>
            </div>
            <div class="mobileheaderinfo-grid-item-right">
                <a href="tel:<?php echo get_the_phone('tel') ?>"><?php echo get_the_phone(); ?></a>
            </div>
        </div>
        <div class="mobileheaderinfo-grid-item">
            <div class="mobileheaderinfo-grid-item-left">
                <i class="mobileheaderinfo-grid-item-left-icon fa fa-map-marker"></i>
            </div>
            <div class="mobileheaderinfo-grid-item-right">
                <?php echo get_master_address(''); ?>
            </div>
        </div>
    </div>
</div>
<?php 
    if( !get_field('quickquote-disable','options') ) :
 ?>
    <div class="mobileheaderquote">
        <div class="mobileheaderquote-wrapper">
            <div class="mobileheaderquote-wrapper-text"><?php the_field('header-bar-text', 'option') ?></div>
            <div class="mobileheaderquote-wrapper-button estimate-toggle"><?php the_field('quickquote-button-text', 'option'); ?> <i class="fa fa-angle-right"></i></div>
        </div>
    </div>
<?php
    endif;
?>
