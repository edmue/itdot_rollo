<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_hidden_field.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

   
// Output a form hidden field
  function draw_hidden_field($name, $value = '', $parameters = '') {
    $field = '<input type="hidden" name="' . parse_input_field_data($name, array('"' => '&quot;')) . '" value="';

    if (not_null($value)) {
      $field .= parse_input_field_data($value, array('"' => '&quot;'));
    } else {
      $field .= parse_input_field_data($GLOBALS[$name], array('"' => '&quot;'));
    }

    if (not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '" />';

    return $field;
  }
 ?>