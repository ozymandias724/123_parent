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
        if( !empty($field['badges']) ){
            $return .= '<section class="footer_badges"><ul>';
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
        if( !empty($field['payment_types']) ){
            $return .= '<section class="footer_payment_types"><ul>';
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

    function _get_company_info()
    {
        $logo = _get_site_logo();
        $address = (!empty(_get_full_address_br()) ? '<a class="footer_address" href="javascript:;">'._get_full_address_br().'</a>': '');
        $phone_number_1 = (!empty(_get_phone_number_1()) ? '<a class="footer_phone_1" href="tel:'._get_phone_number_1().'">'._get_phone_number_1().'</a>': '');
        $phone_number_2 =(!empty(_get_phone_number_2()) ? '<a class="footer_phone_2" href="tel:'._get_phone_number_2().'">'._get_phone_number_2().'</a>': '');
        $social_icons = _get_social_icons();

        $format_company_info = '
            <section id="footer_company_info">
                %s
                %s
                %s
                %s
                %s
            </section>
        ';
        $company_info = sprintf(
            $format_company_info
            ,$logo
            ,$address
            ,$phone_number_1
            ,$phone_number_2
            ,$social_icons
        );
        return $company_info;
    }

    function _get_nav()
    {
        $format_nav = '
            <section>
                %s
                <nav id="footer_nav">
                    %s
                </nav>
            </section>
        ';
        $nav = sprintf(
            $format_nav
            ,'<h3>Links</h3>'
            ,_get_site_nav()
        );
        return $nav;
    }

    function _get_footer_content()
    {
        $format_footer_content = '
            <div class="container">
                %s
                %s
                %s
                %s
            </div>
                %s
        ';

        $footer_content = sprintf(
            $format_footer_content
            ,_get_company_info()
            ,_get_nav()
            ,_get_payment_types()
            ,_get_badges()
            ,_get_copyright_banner()
        );
        
        return $footer_content;
    }
    
?>
</main>
<footer>
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