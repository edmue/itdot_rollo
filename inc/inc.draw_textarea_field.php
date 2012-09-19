<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_textarea_field.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function draw_textarea_field($name, $wrap='', $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
	$field = '<textarea name="' . parse_input_field_data($name, array('"' => '&quot;')) . '" id="' . parse_input_field_data($name, array('"' => '&quot;')) . '" cols="' . parse_input_field_data($width, array('"' => '&quot;')) . '" rows="' . parse_input_field_data($height, array('"' => '&quot;')) . '"';
	
	if(not_null($parameters)) 
		$field .= ' ' . $parameters;
	
	$field .= '>';
	
	if((isset($GLOBALS[$name])) && ($reinsert_value == true))
		$field .= $GLOBALS[$name];
	elseif (not_null($text))
		$field .= $text;
	
	$field .= '</textarea>'."\n";
	
	return $field;
}
?>