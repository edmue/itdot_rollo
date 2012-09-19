<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_subcategories.inc.php 270 2011-09-16 09:56:54Z siekiera $
* 	Letzter Stand:			$Revision: 270 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-16 11:56:54 +0200 (Fri, 16 Sep 2011) $
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

function get_subcategories(&$subcategories_array, $parent_id = 0) {
	global $db;
	
	$subcategories = $db->db_query("SELECT categories_id FROM ".TABLE_CATEGORIES." WHERE parent_id = '".$parent_id."'");

	while(!$subcategories->EOF) {
		$subcategories_array[sizeof($subcategories_array)] = $subcategories->fields['categories_id'];
		if($subcategories->fields['categories_id'] != $parent_id)
			get_subcategories($subcategories_array, $subcategories->fields['categories_id']);
		$subcategories->MoveNext();
	}
}
?>