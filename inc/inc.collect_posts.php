<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: collect_posts.inc.php 145 2011-08-15 15:40:32Z siekiera $
* 	Letzter Stand:			$Revision: 145 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-15 17:40:32 +0200 (Mon, 15 Aug 2011) $
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

function collect_posts() {
	global $coupon_no, $REMOTE_ADDR, $price, $cc_id, $db;

	if (!$REMOTE_ADDR) 
		$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
		
	if ($_POST['gv_redeem_code']) {
		$gv_result = $db->db_query("SELECT 
										coupon_id, 
										coupon_amount, 
										coupon_type, 
										coupon_minimum_order,
										uses_per_coupon, 
										uses_per_user, 
										restrict_to_products,
										restrict_to_categories 
									FROM 
										".TABLE_COUPONS." 
									WHERE 
										coupon_code='".$_POST['gv_redeem_code']."' 
									AND 
										coupon_active='Y'");

		if ($gv_result->_numOfRows) {
			$redeem = $db->db_query("SELECT * FROM ".TABLE_COUPON_REDEEM_TRACK." WHERE coupon_id = '".$gv_result->fields['coupon_id']."'");
			
			if(($redeem->_numOfRows) && ($gv_result->fields['coupon_type'] == 'G'))
				redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(ERROR_NO_INVALID_REDEEM_GV), 'NONSSL'));

		} else
			redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(ERROR_NO_INVALID_REDEEM_GV), 'NONSSL'));
	
		if ($gv_result->fields['coupon_type'] == 'G') {
			$gv_amount = $gv_result->fields['coupon_amount'];
	
			$gv_amount_result = $db->db_query("SELECT amount FROM ".TABLE_COUPON_GV_CUSTOMER." WHERE customer_id = '".$_SESSION['customer_id']."'");
	
			$customer_gv = false;
			$total_gv_amount = $gv_amount;
			
			if ($gv_amount_result->_numOfRows) {
				$total_gv_amount = $gv_amount_result->fields['amount'] + $gv_amount;
				$customer_gv = true;
			}
			
			$db->db_query("UPDATE ".TABLE_COUPONS." SET coupon_active = 'N' WHERE coupon_id = '".$gv_result->fields['coupon_id']."'");
			
			 $db->db_query("INSERT INTO  
									".TABLE_COUPON_REDEEM_TRACK." (
									coupon_id, 
									customer_id, 
									redeem_date, 
									redeem_ip
								)VALUES(
									'".$gv_result->fields['coupon_id']."', 
									'".$_SESSION['customer_id']."', 
								NOW(),
								'".$REMOTE_ADDR."')");
			
			if ($customer_gv)
				$db->db_query("UPDATE ".TABLE_COUPON_GV_CUSTOMER." SET amount = '".$total_gv_amount."' WHERE customer_id = '".$_SESSION['customer_id']."'");
			else
				$db->db_query("INSERT INTO ".TABLE_COUPON_GV_CUSTOMER." (customer_id, amount) VALUES ('".$_SESSION['customer_id']."', '".$total_gv_amount."')");
		
			redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(REDEEMED_AMOUNT. $price->format($gv_amount,true,0,true)), 'NONSSL'));
			
		} else {
			if ($gv_result->_numOfRows < 1)
				redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(ERROR_NO_INVALID_REDEEM_COUPON), 'NONSSL'));
	
			$date_query = $db->db_query("SELECT coupon_start_date from ".TABLE_COUPONS." WHERE coupon_start_date <= NOW() AND coupon_code='".$_POST['gv_redeem_code']."'");
	 
			if ($date_query->_numOfRows < 1) 
				redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(ERROR_INVALID_STARTDATE_COUPON), 'NONSSL'));
	
			$date_query = $db->db_query("SELECT coupon_expire_date FROM ".TABLE_COUPONS." WHERE coupon_expire_date >= NOW() AND coupon_code='".$_POST['gv_redeem_code']."'");
	
			if ($date_query->_numOfRows < 1) 
				redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(ERROR_INVALID_FINISDATE_COUPON), 'NONSSL'));
	
			$coupon_count = $db->db_query("SELECT coupon_id FROM ".TABLE_COUPON_REDEEM_TRACK." WHERE coupon_id = '".$gv_result->fields['coupon_id']."'");
			$coupon_count_customer = $db->db_query("SELECT coupon_id FROM ".TABLE_COUPON_REDEEM_TRACK." WHERE coupon_id = '".$gv_result->fields['coupon_id']."' AND customer_id = '".$_SESSION['customer_id']."'");
	
			if ($coupon_count->_numOfRows >= $gv_result->fields['uses_per_coupon'] && $gv_result->fields['uses_per_coupon'] > 0) 
				redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(ERROR_INVALID_USES_COUPON.$gv_result->fields['uses_per_coupon'].TIMES ), 'SSL'));
	
			if ($coupon_count_customer->_numOfRows >= $gv_result->fields['uses_per_user'] && $gv_result->fields['uses_per_user'] > 0) 
				redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(ERROR_INVALID_USES_USER_COUPON.$gv_result->fields['uses_per_user'].TIMES ), 'SSL'));
	
			if ($gv_result->fields['coupon_type']=='S')
				$coupon_amount = $order->info['shipping_cost'];
			else
				$coupon_amount = $gv_result->fields['coupon_amount'].' ';
	
			if ($gv_result->fields['coupon_type']=='P') 
				$coupon_amount = $gv_result->fields['coupon_amount'].'% ';
				
			if ($gv_result->fields['coupon_minimum_order'] > 0) 
				$coupon_amount .= 'on orders greater than '.$gv_result->fields['coupon_minimum_order'];
	
			$_SESSION['cc_id'] = $gv_result->fields['coupon_id'];
			redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(REDEEMED_COUPON), 'NONSSL'));
		}
	}
	if ($_POST['submit_redeem_x'] && $gv_result->fields['coupon_type'] == 'G')
		redirect(href_link(FILENAME_SHOPPING_CART, 'info_message='.urlencode(ERROR_NO_REDEEM_CODE), 'NONSSL'));
}
?>