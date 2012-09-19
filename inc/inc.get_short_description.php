<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_short_description.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_short_description($product_id, $language = '') {
	global $db;

	if(empty($language))
		$language = $_SESSION['languages_id'];

	$product = $db->db_query("SELECT products_short_description FROM " . TABLE_PRODUCTS_DESCRIPTION . " WHERE products_id = '" . $product_id . "' AND language_id = '" . $language . "'");

	return $product->fields['products_short_description'];
}
?>