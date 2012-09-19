<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_pull_down_menu.inc.php 283 2011-09-19 17:46:21Z siekiera $
* 	Letzter Stand:			$Revision: 283 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-19 19:46:21 +0200 (Mon, 19 Sep 2011) $
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

function draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    $field = '<select name="' .$name. '"';

    if(not_null($parameters)) 
    	$field .= ' '.$parameters;

    $field .= '>';

	for ($i=0, $n=sizeof($values); $i<$n; $i++) {
		$field .= '<option value="'.$values[$i]['id']. '"';
		if($default == $values[$i]['id'])
			$field .= ' selected="selected"';
	
		$field .= '>'.$values[$i]['text'].'</option>';
	}
    $field .= '</select>';

    if($required == true)
    	$field .= TEXT_FIELD_REQUIRED;

	return $field;
}

function draw_pull_down_menuNote($data, $values, $default = '', $parameters = '', $required = false) {
	$field = '<select name="'.parse_input_field_data($data['name'], array('"' => '&quot;')).'"';
	
	if(not_null($parameters)) 
		$field .= ' '.$parameters;
	
	$field .= '>';
	
	if (empty($default) && isset($GLOBALS[$data['name']])) $default = $GLOBALS[$data['name']];
	
	for ($i=0, $n=sizeof($values); $i<$n; $i++) {
		$field .= '<option value="'.parse_input_field_data($values[$i]['id'], array('"' => '&quot;')).'"';
		if ($default == $values[$i]['id'])
			$field .= ' selected="selected"';
	
		$field .= '>'.parse_input_field_data($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')).'</option>';
	}
	$field .= '</select>'.$data['text'];
	
	if($required == true) 
		$field .= TEXT_FIELD_REQUIRED;
	
	return $field;
}
?>