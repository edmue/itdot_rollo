<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.get_img_alt.php 52 2011-06-23 20:00:43Z siekiera $
* 	Letzter Stand:			$Revision: 52 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-23 22:00:43 +0200 (Thu, 23 Jun 2011) $
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

function get_img_alt($pID, $lID, $imgNr = '') {
	global $db;
	
	if($pID !='' && $lID !='') {
		$alt = $db->db_query("SELECT alt_langID_".$lID." FROM ".TABLE_PRODUCTS_IMAGES." WHERE products_id = '".$pID."' AND image_nr = '".$imgNr."' ");
		return $alt->fields['alt_langID_'.$lID];
	}
	else 
		return false;
}
?>