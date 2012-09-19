<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_selection_field.inc.php 252 2011-09-06 13:47:32Z siekiera $
* 	Letzter Stand:			$Revision: 252 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-06 15:47:32 +0200 (Tue, 06 Sep 2011) $
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

function draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
	$selection = '<input type="'.parse_input_field_data($type, array('"' => '&quot;')).'" name="'.parse_input_field_data($name,array('"'=>'&quot;')).'"';
	
	if (not_null($value)) 
		$selection .= ' value="'.parse_input_field_data($value, array('"' => '&quot;')).'"';
	
	if (($checked == true) || ($GLOBALS[$name] == 'on') || ((isset($value)) && ($GLOBALS[$name] == $value)))
		$selection .= ' checked="checked"';

	if (not_null($parameters)) 
		$selection .= ' '.$parameters;
	
	$selection .= ' />';

	return $selection;
}

function draw_selection_fieldNote($data, $type, $value = '', $checked = false, $parameters = '') {
	$selection = $data['suffix'].'<input type="'.parse_input_field_data($type, array('"' => '&quot;')).'" name="'.parse_input_field_data($data['name'], array('"' => '&quot;')).'"';
	
	if (not_null($value)) $selection .= ' value="'.parse_input_field_data($value, array('"' => '&quot;')).'"';
	
	if (($checked == true) || ($GLOBALS[$data['name']] == 'on') || ((isset($value)) && ($GLOBALS[$data['name']] == $value)))
		$selection .= ' checked="checked"';
	
	if (not_null($parameters)) 
		$selection .= ' '.$parameters;
	
	$selection .= ' />'.$data['text'];
	
	return $selection;
}
?>