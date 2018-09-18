<?php 

	// Simpler call to get_sub_field if !empty or return null
	if( !function_exists("get_subfield_ternary") ){
		function get_subfield_ternary($field, $post_id){
			return ( !empty(get_sub_field("$field", "$post_id")) ) ? get_sub_field("$field", "$post_id") : null;
		}
	}

	// recursive empty() for arrays
	if( !function_exists('is_array_empty') ){
		function is_array_empty($InputVariable){
		   $Result = true;

		   if (is_array($InputVariable) && count($InputVariable) > 0){
		      foreach ($InputVariable as $Value){
		         $Result = $Result && is_array_empty($Value);
		      }
		   }
		   else{
		      $Result = empty($InputVariable);
		   }

		   return $Result;
		}
	}


	// unregisters a post type if found
	if ( ! function_exists( 'unregister_post_type' ) ) :
		function unregister_post_type( $post_type ) {
		    global $wp_post_types;
		    if ( isset( $wp_post_types[ $post_type ] ) ) {
		        unset( $wp_post_types[ $post_type ] );
		        return true;
		    }
		    return false;
		}
	endif;



	// determines if an acf repeater is empty
	if(!function_exists('rows_empty')){
		function rows_empty($key, $src = 'option'){
			try {
				$rows = get_field($key, $src);
				$count = [];
				foreach( $rows as $row ){
					array_values($row)[0] == false ? array_push($count, false) : array_push($count, true);
				}
				if( in_array(true, $count) ){
					return false;
				}
				else{
					return true;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
	}

	// recursive strpos returns array of positions of needle in haystack
	if( !function_exists('strpos_r') ){
		function strpos_r($haystack, $needle){
			$lastPos = 0;
			$positions = [];
			while ( ( $lastPos = strpos($haystack, $needle, $lastPos) ) !== false ) {
			    $positions[] = $lastPos;
			    $lastPos = $lastPos + strlen($needle);
			}
			return $positions;
		}
	}

	if( !function_exists('URL_exists') ){
		function URL_exists($url){
			$ch = curl_init($url);    
		    curl_setopt($ch, CURLOPT_NOBODY, true);
		    curl_exec($ch);
		    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		    if($code == 200){
		    	$status = true;
		    }
		    else{
	    		$status = false;
		    }
		    curl_close($ch);
		   	return $status;
		}
	}


 ?>