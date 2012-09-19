<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: set_banner_status.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

   
// Sets the status of a banner
  function set_banner_status($banners_id, $status) {
  	global $db;
    if ($status == '1') {
      return $db->db_query("UPDATE " . TABLE_BANNERS . " SET status = '1', date_status_change = NOW(), date_scheduled = NULL WHERE banners_id = '" . $banners_id . "'");
    } elseif ($status == '0') {
      return $db->db_query("UPDATE " . TABLE_BANNERS . " SET status = '0', date_status_change = NOW() WHERE banners_id = '" . $banners_id . "'");
    } else {
      return -1;
    }
  }
 ?>