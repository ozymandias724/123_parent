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
        $footer_info = get_field('footer', 'options');
        $banner = $footer_info['copyright_banner'];
        $terms = $banner['terms_and_conditions'];

        $copyright_text = (!empty($banner['copyright']) ? $banner['copyright'] : '');
        $terms_url = (!empty($terms['url']) ? $terms['url'] : ''); 
        $terms_title = (!empty($terms['title']) ? $terms['title'] : '');
        $terms_target = (!empty($terms['target']) ? $terms['target'] : ''); 

        $format_url = '<a href="%s" target="%s">%s</a>';

        $url = sprintf(
            $format_url
            ,$terms_url
            ,$terms_target
            ,$terms_title
        );

        $format_copyright = '<p>%s</p>';

        $copyright = sprintf(
            $format_copyright
            ,$copyright_text
        );

        $format_banner = '
            <div id="copyright_banner">
                %s
                %s
            </div>
        ';

        $copyright_banner = sprintf(
            $format_banner
            ,$url
            ,$copyright
        );

        return $copyright_banner; 
    }

    function _get_badges()
    {
        $footer_info = get_field('footer', 'options');
        $badges_info = $footer_info['badges'];

        $format_badges = '
            <div id="footer_badges">
                %s
                %s
            </div>
        ';

        $format_badge = '
            <li>
                <a href="%s"><div style="background-image:url(%s);"></div></a>
            </li>
        ';

        $badges_ul = '<ul>';
        
        foreach($badges_info as $badge_info)
        {
            $title = '<h3>Powered by</h3>';
            $url = (!empty($badge_info['url']) ? $badge_info['url'] : '');
            $image_url = (!empty($badge_info['image']['url']) ? $badge_info['image']['url'] : '');
            $badge = sprintf(
                $format_badge
                ,$url
                ,$image_url
            );
            $badges_ul .= $badge;
        }   
        
        $badges_ul .= '</ul>';

        $badges = sprintf(
            $format_badges
            ,$title
            ,$badges_ul
        );

        return $badges;
    }

    function _get_payment_types()
    {
        $footer_info = get_field('footer', 'options');
        $payments_info = $footer_info['payment_types'];

        $format_payments = '
            <div id="footer_payments">
                %s
                %s
            </div>
        ';

        $format_payment = '
            <li>
                <div style="background-image:url(%s);">%s</div>
            </li>
        ';

        $payments_ul = '<ul>';

        foreach($payments_info as $payment_info)
        {
            $title = '<h3>Payment</h3>';
            $name = (!empty($payment_info['name']) ? $payment_info['name'] : '');
            $image_url = (!empty($payment_info['image']['url']) ? $payment_info['image']['url'] : '');
            $payment = sprintf(
                $format_payment
                ,$image_url
                ,$name
            );
            $payments_ul .= $payment;
        }

        $payments_ul .= '</ul>';

        $payments = sprintf(
            $format_payments
            ,$title
            ,$payments_ul
        );

        return $payments;
    }

    function _get_company_info()
    {
        $logo = _get_site_logo();
        $address = (!empty(_get_full_address_br()) ? '<a class="footer_address" href="javascript:;">'._get_full_address_br().'</a>': '');
        $phone_number_1 = (!empty(_get_phone_number_1()) ? '<a class="footer_phone_1" href="tel:'._get_phone_number_1().'">'._get_phone_number_1().'</a>': '');
        $phone_number_2 =(!empty(_get_phone_number_2()) ? '<a class="footer_phone_2" href="tel:'._get_phone_number_2().'">'._get_phone_number_2().'</a>': '');
        $social_icons = _get_social_icons();

        $format_company_info = '
            <div id="footer_company_info">
                %s
                %s
                %s
                %s
                %s
            </div>
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
        $title = '<h3>Links</h3>';
        $format_nav = '
            <nav id="footer_nav">
                %s
                %s
            </nav>
        ';
        $nav = sprintf(
            $format_nav
            ,$title
            ,_get_site_nav()
        );
        return $nav;
    }

    function _get_footer_content()
    {
        $footer_info = get_field('footer', 'options');
        $format_footer_content = '
            <div id="footer_row_1">
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
            ,(!empty($footer_info['payment_types']) ? _get_payment_types() : '')
            ,(!empty($footer_info['badges']) ? _get_badges() : '')
            ,(!empty($footer_info['copyright_banner']) ? _get_copyright_banner() : '')
        );
        
        return $footer_content;
    }
    
?>
</main>
<footer>
<?php 
    
    echo get_section_banner('Footer Here Please');
    
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