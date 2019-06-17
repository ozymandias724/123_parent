<?php  
/**
 * Part: Footer
 * Description:
 *  logo, company info, address
 *  nav links
 *  payment types
 *  social icons
 *  copyright section
 */

    function get_copyright_banner(){
        $return = '';
        $field = get_field('footer', 'options');

        $company_name = get_field('company_info', 'options')['company_name'];

        $format = '
            <div class="site__copyright_banner">
                <span>Copyright &copy; '.date('Y', time()).' '.$company_name.'</span>
                %s
            </div>
        ';
        $return .= sprintf(
            $format
            ,( !empty($field['copyright_banner']['text']) 
            ? '<a href="'.$field['copyright_banner']['url'].'" target="_blank">Website Created By '.$field['copyright_banner']['text'].'</a>' 
            : '<a href="https://123websites.com" target="_blank">Website Created By 123Websites.com</a>'
            )
        );
        return $return;
    }

    function get_payment_types(){
        $return = '';
        $field = get_field('footer', 'options');
        $footer_style = get_field('footer', 'options')['style'];
        if( !empty($field['payment_types']) ){

            $return .= '<div class="footer_payment_types"><ul>';

            $format = '
                <li>%s</li>
            ';
            foreach( $field['payment_types'] as $type ){
                $return .= sprintf(
                    $format
                    ,(!empty($type['icon']) ? $type['icon'] : '')
                );
            }
            $return .= '</ul></div>';
        }
        return $return;
    }

    function get_footer_logo(){
        $return = '';
        $field = get_field('footer', 'options');
        if( !empty($field['logo']) ){
            $format = '
                <a class="site__footer_logo" href="%s" title="%s">
                    <div style="background-image:url(%s);"></div>
                </a>
            ';
            $return .= sprintf(
                $format
                ,site_url()
                ,( !empty($field['logo']['alt']) ? $field['logo']['alt'] : '')
                ,$field['logo']['url']
            );
        }
        return $return;
    }

    function get_company_info(){
        $footer_style = get_field('footer', 'options')['style'];
        $logo = get_footer_logo();
        $address = (!empty(get_full_address_br()) ? '<a class="footer_address" href="javascript:;">'.get_full_address_br().'</a>': '');
        $phone_number_1 = (!empty(get_phone_number_1()) ? '<a class="footer_phone_1" href="tel:'.get_phone_number_1().'"><span>P:</span> '.get_phone_number_1().'</a>': '');
        $phone_number_2 =(!empty(get_phone_number_2()) ? '<a class="footer_phone_2" href="tel:'.get_phone_number_2().'"><span>F:</span> '.get_phone_number_2().'</a>': '');
        $format_company_info = '
            <div id="footer_company_info">
                %s
                %s
                %s
                %s
                %s
                %s
            </div>
        ';
        if($footer_style == 'one'){
            $format = '
                <div id="footer_company_info">
                    %s
                    %s
                    %s
                    %s
                </div>
            ';
            $company_info = sprintf(
                $format
                ,$logo
                ,$address
                ,$phone_number_1
                ,$phone_number_2
            );
        }else if($footer_style == 'two'){
            $address = (!empty(get_full_address()) ? '<a class="footer_address" href="javascript:;">'.get_full_address().'</a>': '');
            $format = '
                <div id="footer_company_info">
                    %s
                    %s
                    <div class="last_company_info">
                        %s
                        %s
                        %s
                    </div>
                </div>
            ';
            $company_info = sprintf(
                $format
                ,$logo
                ,get_nav()
                ,$address
                ,$phone_number_1
                ,$phone_number_2
            );
        }else if($footer_style == 'three'){
            $address = (!empty(get_full_address()) ? '<a class="footer_address" href="javascript:;">'.get_full_address().'</a>': '');
            $format = '
                <div id="footer_company_info">
                    %s
                    %s
                    %s
                    %s
                    %s
                    %s
                </div>
            ';
            $company_info = sprintf(
                $format
                ,$logo
                ,get_nav()
                ,(!empty(get_social_icons()) ? get_social_icons() : '')
                ,$address
                ,$phone_number_1
                ,$phone_number_2
            );
        }
        return $company_info;
    }

    function get_nav(){
        $footer_style = get_field('footer', 'options')['style'];

        $fields = get_fields( get_option('page_on_front') );
        $anchor_link_count = 0;

        foreach($fields['content_blocks'] as $i => $block){
            if( !empty($block['anchor_link_text']) ){
                $anchor_link_count++;
            }
        }
        
        if($anchor_link_count > 0){
            if($footer_style == 'one'){
                $format_nav = '
                    <div id="footer_nav">
                        <h3 class="nav_title">Navigate</h3>
                        <nav>
                            %s
                        </nav>
                    </div>
                ';
            }else{
                $format_nav = '
                    <div id="footer_nav">
                        <nav>
                            %s
                        </nav>
                    </div>
                ';
            }
            $nav = sprintf(
                $format_nav
                ,get_site_nav()
            );  
        }
        return $nav;
    }

    function get_recent_posts(){
        $return = '';
        $query = new WP_Query(array(
            'posts_per_page' => 3,
            'nopaging' => true
        ));
        $posts = get_posts($query);
        if(!empty($posts)){
            $format = '
                <div id="footer_posts">
                    <h3>Recent Posts</h3>
                    <ul>%s</ul>
                </div>
            ';

            $format_post = '
                <li><a href="%s">%s</a></li>
            ';
            for($x = 0; $x < 3; $x++){
                $the_posts .= sprintf(
                    $format_post
                    ,get_post_permalink($posts[$x])
                    ,$posts[$x]->post_title
                );
            }
            $return .= sprintf(
                $format
                ,$the_posts
            );
        }
        return $return;
    }

    function get_footer_content(){
        $footer_style = get_field('footer', 'options')['style'];
        $width = get_field('footer', 'options')['width'];
        if($footer_style == 'one'){
            $format_footer_content = '
                <div class="container '.$width.'">
                    %s
                    %s
                    %s
                    <div id="footer_social">
                        %s
                    </div>
                </div>
                <div class="footer_copyright">
                    <div class="container '.$width.'">
                        %s
                        %s
                    </div>
                </div>
            ';
            $return = sprintf(
                $format_footer_content
                ,get_company_info()
                ,get_nav()
                ,get_recent_posts()
                ,(!empty(get_social_icons()) ? '<h3>Follow Us</h3>'.get_social_icons():'')
                ,get_copyright_banner()
                ,get_payment_types()
            );
        }else if($footer_style == 'two'){
            $format_footer_content = '
                <div class="container '.$width.'">
                    %s
                    %s
                    <div class="footer_last_div">
                        %s
                        <div id="footer_social">
                            %s
                        </div>
                    </div>
                </div>
            ';

            $return = sprintf(
                $format_footer_content
                ,get_company_info()
                ,get_copyright_banner()
                ,get_payment_types()
                ,(!empty(get_social_icons()) ? '<h3>Follow Us</h3>'.get_social_icons():'')
            );

        }else if($footer_style == 'three'){
            $format_footer_content = '
                <div class="container '.$width.'">
                    %s
                    %s
                    %s
                </div>
            ';
            $return = sprintf(
                $format_footer_content
                ,get_company_info()
                ,get_copyright_banner()
                ,get_payment_types() 
            );
        }
        return $return;
    }
    
?>
</main>
<footer class="site__fade site__fade-up colors__main_footer_bg" id="footer_<?php echo get_field('footer', 'options')['style'] ?>">
<?php 

    echo get_footer_content();
    
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