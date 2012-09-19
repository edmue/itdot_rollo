<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.get_hex_image.php 2 2011-06-06 12:08:34Z siekiera $
* 	Letzter Stand:			$Revision: 382 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2012-02-11 20:21:50 +0100 (Sat, 11 Feb 2012) $
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

function get_hex_image($val) {
	global $db;
	
	if(!empty($val)) {
		$hex = $db->db_query("SELECT
									products_options_values_name,
									products_options_hex_image
								FROM
									".TABLE_PRODUCTS_OPTIONS_VALUES."
								WHERE
									products_options_values_id = '".(int)$val."'
								AND
									language_id = '".(int)$_SESSION['languages_id']."'");

		if($hex->_numOfRows && !empty($hex->fields['products_options_hex_image']))
			return '<span title="'.$hex->fields['products_options_values_name'].'" class="values_hex_image" style="background:'.$hex->fields['products_options_hex_image'].'">&nbsp;</span>';
		else
			return false;
	} else
		return false;
}