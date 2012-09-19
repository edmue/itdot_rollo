<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_order_data.inc.php 126 2011-08-05 15:18:24Z peter $
* 	Letzter Stand:			$Revision: 126 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-05 17:18:24 +0200 (Fri, 05 Aug 2011) $
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


function get_order_data($order_id) {
	global $db;
	
	$order_data = $db->db_query("	SELECT
										customers_name,
										customers_company,
										customers_street_address,
										customers_suburb,
										customers_city,
										customers_postcode,
										customers_state,
										customers_country,
										customers_telephone,
										customers_email_address,
										customers_address_format_id,
										delivery_name,
										delivery_company,
										delivery_street_address,
										delivery_suburb,
										delivery_city,
										delivery_postcode,
										delivery_state,
										delivery_country,
										delivery_address_format_id,
										billing_name,
										billing_company,
										billing_street_address,
										billing_suburb,
										billing_city,
										billing_postcode,
										billing_state,
										billing_country,
										billing_address_format_id,
										payment_method,
										comments,
										date_purchased,
										orders_status,
										currency,
										currency_value
									FROM 
										".TABLE_ORDERS."
									WHERE 
										orders_id='".$_GET['oID']."'");
	
	$order_status_data  = $db->db_query("	SELECT
												orders_status_name
											FROM 
												".TABLE_ORDERS_STATUS."
											WHERE 
												orders_status_id='".$order_data->fields['orders_status']."'
											AND 
												language_id='".$_SESSION['languages_id']."'");	
			
	$order_data->fields['orders_status'] = $order_status_data->fields['orders_status_name'];
	include(DIR_WS_LANGUAGES.$_SESSION['language'].'/modules/payment/'.$order_data->fields['payment_method'].'.php');
	$order_data->fields['payment_method'] = constant(strtoupper('MODULE_PAYMENT_'.$order_data->fields['payment_method'].'_TEXT_TITLE'));	
	return $order_data->fields; 
}
?>