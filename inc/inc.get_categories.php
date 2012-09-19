<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_categories.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_categories($categories_array = '', $parent_id = '0', $indent = '') {
	global $db;

	$parent_id = $parent_id;

	if (!is_array($categories_array))
		$categories_array = array();

	$categories = $db->db_query("SELECT
									c.categories_id,
									cd.categories_name
								FROM
									".TABLE_CATEGORIES." c,
									".TABLE_CATEGORIES_DESCRIPTION." cd
								WHERE
									parent_id = ".$db->db_prepare($parent_id)."
								AND
									c.categories_id = cd.categories_id
								AND
									c.categories_status != 0
								AND
									cd.language_id = '".$_SESSION['languages_id']."'
								ORDER BY
									sort_order, cd.categories_name");

	while(!$categories->EOF) {
		$categories_array[] = array('id' => $categories->fields['categories_id'], 'text' => $indent.$categories->fields['categories_name']);

		if ($categories->fields['categories_id'] != $parent_id)
			$categories_array = get_categories($categories_array, $categories->fields['categories_id'], $indent.'&nbsp;&nbsp;');
		$categories->MoveNext();
	}

	return $categories_array;
}
?>