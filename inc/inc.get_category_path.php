<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_category_path.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_category_path($cID) {
	require_once(DIR_FS_INC.'inc.get_parent_categories.php');

	$cPath = '';

	$category = $cID;

	$categories = array();
	get_parent_categories($categories, $cID);

	$categories = array_reverse($categories);

	$cPath = implode('_', $categories);

	if(not_null($cPath))
		$cPath .= '_';

	$cPath .= $cID;

	return $cPath;
}
?>