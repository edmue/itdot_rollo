<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: write_user_info.inc.php 250 2011-09-05 23:08:30Z peter $
* 	Letzter Stand:			$Revision: 250 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-09-06 01:08:30 +0200 (Tue, 06 Sep 2011) $
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

function write_user_info($customer_id) {
	global $db;

	$sql_data_array = array('customers_id' => $customer_id,
	                      'customers_ip' => '',
	                      'customers_ip_date' => 'now()',
	                      'customers_host' => $_SESSION['tracking']['http_referer']['host'],
	                      'customers_advertiser' => $_SESSION['tracking']['refID'],
	                      'customers_referer_url' => $_SESSION['tracking']['http_referer']['host'].$_SESSION['tracking']['http_referer']['path']);

	$db->db_perform(TABLE_CUSTOMERS_IP, $sql_data_array);
	return -1;
}
?>