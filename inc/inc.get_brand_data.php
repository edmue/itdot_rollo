<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.get_brand_data.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_brand_data($id) {
	
	if(empty($id))
		return;
		
	global $db;
	
	$data = $db->db_query("SELECT 
								b.brand_name,
								b.brand_image,
								bi.brand_description,
								bi.brand_url
							FROM
								".TABLE_BRAND." b,
								".TABLE_BRAND_INFO." bi
							WHERE
								b.brand_id = '".(int)$id."'
							AND
								bi.brand_id = '".(int)$id."'
							AND
								bi.languages_id = '".$_SESSION['languages_id']."' ");
	
	return array(	'id' =>	$id,
					'name' => $data->fields['brand_name'],
					'image' => DIR_WS_IMAGES.$data->fields['brand_image'],
					'desc' => $data->fields['brand_description'],
					'url' => $data->fields['brand_url']);
}
?>