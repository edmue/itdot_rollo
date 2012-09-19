<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_path.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_path($current_category_id = '') {
	global $cPath_array, $db;

	if(not_null($current_category_id)) {
		$cp_size = sizeof($cPath_array);
		if ($cp_size == 0)
			$cPath_new = $current_category_id;

		else {
			$cPath_new = '';

			$last_category = $db->db_query_limit("SELECT
														parent_id
													FROM
														" . TABLE_CATEGORIES . "
													WHERE
														categories_id = '" . $cPath_array[($cp_size-1)] . "'", 1);

			$current_category = $db->db_query_limit("SELECT
														parent_id
													FROM
														" . TABLE_CATEGORIES . "
													WHERE
														categories_id = '" . $current_category_id . "'", 1);

			if ($last_category->fields['parent_id'] == $current_category->fields['parent_id']) {
				for($i=0; $i<($cp_size-1); $i++)
					$cPath_new .= '_' . $cPath_array[$i];
			} else {
				for($i=0; $i<$cp_size; $i++)
					$cPath_new .= '_' . $cPath_array[$i];
			}
			$cPath_new .= '_' . $current_category_id;

			if (substr($cPath_new, 0, 1) == '_')
				$cPath_new = substr($cPath_new, 1);
		}

	} else
		$cPath_new = (not_null($cPath_array)) ? implode('_', $cPath_array) : '';

	return 'cPath=' . $cPath_new;
}
?>