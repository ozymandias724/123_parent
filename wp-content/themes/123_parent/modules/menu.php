<?php 
/**
 *	Menu Section Template;
 *	4 Views:
 * 		JPG, PDF, List, Grid
 */
	$menus = get_field('menu-repeater', 'options');
 ?>
<section class="menus" id="menu">
	<?php 
		$guide = '';
		
		foreach( $menus as $menu){
			$name = $menu['menu-category-name'];
			$description = $menu['menu-category-description'];
			$type = $menu['menutype'];
			$content = '<div class="menus-menu">';			
			$guide = '
				<h3>%s</h3>
				<p>%s</p>
			';
			$content .= sprintf(
				$guide
				,$name
				,$description
			);

			switch ( $type )
			{
				case 'gallery':
					$content .= '<ul class="menus-menu-list">';

					$guide = '
						<li class="menus-menu-list-item">
							<img src="%s">
						</li>
					';
					foreach($menu['menu-gallery'] as $i => $image){
						$content .= sprintf(
							$guide
							,$image['url']
						);
					}
					$content .= '</ul>';

					break;

				case 'pdf':
					$guide = '
						<div class="menu-menus-menu-pdf">
							<iframe src="%s"></iframe>
						</div>
					';
					$content .= sprintf(
						$guide
						,$menu['pdfmenu']
					);
					break;

				case 'list':
					$content .= '<ul class="menus-menu-list">';
					$guide = '
						<li class="menus-menu-list-item">
							<h4>%s</h4><h4>%s</h4><p>%s</p>
						</li>
					';
					foreach ($menu['menu-category-list-repeater'] as $i => $list) {
						$content .= sprintf(
							$guide
							,$list['menu-list-item-name']
							,$list['menu-list-item-price']
							,$list['menu-list-item-description']
						);
					}
					$content .= '</ul>';
					break;

				case 'masonry':
					$content .= '<ul class="menus-menu-list">';
					$guide = '
						<li class="menus-menu-list-item">
							%s
							<h4>%s</h4><h4>%s</h4><p>%s</p>
						</li>
					';
					foreach ($menu['menu-category-repeater'] as $i => $list) {
						$doImage = null;
						if( $list['menu-item-picture-toggle'] ){
							$doImage = '<figure><img src="'.$list['menu-item-picture'].'"></figure>';
						}
						$content .= sprintf(
							$guide
							,$doImage
							,$list['menu-item-name']
							,$list['menu-item-price']
							,$list['menu-item-description']
						);
					}
					$content .= '</ul>';
					break;

				default:
					break;
			}

			$content .= '</div>';
			echo $content;
		}
	 ?>
</section>
