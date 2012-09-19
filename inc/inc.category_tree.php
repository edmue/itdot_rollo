<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.category_tree.php 446 2012-06-11 12:37:20Z siekiera $
* 	Letzter Stand:			$Revision: 446 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2012-06-11 14:37:20 +0200 (Mon, 11 Jun 2012) $
*
* 	SEO:mercari by Siekiera Media
* 	http://www.seo-mercari.de
*
* 	Copyright © since 2011 SEO:mercari
* --------------------------------------------------------------------------------------
* 	based on:
* 	© 2000-2001 The Exchange Project  (earlier name of osCommerce)
* 	© 2002-2003 osCommerce - www.oscommerce.com
* 	© 2003     nextcommerce - www.nextcommerce.org
* 	© 2005     xt:Commerce - www.xt-commerce.com
*
* 	Released under the GNU General Public License
* ----------------------------------------------------------------------------------- */

function categories($catid = 0, $level = 1, $num = 1) {

	global $cPath, $current_category_id, $cat_config, $db;

	$myPathArray = explode('_',$cPath);

	if(GROUP_CHECK == 'true')
		$group_check = " AND c.group_permission_".$_SESSION['customers_status']['customers_status_id']." = 1 ";

	$categories = $db->db_query("SELECT
										c.categories_id,
										cd.categories_name
									FROM
										".TABLE_CATEGORIES." c
										LEFT JOIN ".TABLE_CATEGORIES_DESCRIPTION." AS cd
										ON (cd.categories_id = c.categories_id AND cd.language_id = ".(int)$_SESSION['languages_id'].")
									WHERE
										c.parent_id = '".(int)$catid."'
									AND
										c.num = '".(int)$num."'
									AND
										c.categories_status = 1
										".$group_check."
									ORDER BY
										sort_order", true);

	while(!$categories->EOF) {
		$open_ul = '';
		$current = false;
		$more_categories = '';
		if($categories->fields['categories_id'] == $current_category_id)
			$current = '_current current';
			
		elseif(in_array($categories->fields['categories_id'], $myPathArray)) {
			$current = '_current currentparent';
			$open_ul = 'current_ul';
		}
		
		if(SHOW_COUNTS == 'true' || $cat_config['hide_empty'] == true)
			$products = count_products_in_category($categories->fields['categories_id']);
		
		if(($products != 0 && $cat_config['hide_empty'] == true) || ($cat_config['hide_empty'] == false)) {
			$cat_tree .= '<li class="li_level_'.$level.(!empty($open_ul)?' '.$open_ul:'').'">
							<a class="a_level_'.$level.$current.'" href="'.href_link(FILENAME_DEFAULT, 'cPath='.$categories->fields['categories_id']).'">'
								.$categories->fields['categories_name'];

								if($more_categories = categories($categories->fields['categories_id'], $level+1, $num))
									$cat_tree .= '<span>&nbsp;</span>';
				
								if(SHOW_COUNTS == 'true')
									$cat_tree .= ' <em>('.$products.')</em>';
			
			$cat_tree .= '	</a>';

			if(($level < $cat_config['min_level'] || $current) && ($level < $cat_config['max_level'] || !$cat_config['max_level']))
				$cat_tree .= $more_categories;
			
			$cat_tree .= '</li>';
		}
		$categories->MoveNext();
	}

	if($cat_tree) {
		if($level == 1)
			$class .= ' class="navigation '.$cat_config['type'].' categories_'.$num.'"';

		return '<ul'.$class.'>'.$cat_tree.'</ul>';
	}
}