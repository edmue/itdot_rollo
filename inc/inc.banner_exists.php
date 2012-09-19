<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: banner_exists.inc.php 36 2011-06-18 10:00:00Z peter $
* 	Letzter Stand:			$Revision: 36 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-06-18 12:00:00 +0200 (Sat, 18 Jun 2011) $
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


function banner_exists($action, $identifier) {
	global $db;

	if($action == 'dynamic') {
		$banner = $db->db_query("SELECT banners_group, banners_id, banners_title, banners_image, banners_html_text FROM " . TABLE_BANNERS . " WHERE status = '1' and banners_group = '" . $identifier . "'");
		return $banner->fields['banners_group'];

	} elseif ($action == 'static') {
		$banner = $db->db_query("SELECT banners_id, banners_title, banners_image, banners_html_text FROM " . TABLE_BANNERS . " WHERE status = '1' and banners_group = '' LIMIT 1");
		return $banner->fields['banners_id'];

	} else
		return false;
}
?>