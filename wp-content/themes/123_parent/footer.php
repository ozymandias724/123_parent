<?php 
/**
 * Part: Footer
 * Description:
 *  logo, company info, address
 *  nav links
 *  payment types
 *  social icoms
 *  badges
 *  copyright section
 */

    function _get_copyright_banner()
    {
        $return = '';
        $field = get_field('footer', 'options');
        if( !empty($field['copyright_banner']) ){
            $format = '
                <div class="site__copyright_banner"><a href="%s" title="%s" target="%s">%s</a></div>
            ';
            $return .= sprintf(
                $format
                ,(!empty($field['copyright_banner']['url']) ? $field['copyright_banner']['url'] : '')
                ,(!empty($field['copyright_banner']['title']) ? $field['copyright_banner']['title'] : '')
                ,(!empty($field['copyright_banner']['target']) ? $field['copyright_banner']['target'] : '')
                ,(!empty($field['copyright_banner']['title']) ? $field['copyright_banner']['title'] : '')
            );
        }
        return $return;
    }

    function _get_badges()
    {
        $return = '';
        $field = get_field('footer', 'options');
        $footer_style = get_field('footer', 'options')['style'];
        if( !empty($field['badges']) ){
            if($footer_style == 'one')
            {
                $return .= '<section class="footer_badges"><h3>Powered By</h3><ul>';
            }
            else
            {
                $return .= '<section class="footer_badges"><ul>';
            }
            $format = '
                <li><a href="%s" title="%s" target="%s"><img src="%s" alt=""></a></li>
            ';
            foreach( $field['badges'] as $badge ){
                $return .= sprintf(
                    $format
                    ,(!empty($badge['link']['url']) ? $badge['link']['url'] : 'javascript:;')
                    ,(!empty($badge['link']['title']) ? $badge['link']['title'] : '')
                    ,(!empty($badge['link']['target']) ? $badge['link']['target'] : '')
                    ,(!empty($badge['image']['url']) ? $badge['image']['url'] : '')
                );
            }
            $return .= '</ul></section>';
        }
        return $return;
    }

    function _get_payment_types()
    {
        $return = '';
        $field = get_field('footer', 'options');
        $footer_style = get_field('footer', 'options')['style'];

        if( !empty($field['payment_types']) ){
            if($footer_style == 'one')
            {
                $return .= '<section class="footer_payment_types"><h3 class="payment_title">Payment</h3><ul>';
            }
            else
            {
                $return .= '<section class="footer_payment_types"><ul>';
            }
            $format = '
                <li><img src="%s" alt=""></li>
            ';
            foreach( $field['payment_types'] as $type ){
                $return .= sprintf(
                    $format
                    ,(!empty($type['image']['url']) ? $type['image']['url'] : '')
                );
            }
            $return .= '</ul></section>';
        }
        return $return;
    }

    function _get_footer_logo(){
        $return = '';
        $field = get_field('footer', 'options');
        if( !empty($field['logo']) )
        {
            $format = '
                <a class="site__footer_logo" href="%s" title="Footer logo button">
                    <div style="background-image:url(%s);"></div>
                </a>
            ';
            $return .= sprintf(
                $format
                ,site_url()
                ,$field['logo']['url']
            );
        }
        return $return;
    }

    function _get_company_info()
    {
        $footer_style = get_field('footer', 'options')['style'];
        $logo = _get_footer_logo();
        $address = (!empty(_get_full_address()) ? '<a class="footer_address" href="javascript:;">'._get_full_address().'</a>': '');
        $phone_number_1 = (!empty(_get_phone_number_1()) ? '<a class="footer_phone_1" href="tel:'._get_phone_number_1().'">P: '._get_phone_number_1().'</a>': '');
        $phone_number_2 =(!empty(_get_phone_number_2()) ? '<a class="footer_phone_2" href="tel:'._get_phone_number_2().'">F: '._get_phone_number_2().'</a>': '');
        $social_icons = _get_social_icons();

        $format_company_info = '
            <section id="footer_company_info">
                %s
                %s
                %s
                %s
                %s
                %s
            </section>
        ';
        if($footer_style == 'one')
        {
            $format = '
                <section id="footer_company_info">
                    %s
                    %s
                    %s
                    %s
                    %s
                </section>
            ';
            $company_info = sprintf(
                $format
                ,$logo
                ,$phone_number_1
                ,$phone_number_2
                ,$address
                ,$social_icons
            );
        }
        else if($footer_style == 'two')
        {
            $format = '
                <section id="footer_company_info">
                    %s
                    %s
                    %s
                    %s
                    %s
                    %s
                </section>
            ';
            $company_info = sprintf(
                $format
                ,$logo
                ,_get_nav()
                ,$social_icons
                ,$address
                ,$phone_number_1
                ,$phone_number_2
            );
        }
        else if($footer_style == 'three')
        {
            $format = '
                <section id="footer_company_info">
                    %s
                    %s
                    %s
                    %s
                    %s
                </section>
            ';
            $company_info = sprintf(
                $format
                ,$logo
                ,_get_nav()
                ,$address
                ,$phone_number_1
                ,$phone_number_2
            );
        }
        return $company_info;
    }

    function _get_nav()
    {
        $footer_style = get_field('footer', 'options')['style'];
        if($footer_style == 'one')
        {
            $format_nav = '
                <section id="footer_nav_section">
                    <h3 class="nav_title">Links</h3>
                    <nav id="footer_nav">
                        %s
                    </nav>
                </section>
            ';
        }
        else
        {
            $format_nav = '
                <section id="footer_nav_section">
                    <nav id="footer_nav">
                        %s
                    </nav>
                </section>
            ';
        }

        if(strlen(_get_site_nav()) > 26)
        {
            $nav = sprintf(
                $format_nav
                ,_get_site_nav()
            );  
        }
        return $nav;
    }

    function _get_footer_content()
    {
        $footer_style = get_field('footer', 'options')['style'];
        if($footer_style == 'one')
        {
            $format_footer_content = '
                <div class="container">
                    %s
                    %s
                    %s
                    %s
                </div>
                <div class="container footer_one_copyright">
                    %s
                </div>
            ';

            $return = sprintf(
                $format_footer_content
                ,_get_company_info()
                ,_get_nav()
                ,_get_payment_types() 
                ,_get_badges()
                ,_get_copyright_banner()
            );
        }
        else if($footer_style == 'two')
        {
            $format_footer_content = '
                <div class="container">
                    %s
                    %s
                    %s
                    %s
                </div>
            ';

            $return = sprintf(
                $format_footer_content
                ,_get_company_info()
                ,_get_copyright_banner()
                ,_get_badges()
                ,_get_payment_types() 
            );

        }
        else if($footer_style == 'three')
        {
            $format_footer_content = '
                <div class="container">
                    %s
                    %s
                    %s
                    <div class="footer_three_last_div">
                        %s
                        <div class="footer_three_social_media">
                            %s
                        </div>
                    </div>
                </div>
            ';

            $return = sprintf(
                $format_footer_content
                ,_get_company_info()
                ,_get_copyright_banner()
                ,_get_badges()
                ,_get_payment_types()
                ,(!empty(_get_social_icons()) ? '<p>Follow Us</p>'._get_social_icons():'')
            );
        }
        return $return;
    }
    
?>
</main>
<footer class="site__fade site__fade-up" id="footer_<?php echo get_field('footer', 'options')['style'] ?>">
<?php 

    echo _get_footer_content();
    
    // live reload script
	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
        ?>
	   	<script src="//localhost:35729/livereload.js"></script>
	   <?php
	}
    wp_footer();
?>
</footer>
</body>
</html>