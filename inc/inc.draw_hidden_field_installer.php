<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: draw_hidden_field_installer.inc.php 221 2011-08-29 17:31:01Z peter $
* 	Letzter Stand:			$Revision: 221 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-29 19:31:01 +0200 (Mon, 29 Aug 2011) $
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

function draw_hidden_field_installer($name, $value) {
	return '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
}
?>