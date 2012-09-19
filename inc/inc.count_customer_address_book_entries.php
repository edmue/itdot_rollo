<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: count_customer_address_book_entries.inc.php 123 2011-08-04 15:56:13Z peter $
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

function count_customer_address_book_entries($id = '', $check_session = true) {
	global $db;

	if (is_numeric($id) == false) {
		if (isset($_SESSION['customer_id'])) 
			$id = $_SESSION['customer_id'];
		else
			return 0;
	}
	
	if ($check_session == true)
		if ( (isset($_SESSION['customer_id']) == false) || ($id != $_SESSION['customer_id']) ) 
			return 0;

	
	$addresses = $db->db_query("SELECT address_book_id FROM ".TABLE_ADDRESS_BOOK." WHERE customers_id = '".(int)$id."'");

	return $addresses->_numOfRows;
}
?>