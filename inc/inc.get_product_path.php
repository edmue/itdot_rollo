<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_product_path.inc.php 172 2011-08-18 14:14:01Z siekiera $
* 	Letzter Stand:			$Revision: 172 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-18 16:14:01 +0200 (Thu, 18 Aug 2011) $
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

function get_product_path($products_id) {
	global $db;

	require_once(DIR_FS_INC.'inc.get_parent_categories.php');

	$cPath = '';

	$category = $db->db_query("SELECT
									p2c.categories_id
								FROM
									".TABLE_PRODUCTS." p,
									".TABLE_PRODUCTS_TO_CATEGORIES." p2c
								WHERE
									p.products_id = '".(int)$products_id."'
								AND
									p.products_status = '1'
								AND
									p.products_id = p2c.products_id
								AND
									p2c.categories_id != 0
								LIMIT 1");
	if($category->_numOfRows) {
		$categories = array();
		get_parent_categories($categories, $category->fields['categories_id']);

		$categories = array_reverse($categories);

		$cPath = implode('_', $categories);

		if (not_null($cPath)) 
			$cPath .= '_';
			
		$cPath .= $category->fields['categories_id'];
	}
	return $cPath;
}
?>