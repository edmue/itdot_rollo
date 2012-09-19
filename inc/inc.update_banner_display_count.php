<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: update_banner_display_count.inc.php 2 2011-06-06 12:08:34Z siekiera $
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


  // Update the banner display statistics
  function update_banner_display_count($banner_id) {
  	global $db;
    $banner_check = $db->db_query("SELECT banners_id FROM " . TABLE_BANNERS_HISTORY . " WHERE banners_id = '" . $banner_id . "' AND date_format(banners_history_date, '%Y%m%d') = date_format(NOW(), '%Y%m%d')");

    if ($banner_check->_numOfRows > 0) {
      $db->db_query("UPDATE " . TABLE_BANNERS_HISTORY . " SET banners_shown = banners_shown + 1 WHERE banners_id = '" . $banner_id . "' AND date_format(banners_history_date, '%Y%m%d') = date_format(NOW(), '%Y%m%d')");
    } else {
      $db->db_query("INSERT INTO " . TABLE_BANNERS_HISTORY . " (banners_id, banners_shown, banners_history_date) VALUES ('" . $banner_id . "', 1, NOW())");
    }
  }
?>