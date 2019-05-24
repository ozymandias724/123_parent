<?php 
/**
 * Partial
 * Popups
 */
    $popups = get_field('popups','options');

    function _get_status($popups, $popup_name)
    {
        return ($popups[$popup_name]['status'] == 1) ? true : false;
    }

    function _get_times()
    {
        return '<a href="javascript:;" class="popup_close"><i class="fas fa-times"></i></a>';
    }

    function _get_form()
    {
       $form = '';
        return $form;
    }

    function _echo_popups($popups)
    {
        if(_get_status($popups, 'header')) echo _header_popup($popups);

        if(_get_status($popups, 'timed_overlay')) echo _timed_overlay_popup($popups);

        if(_get_status($popups, 'banner')) echo _banner_popup($popups);
    }

    function _header_popup($popups)
    {   
        $popup = array_slice($popups['header'], 0);
        $image = (!empty($popup['image']['url'])) ? '<div style="background-image:url('.$popup['image']['url'].');"></div>' : '';
        $heading = (!empty($popup['popup_heading'])) ? '<h3>'.$popup['popup_heading'].'</h3>' : '';
        $text = (!empty($popup['popup_text'])) ? $popup['popup_text'] : '';
        $email = (!empty($popup['email'])) ? '<p>'.$popup['email'].'</p>' : '';

        $format_popup = '
            <section class="popup" id="header_popup">
                <div>
                    %s
                    %s
                    %s
                    %s
                    %s
                </div>
            </section>
        ';

        $header_popup = sprintf(
            $format_popup
            ,_get_times()
            ,$heading
            ,$image
            ,_get_form()
            ,$text
        );
        
        return $header_popup;
    }

    function _timed_overlay_popup($popups)
    {
        $popup = array_slice($popups['timed_overlay'], 0);
        $image = (!empty($popup['image']['url'])) ? '<div style="background-image:url('.$popup['image']['url'].');"></div>' : '';
        $heading = (!empty($popup['popup_heading'])) ? '<h3>'.$popup['popup_heading'].'</h3>' : '';
        $text = (!empty($popup['popup_text'])) ? $popup['popup_text'] : '';
        $email = (!empty($popup['email'])) ? '<p>'.$popup['email'].'</p>' : '';
        $timer_first_view = (!empty($popup['first_view_timer'])) ? $popup['first_view_timer'] : '';
        $timer_viewed_once = (!empty($popup['viewed_once_timer'])) ? $popup['viewed_once_timer'] : '';

        $format_popup = '
            <section class="popup" id="timed_overlay_popup" data-first-view="%s" data-second-view="%s" data-viewed="0">
                <div>
                    %s
                    %s
                    %s
                    %s
                    %s
                </div>
            </section>
        ';

        $timed_overlay_popup = sprintf(
            $format_popup
            ,$timer_first_view
            ,$timer_viewed_once
            ,_get_times()
            ,$heading
            ,$image
            ,_get_form()
            ,$text
        );

        return $timed_overlay_popup; 
    }

    function _banner_popup($popups)
    {
        $popup = array_slice($popups['banner'], 0);
        $bar_text = (!empty($popup['bar_text'])) ? '<h3>'.$popup['bar_text'].'</h3>' : '';
        $image = (!empty($popup['popup_image']['url'])) ? '<div style="background-image:url('.$popup['popup_image']['url'].');"></div>' : '';
        $heading = (!empty($popup['popup_heading'])) ? '<h3>'.$popup['popup_heading'].'</h3>' : '';
        $text = (!empty($popup['popup_text'])) ? $popup['popup_text'] : '';
        $email = (!empty($popup['email'])) ? '<p>'.$popup['email'].'</p>' : '';

        $format_popup = '
            <section class="popup" id="banner_popup">
                <div>
                    %s
                </div>
            </section>
        ';

        $banner_popup = sprintf(
            $format_popup
            ,$text
        );

        return $banner_popup; 
    }
    _echo_popups($popups);
?>