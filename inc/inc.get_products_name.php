<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_products_name.inc.php 96 2011-07-12 14:06:27Z siekiera $
* 	Letzter Stand:			$Revision: 96 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-12 16:06:27 +0200 (Tue, 12 Jul 2011) $
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

function get_products_name($product_id, $language = '') {
	global $db;
    if(empty($language)) 
    	$language = $_SESSION['languages_id'];

    $product = $db->db_query("SELECT 
									products_name 
								FROM 
									".TABLE_PRODUCTS_DESCRIPTION." 
								WHERE 
									products_id = '".$product_id."' 
								AND 
									language_id = '".$language."'", true);
    return $product->fields['products_name'];
}