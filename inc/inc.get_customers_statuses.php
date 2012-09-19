<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_customers_statuses.inc.php 123 2011-08-04 15:56:13Z peter $
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



function get_customers_statuses() {
	global $db;

	$customers_statuses_array = array(array());
	
	if ($_SESSION['languages_id']=='') 
		$customers_statuses = $db->db_query("SELECT * FROM " . TABLE_CUSTOMERS_STATUS . " WHERE language_id = '1' ORDER BY customers_status_id");
	else
		$customers_statuses = $db->db_query("SELECT * FROM " . TABLE_CUSTOMERS_STATUS . " WHERE language_id = '" . $_SESSION['languages_id'] . "' ORDER BY customers_status_id");
	
	$i = 1;
	while (!$customers_statuses->EOF) {
		$i = $customers_statuses->fields['customers_status_id'];
		
		$customers_statuses_array[] = array(	'id' => $customers_statuses->fields['customers_status_id'],
												'text' => $customers_statuses->fields['customers_status_name'],
												'csa_public' => $customers_statuses->fields['customers_status_public'],
												'csa_show_price' => $customers_statuses->fields['customers_status_show_price'],
												'csa_show_price_tax' => $customers_statuses->fields['customers_status_show_price_tax'],
												'csa_image' => $customers_statuses->fields['customers_status_image'],
												'csa_discount' => $customers_statuses->fields['customers_status_discount'],
												'csa_ot_discount_flag' => $customers_statuses->fields['customers_status_ot_discount_flag'],
												'csa_ot_discount' => $customers_statuses->fields['customers_status_ot_discount'],
												'csa_graduated_prices' => $customers_statuses->fields['customers_status_graduated_prices'],
												'csa_cod_permission' => $customers_statuses->fields['customers_status_cod_permission'],
												'csa_cc_permission' => $customers_statuses->fields['customers_status_cc_permission'],
												'csa_bt_permission' => $customers_statuses->fields['customers_status_bt_permission']);
		$customers_statuses->MoveNext();
	}
	return $customers_statuses_array;
}
?>