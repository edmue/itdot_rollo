<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_parent_categories.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_parent_categories(&$categories, $categories_id) {
	global $db;

	$parent_categories = $db->db_query("SELECT parent_id FROM " . TABLE_CATEGORIES . " WHERE categories_id = " . $categories_id . "");

	while(!$parent_categories->EOF) {

		if($parent_categories->fields['parent_id'] == 0)
			return true;

		$categories[sizeof($categories)] = $parent_categories->fields['parent_id'];

		if($parent_categories->fields['parent_id'] != $categories_id)
			get_parent_categories($categories, $parent_categories->fields['parent_id']);

		$parent_categories->MoveNext();
	}
}
?>