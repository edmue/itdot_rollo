<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: set_reviews_status.inc.php 189 2011-08-22 14:45:29Z siekiera $
* 	Letzter Stand:			$Revision: 189 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-22 16:45:29 +0200 (Mon, 22 Aug 2011) $
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

function set_reviews_status($reviews_id, $status) {
  	global $db;
  	return $db->db_query("UPDATE ".TABLE_REVIEWS." SET reviews_status = '".$status."' WHERE reviews_id = '".$reviews_id."'");
}
?>