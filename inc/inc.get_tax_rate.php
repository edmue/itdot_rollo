<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_tax_rate.inc.php 113 2011-07-25 11:00:49Z siekiera $
* 	Letzter Stand:			$Revision: 113 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-25 13:00:49 +0200 (Mon, 25 Jul 2011) $
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

function get_tax_rate($class_id, $country_id = -1, $zone_id = -1) {
	global $db;

	if(($country_id == -1) && ($zone_id == -1)) {
		if (!isset($_SESSION['customer_id'])) {
			$country_id = STORE_COUNTRY;
			$zone_id = STORE_ZONE;
		} else {
			$country_id = $_SESSION['customer_country_id'];
			$zone_id = $_SESSION['customer_zone_id'];
		}
	} else {
		$country_id = $country_id;
		$zone_id = $zone_id;
	}

	$tax = $db->db_query("SELECT
								sum(tax_rate) AS tax_rate
							FROM
								" . TABLE_TAX_RATES . " tr
								LEFT JOIN
									" . TABLE_ZONES_TO_GEO_ZONES . " za ON (tr.tax_zone_id = za.geo_zone_id)
								LEFT JOIN
									" . TABLE_GEO_ZONES . " tz ON (tz.geo_zone_id = tr.tax_zone_id)
							WHERE
								(za.zone_country_id is null or za.zone_country_id = '0' OR za.zone_country_id = '" . $country_id . "')
							AND
								(za.zone_id is null OR za.zone_id = '0' OR za.zone_id = '" . $zone_id . "')
							AND
								tr.tax_class_id = '" . $class_id . "'
							GROUP BY
								tr.tax_priority");
	if($tax->_numOfRows) {
		$tax_multiplier = 1.0;
		while(!$tax->EOF) {
			$tax_multiplier *= 1.0 + ($tax->fields['tax_rate'] / 100);
			$tax->MoveNext();
		}
		return ($tax_multiplier - 1.0) * 100;

	} else
		return 0;
}
?>