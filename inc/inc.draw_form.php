<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_form.inc.php 30 2011-06-16 15:41:19Z siekiera $
* 	Letzter Stand:			$Revision: 30 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-16 17:41:19 +0200 (Thu, 16 Jun 2011) $
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

function draw_form($name, $action, $method = 'POST', $parameters = '') {
    $form = '<form id="'.parse_input_field_data($name, array('"' => '&quot;')).'" action="'.parse_input_field_data($action, array('"' => '&quot;')).'" method="'.parse_input_field_data($method, array('"' => '&quot;')).'"';

    if(not_null($parameters)) 
    	$form .= ' '.$parameters;

    $form .= '>';

    return $form;
}
?>