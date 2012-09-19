<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: parse_category_path.inc.php 96 2011-07-12 14:06:27Z siekiera $
* 	Letzter Stand:			$Revision: 96 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-12 16:06:27 +0200 (Tue, 12 Jul 2011) $
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

require_once(DIR_FS_INC.'inc.string_to_int.php');

function parse_category_path($cPath) {
	$cPath_array = array_map('string_to_int', explode('_', $cPath));
	return array_unique($cPath_array);
}
?>