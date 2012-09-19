<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: check_categories_status.inc.php 2 2011-06-06 12:08:34Z siekiera $
* 	Letzter Stand:			$Revision: 2 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-06 14:08:34 +0200 (Mon, 06 Jun 2011) $
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

function check_categories_status($categories_id) {
	global $db;

	if(!$categories_id)
		return 0;

	$category = $db->db_query("SELECT
									parent_id,
									categories_status
								FROM
									".TABLE_CATEGORIES."
								WHERE
									categories_id = '".(int) $categories_id."'");

	if($category->fields['categories_status'] == 0)
		return 1;
	else {
		if ($category->fields['parent_id'] != 0) {
			if (check_categories_status($category->fields['parent_id']) >= 1)
				return 1;
		}
		return 0;
	}
}

/*
function get_categoriesstatus_for_product($product_id) {
	global $db;

	$category = $db->db_query("SELECT
									categories_id
								FROM
									".TABLE_PRODUCTS_TO_CATEGORIES."
								WHERE
									products_id='".$product_id."'");

	while(!$category->EOF) {
		if (check_categories_status($category->fields['categories_id']) >= 1)
			return 1;
		else
			return 0;

		echo $categorie_data['categories_id'];

	}
}
*/
?>