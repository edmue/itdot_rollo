<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: format_price_order.inc.php 123 2011-08-04 15:56:13Z peter $
* 	Letzter Stand:			$Revision: 123 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-04 17:56:13 +0200 (Thu, 04 Aug 2011) $
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

require_once(DIR_FS_INC.'inc.precision.php');

function format_price_order ($price_string, $price_special, $currency, $show_currencies=1){
	global $db;
	
	$currencies_value = $db->db_query("	SELECT 
											symbol_left,
											symbol_right,
											decimal_places,
											value
										FROM 
											".TABLE_CURRENCIES." 
										WHERE
											code = '".$currency ."'");
	
	$currencies_data=array();
	$currencies_data=array(	'SYMBOL_LEFT'=>$currencies_value->fields['symbol_left'] ,
							'SYMBOL_RIGHT'=>$currencies_value->fields['symbol_right'] ,
							'DECIMAL_PLACES'=>$currencies_value->fields['decimal_places'] ,
							'VALUE'=> $currencies_value->fields['value']);

	$price_string = precision($price_string,$currencies_data->fields['DECIMAL_PLACES']);
	
	if ($price_special=='1') {
		$currencies_value = $db->db_query("	SELECT 
												symbol_left,
												decimal_point,
												thousands_point,
												value
											FROM 
												".TABLE_CURRENCIES." 
											WHERE
												code = '".$currency ."'");
		
		$price_string = number_format($price_string,$currencies_data->fields['DECIMAL_PLACES'], $currencies_value->fields['decimal_point'], $currencies_value->fields['thousands_point']);
		
		if ($show_currencies == 1) 
			$price_string = $currencies_data->fields['SYMBOL_LEFT']. ' '.$price_string.' '.$currencies_data->fields['SYMBOL_RIGHT'];

	}
	return $price_string;
}
?>