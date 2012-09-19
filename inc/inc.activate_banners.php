<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: activate_banners.inc.php 2 2011-06-06 12:08:34Z siekiera $
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


// Auto activate banners
  function activate_banners() {
  	global $db;
  	
    $banners = $db->db_query("SELECT banners_id, date_scheduled FROM " . TABLE_BANNERS . " WHERE date_scheduled != ''");
    if ($banners->_numOfRows > 0) {
      while (!$banners->EOF) {
        if (date('Y-m-d H:i:s') >= $banners->fields['date_scheduled']) {
          set_banner_status($banners->fields['banners_id'], '1');
        }
       $banners->MoveNext();
      }
    }
  }
 ?>
