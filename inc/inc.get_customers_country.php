<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_customers_country.inc.php 123 2011-08-04 15:56:13Z peter $
* 	Letzter Stand:			$Revision: 123 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-04 17:56:13 +0200 (Thu, 04 Aug 2011) $
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

function get_customers_country($customers_id) {
	$customers = $db->db_query("SELECT 
									customers_default_address_id 
								FROM 
									".TABLE_CUSTOMERS." 
								WHERE 
									customers_id = '".$customers_id."'");

	$address_book = $db->db_query("	SELECT 
										entry_country_id 
									FROM 
										".TABLE_ADDRESS_BOOK." 
									WHERE 
										address_book_id = '".$customers->fields['customers_default_address_id']."'");

	return $address_book->fields['entry_country_id'];
}
?>