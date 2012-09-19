<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: oe_customer_infos.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function  oe_customer_infos($customers_id) {
	global $db;

	$customer = $db->db_query("SELECT
									a.entry_country_id,
									a.entry_zone_id
								FROM
									".TABLE_CUSTOMERS." c,
									".TABLE_ADDRESS_BOOK." a
								WHERE
									c.customers_id  = '".$customers_id."'
								AND
									c.customers_id = a.customers_id
								AND
									c.customers_default_address_id = a.address_book_id");

	$customer_info_array = array(	'country_id' => $customer->fields['entry_country_id'],
									'zone_id' => $customer->fields['entry_zone_id']);

	return $customer_info_array;
}
?>