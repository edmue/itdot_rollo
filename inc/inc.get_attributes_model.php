<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_attributes_model.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_attributes_model($product_id, $attribute_name) {
	global $db;

   $options_value_id = $db->db_query("SELECT
											products_options_values_id
										FROM
											".TABLE_PRODUCTS_OPTIONS_VALUES."
										WHERE
											products_options_values_name = ".$db->db_prepare($attribute_name));

    while (!$options_value_id->EOF) {
	    $options_attr = $db->db_query("SELECT
											attributes_model
										FROM
											".TABLE_PRODUCTS_ATTRIBUTES."
										WHERE
											options_values_id = ".$db->db_prepare($options_value_id->fields['products_options_values_id'])."
										AND
											products_id = ".$db->db_prepare($product_id));
	    if ($options_attr->fields['attributes_model']!='')
	    	return $options_attr->fields['attributes_model'];
	    $options_value_id->MoveNext();
    }
}
?>