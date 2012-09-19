<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: parse_input_field_data.inc.php 226 2011-08-30 21:37:22Z siekiera $
* 	Letzter Stand:			$Revision: 226 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-30 23:37:22 +0200 (Tue, 30 Aug 2011) $
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

function parse_input_field_data($data, $parse) {
	if((!empty($data) && !is_array($data)) && !empty($parse))
		return strtr(trim($data), $parse);
}
?>