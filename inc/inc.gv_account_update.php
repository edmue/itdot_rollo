<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: gv_account_update.inc.php 126 2011-08-05 15:18:24Z peter $
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

function gv_account_update($customer_id, $gv_id) {
	global $db;
	
	$customer_gv = $db->db_query("	SELECT 
										amount 
									FROM 
										".TABLE_COUPON_GV_CUSTOMER." 
									WHERE 
										customer_id = '".$customer_id."'");
	
	$coupon_gv = $db->db_query("SELECT 
									coupon_amount 
								FROM 
									".TABLE_COUPONS." 
								WHERE 
									coupon_id = '".$gv_id."'");

	if ($customer_gv->_numOfRows > 0) {
		$new_gv_amount = $customer_gv->fields['amount'] + $coupon_gv->fields['coupon_amount'];
		$new_gv_amount = str_replace(",", ".", $new_gv_amount);
		$gv_query = $db->db_query("	UPDATE 
										".TABLE_COUPON_GV_CUSTOMER." 
									SET 
										amount = '".$new_gv_amount."' 
									WHERE 
										customer_id = '".$customer_id."'");
	}else{
		$gv_query = $db->db_query("	INSERT INTO ".TABLE_COUPON_GV_CUSTOMER." (
										customer_id, 
										amount
									)VALUES(
										'".$customer_id."', 
										'".$coupon_gv->fields['coupon_amount']."')");
	}
}
?>