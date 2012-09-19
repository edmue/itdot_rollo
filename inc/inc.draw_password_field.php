<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_password_field.inc.php 229 2011-08-31 18:07:47Z siekiera $
* 	Letzter Stand:			$Revision: 229 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-31 20:07:47 +0200 (Wed, 31 Aug 2011) $
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

function draw_password_field($name, $value = '', $parameters = '') {
	return draw_input_field($name, $value, $parameters, 'password', false);
}

function draw_password_fieldNote($name, $value = '', $parameters = '') {
	return draw_input_fieldNote($name, $value, $parameters, 'password', false);
}
?>