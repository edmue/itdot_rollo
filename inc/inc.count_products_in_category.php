<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: count_products_in_category.inc.php 93 2011-07-08 17:47:44Z siekiera $
* 	Letzter Stand:			$Revision: 93 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-08 19:47:44 +0200 (Fri, 08 Jul 2011) $
*
* 	SEO:mercari by Siekiera Media
* 	http://www.seo-mercari.de
*
* 	Copyright (c) since 2011 SEO:mercari
* --------------------------------------------------------------------------------------
* 	based on:
* 	(c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
* 	(c) 2002-2003 osCommerce - www.oscommerce.com
* 	(c) 2003     nextcommerce - www.nextcommerce.org
* 	(c) 2005     xt:Commerce - www.xt-commerce.com
*
* 	Released under the GNU General Public License
* ----------------------------------------------------------------------------------- */

function count_products_in_category($category_id, $include_inactive = false) {
	global $db;
	
	$products_count = 0;
	
	if ($include_inactive == true)
		$and = " AND p.products_status = '1' ";
		
	$products = $db->db_query("SELECT 
									COUNT(*) AS total 
								FROM 
									".TABLE_PRODUCTS." p, 
									".TABLE_PRODUCTS_TO_CATEGORIES." p2c 
								WHERE 
									p.products_id = p2c.products_id 
								AND 
									p2c.categories_id = '".$category_id."'".$and, true);
	
	$products_count += $products->fields['total'];
	
	$child_categories = $db->db_query("SELECT categories_id FROM ".TABLE_CATEGORIES." WHERE parent_id = '".$category_id."'", true);
	
	if ($child_categories->_numOfRows) {
		while (!$child_categories->EOF) {
			$products_count += count_products_in_category($child_categories->fields['categories_id'], $include_inactive);
			$child_categories->MoveNext();
		}
	}
	
	return $products_count;
}