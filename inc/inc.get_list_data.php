<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: fuzzy_search.php 131 2011-08-08 15:41:29Z peter $
* 	Letzter Stand:			$Revision: 131 $
* 	zuletzt geändert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-08 17:41:29 +0200 (Mon, 08 Aug 2011) $
*
* 	SEO:mercari by Siekiera Media
* 	http://www.seo-mercari.de
*
* 	Copyright © since 2011 SEO:mercari
* --------------------------------------------------------------------------------------
* 	based on:
* 	© 2000-2001 The Exchange Project  (earlier name of osCommerce)
* 	© 2002-2003 osCommerce - www.oscommerce.com
* 	© 2003     nextcommerce - www.nextcommerce.org
* 	© 2005     xt:Commerce - www.xt-commerce.com
*
* 	Released under the GNU General Public License
* ----------------------------------------------------------------------------------- */

function get_list_data($list_name) {
	global $db;
	
	$options = $db->db_query("SELECT 
									list_name, 
									col, 
									p_img, 
									p_name, 
									p_price, 
									b_details, 
									b_order, 
									b_wishlist, 
									p_reviews, 
									p_stockimg, 
									p_vpe, 
									p_model,
									p_isbn,
									p_manu_img, 
									p_manu_name, 
									p_short_desc, 
									p_short_desc_lenght, 
									p_long_desc, 
									p_long_desc_lenght, 
									list_type,
									list_file,
									box_count,
									box_effect,
									effect_direction
								FROM 
									".TABLE_PRODUCTS_LISTINGS." 
								WHERE 
									list_name = '".$list_name."'", true);
	return $options->fields;
}