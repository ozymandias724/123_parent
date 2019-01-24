<?php 
/**
 * "Super header" partial rewrite
 *  cleaner, less class reliant, rigid structure
 */
    // $addr = get_the_address(); // supposedly depricated
    $addr = get_master_address(); // supposedly easy to format (test plz)
    $addr = str_replace('<br>', ' - ', $addr);
    $gmap_query = '#'; // simple href to search for the addr
    $num_display = get_the_phone();
    $num_href = get_the_phone('tel');

    $content_quotebtn = '';
    if(!get_field('quickquote-disable', 'option')){
        $format_quotebtn = '
            <a href="#" class="topbanner-quickquote">
                <span>%s</span>
                <i class="fa fa-angle-right"></i>
            </a>
        ';
        $content_quotebtn = sprintf(
            $format_quotebtn
            ,get_field('quickquote-button-text', 'option')
        );
    }
    $format_socialtopbar = '
        <div id="opt__topbanner">
            <a href="%s" alt=""><i class="fa fa-map-marker"></i>
                <span>%s</span>
            </a>
            <a href="%s">
                <i class="fa fa-phone"></i>
                <span>%s</span>
            </a>
            %s
        </div>
    ';
    $content_socialtopbar = sprintf(
        $format_socialtopbar
        ,$gmap_query
        ,$addr
        ,$num_href
        ,$num_display
        ,$content_quotebtn
    );
?>
<header class="header">
    <div class="header-content">
        <?php echo $content_socialtopbar; ?>
    </div>
</header>