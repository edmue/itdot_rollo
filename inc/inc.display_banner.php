<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: display_banner.inc.php 37 2011-06-18 10:13:15Z peter $
* 	Letzter Stand:			$Revision: 37 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-06-18 12:13:15 +0200 (Sat, 18 Jun 2011) $
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

   
// Display a banner from the specified group or banner id ($identifier)
  function display_banner($action, $identifier) {
  	global $db;

    if ($action == 'dynamic') {
      $banners = $db->db_query("SELECT banners_id FROM " . TABLE_BANNERS . " WHERE status = '1' AND banners_group = '" . $identifier . "'");

      if ($banners->_numOfRows > 0) {
        $banner = $db->db_query("SELECT 
        						banners_id, 
        						banners_title, 
        						banners_image, 
        						banners_html_text 
        					FROM 
        						" . TABLE_BANNERS . " 
        					WHERE 
        						status = '1' 
        					AND 
        						banners_group = '".$identifier."'
        					ORDER BY
        						RAND()");
      } else {
        return '<b>XTC ERROR! (display_banner(' . $action . ', ' . $identifier . ') -> No banners with group \'' . $identifier . '\' found!</b>';
      }
    } elseif ($action == 'static') {
      if (is_array($identifier)) {
        $banner = $identifier;
      } else {
        $banner = $db->db_query("SELECT 
        							banners_id, 
        							banners_title, 
        							banners_image, 
        							banners_html_text 
        						FROM 
        							" . TABLE_BANNERS . " 
        						WHERE 
        							status = '1' 
        						AND 
        							banners_id = '" . $identifier . "'");
        
        if ($banner->_numOfRows > 0) {}
        else
          return '<b>XTC ERROR! (display_banner(' . $action . ', ' . $identifier . ') -> Banner with ID \'' . $identifier . '\' not found, or status inactive</b>';
        
      }
    } else {
      return '<b>XTC ERROR! (display_banner(' . $action . ', ' . $identifier . ') -> Unknown $action parameter value - it must be either \'dynamic\' or \'static\'</b>';
    }
    if ($banner->fields['banners_html_text']->_numOfRows != 0) {
      $banner_string = $banner->fields['banners_html_text'];
    } else {
      $banner_string = '<a href="' . href_link(FILENAME_REDIRECT, 'action=banner&goto=' . $banner->fields['banners_id']) . '" onclick="window.open(this.href); return false;">' . image(DIR_WS_IMAGES.'banner/' . $banner->fields['banners_image'], $banner->fields['banners_title']) . '</a>';
    }

    update_banner_display_count($banner->fields['banners_id']);

    return $banner_string;
  }
 ?>