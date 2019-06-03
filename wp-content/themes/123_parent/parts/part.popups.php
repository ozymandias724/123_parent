<?php 
/**
 * Partial
 * Popups
 */
    $popups = get_field('popups','options');

    function get_times()
    {
        return '<a href="javascript:;" class="popup_close"><i class="fas fa-times"></i></a>';
    }

    function get_form($popups, $type)
    {
        $form = '
            <section id="banner__form" class="site__block">
                <div class="container">
                '. (!empty($popups[$type]['overlay']['form']) ? do_shortcode('[wpforms id="'.$popups[$type]['overlay']['form']->ID.'" title="false" description="false"]' ) : '' ). '
                </div>
            </section>
        ';

        return $form;
    }


    // 
    function echo_popups($popups)
    {
        if(get_status($popups, 'banner')) echo banner_popup($popups);

        if(get_status($popups, 'header')) echo header_popup($popups);

        if(get_status($popups, 'timed_overlay')) echo timed_overlay_popup($popups);

    }

    function get_status($popups, $popup_name)
    {
        return ($popups[$popup_name]['status'] == 1) ? true : false;
    }

    function banner_popup($popups)
    {

        $button_text = (!empty($popups['banner']['button']['text']) ? $popups['banner']['button']['text'] : '' );
        $image = (!empty($popups['banner']['overlay']['image']['url']) ? '<div style="background-image:url('.$popups['banner']['overlay']['image']['url'].');"></div>' : '');
        $heading = (!empty($popups['banner']['overlay']['heading']) ? '<h3>'.$popups['banner']['overlay']['heading'].'</h3>' : '');
        $details = (!empty($popups['banner']['overlay']['details']) ? $popups['banner']['overlay']['details'] : '');
 
        $format_popup = '
            <section class="popup" id="banner_popup_button">
                <a href="javascript:;">%s</a>
            </section>
            <section class="popup" id="banner_popup">
                %s
                <div class="container" style="%s %s">
                    %s
                    <div class="popup_details">
                        %s
                        %s
                        %s
                    </div>
                </div>     
            </section>
        '; 

        $banner_popup = sprintf(
            $format_popup
            ,$button_text
            ,get_times()
            ,( !empty( $popups['banner']['overlay']['background_color'] ) ? 'background-color:'.$popups['banner']['overlay']['background_color'].';' : '' )           // container bg color style
            ,( !empty( $popups['banner']['overlay']['foreground_color'] ) ? 'color:'.$popups['banner']['overlay']['foreground_color'].';' : '' )           // container bg color style
            ,$image
            ,$heading
            ,$details
            ,get_form($popups, 'banner')
        );
        

        return $banner_popup; 
    }


    function header_popup($popups)
    {   
        $image = (!empty($popups['header']['overlay']['image']['url'])) ? '<div style="background-image:url('.$popups['header']['overlay']['image']['url'].');"></div>' : '';
        $heading = (!empty($popups['header']['overlay']['heading'])) ? '<h3>'.$popups['header']['overlay']['heading'].'</h3>' : '';
        $details = (!empty($popups['header']['overlay']['details'])) ? $popups['header']['overlay']['details'] : '';

        $format_popup = '
            <section class="popup" id="header_popup">
                <div class="container" style="%s %s"> 
                    %s
                    <div class="popup_details">
                        %s
                        %s
                        %s
                        %s
                    </div>
                </div>
            </section>
        ';

        $header_popup = sprintf(
            $format_popup
            ,( !empty( $popups['header']['overlay']['background_color'] ) ? 'background-color:'.$popups['header']['overlay']['background_color'].';' : '' )           // container bg color style
            ,( !empty( $popups['header']['overlay']['foreground_color'] ) ? 'color:'.$popups['header']['overlay']['foreground_color'].';' : '' )           // container bg color style
            ,get_times()
            ,$image
            ,$heading
            ,$details
            ,get_form($popups, 'header')
        );
        
        return $header_popup;
    }

    function timed_overlay_popup($popups)
    {
        $image = (!empty($popups['timed_overlay']['overlay']['image']['url']) ? '<div style="background-image:url('.$popups['timed_overlay']['overlay']['image']['url'].');"></div>' : '');
        $heading = (!empty($popups['timed_overlay']['overlay']['heading']) ? '<h3>'.$popups['timed_overlay']['overlay']['heading'].'</h3>' : '');
        $details = (!empty($popups['timed_overlay']['overlay']['details']) ? $popups['timed_overlay']['overlay']['details'] : '');
        $timer_first_view = (!empty($popups['timed_overlay']['first_view_timer']) ? $popups['timed_overlay']['first_view_timer'] : '');
        $timer_viewed_once = (!empty($popups['timed_overlay']['viewed_once_timer']) ? $popups['timed_overlay']['viewed_once_timer'] : '');

        $format_popup = '
            <section class="popup" id="timed_overlay_popup" data-first-view="%s" data-second-view="%s" data-viewed="0">
                <div class="container" style="%s %s">
                    %s
                    <div class="popup_details">
                        %s
                        %s
                        %s
                        %s
                    </div>
                </div>
            </section>
        ';

        $timed_overlay_popup = sprintf(
            $format_popup
            ,$timer_first_view
            ,$timer_viewed_once
            ,( !empty( $popups['timed_overlay']['overlay']['background_color'] ) ? 'background-color:'.$popups['timed_overlay']['overlay']['background_color'].';' : '' )           // container bg color style
            ,( !empty( $popups['timed_overlay']['overlay']['foreground_color'] ) ? 'color:'.$popups['timed_overlay']['overlay']['foreground_color'].';' : '' )           // container bg color style
            ,get_times()
            ,$image
            ,$heading
            ,$details
            ,get_form($popups, 'timed_overlay')
        );

        return $timed_overlay_popup; 
    }
 
    echo_popups($popups);
?>