<?php 

/**
 * nav related stuff
 */
class NavUtil extends MiscUtil
{
	public static $activePageTitles
		, $activePageNames
		, $activePageLinks
		, $navItemData
		, $acfPageList;
	
	function __construct()
	{
		add_action( 'acf/init', NavUtil::_init() );
	}
		
	function _init()
	{
		// get the active pages as set by the repeater module (not extra pages!)
		NavUtil::$acfPageList = get_field('field_naaolkn23oin', 'options');

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
	public static function render_nav_links($css_prefix = "navlinks"){
		echo '<ul class="'. $css_prefix .'">';
		foreach (NavUtil::$navItemData as $i => $navItem) :
			NavUtil::$navItemData[$i]['permalink'] = get_site_url() . "/#" . NavUtil::$activePageNames[$i];
		?>
			<li class="<?php echo $css_prefix . "-item" ?>">
				<a class="<?php echo $css_prefix . '-item-link' ?>" href="<?php echo NavUtil::$navItemData[$i]['permalink']; ?>">
					<?php echo NavUtil::$navItemData[$i]['title']; ?>
				</a>
			</li>		
		<?php
		endforeach;
		echo "</ul>";
	}
}

$NavUtil = new NavUtil();
 ?>