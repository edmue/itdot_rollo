<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: input_validation.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function input_validation($var, $type, $replace_char) {

	switch($type) {
		case 'cPath':
			$replace_param='/[^0-9_]/';
			break;
		case 'int':
			$replace_param='/[^0-9]/';
			break;
		case 'char':
			$replace_param='/[^a-zA-Z]/';
			break;
	}

	$val = preg_replace($replace_param,$replace_char,$var);

	return $val;
}
?>