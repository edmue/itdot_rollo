<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: validate_vatid_status.inc.php 270 2011-09-16 09:56:54Z siekiera $
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

function validate_vatid_status($customer_id) {
	global $db;
	
	$customer_status = $db->db_query("SELECT customers_vat_id_status FROM ".TABLE_CUSTOMERS." WHERE customers_id='".$customer_id."'");
	
	if ($customer_status->fields['customers_vat_id_status'] == '0')
		return TEXT_VAT_FALSE;
	
	if ($customer_status->fields['customers_vat_id_status'] == '1')
		return TEXT_VAT_TRUE;
	
	if ($customer_status->fields['customers_vat_id_status'] == '8')
		return TEXT_VAT_UNKNOWN_COUNTRY;
	
	if ($customer_status->fields['customers_vat_id_status'] == '9')
		return TEXT_VAT_UNKNOWN_ALGORITHM;
}
?>