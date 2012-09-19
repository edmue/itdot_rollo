<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: address_summary.inc.php 270 2011-09-16 09:56:54Z siekiera $
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
   
function address_summary($customers_id, $address_id) {
	global $db;
	
	$customers_id = $db->db_prepare($customers_id);
	$address_id = $db->db_prepare($address_id);
	
	$address = $db->db_query("	SELECT 
									ab.entry_street_address, 
									ab.entry_suburb, 
									ab.entry_postcode, 
									ab.entry_city, 
									ab.entry_state, 
									ab.entry_country_id, 
									ab.entry_zone_id, 
									c.countries_name, 
									c.address_format_id 
								FROM 
									".TABLE_ADDRESS_BOOK." ab, 
									".TABLE_COUNTRIES." c 
								WHERE 
									ab.address_book_id = ".$db->db_prepare($address_id)." 
								AND 
									ab.customers_id = ".$db->db_prepare($customers_id)." 
								AND 
									ab.entry_country_id = c.countries_id");
	
	$street_address = $address->fields['entry_street_address'];
	$suburb = $address->fields['entry_suburb'];
	$postcode = $address->fields['entry_postcode'];
	$city = $address->fields['entry_city'];
	$state = get_zone_code($address->fields['entry_country_id'], $address->fields['entry_zone_id'], $address->fields['entry_state']);
	$country = $address->fields['countries_name'];
	
	$address_format = $db->db_query("	SELECT 
											address_summary 
										FROM 
											".TABLE_ADDRESS_FORMAT." 
										WHERE 
											address_format_id = '".$address->fields['address_format_id']."'");
	
	$address_summary = $address_format->fields['address_summary'];
	eval("\$address = \"$address_summary\";");
	
	return $address;
}
 ?>