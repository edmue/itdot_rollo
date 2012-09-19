<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: update_whos_online.inc.php 270 2011-09-16 09:56:54Z siekiera $
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

function update_whos_online() {
	global $db;

	if (isset($_SESSION['customer_id'])) {
		$wo_customer_id = $_SESSION['customer_id'];

		$customer = $db->db_query("SELECT customers_firstname, customers_lastname FROM ".TABLE_CUSTOMERS." WHERE customers_id = '".$_SESSION['customer_id']."'");

		$wo_full_name = addslashes($customer->fields['customers_firstname'].' '.$customer->fields['customers_lastname']);
	} else {
		$wo_customer_id = '';
		$wo_full_name = 'Gast';
	}

	$wo_session_id = session_id();
	$wo_ip_address = getenv('REMOTE_ADDR');
	$user_agent  = $_SERVER['HTTP_USER_AGENT'];
	$wo_last_page_url = addslashes($_SERVER['REQUEST_URI']);

	$current_time = time();
	$wo_referer = $_SERVER['HTTP_REFERER'];
	$xx_mins_ago = ($current_time - 900);

	$db->db_query("DELETE FROM ".TABLE_WHOS_ONLINE." WHERE time_last_click < '".$xx_mins_ago."'");

	$stored_customer = $db->db_query("SELECT customer_id FROM ".TABLE_WHOS_ONLINE." WHERE session_id = '".$wo_session_id."'");

	if($stored_customer->_numOfRows)
		$db->db_query("UPDATE ".TABLE_WHOS_ONLINE." SET customer_id = '".$wo_customer_id."', full_name = '".$wo_full_name."', ip_address = '".$wo_ip_address."', time_last_click = '".$current_time."', last_page_url = '".$wo_last_page_url."', http_referer = '". $wo_referer."', user_agent = ".$db->db_prepare($user_agent)." WHERE session_id = '".$wo_session_id."'");
	else
		$db->db_query("INSERT INTO ".TABLE_WHOS_ONLINE." (customer_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url, http_referer, user_agent) VALUES ('".$wo_customer_id."', '".$wo_full_name."', '".$wo_session_id."', '".$wo_ip_address."', '".$current_time."', '".$current_time."', '".$wo_last_page_url."', '".$wo_referer."', ".$db->db_prepare($user_agent).")");
}
?>