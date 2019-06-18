<?php
require_once('includes/custom-controls.php');
add_action( 'customize_register', 'my_customize_register' );
function my_customize_register($wp_customize) {

    $wp_customize->add_section('section_fonts', array(
        'title'		=> esc_html__('Fonts', 'mytheme'),
        'priority'	=> 0,
    ));

    /**
	*Main Google Font Setting
	**/
    $wp_customize->add_setting( 'main_google_font_list', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control( new Google_Font_Dropdown_Custom_Control( $wp_customize, 'main_google_font_list', array(
        'label'      => 'Main Google Font',
        'section'    => 'section_fonts',
        'settings'   => 'main_google_font_list',
    )));
}



/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */
class Site__Customizer
{
    /**
     * This hooks into 'customize_register' (available as of WP 3.4) and allows
     * you to add new sections and controls to the Theme Customize screen.
     * 
     * Note: To enable instant preview, we have to actually write a bit of custom
     * javascript. See live_preview() for more.
     *  
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customize
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
     * @since MyTheme 1.0
     */
    public static function register($wp_customize)
    {
        
        /**
         * Settings
        */
        $settings = array(
            'colors__main_body_bg'
            ,'colors__main_header_bg'
            ,'colors__main_footer_bg'
            ,'colors__main_accent_bg'
            ,'colors__type_headings'
            ,'colors__type_body'
            ,'colors__type_navlinks'
            ,'colors__type_herotext'
            ,'colors__type_dividers'
            ,'colors__type_footertext'
            ,'fonts__body'
            ,'fonts__body_weight'
            ,'fonts__body_italics'
            ,'fonts_navlinks'
            ,'fonts_navlinks_weight'
            ,'fonts_navlinks_italics'
            ,'fonts_hero_title'
            ,'fonts_hero_title_weight'
            ,'fonts_hero_title_italics'
            ,'fonts_hero_subtitle'
            ,'fonts_hero_subtitle_weight'
            ,'fonts_hero_subtitle_italics'
            ,'fonts_buttons'
            ,'fonts_buttons_weight'
            ,'fonts_buttons_italics'
            ,'fonts_alttext'
            ,'fonts_alttext_weight'
            ,'fonts_alttext_italics'
            ,'fonts__headings'
            ,'fonts__headings_weight'
            ,'fonts__headings_italics'
            ,'links_anylink'
            ,'links_anylink_hover'
            ,'links_button_text'
            ,'links_button_bg'
            ,'links_button_bg_hover'
        );
        foreach ($settings as $setting) {
            $wp_customize->add_setting($setting, array('transport' => 'postMessage'));
        }
        /**
         * Panels
        */
        $panels = array(
            [
                'id' => 'site__colors'
                ,'args' => [
                    'title' => __( 'The Site Colors Panel' ),
                ]
            ]
            ,[
                'id' => 'site__fonts'
                ,'args' => [
                    'title' => __( 'The Site Fonts Panel' ),
                ]
            ]
        );
        foreach( $panels as $panel ){
            $wp_customize->add_panel($panel['id'], $panel['args']);
        }
        /**
         *  Sections 
        */
        $sections = array(
            [
                'id' => 'colors__main',
                'args' => array(
                    'title' => __('Main', '123_parent'), //Visible title of section
                    'panel' => 'site__colors'
                )
            ]
            ,[
                'id' => 'colors__text',
                'args' => array(
                    'title' => __('Text', '123_parent'), //Visible title of section
                    'panel' => 'site__colors'
                )
            ]
            ,[
                'id' =>'colors__links',
                'args' => array(
                    'title' => __('Link', '123_parent'), //Visible title of section
                    'panel' => 'site__colors'
                )
            ]
            ,[
                'id' =>'fonts__body',
                'args' => array(
                    'title' => __('Body', '123_parent'), //Visible title of section
                    'panel' => 'site__fonts'
                )
            ]
            ,[
                'id' =>'fonts__headings',
                'args' => array(
                    'title' => __('Headings', '123_parent'), //Visible title of section
                    'panel' => 'site__fonts'
                )
            ]
            
        );
        foreach ($sections as $section) {
            $wp_customize->add_section($section['id'], $section['args']);
        }
        
        /**
         * Controls
        */
        // color controls
        $color_controls = array(    
            [
                'id' => 'main_body_bg'
                ,'args' => [
                    'label' => __('Body Background', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__main_body_bg', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__main', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'main_header_bg'
                ,'args' => [
                    'label' => __('Header Background', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__main_header_bg', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__main', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'main_footer_bg'
                ,'args' => [
                    'label' => __('Footer Background', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__main_footer_bg', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__main', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'main_accent'
                ,'args' => [
                    'label' => __('Accent Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__main_accent_bg', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__main', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'type_headings'
                ,'args' => [
                    'label' => __('Headings Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__type_headings', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__text', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'type_body'
                ,'args' => [
                    'label' => __('Body Text Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__type_body', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__text', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'type_navlinks'
                ,'args' => [
                    'label' => __('Nav Links Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__type_navlinks', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__text', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'type_herotext'
                ,'args' => [
                    'label' => __('Hero Text Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__type_herotext', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__text', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'type_dividers'
                ,'args' => [
                    'label' => __('Dividers Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__type_dividers', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__text', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'type_footertext'
                ,'args' => [
                    'label' => __('Footer Text Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'colors__type_footertext', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__text', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'links_anylink'
                ,'args' => [
                    'label' => __('Generic Link', '123_parent'), //Admin-visible name of the control
                    'settings' => 'links_anylink', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__links', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'links_anylink_hover'
                ,'args' => [
                    'label' => __('Generic Link (Hover)', '123_parent'), //Admin-visible name of the control
                    'settings' => 'links_anylink_hover', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__links', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'links_button_text'
                ,'args' => [
                    'label' => __('Button Text', '123_parent'), //Admin-visible name of the control
                    'settings' => 'links_button_text', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__links', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'links_button_bg'
                ,'args' => [
                    'label' => __('Button Background', '123_parent'), //Admin-visible name of the control
                    'settings' => 'links_button_bg', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__links', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'links_button_bg_hover'
                ,'args' => [
                    'label' => __('Button Background (Hover)', '123_parent'), //Admin-visible name of the control
                    'settings' => 'links_button_bg_hover', //Which setting to load and manipulate (serialized is okay)
                    'section' => 'colors__links', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
        );
        foreach ($color_controls as $color_control) {
            $wp_customize->add_control(new WP_Customize_Color_Control(
                $wp_customize
                ,$color_control['id']
                ,$color_control['args']
            ));
        }

        // fonts controls
        $fonts_controls = array(
            [
                'id' => 'fonts__body'
                ,'args' => [
                    'label' => __('Choose Body Font', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__body' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__body' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'select'
                    ,'choices' => array(
                        'lato' => 'Lato'
                        ,'gotham' => 'Gotham'
                    )
                ]
            ]
            ,[
                'id' => 'fonts__body_italics'
                ,'args' => [
                    'label' => __('Italics?', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__body' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__body_italics' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'checkbox'
                ]
            ]
            ,[
                'id' => 'fonts__body_weight'
                ,'args' => [
                    'label' => __('Choose Body Font', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__body' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__body_weight' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'select'
                    ,'choices' => array(
                        '100'
                        ,'200'
                        ,'300'
                        ,'400'
                        ,'500'
                        ,'600'
                        ,'700'
                        ,'800'
                        ,'900'
                    )
                ]
            ]
            ,[
                'id' => 'fonts__navlinks'
                ,'args' => [
                    'label' => __('Choose Nav Font', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__body' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__navlinks' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'select'
                    ,'choices' => array(
                        'lato' => 'Lato'
                        ,'gotham' => 'Gotham'
                    )
                ]
            ]
            ,[
                'id' => 'fonts__navlinks_italics'
                ,'args' => [
                    'label' => __('Italics?', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__body' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__navlinks_italics' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'checkbox'
                ]
            ]
            ,[
                'id' => 'fonts__navlinks_weight'
                ,'args' => [
                    'label' => __('Choose Body Font', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__body' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__navlinks_weight' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'select'
                    ,'choices' => array(
                        '100'
                        ,'200'
                        ,'300'
                        ,'400'
                        ,'500'
                        ,'600'
                        ,'700'
                        ,'800'
                        ,'900'
                    )
                ]
            ]
            ,[
                'id' => 'fonts__headings'
                ,'args' => [
                    'label' => __('Choose Header Font', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__headings' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__headings' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'select'
                    ,'choices' => array(
                        'lato' => 'Lato'
                        ,'gotham' => 'Gotham'
                    )
                ]
            ]
            ,[
                'id' => 'fonts__headings_italics'
                ,'args' => [
                    'label' => __('Italics?', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__headings' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__headings_italics' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'checkbox'
                ]
            ]
            ,[
                'id' => 'fonts__headings_weight'
                ,'args' => [
                    'label' => __('Choose headings Font', '123_parent') //Admin-visible name of the control
                    ,'section' => 'fonts__headings' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'fonts__headings_weight' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'select'
                    ,'choices' => array(
                        '100'
                        ,'200'
                        ,'300'
                        ,'400'
                        ,'500'
                        ,'600'
                        ,'700'
                        ,'800'
                        ,'900'
                    )
                ]
            ]
        );
        foreach ($fonts_controls as $fonts_control) {
            $wp_customize->add_control($fonts_control['id'], $fonts_control['args']);
        }
        
        //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
        $wp_customize->get_setting('blogname')->transport = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
        $wp_customize->get_setting('background_color')->transport = 'postMessage';
    }

    public static function header_output()
    {
        $els = array(
            [
                '.colors__body_bg, body'                      // selector
                ,'background-color'                // property
                ,'colors__main_body_bg'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__header_bg, header'    // selector
                ,'background-color'                // property
                ,'colors__main_header_bg'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__footer_bg, footer'    // selector
                ,'background-color'                // property
                ,'colors__main_footer_bg'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__accent_bg'    // selector
                ,'background-color'                // property
                ,'colors__main_accent_bg'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__type_headings, h1, h2, h3, h4, h5, h6'    // selector
                ,'color'                // property
                ,'colors__type_headings'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__type_body, body'    // selector
                ,'color'                // property
                ,'colors__type_body'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__type_navlinks, .navlinks-item-link'    // selector
                ,'color'                // property
                ,'colors__type_navlinks'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__type_herotext, section.hero'    // selector
                ,'color'                // property
                ,'colors__type_herotext'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__type_dividers'    // selector
                ,'color'                // property
                ,'colors__type_dividers'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.colors__type_footertext, .footer'    // selector
                ,'color'                // property
                ,'colors__type_footertext'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.fonts__body, body'    // selector
                ,'font-family'                // property
                ,'fonts__body'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.fonts__headings, h1, h2, h3, h4, h5, h6'    // selector
                ,'font-family'                // property
                ,'fonts__headings'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.links_anylink, a'    // selector
                ,'color'                // property
                ,'links_anylink'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.links_anylink:hover, a:hover'    // selector
                ,'color'                // property
                ,'links_anylink_hover'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.links_button_text'    // selector
                ,'color'                // property
                ,'links_button_text'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.links_button_bg'    // selector
                ,'background-color'                // property
                ,'links_button_bg'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.links_button_bg:hover'    // selector
                ,'background-color'                // property
                ,'links_button_bg_hover'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
        );
        $return_customizer_css = '<style type="text/css"';
        foreach ($els as $el) {
            $return_customizer_css .= self::generate_css($el[0],$el[1],$el[2],$el[3],$el[4]);
        }
        $return_customizer_css .= '</style';

        return $return_customizer_css;
    }
    


    // Helper Functions Below
    /**
     * This outputs the javascript needed to automate the live settings preview.
     * Also keep in mind that this function isn't necessary unless your settings 
     * are using 'transport'=>'postMessage' instead of the default 'transport'
     * => 'refresh'
     * 
     * Used by hook: 'customize_preview_init'
     * 
     * @see add_action('customize_preview_init',$func)
     * @since MyTheme 1.0
     */
    public static function live_preview()
    {
        wp_enqueue_script(
            'mytheme-themecustomizer', // Give the script a unique ID
            get_template_directory_uri() . '/__build/_js/_conditional/customizer.js', // Define the path to the JS file
            array('jquery', 'customize-preview'), // Define dependencies
            null, // Define a version (optional) 
            true // Specify whether to put in footer (leave this true)
        );
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = false)
    {
        $return = '';
        $mod = get_theme_mod($mod_name);
        if (!empty($mod)) {
            $return = sprintf(
                '%s { %s:%s; }',
                $selector,
                $style,
                $prefix . $mod . $postfix
            );
            if ($echo) {
                echo $return;
            }
        }
        return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action('customize_register', array('Site__Customizer', 'register'));

// Output custom CSS to live site
add_action('wp_head', array('Site__Customizer', 'header_output'));

// Enqueue live preview javascript in Theme Customizer admin screen
add_action('customize_preview_init', array('Site__Customizer', 'live_preview'));

// 
