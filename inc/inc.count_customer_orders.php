<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: count_customer_orders.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function count_customer_orders($id = '', $check_session = true) {
	global $db;

	if (is_numeric($id) == false) {
		if (isset($_SESSION['customer_id']))
			$id = $_SESSION['customer_id'];
		else
			return 0;
	}

	if($check_session == true)
		if((isset($_SESSION['customer_id']) == false) || ($id != $_SESSION['customer_id']) )
			return 0;

	$orders_check = $db->db_query("SELECT COUNT(*) AS total FROM " . TABLE_ORDERS . " WHERE customers_id = '" . (int)$id . "'");
	return $orders_check->fields['total'];
}
?>