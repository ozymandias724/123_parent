<?php 

class FusionTableHandler{


	private $table_prefix;

	public function __construct(){
		global $wpdb;
		$this->table_prefix = $wpdb->prefix . '123ft_';
	}
	public function get_countries_for_acf_select(){
		global $wpdb;
		$results = $wpdb->get_results('SELECT ISO_2DIGIT, Name FROM ' . $this->table_prefix . 'countries ORDER BY Name;', ARRAY_N);
		$for_return = [];
		foreach($results as $result){
			$for_return[$result[0]] = $result[1];
		}
		return $for_return;
	}
	public function get_states_for_acf_select(){
		global $wpdb;
		$results = $wpdb->get_results('SELECT id, name FROM ' . $this->table_prefix . 'states ORDER BY name;', ARRAY_N);
		$for_return = [];
		foreach($results as $result){
			$for_return[$result[0]] = $result[1];
		}
		return $for_return;
	}

	public function get_states_geometry($states){
		global $wpdb;	
		$sql_states = '';
		foreach($states as $index => $state){
			if( $index !== count($states) - 1 ){
				$sql_states .= '"' . $state . '", ';
			}
			else{
				$sql_states .= '"' . $state . '"';
			}
		}
		$result = $wpdb->get_results('SELECT geometry FROM ' . $this->table_prefix . 'states WHERE id IN (' . $sql_states . ');', ARRAY_A);
		return $result;
	}

	public function get_counties_geometry($counties){
		global $wpdb;	
		$sql_counties = '';
		foreach($counties as $index => $county){
			if( $index !== count($counties) - 1 ){
				$sql_counties .= '"' . $county . '", ';
			}
			else{
				$sql_counties .= '"' . $county . '"';
			}
		}
		$result = $wpdb->get_results('SELECT geometry FROM ' . $this->table_prefix . 'counties WHERE basic_county IN (' . $sql_counties . ');', ARRAY_A);
		return $result;
	}

	public function get_countries_geometry($countries){
		global $wpdb;	
		$sql_countries = '';
		foreach($countries as $index => $country){
			if( $index !== count($countries) - 1 ){
				$sql_countries .= '"' . $country . '", ';
			}
			else{
				$sql_countries .= '"' . $country . '"';
			}
		}
		$result = $wpdb->get_results('SELECT geometry FROM ' . $this->table_prefix . 'countries WHERE ISO_2DIGIT IN (' . $sql_countries . ');', ARRAY_A);
		return $result;
	}
}

$fth = new FusionTableHandler();

?>