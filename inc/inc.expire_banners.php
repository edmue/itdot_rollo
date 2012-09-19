<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: expire_banners.inc.php 2 2011-06-06 12:08:34Z siekiera $
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


require_once(DIR_FS_INC.'inc.set_banner_status.php');
// Auto expire banners
  function expire_banners() {
  	global $db;
  	
    $banners = $db->db_query("SELECT 
    							b.banners_id, b.expires_date, 
    							b.expires_impressions, 
    							SUM(bh.banners_shown) AS banners_shown 
    						FROM 
    							" . TABLE_BANNERS . " b, 
    							" . TABLE_BANNERS_HISTORY . " bh 
    						WHERE 
    							b.status = '1' 
    						AND 
    							b.banners_id = bh.banners_id 
    						GROUP BY 
    							b.banners_id");
    
    if ($banners->_numOfRows > 0) {
      while (!$banners->EOF) {
        if (not_null($banners->fields['expires_date'])) {
          if (date('Y-m-d H:i:s') >= $banners->fields['expires_date']) {
            set_banner_status($banners->fields['banners_id'], '0');
          }
        } elseif (not_null($banners->fields['expires_impressions'])) {
          if ($banners->fields['banners_shown'] >= $banners->fields['expires_impressions']) {
            set_banner_status($banners->fields['banners_id'], '0');
          }
        }
       $banners->MoveNext();
      }
    }
  }
 ?>
