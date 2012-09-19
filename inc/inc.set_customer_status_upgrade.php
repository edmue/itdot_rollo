<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: set_customer_status_upgrade.inc.php 126 2011-08-05 15:18:24Z peter $
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

function set_customer_status_upgrade($customer_id){
	global $db;

	if (($_SESSION['customer_status_value']['customers_status_id'] == "'.DEFAULT_CUSTOMERS_STATUS_ID_NEWSLETTER .'" )&&($_SESSION['customer_status_value']['customers_is_newsletter'] == 0)){
	
		$db->db_query("	UPDATE 
							".TABLE_CUSTOMERS." 
						SET 
							customers_status = '".DEFAULT_CUSTOMERS_STATUS_ID."' 
						WHERE 
							customers_id = '".$_SESSION['customer_id']."'");
		
		$db->db_query("	INSERT INTO ".TABLE_CUSTOMERS_STATUS_HISTORY."(
							customers_id, 
							new_value, 
							old_value,
							date_added, 
							customer_notified
						)VALUES(
							'".$_SESSION['customer_id']."', 
							'".DEFAULT_CUSTOMERS_STATUS_ID."', 
							'".DEFAULT_CUSTOMERS_STATUS_ID_NEWSLETTER."', 
							NOW(), 
						  	'".$customer_notified."')");
	}
	return 1;
}

 ?>
