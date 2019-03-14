<?php 
/**
 * Partial
 * Hero Section
 */

    $type = get_field('choose_hero_type', 'options');


    
    if( $type == 'none' || empty($type) ){

        $content_hero = '';
        
    } else {
        
        $content_hero = '<section class="hero">';

        if( $type == 'image' ){
    
            $fields = get_field('image', 'options');

            $format_hero = '
                <div class="hero-bgimg" style="background-image: url(%s)">
                    <div>
                        <h2>%s</h2>
                        <p>%s</p>
                        <a href="javascript:;">%s</a>
                    </div>
                </div>
            ';
            
            $content_hero .= sprintf(
                $format_hero
                ,$fields['image']['url']
                ,( !empty($fields['heading']) ) ? $fields['heading'] : ''
                ,( !empty($fields['tagline']) ) ? $fields['tagline'] : ''
                ,( !empty($fields['call_to_action']) ) ? $fields['call_to_action'] : ''
            );
        }

        else if( $type == 'slider' ){
    
            $fields = get_field('slider', 'options');
    
            $format_hero = '';
            
            $content_hero .= sprintf(
                $format_hero
            );
            
            
        }

        else if( $type == 'video' ){
            
            $fields = get_field('video', 'options');
    
            $format_hero = '';
            
            $content_hero .= sprintf(
                $format_hero
            );
            
            
        }
        
        $content_hero .= '</section>';
    }

    
    echo $content_hero;
 ?>