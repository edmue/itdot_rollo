<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_input_field_installer.inc.php 41 2011-06-20 15:12:18Z siekiera $
* 	Letzter Stand:			$Revision: 41 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-20 17:12:18 +0200 (Mon, 20 Jun 2011) $
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

function draw_input_field_installer($name, $text = '', $type = 'text', $parameters = '', $reinsert_value = true) {
	$field = '<input type="'.$type.'" name="'.$name.'"';
	if ( ($key = $GLOBALS[$name]) || ($key = $_GET[$name]) || ($key = $_POST[$name]) || ($key = $_SESSION[$name]) && ($reinsert_value) )
		$field .= ' value="'.$key.'"';
	elseif ($text != '') 
		$field .= ' value="'.$text.'"';
	
	if ($parameters) $field.= ' '.$parameters;
		$field .= ' />';

	return $field;
}
?>