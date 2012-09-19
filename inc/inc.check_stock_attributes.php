<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: check_stock_attributes.inc.php 52 2011-06-23 20:00:43Z siekiera $
* 	Letzter Stand:			$Revision: 52 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-23 22:00:43 +0200 (Thu, 23 Jun 2011) $
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

function check_stock_attributes($attribute_id, $products_quantity) {
	global $db;

	$stock_data = $db->db_query("SELECT
									attributes_stock
								FROM
									".TABLE_PRODUCTS_ATTRIBUTES."
								WHERE
									products_attributes_id='".$attribute_id."'");

	$stock_left = $stock_data->fields['attributes_stock'] - $products_quantity;
	$out_of_stock = '';

	if($stock_left < 1)
		$out_of_stock = '<span class="markProductOutOfStock">' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</span>';

	return $out_of_stock;
}
?>