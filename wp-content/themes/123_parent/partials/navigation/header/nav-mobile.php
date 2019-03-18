<?php 

    $format_nav_mobile = '
        <header class="%s %s mobileheader" id="theme_name_maybe">
            <div>
                %s
                <a href="javascript:;">
                    <span></span>
                    <span></span>
                    <span></span> 
                </a>
            </div>
            <div>
                <nav>
                    %s
                </nav>
                <div>
                    <a href="%s">%s</a>
                </div>
                %s
            </div>      
            <span class="mobileheader-tint--bg"></span>
            <span class="mobileheader-tint"></span>
        </header>
    ';
    
    $content_nav_mobile = sprintf(
        $format_nav_mobile
        ,$fadenav
        ,$invertlogo
        ,$content_logo
        ,NavUtil::get_nav_links()
        ,$num_href
        ,$num_display
        ,$content_social_icons
    );

    echo $content_nav_mobile;    
 ?>