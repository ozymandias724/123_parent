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

    function _echo_popups($popups)
    {
        if(_get_status($popups, 'header'))
        {
            echo _header_popup($popups);
        }
        if(_get_status($popups, 'timed_overlay'))
        {
            echo _timed_overlay_popup($popups);
        }
    }

    function _header_popup($popups)
    {   
        $popup = array_slice($popups['header'], 0);
        $image = (!empty($popup['image']['url'])) ? '<div style="background-image:url('.$popup['image']['url'].');"></div>' : '';
        $heading = (!empty($popup['popup_heading'])) ? '<h3>'.$popup['popup_heading'].'</h3>' : '';
        $text = (!empty($popup['popup_text'])) ? $popup['popup_text'] : '';
        $email = (!empty($popup['email'])) ? '<p>'.$popup['email'].'</p>' : '';

        $format_popup = '
            <section id="header_popup">
                %s
                %s
                %s
                %s
            </section>
        ';

        $header_popup = sprintf(
            $format_popup
            ,$image
            ,$heading
            ,$text
            ,$email
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
            <section id="timed_overlay_popup">
                %s
                %s
                %s
                %s
            </section>
        ';

        $timed_overlay_popup = sprintf(
            $format_popup
            ,$image
            ,$heading
            ,$text
            ,$email
        );

        return $timed_overlay_popup; 
    }

    _echo_popups($popups);

?>