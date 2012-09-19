<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: address_format.inc.php 270 2011-09-16 09:56:54Z siekiera $
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

require_once(DIR_FS_INC.'inc.get_country_name.php');

function address_format($address_format_id, $address, $html, $boln, $eoln) {
	global $db;

	$address_format = $db->db_query("SELECT
										address_format AS format
									FROM
										".TABLE_ADDRESS_FORMAT."
									WHERE
										address_format_id = '".$address_format_id."'");

	$company = addslashes($address['company']);
	$firstname = addslashes($address['firstname']);
	$lastname = addslashes($address['lastname']);
	$street = addslashes($address['street_address']);
	$suburb = addslashes($address['suburb']);
	$city = addslashes($address['city']);
	$state = addslashes($address['state']);
	$country_id = $address['country_id'];
	$zone_id = $address['zone_id'];
	$postcode = addslashes($address['postcode']);
	$zip = $postcode;
	$country = get_country_name($country_id);

	if($html) {
		$HR = '<hr />';
		$hr = '<hr />';
		if (($boln == '') && ($eoln == "\n")) {
			$CR = '<br />';
			$cr = '<br />';
			$eoln = $cr;
		} else {
			$CR = $eoln.$boln;
			$cr = $CR;
		}
	} else {
		$CR = $eoln;
		$cr = $CR;
		$HR = '----------------------------------------';
		$hr = '----------------------------------------';
	}

	$statecomma = '';
	$streets = $street;
	if($suburb != '')
		$streets = $street.$cr.$suburb;

	if($firstname == '')
		$firstname = addslashes($address['name']);

	if($country == '')
		$country = addslashes($address['country']);

	$fmt = $address_format->fields['format'];
	eval("\$address = \"$fmt\";");

	if(!empty($company))
		$address = $company.$cr.$address;

	$address = stripslashes($address);

	return $address;
}