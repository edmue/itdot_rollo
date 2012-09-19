<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_brand.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_brand($brand_array = '') {
	global $db;
	if (!is_array($brand_array))
		$brand_array = array();

	$brand = $db->db_query("SELECT brand_id, brand_name FROM ".TABLE_BRAND." ORDER BY brand_name");
	while(!$brand->EOF) {
		$brand_array[] = array('id' => $brand->fields['brand_id'], 'text' => $brand->fields['brand_name']);
		$brand->MoveNext();
	}

	return $brand_array;
}
?>