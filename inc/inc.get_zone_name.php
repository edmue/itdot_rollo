<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_zone_name.inc.php 270 2011-09-16 09:56:54Z siekiera $
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

function get_zone_name($country_id, $zone_id, $default_zone) {
	global $db;

	$zone = $db->db_query("SELECT zone_name from " . TABLE_ZONES . " WHERE zone_country_id = '" . $country_id . "' and zone_id = " . $zone_id);
	if($zone->_numOfRows)
		return $zone->fields['zone_name'];
	else
		return $default_zone;
}
?>