<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_input_field.inc.php 249 2011-09-05 21:21:43Z siekiera $
* 	Letzter Stand:			$Revision: 249 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-05 23:21:43 +0200 (Mon, 05 Sep 2011) $
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

function draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
	$field = '<input type="'.parse_input_field_data($type, array('"' => '&quot;')).'" name="'.parse_input_field_data($name, array('"' => '&quot;')).'"';
	
	if((isset($GLOBALS[$name])) && ($reinsert_value == true))
		$field .= ' value="'.parse_input_field_data($GLOBALS[$name], array('"' => '&quot;')).'"';
		
	elseif (not_null($value))
		$field .= ' value="'.parse_input_field_data($value, array('"' => '&quot;')).'"';
	
	if($type != 'password') {
		if(strstr($parameters, 'class='))
			$parameters = str_replace('class="', 'class="css_'.$type.' ', $parameters);
		else
			$parameters = $parameters.' class="css_'.$type.'"';
	}
	
	if(not_null($parameters))
		$field .= ' '.$parameters;
	
	$field .= ' />';
	
	return $field;
}

function draw_input_fieldNote($data, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
	$field = '<input type="'.parse_input_field_data($type, array('"' => '&quot;')).'" name="'.parse_input_field_data($data['name'], array('"' => '&quot;')).'"';

	if((isset($GLOBALS[$data['name']])) && ($reinsert_value == true))
		$field .= ' value="'.parse_input_field_data($GLOBALS[$data['name']], array('"' => '&quot;')).'"';
	elseif(not_null($value))
		$field .= ' value="'.parse_input_field_data($value, array('"' => '&quot;')).'"';

	if(not_null($parameters)) 
		$field .= ' '.$parameters;

	$field .= ' />'.$data['text'];

	return $field;
}
?>