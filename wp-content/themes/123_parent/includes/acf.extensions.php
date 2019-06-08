<?php 

// built-in acf
if( function_exists('acf_add_options_page') ) {
	// Main Theme Settings
	acf_add_options_page(array(
		'page_title' 	=> 'Sitewide Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'general-settings',
		'capability'	=> 'read_private_posts',
		'icon_url'      => 'dashicons-admin-settings',
		'redirect'		=> false,
        'position' 		=> 3,
	));
}

add_filter('acf/load_field/name=anchor_enabled', 'do_hide_acf_fields');
add_filter('acf/load_field/name=anchor_link_text', 'do_hide_acf_fields');
function do_hide_acf_fields( $field ) {
    
    if( !get_field('header', 'options')['long_scroll'] ){
        return;
    }else {
        return $field;
    }
}   

/**
 * Display the ACF address
 * Must be used in the loop
 *
 * @author  Mike Hemberger 
 * 
 * @uses    Advanced Custom Field
 *
 * @param   integer  $post_id  The ID of the post to get the address from
 *
 * @return  void
 */
function get_address( $post_id ) {
 
    $is_postal = get_post_meta( $post_id, 'address_is_postal', true );
    $street    = get_post_meta( $post_id, 'address_street', true );
    $street_2  = get_post_meta( $post_id, 'address_street_2', true );
    $city      = get_post_meta( $post_id, 'address_city', true );
    $state     = get_post_meta( $post_id, 'address_state', true );
    $postcode  = get_post_meta( $post_id, 'address_postcode', true );
    $country   = get_post_meta( $post_id, 'address_country', true );
 
    $postal = $is_postal ? ' itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"' : '';
 
    $output = '';
 
    // Bail if no fields have a value
    if ( ! ( $street || $street_2 || $city || $state || $postcode || $country ) ) {
        return $output;
    }
 
    $output .= '<div class="address">';
 
        if ( $street ) {
            $output .= '<span class="street-address">' . esc_html( $street ) . '</span>';
        }
 
        if ( $street_2 ) {
            $output .= '<span class="street-address-2">' . esc_html( $street_2 ) . '</span>';
        }
 
        if ( $city || $state || $postcode ) {
 
            $output .= '<div class="address-columns">';
 
                if ( $city ) {
                    $output .= '<span class="locality"> ' . esc_html( $city ) . ',</span>';
                }
 
                if ( $state ) {
                    $output .= '<span class="region">' . esc_html( $state ) . '</span>';
                }
 
                if ( $postcode ) {
                    $output .= '<span class="postal-code">' . esc_html( $postcode ) . '</span>';
                }
 
 
            $output .= '</div>';
 
            if ( $country ) {
                $output .= '<span class="country-name">' . get_country( $country ) . '</span>';
            }
 
        }
 
    $output .= '</div>';
 
    return $output;
 
}
 
/**
 * Load the state choices
 *
 * @return array
 */
add_filter( 'acf/load_field/name=address_state', function( $field ) {
    $field['choices'] = array();
    return get_choices( $field, get_states_array() );
});
 
/**
 * Load the country choices
 * Original list from Yoast Local SEO
 *
 * @return array
 */
add_filter( 'acf/load_field/name=address_country', function( $field ) {
    $field['choices'] = array();
    return get_choices( $field, get_countries_array() );
});
 
/**
 * Return the state name based on state code
 *
 * @param  string $state_code Two char country code.
 *
 * @return string State name.
 */
function get_state( $state_code = '' ) {
    return get_value_from_key( $state_code, get_states_array() );
}
 
/**
 * Return the country name based on country code
 *
 * @param  string $country_code Two char country code.
 *
 * @return string Country name.
 */
function get_country( $country_code = '' ) {
    return get_value_from_key( $country_code, get_countries_array() );
}
 
/**
 * Helper method to get the formatted choices to load an ACF select field
 *
 * @param  array  $field   $field array from acf/load_field
 * @param  array  $choices The unformatted choices array
 *
 * @return array
 */
function get_choices( $field, $choices ) {
    foreach ( $choices as $key => $value ) {
        $field['choices'][ $key ] = $value;
    }
    return $field;
}
 
/**
 * Get the value of an array item by key
 *
 * @param   string  $key
 * @param   array   $names
 *
 * @return  string
 */
function get_value_from_key( $key = '', $names ) {
    if ( $key == '' || ! array_key_exists( $key, $names ) ) {
        return false;
    }
    return $names[$key];
}
 
/**
 * Retrieves array of all states and their state code.
 *
 * @return array Array of states
 */
function get_states_array() {
    return array(
        'AL' => __( 'Alabama' , 'textdomain' ),
        'AK' => __( 'Alaska' , 'textdomain' ),
        'AZ' => __( 'Arizona' , 'textdomain' ),
        'AR' => __( 'Arkansas' , 'textdomain' ),
        'CA' => __( 'California' , 'textdomain' ),
        'CO' => __( 'Colorado' , 'textdomain' ),
        'CT' => __( 'Connecticut' , 'textdomain' ),
        'DE' => __( 'Delaware' , 'textdomain' ),
        'DC' => __( 'District of Colombia' , 'textdomain' ),
        'FL' => __( 'Florida' , 'textdomain' ),
        'GA' => __( 'Georgia' , 'textdomain' ),
        'HI' => __( 'Hawaii' , 'textdomain' ),
        'ID' => __( 'Idaho' , 'textdomain' ),
        'IL' => __( 'Illinois' , 'textdomain' ),
        'IN' => __( 'Indiana' , 'textdomain' ),
        'IA' => __( 'Iowa' , 'textdomain' ),
        'KS' => __( 'Kansas' , 'textdomain' ),
        'KY' => __( 'Kentucky' , 'textdomain' ),
        'LA' => __( 'Louisiana' , 'textdomain' ),
        'ME' => __( 'Maine' , 'textdomain' ),
        'MD' => __( 'Maryland' , 'textdomain' ),
        'MA' => __( 'Massachusetts' , 'textdomain' ),
        'MI' => __( 'Michigan' , 'textdomain' ),
        'MN' => __( 'Minnesota' , 'textdomain' ),
        'MS' => __( 'Mississippi' , 'textdomain' ),
        'MO' => __( 'Missouri' , 'textdomain' ),
        'MT' => __( 'Montana' , 'textdomain' ),
        'NE' => __( 'Nebraska' , 'textdomain' ),
        'NV' => __( 'Nevada' , 'textdomain' ),
        'NH' => __( 'New Hampshire' , 'textdomain' ),
        'NJ' => __( 'New Jersey' , 'textdomain' ),
        'NM' => __( 'New Mexico' , 'textdomain' ),
        'NY' => __( 'New York' , 'textdomain' ),
        'NC' => __( 'North Carolina' , 'textdomain' ),
        'ND' => __( 'North Dakota' , 'textdomain' ),
        'OH' => __( 'Ohio' , 'textdomain' ),
        'OK' => __( 'Oklahoma' , 'textdomain' ),
        'OR' => __( 'Oregon' , 'textdomain' ),
        'PA' => __( 'Pennsylvania' , 'textdomain' ),
        'PR' => __( 'Puerto Rico' , 'textdomain' ),
        'RI' => __( 'Rhode Island' , 'textdomain' ),
        'SC' => __( 'South Carolina' , 'textdomain' ),
        'SD' => __( 'South Dakota' , 'textdomain' ),
        'TN' => __( 'Tennessee' , 'textdomain' ),
        'TX' => __( 'Texas' , 'textdomain' ),
        'UT' => __( 'Utah' , 'textdomain' ),
        'VT' => __( 'Vermont' , 'textdomain' ),
        'VA' => __( 'Virginia' , 'textdomain' ),
        'WA' => __( 'Washington' , 'textdomain' ),
        'WV' => __( 'West Virginia' , 'textdomain' ),
        'WI' => __( 'Wisconsin' , 'textdomain' ),
        'WY' => __( 'Wyoming' , 'textdomain' ),
    );
}
 
/**
 * Retrieves array of all countries and their ISO country code.
 * This needs to stay in sync with the ACF address_country field, if one changes, change the other
 *
 * @return array Array of countries.
 */
function get_countries_array() {
    return array(
        'AX' => __( 'Åland Islands', 'textdomain' ),
        'AF' => __( 'Afghanistan', 'textdomain' ),
        'AL' => __( 'Albania', 'textdomain' ),
        'DZ' => __( 'Algeria', 'textdomain' ),
        'AD' => __( 'Andorra', 'textdomain' ),
        'AO' => __( 'Angola', 'textdomain' ),
        'AI' => __( 'Anguilla', 'textdomain' ),
        'AQ' => __( 'Antarctica', 'textdomain' ),
        'AG' => __( 'Antigua and Barbuda', 'textdomain' ),
        'AR' => __( 'Argentina', 'textdomain' ),
        'AM' => __( 'Armenia', 'textdomain' ),
        'AW' => __( 'Aruba', 'textdomain' ),
        'AU' => __( 'Australia', 'textdomain' ),
        'AT' => __( 'Austria', 'textdomain' ),
        'AZ' => __( 'Azerbaijan', 'textdomain' ),
        'BS' => __( 'Bahamas', 'textdomain' ),
        'BH' => __( 'Bahrain', 'textdomain' ),
        'BD' => __( 'Bangladesh', 'textdomain' ),
        'BB' => __( 'Barbados', 'textdomain' ),
        'BY' => __( 'Belarus', 'textdomain' ),
        'PW' => __( 'Belau', 'textdomain' ),
        'BE' => __( 'Belgium', 'textdomain' ),
        'BZ' => __( 'Belize', 'textdomain' ),
        'BJ' => __( 'Benin', 'textdomain' ),
        'BM' => __( 'Bermuda', 'textdomain' ),
        'BT' => __( 'Bhutan', 'textdomain' ),
        'BO' => __( 'Bolivia', 'textdomain' ),
        'BQ' => __( 'Bonaire, Sint Eustatius and Saba', 'textdomain' ),
        'BA' => __( 'Bosnia and Herzegovina', 'textdomain' ),
        'BW' => __( 'Botswana', 'textdomain' ),
        'BV' => __( 'Bouvet Island', 'textdomain' ),
        'BR' => __( 'Brazil', 'textdomain' ),
        'IO' => __( 'British Indian Ocean Territory', 'textdomain' ),
        'VG' => __( 'British Virgin Islands', 'textdomain' ),
        'BN' => __( 'Brunei', 'textdomain' ),
        'BG' => __( 'Bulgaria', 'textdomain' ),
        'BF' => __( 'Burkina Faso', 'textdomain' ),
        'BI' => __( 'Burundi', 'textdomain' ),
        'KH' => __( 'Cambodia', 'textdomain' ),
        'CM' => __( 'Cameroon', 'textdomain' ),
        'CA' => __( 'Canada', 'textdomain' ),
        'CV' => __( 'Cape Verde', 'textdomain' ),
        'KY' => __( 'Cayman Islands', 'textdomain' ),
        'CF' => __( 'Central African Republic', 'textdomain' ),
        'TD' => __( 'Chad', 'textdomain' ),
        'CL' => __( 'Chile', 'textdomain' ),
        'CN' => __( 'China', 'textdomain' ),
        'CX' => __( 'Christmas Island', 'textdomain' ),
        'CC' => __( 'Cocos (Keeling) Islands', 'textdomain' ),
        'CO' => __( 'Colombia', 'textdomain' ),
        'KM' => __( 'Comoros', 'textdomain' ),
        'CG' => __( 'Congo (Brazzaville)', 'textdomain' ),
        'CD' => __( 'Congo (Kinshasa)', 'textdomain' ),
        'CK' => __( 'Cook Islands', 'textdomain' ),
        'CR' => __( 'Costa Rica', 'textdomain' ),
        'HR' => __( 'Croatia', 'textdomain' ),
        'CU' => __( 'Cuba', 'textdomain' ),
        'CW' => __( 'Curaçao', 'textdomain' ),
        'CY' => __( 'Cyprus', 'textdomain' ),
        'CZ' => __( 'Czech Republic', 'textdomain' ),
        'DK' => __( 'Denmark', 'textdomain' ),
        'DJ' => __( 'Djibouti', 'textdomain' ),
        'DM' => __( 'Dominica', 'textdomain' ),
        'DO' => __( 'Dominican Republic', 'textdomain' ),
        'EC' => __( 'Ecuador', 'textdomain' ),
        'EG' => __( 'Egypt', 'textdomain' ),
        'SV' => __( 'El Salvador', 'textdomain' ),
        'GQ' => __( 'Equatorial Guinea', 'textdomain' ),
        'ER' => __( 'Eritrea', 'textdomain' ),
        'EE' => __( 'Estonia', 'textdomain' ),
        'ET' => __( 'Ethiopia', 'textdomain' ),
        'FK' => __( 'Falkland Islands', 'textdomain' ),
        'FO' => __( 'Faroe Islands', 'textdomain' ),
        'FJ' => __( 'Fiji', 'textdomain' ),
        'FI' => __( 'Finland', 'textdomain' ),
        'FR' => __( 'France', 'textdomain' ),
        'GF' => __( 'French Guiana', 'textdomain' ),
        'PF' => __( 'French Polynesia', 'textdomain' ),
        'TF' => __( 'French Southern Territories', 'textdomain' ),
        'GA' => __( 'Gabon', 'textdomain' ),
        'GM' => __( 'Gambia', 'textdomain' ),
        'GE' => __( 'Georgia', 'textdomain' ),
        'DE' => __( 'Germany', 'textdomain' ),
        'GH' => __( 'Ghana', 'textdomain' ),
        'GI' => __( 'Gibraltar', 'textdomain' ),
        'GR' => __( 'Greece', 'textdomain' ),
        'GL' => __( 'Greenland', 'textdomain' ),
        'GD' => __( 'Grenada', 'textdomain' ),
        'GP' => __( 'Guadeloupe', 'textdomain' ),
        'GT' => __( 'Guatemala', 'textdomain' ),
        'GG' => __( 'Guernsey', 'textdomain' ),
        'GN' => __( 'Guinea', 'textdomain' ),
        'GW' => __( 'Guinea-Bissau', 'textdomain' ),
        'GY' => __( 'Guyana', 'textdomain' ),
        'HT' => __( 'Haiti', 'textdomain' ),
        'HM' => __( 'Heard Island and McDonald Islands', 'textdomain' ),
        'HN' => __( 'Honduras', 'textdomain' ),
        'HK' => __( 'Hong Kong', 'textdomain' ),
        'HU' => __( 'Hungary', 'textdomain' ),
        'IS' => __( 'Iceland', 'textdomain' ),
        'IN' => __( 'India', 'textdomain' ),
        'ID' => __( 'Indonesia', 'textdomain' ),
        'IR' => __( 'Iran', 'textdomain' ),
        'IQ' => __( 'Iraq', 'textdomain' ),
        'IM' => __( 'Isle of Man', 'textdomain' ),
        'IL' => __( 'Israel', 'textdomain' ),
        'IT' => __( 'Italy', 'textdomain' ),
        'CI' => __( 'Ivory Coast', 'textdomain' ),
        'JM' => __( 'Jamaica', 'textdomain' ),
        'JP' => __( 'Japan', 'textdomain' ),
        'JE' => __( 'Jersey', 'textdomain' ),
        'JO' => __( 'Jordan', 'textdomain' ),
        'KZ' => __( 'Kazakhstan', 'textdomain' ),
        'KE' => __( 'Kenya', 'textdomain' ),
        'KI' => __( 'Kiribati', 'textdomain' ),
        'KW' => __( 'Kuwait', 'textdomain' ),
        'KG' => __( 'Kyrgyzstan', 'textdomain' ),
        'LA' => __( 'Laos', 'textdomain' ),
        'LV' => __( 'Latvia', 'textdomain' ),
        'LB' => __( 'Lebanon', 'textdomain' ),
        'LS' => __( 'Lesotho', 'textdomain' ),
        'LR' => __( 'Liberia', 'textdomain' ),
        'LY' => __( 'Libya', 'textdomain' ),
        'LI' => __( 'Liechtenstein', 'textdomain' ),
        'LT' => __( 'Lithuania', 'textdomain' ),
        'LU' => __( 'Luxembourg', 'textdomain' ),
        'MO' => __( 'Macao S.A.R., China', 'textdomain' ),
        'MK' => __( 'Macedonia', 'textdomain' ),
        'MG' => __( 'Madagascar', 'textdomain' ),
        'MW' => __( 'Malawi', 'textdomain' ),
        'MY' => __( 'Malaysia', 'textdomain' ),
        'MV' => __( 'Maldives', 'textdomain' ),
        'ML' => __( 'Mali', 'textdomain' ),
        'MT' => __( 'Malta', 'textdomain' ),
        'MH' => __( 'Marshall Islands', 'textdomain' ),
        'MQ' => __( 'Martinique', 'textdomain' ),
        'MR' => __( 'Mauritania', 'textdomain' ),
        'MU' => __( 'Mauritius', 'textdomain' ),
        'YT' => __( 'Mayotte', 'textdomain' ),
        'MX' => __( 'Mexico', 'textdomain' ),
        'FM' => __( 'Micronesia', 'textdomain' ),
        'MD' => __( 'Moldova', 'textdomain' ),
        'MC' => __( 'Monaco', 'textdomain' ),
        'MN' => __( 'Mongolia', 'textdomain' ),
        'ME' => __( 'Montenegro', 'textdomain' ),
        'MS' => __( 'Montserrat', 'textdomain' ),
        'MA' => __( 'Morocco', 'textdomain' ),
        'MZ' => __( 'Mozambique', 'textdomain' ),
        'MM' => __( 'Myanmar', 'textdomain' ),
        'NA' => __( 'Namibia', 'textdomain' ),
        'NR' => __( 'Nauru', 'textdomain' ),
        'NP' => __( 'Nepal', 'textdomain' ),
        'NL' => __( 'Netherlands', 'textdomain' ),
        'AN' => __( 'Netherlands Antilles', 'textdomain' ),
        'NC' => __( 'New Caledonia', 'textdomain' ),
        'NZ' => __( 'New Zealand', 'textdomain' ),
        'NI' => __( 'Nicaragua', 'textdomain' ),
        'NE' => __( 'Niger', 'textdomain' ),
        'NG' => __( 'Nigeria', 'textdomain' ),
        'NU' => __( 'Niue', 'textdomain' ),
        'NF' => __( 'Norfolk Island', 'textdomain' ),
        'KP' => __( 'North Korea', 'textdomain' ),
        'NO' => __( 'Norway', 'textdomain' ),
        'OM' => __( 'Oman', 'textdomain' ),
        'PK' => __( 'Pakistan', 'textdomain' ),
        'PS' => __( 'Palestinian Territory', 'textdomain' ),
        'PA' => __( 'Panama', 'textdomain' ),
        'PG' => __( 'Papua New Guinea', 'textdomain' ),
        'PY' => __( 'Paraguay', 'textdomain' ),
        'PE' => __( 'Peru', 'textdomain' ),
        'PH' => __( 'Philippines', 'textdomain' ),
        'PN' => __( 'Pitcairn', 'textdomain' ),
        'PL' => __( 'Poland', 'textdomain' ),
        'PT' => __( 'Portugal', 'textdomain' ),
        'QA' => __( 'Qatar', 'textdomain' ),
        'IE' => __( 'Republic of Ireland', 'textdomain' ),
        'RE' => __( 'Reunion', 'textdomain' ),
        'RO' => __( 'Romania', 'textdomain' ),
        'RU' => __( 'Russia', 'textdomain' ),
        'RW' => __( 'Rwanda', 'textdomain' ),
        'ST' => __( 'São Tomé and Príncipe', 'textdomain' ),
        'BL' => __( 'Saint Barthélemy', 'textdomain' ),
        'SH' => __( 'Saint Helena', 'textdomain' ),
        'KN' => __( 'Saint Kitts and Nevis', 'textdomain' ),
        'LC' => __( 'Saint Lucia', 'textdomain' ),
        'SX' => __( 'Saint Martin (Dutch part)', 'textdomain' ),
        'MF' => __( 'Saint Martin (French part)', 'textdomain' ),
        'PM' => __( 'Saint Pierre and Miquelon', 'textdomain' ),
        'VC' => __( 'Saint Vincent and the Grenadines', 'textdomain' ),
        'SM' => __( 'San Marino', 'textdomain' ),
        'SA' => __( 'Saudi Arabia', 'textdomain' ),
        'SN' => __( 'Senegal', 'textdomain' ),
        'RS' => __( 'Serbia', 'textdomain' ),
        'SC' => __( 'Seychelles', 'textdomain' ),
        'SL' => __( 'Sierra Leone', 'textdomain' ),
        'SG' => __( 'Singapore', 'textdomain' ),
        'SK' => __( 'Slovakia', 'textdomain' ),
        'SI' => __( 'Slovenia', 'textdomain' ),
        'SB' => __( 'Solomon Islands', 'textdomain' ),
        'SO' => __( 'Somalia', 'textdomain' ),
        'ZA' => __( 'South Africa', 'textdomain' ),
        'GS' => __( 'South Georgia/Sandwich Islands', 'textdomain' ),
        'KR' => __( 'South Korea', 'textdomain' ),
        'SS' => __( 'South Sudan', 'textdomain' ),
        'ES' => __( 'Spain', 'textdomain' ),
        'LK' => __( 'Sri Lanka', 'textdomain' ),
        'SD' => __( 'Sudan', 'textdomain' ),
        'SR' => __( 'Suriname', 'textdomain' ),
        'SJ' => __( 'Svalbard and Jan Mayen', 'textdomain' ),
        'SZ' => __( 'Swaziland', 'textdomain' ),
        'SE' => __( 'Sweden', 'textdomain' ),
        'CH' => __( 'Switzerland', 'textdomain' ),
        'SY' => __( 'Syria', 'textdomain' ),
        'TW' => __( 'Taiwan', 'textdomain' ),
        'TJ' => __( 'Tajikistan', 'textdomain' ),
        'TZ' => __( 'Tanzania', 'textdomain' ),
        'TH' => __( 'Thailand', 'textdomain' ),
        'TL' => __( 'Timor-Leste', 'textdomain' ),
        'TG' => __( 'Togo', 'textdomain' ),
        'TK' => __( 'Tokelau', 'textdomain' ),
        'TO' => __( 'Tonga', 'textdomain' ),
        'TT' => __( 'Trinidad and Tobago', 'textdomain' ),
        'TN' => __( 'Tunisia', 'textdomain' ),
        'TR' => __( 'Turkey', 'textdomain' ),
        'TM' => __( 'Turkmenistan', 'textdomain' ),
        'TC' => __( 'Turks and Caicos Islands', 'textdomain' ),
        'TV' => __( 'Tuvalu', 'textdomain' ),
        'UG' => __( 'Uganda', 'textdomain' ),
        'UA' => __( 'Ukraine', 'textdomain' ),
        'AE' => __( 'United Arab Emirates', 'textdomain' ),
        'GB' => __( 'United Kingdom', 'textdomain' ),
        'US' => __( 'United States', 'textdomain' ),
        'UY' => __( 'Uruguay', 'textdomain' ),
        'UZ' => __( 'Uzbekistan', 'textdomain' ),
        'VU' => __( 'Vanuatu', 'textdomain' ),
        'VA' => __( 'Vatican', 'textdomain' ),
        'VE' => __( 'Venezuela', 'textdomain' ),
        'VN' => __( 'Vietnam', 'textdomain' ),
        'WF' => __( 'Wallis and Futuna', 'textdomain' ),
        'EH' => __( 'Western Sahara', 'textdomain' ),
        'WS' => __( 'Western Samoa', 'textdomain' ),
        'YE' => __( 'Yemen', 'textdomain' ),
        'ZM' => __( 'Zambia', 'textdomain' ),
        'ZW' => __( 'Zimbabwe', 'textdomain' ),
    );
}

?>