<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_products.inc.php 126 2011-08-05 15:18:24Z peter $
* 	Letzter Stand:			$Revision: 126 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-05 17:18:24 +0200 (Fri, 05 Aug 2011) $
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

function unserialize_session_data($session_data) {
	$variables = array();
	$a = preg_split( "/(\w+)\|/", $session_data, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );
	for( $i = 0; $i < count( $a ); $i = $i+2 ) {
		$variables[$a[$i]] = unserialize( $a[$i+1] );
	}
	return($variables);
}

function get_products($session) {
	global $db, $price;
	
	if (!is_array($session)) 
		return false;
	
	$products_array = array();
	reset($session);
	
	if (is_array($session['cart']->contents)) { 
		while(list($products_id, ) = each($session['cart']->contents)) {
			$products = $db->db_query("	SELECT 
											p.products_id, 
											pd.products_name,
											p.products_image, 
											p.products_model,
											p.products_price, 
											p.products_discount_allowed, 
											p.products_weight, 
											p.products_tax_class_id 
										FROM 
											".TABLE_PRODUCTS." p, 
											".TABLE_PRODUCTS_DESCRIPTION." pd
										WHERE 
											p.products_id='".get_prid($products_id)."' 
										AND 
											pd.products_id = p.products_id 
										AND 
											pd.language_id = '".$_SESSION['languages_id']."'");
			
			if ($products->_numOfRows != 0) {
				$prid = $products->fields['products_id'];

				$products_price = $price->GetPrice($products->fields['products_id'],
				$format=false,
				$session['cart']->contents[$products_id]['qty'],
				$products->fields['products_tax_class_id'],
				$products->fields['products_price']);
				
				
				$products_array[] = array(	'id' => $products_id,
											'name' => $products->fields['products_name'],
											'model' => $products->fields['products_model'],
											'image' => $products->fields['products_image'],
											'price' => $products_price+attributes_price($products_id,$session),
											'quantity' => $session['cart']->contents[$products_id]['qty'],
											'weight' => $products->fields['products_weight'],
											'final_price' => ($products_price+attributes_price($products_id,$session)),
											'tax_class_id' => $products->fields['products_tax_class_id'],
											'attributes' => $session['contents'][$products_id]['attributes']);
			}
		}
		return $products_array;
	}
	return false;
}
    
function attributes_price($products_id, $session) {
	global $db, $price;
	
	if (isset($session['contents'][$products_id]['attributes'])) {
		reset($session['contents'][$products_id]['attributes']);
	
		while (list($option, $value) = each($session['contents'][$products_id]['attributes'])) {
			$attribute_price = $db->db_query("	SELECT 
													pd.products_tax_class_id, 
													p.options_values_price, 
													p.price_prefix 
												FROM 
													".TABLE_PRODUCTS_ATTRIBUTES." p, 
													".TABLE_PRODUCTS." pd 
												WHERE 
													p.products_id = '".$products_id."' 
												AND 
													p.options_id = '".$option."' 
												AND 
													pd.products_id = p.products_id 
												AND 
													p.options_values_id = '".$value."'");
	
			if ($attribute_price->fields['price_prefix'] == '+') 
				$attributes_price += $price->format($attribute_price->fields['options_values_price'], false, $attribute_price->fields['products_tax_class_id']);
			else
				$attributes_price -= $price->format($attribute_price->fields['options_values_price'], false, $attribute_price->fields['products_tax_class_id']);
	
		}
	}
	return $attributes_price;
}