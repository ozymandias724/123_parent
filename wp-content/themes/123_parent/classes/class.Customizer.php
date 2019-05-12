<?php
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
        
        // add settings
        $settings = array(
            [
                'id' => 'link_textcolor'
                ,'args' => [
                    'default' => '#383838', //Default setting/value to save
                    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                    'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                    'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
                ]
            ]
            ,[
                'id' => 'header_bgcolor'
                ,'args' => [
                    'default' => '#383838', //Default setting/value to save
                    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                    'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                    'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
                ]
            ]
            ,[
                'id' => 'header_nav_bgcolor'
                ,'args' => [
                    'default' => '#383838', //Default setting/value to save
                    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                    'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                    'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
                ]
            ]
            ,[
                'id' => 'site__colors_buttons_bg'
                ,'args' => [
                    'default' => '#383838', //Default setting/value to save
                    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                    'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                    'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
                ]
            ]
            ,[
                'id' => 'site__fonts_body'
                ,'args' => [
                    'default' => '#383838', //Default setting/value to save
                    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                    'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                    'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
                ]
            ]
            ,[
                'id' => 'site__fonts_headers'
                ,'args' => [
                    'default' => '#383838', //Default setting/value to save
                    'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
                    'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
                    'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
                ]
            ]
        );
        foreach ($settings as $setting) {
            $wp_customize->add_setting($setting['id'], $setting['args']);
        }
        // add sections
        $sections = array(
            [
                'id' => '123parent_colors',
                'args' => array(
                    'title' => __('Choose Theme Colors', '123_parent'), //Visible title of section
                    'priority' => 35, //Determines what order this appears in
                    'capability' => 'edit_theme_options', //Capability needed to tweak
                    'description' => __('Allows you to customize some example settings for 123_parent.', '123_parent'), //Descriptive tooltip
                )
            ]
            ,[
                'id' =>'123parent_fonts',
                'args' => array(
                    'title' => __('Choose Theme Fonts', '123_parent'), //Visible title of section
                    'priority' => 35, //Determines what order this appears in
                    'capability' => 'edit_theme_options', //Capability needed to tweak
                    'description' => __('Allows you to customize some example settings for 123_parent.', '123_parent'), //Descriptive tooltip
                )
            ]
            
        );
        foreach ($sections as $section) {
            $wp_customize->add_section($section['id'], $section['args']);
        }
        // add controls
        $color_controls = array(
            [
                'id' => '123_parent_link_textcolor'
                ,'args' => [
                    'label' => __('Links (text)', '123_parent'), //Admin-visible name of the control
                    'settings' => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
                    'priority' => 10, //Determines the order this control appears in for the specified section
                    'section' => '123parent_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => '123_parent_header_bgcolor'
                ,'args' => [
                    'label' => __('Header Background Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'header_bgcolor', //Which setting to load and manipulate (serialized is okay)
                    'priority' => 10, //Determines the order this control appears in for the specified section
                    'section' => '123parent_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => '123_parent_header_nav_bgcolor'
                ,'args' => [
                    'label' => __('Nav Background Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'header_nav_bgcolor', //Which setting to load and manipulate (serialized is okay)
                    'priority' => 10, //Determines the order this control appears in for the specified section
                    'section' => '123parent_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                ]
            ]
            ,[
                'id' => 'site__colors_buttons_bg'
                ,'args' => [
                    'label' => __('Buttons Background Color', '123_parent'), //Admin-visible name of the control
                    'settings' => 'site__colors_buttons_bg', //Which setting to load and manipulate (serialized is okay)
                    'priority' => 10, //Determines the order this control appears in for the specified section
                    'section' => '123parent_colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
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
        $fonts_controls = array(
            [
                'id' => 'site__fonts_body'
                ,'args' => [
                    'label' => __('Choose Body Font', '123_parent') //Admin-visible name of the control
                    ,'section' => '123parent_fonts' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'site__fonts_body' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'select'
                    ,'choices' => array(
                        'lato' => 'Lato'
                        ,'gotham' => 'Gotham'
                    )
                    ,'priority' => 10, //Determines the order this control appears in for the specified section
                ]
            ]
            ,[
                'id' => 'site__fonts_headers'
                ,'args' => [
                    'label' => __('Choose Header Font', '123_parent') //Admin-visible name of the control
                    ,'section' => '123parent_fonts' //ID of the section this control should render in (can be one of yours, or a WordPress default section)
                    ,'settings' => 'site__fonts_headers' //Which setting to load and manipulate (serialized is okay)
                    ,'type' => 'select'
                    ,'choices' => array(
                        'lato' => 'Lato'
                        ,'gotham' => 'Gotham'
                    )
                    ,'priority' => 10, //Determines the order this control appears in for the specified section
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

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     * 
     * Used by hook: 'wp_head'
     * 
     * @see add_action('wp_head',$func)
     * @since MyTheme 1.0
     */
    public static function header_output()
    {
        $els = array(
            [
                '.site_colors_links'    // selector
                ,'color'                // property
                ,'link_textcolor'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                'html body'    // selector
                ,'font-family'                // property
                ,'site__fonts_body'       // theme_mod (setting)
                ,''                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.site_colors_header_bg'    // selector
                ,'background-color'                // property
                ,'header_nav_bgcolor'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.site_colors_header_nav_bg'    // selector
                ,'color'                // property
                ,'header_nav_bgcolor'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
            ,[
                '.site__colors_buttons_bg'    // selector
                ,'background-color'                // property
                ,'site__colors_buttons_bg'       // theme_mod (setting)
                ,'#'                    // prefix
                ,' !important'          // postfix
            ]
        );
        $return_customizer_css = '';
        foreach ($els as $el) {
            $return_customizer_css .= self::generate_css($el[0],$el[1],$el[2],$el[3],$el[4]);
        }
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
    public static function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true)
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