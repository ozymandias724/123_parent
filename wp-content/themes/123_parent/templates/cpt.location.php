<?php 
/**
 * Template Name: Location
 * Template Post Type: areas-served
 */

    $fields = get_fields($post->ID);  

    function _get_address($ID)
    {
        $return = '';
        $location_content = get_fields($ID);
        $address = (!empty($location_content['content']['address']) ? $location_content['content']['address'] : '');
        if(!empty($address))
        {
            $postal = '';
            if(!empty($address['address_is_postal']))
            {
                $is_postal = $address['address_is_postal'];
                if($is_postal)
                {
                    $postal = '<p>Postal Address:</p>';
                }
            }  
            $street_1 = (!empty($address['address_street']) ? $address['address_street'] : '');
            $street_2 = (!empty($address['address_street_2']) ? $address['address_street_2'] : '');
            $city = (!empty($address['address_city']) ? $address['address_city'] : '');
            $state = (!empty($address['address_state']) ? $address['address_state'] : '');
            $postcode = (!empty($address['address_postcode']) ? $address['address_postcode'] : '');
  
            $format = '
                <div class="location_address">
                    %s
                    <p>%s %s</p> 
                    <p>%s, %s %s</p>
                </div>'; 
            $return = sprintf(
                $format
                ,$postal
                ,$street_1
                ,$street_2
                ,$city
                ,$state
                ,$postcode
            );
        }
        
        return $return; 
    }

    $format = '
        <section class="mod__featured_grid">
            <div class="container">
                <div class="site__fade site__fade-up">
                    %s
                    <div class="location_content">
                        <p class="location_heading">%s</p>
                        %s
                    </div>
                </div>
            </div>
        </section>
    ';

    $return = sprintf(
        $format
        ,(!empty($fields['content']['image']['url']) ? '<div class="site__bgimg block"><div class="site__bgimg_img" style="background-image: url('.$fields['content']['image']['url'].')"></div></div>': '')
        ,(!empty($fields['content']['heading']) ? $fields['content']['heading'] : '')
        ,_get_address($post->ID)
    );
    
    get_header();

?>
<main id="single_location">
<?php  
    echo $return; 
    get_footer();
 ?>