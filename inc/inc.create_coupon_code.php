<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: create_coupon_code.inc.php 232 2011-09-01 14:07:30Z siekiera $
* 	Letzter Stand:			$Revision: 232 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-01 16:07:30 +0200 (Thu, 01 Sep 2011) $
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

function create_coupon_code($salt="secret", $length = SECURITY_CODE_LENGTH) {
	global $db;
	
	$ccid = md5(uniqid("","salt"));
	$ccid .= md5(uniqid("","salt"));
	$ccid .= md5(uniqid("","salt"));
	$ccid .= md5(uniqid("","salt"));
	srand((double)microtime()*1000000); // seed the random number generator
	$random_start = @rand(0, (128-$length));
	$good_result = 0;
	
	while ($good_result == 0) {
		$id1=substr($ccid, $random_start,$length);
		$query = $db->db_query("SELECT coupon_code FROM ".TABLE_COUPONS." WHERE coupon_code = '".$id1."'");
		
		if ($query->_numOfRows < 1) 
			$good_result = 1;
	}
	return $id1;
}
?>