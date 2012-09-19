<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_countries.inc.php 270 2011-09-16 09:56:54Z siekiera $
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

function get_countriesList($countries_id = '', $with_iso_codes = false) {
	global $db;

	$countries_array = array();
	if(not_null($countries_id)) {
		if($with_iso_codes == true) {
			$countries = $db->db_query("SELECT countries_name, countries_iso_code_2, countries_iso_code_3 from " . TABLE_COUNTRIES . " WHERE countries_id = " . $countries_id . " and status = '1' ORDER BY countries_name");

			$countries_array = array('countries_name' => $countries->fields['countries_name'],
									'countries_iso_code_2' => $countries->fields['countries_iso_code_2'],
									'countries_iso_code_3' => $countries->fields['countries_iso_code_3']);
		} else {
			$countries = $db->db_query("SELECT countries_name from " . TABLE_COUNTRIES . " WHERE countries_id = " . $countries_id . " and status = '1'");
			$countries_array = array('countries_name' => $countries->fields['countries_name']);
		}

	} else {
		$countries = $db->db_query("SELECT countries_id, countries_name from " . TABLE_COUNTRIES . " WHERE status = '1' ORDER BY countries_name");
		while(!$countries->EOF) {
			$countries_array[] = array(	'countries_id' => $countries->fields['countries_id'],
										'countries_name' => $countries->fields['countries_name']);
			$countries->MoveNext();
		}
	}

	return $countries_array;
}
?>