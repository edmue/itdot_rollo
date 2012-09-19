<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: customer_greeting.inc.php 102 2011-07-14 07:35:06Z siekiera $
* 	Letzter Stand:			$Revision: 102 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-14 09:35:06 +0200 (Thu, 14 Jul 2011) $
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

function customer_greeting($index = true) {
	global $db;
	
	if(isset($_SESSION['customer_last_name']) && isset($_SESSION['customer_id'])) {
		if (!isset($_SESSION['customer_gender'])) {
			$check = $db->db_query("SELECT 
										customers_gender 
									FROM 
										".TABLE_CUSTOMERS." 
									WHERE 
										customers_id = '".$_SESSION['customer_id']."'");

			$_SESSION['customer_gender'] = $check->fields['customers_gender'];
		}
		
		if($index) {
			if($_SESSION['customer_gender'] == 'f')
				$greeting_string = sprintf(TEXT_GREETING_PERSONAL, FEMALE.' '. $_SESSION['customer_last_name'], href_link(FILENAME_PRODUCTS_NEW));
			else
				$greeting_string = sprintf(TEXT_GREETING_PERSONAL, MALE.' '.$_SESSION['customer_last_name'], href_link(FILENAME_PRODUCTS_NEW));

		} else {
			if($_SESSION['customer_gender'] == 'f')
				$greeting_string = FEMALE.' '. $_SESSION['customer_last_name'];
			else
				$greeting_string = MALE.' '.$_SESSION['customer_last_name'];
		}

	} elseif($index)
		$greeting_string = sprintf(TEXT_GREETING_GUEST, href_link(FILENAME_LOGIN, '', 'SSL'), href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
	
	return $greeting_string;
}
?>