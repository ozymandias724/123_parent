<?php 
/**
 * NavUtil handles config and render the main site nav
 */
class NavUtil
{
	public static $activePageTitles
		, $activePageNames
		, $activePageLinks
		, $navItemData
		, $acfPageList;
	
	function __construct()
	{
		add_action('acf/init', array($this, '_init'));
	}
		
	function _init()
	{
		// get the active pages as set by the repeater module (not extra pages!)
		$acfPageList = get_field('field_naaolkn23oin', 'options');
		if( !empty($acfPageList) ){
			
			NavUtil::$acfPageList = $acfPageList;


			// get the 'slug' required for that page (from acf value not post object)
			NavUtil::$activePageNames = array_values(array_column(NavUtil::$acfPageList, 'page-template'));
			// get post permalinks for the active pages defined by the required slug value (not actual slug if changed somehow)
			NavUtil::$activePageLinks = array_values(array_map(function($val){
				return get_the_permalink( get_page_by_path($val, ARRAY_A)['ID']);
			}, NavUtil::$activePageNames));

			// get the post_title for the required pages slug value
			NavUtil::$activePageTitles = array_values(array_map(function($val){
				return get_page_by_path($val, ARRAY_A)['post_title'];
			}, NavUtil::$activePageNames));


			foreach (NavUtil::$acfPageList as $i => $page) {
				# code...
				NavUtil::$navItemData[$i]['permalink'] = NavUtil::$activePageLinks[$i];
				NavUtil::$navItemData[$i]['slug'] = NavUtil::$activePageNames[$i];
				NavUtil::$navItemData[$i]['title'] = NavUtil::$activePageTitles[$i];
			}

		}

	}
	/**
	 * echoes the main nav as html
	 * @param  string $prepend [prepend the default classes]
	 */
	public static function render_nav_links($prepend = "navlinks"){
		if( empty(NavUtil::$navItemData) ){
			NavUtil::_init();
		}
		// wrapper
		echo '<ul class="'.$prepend.'">';
		// each link
		foreach (NavUtil::$navItemData as $i => $navItem) :
			// vars
			$title = NavUtil::$navItemData[$i]['title'];
			$link = NavUtil::$navItemData[$i]['permalink'];

			// toggle #hash nav
			if( wp_get_theme()->Name == '123_three' || wp_get_theme()->Name == '123_one' ){
				$link = get_site_url() . "/" . NavUtil::$activePageNames[$i];
			} else {
				$link = get_site_url() . "/#" . NavUtil::$activePageNames[$i];
			}
		?>
			<li class="<?php echo $prepend . "-item" ?>">
				<a data-scroll class="<?php echo $prepend . '-item-link' ?>" href="<?php echo $link; ?>">
					<?php echo $title; ?>
				</a>
			</li>		
		<?php
		endforeach;
		echo "</ul>";
	}

    /**
     * returns a formatted string of ul.navlinks > li.navlinks-item > a.navlinks-item-link or custom base class
     *
     * @param string $prepend
     * @return string
     */
	public static function get_nav_links($prepend = 'navlinks' ){
		$nav_format = '<li class="%s-item"><a class="%s-item-link" href="%s" title="Menu button">%s</a></li>';
		$nav = '<ul class="'.$prepend.'">';
		if( !empty(NavUtil::$navItemData) ){
			foreach(NavUtil::$navItemData as $i => $navItem){
				// vars
				$title = NavUtil::$navItemData[$i]['title'];
				$link = NavUtil::$navItemData[$i]['permalink'];
				// toggle #hash nav
				if( wp_get_theme()->Name == '123_three' || wp_get_theme()->Name == '123_one' ){
					$link = get_site_url() . "/" . NavUtil::$activePageNames[$i];
				} else {
					$link = get_site_url() . "/#" . NavUtil::$activePageNames[$i];
				}

				$nav .= sprintf(
					$nav_format
					,$prepend
					,$prepend
					,$link
					,$title
				);
			}
		}
		$nav .= '</ul>';
		return $nav;
	}
}
new NavUtil();
 ?>