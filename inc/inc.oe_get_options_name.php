<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: oe_get_options_name.inc.php 126 2011-08-05 15:18:24Z peter $
* 	Letzter Stand:			$Revision: 126 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-05 17:18:24 +0200 (Fri, 05 Aug 2011) $
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

function oe_get_options_name($products_options_id, $language = '') {
	global $db;

if (empty($language)) 
	$language = $_SESSION['languages_id'];

	$product_query = $db->db_query("SELECT 
										products_options_name 
									FROM 
										".TABLE_PRODUCTS_OPTIONS." 
									WHERE 
										products_options_id = '".$products_options_id."' 
									AND 
										language_id = '".$language."'");
	
	return $product->fields['products_options_name'];
}
?>