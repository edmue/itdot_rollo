<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_customer_status_value.inc.php 123 2011-08-04 15:56:13Z peter $
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

function get_customer_status_value($customer_id) {
	global $db;

	if (isset($_SESSION['customer_id'])) {
		$customer_status_value = $db->db_query("SELECT 
													c.customers_status, 
													c.member_flag, 
													cs.customers_status_id, 
													cs.customers_status_name, 
													cs.customers_status_public, 
													cs.customers_status_show_price, 
													cs_customers_status_min_order, 
													cs.customers_status_max_order, 
													cs.customers_status_show_price_tax, 
													cs.customers_status_image, 
													cs.customers_status_discount, 
													cs.customers_status_ot_discount_flag, 
													cs.customers_status_ot_discount, 
													cs.customers_status_graduated_prices, 
													cs.customers_status_cod_permission, 
													cs.customers_status_cc_permission, 
													cs.customers_status_bt_permission  
												FROM 
													".TABLE_CUSTOMERS." AS c 
												LEFT JOIN 
													".TABLE_CUSTOMERS_STATUS." AS cs 
												ON 
													customers_status = customers_status_id 
												WHERE 
													c.customers_id='".$_SESSION['customer_id']."' 
												AND 
													cs.language_id = '".$_SESSION['languages_id']."'");
		
	}else{
		$customer_status_value = $db->db_query("SELECT 
													cs.customers_status_id, 
													cs.customers_status_name, 
													cs.customers_status_public, 
													cs.customers_status_show_price, 
													cs_customers_status_min_order, 
													cs.customers_status_max_order, 
													cs.customers_status_show_price_tax, 
													cs.customers_status_image, 
													cs.customers_status_discount, 
													cs.customers_status_ot_discount_flag, 
													cs.customers_status_ot_discount, 
													cs.customers_status_graduated_prices  
												FROM 
													".TABLE_CUSTOMERS_STATUS." AS cs 
												WHERE 
													cs.customers_status_id='".DEFAULT_CUSTOMERS_STATUS_ID_GUEST."' 
												AND 
													cs.language_id = '".$_SESSION['languages_id']."'");
		
		$customer_status_value->fields['customers_status'] = DEFAULT_CUSTOMERS_STATUS_ID_GUEST;
	}
		
	session_register('customer_status_value');
	return $customer_status_value->fields;
}
 ?>
