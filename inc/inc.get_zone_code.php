<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_zone_code.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_zone_code($country_id, $zone_id, $default_zone) {
	global $db;

	$zone = $db->db_query("SELECT zone_code FROM ".TABLE_ZONES." WHERE zone_country_id = '".$country_id."' AND zone_id = ".$zone_id);

	if($zone->_numOfRows)
		return $zone->fields['zone_code'];
	else
		return $default_zone;
}
?>