<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: check_stock.inc.php 48 2011-06-22 15:46:05Z siekiera $
* 	Letzter Stand:			$Revision: 48 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-22 17:46:05 +0200 (Wed, 22 Jun 2011) $
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

require_once(DIR_FS_INC.'inc.get_products_stock.php');
function check_stock($products_id, $products_quantity) {
	$stock_left = get_products_stock($products_id) - $products_quantity;
	$out_of_stock = '';

	if ($stock_left < 0)
		$out_of_stock = '<span class="products_out_of_stock">'.STOCK_MARK_PRODUCT_OUT_OF_STOCK.'</span>';

	return $out_of_stock;
}
?>